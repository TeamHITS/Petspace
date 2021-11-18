<?php

namespace App\Http\Controllers\Web;

use App\Criteria\CalendarSlotCriteria;
use App\Models\CalendarSlots;
use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\CalendarSlotsDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateCalendarSlotRequest;
use App\Http\Requests\Admin\UpdateCalendarSlotRequest;
use App\Repositories\Admin\CalendarSlotsRepository;
use App\Repositories\Admin\PetspaceRepository;
use App\Repositories\Admin\UserRepository;


use App\Http\Controllers\AppBaseController;
use App\Models\Order;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

use Illuminate\Http\Request;

use DateTime;
use DB;

class CalendarSlotsController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  calendarSlotsRepository */
    private $calendarSlotsRepository;
    private $petspaceRepository;
    private $userRepository;

    public function __construct(CalendarSlotsRepository $calendarSlotsRepo, PetspaceRepository $petspaceRepo, UserRepository $userRepo)
    {
        $this->calendarSlotsRepository = $calendarSlotsRepo;
        $this->petspaceRepository      = $petspaceRepo;
        $this->userRepository          = $userRepo;
        $this->ModelName               = 'CalendarSlots';
        $this->BreadCrumbName          = 'CalendarSlots';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        $times_array         = $this->hoursRange('7', '23');
        $times_array_display = $this->hoursRange('7', '23', '1');
        return view('vendor.calendar.index')->with(['title' => $this->BreadCrumbName, 'times' => $times_array, 'times_for_display' => $times_array_display]);
    }

    public function getSlots(Request $request)
    {
        $userId   = \Auth::id();
        $user     = $this->userRepository->findWithoutFail($userId);
        $petspace = $this->petspaceRepository->findWhere(["user_id" => $userId])->first();

        $dt          = json_decode($request->input('dateList'));
        $times_array = $this->hoursRange('7', '23');
        //dd($dt,$times_array);
        $counter = -1;
        $dates   = array();

//        $times_array = $this->hoursRange('7', '23');

        $userId   = \Auth::id();
        $user     = $this->userRepository->findWithoutFail($userId);
        $petspace = $this->petspaceRepository->findWhere(["user_id" => $userId])->first();

        foreach ($dt as $key => $date_db) {

            //$timestamp = strtotime($date_db);
            $day            = strtolower(date('l', strtotime($date_db)));
            $date_db        .= ' 00:00:00';
            $calendar_slots = [];
            $open_time      = strtotime(reset($times_array));
            $close_time     = strtotime(end($times_array));
            for ($i = $open_time; $i < $close_time; $i += 900) {

                $start_time = date('H:i:s', $i);

                /*$calendar_slots [$i] = $aa = $this->calendarSlotsRepository->resetCriteria()->pushCriteria(new CalendarSlotCriteria([
                    'petspace_id' => $petspace->id,
                    'start_date'  => $date_db,
                    'start_time'  => $start_time,
                    'day'         => $day
                ]))->all()->toArray();*/
                /* dd("( petspace_id = ".$petspace->id." AND start_date ='".$date_db."'  AND start_time = '".$start_time."' AND (JSON_VALUE(reserved_days,'$.".$day."') = 'on'))");*/
                $bb = $this->calendarSlotsRepository->whereRaw("(petspace_id = " . $petspace->id . " AND reserved_type = 'Daily' AND start_time = '" . $start_time . "')")->get()->toArray();

                $a = $this->calendarSlotsRepository->whereRaw("(petspace_id = " . $petspace->id . " 
                                                                                        AND '" . $date_db . "' BETWEEN  start_date AND end_date  
                                                                                        AND start_time = '" . $start_time . "' 
                                                                                        AND (JSON_VALUE(reserved_days,'$." . $day . "') = 'on'))")
                    ->get()->toArray();
                // $calendar_slots [$i]= $aa = $a;
                $calendar_slots [$i] = $aa = array_merge($bb, $a);

                if (empty($aa)) {
                    $calendar_slots[$i][] = array("slot_type" => "Empty");
                }
                /*
                if(!empty($calendar_slots[$start_time][0])){

                   $slot_count = $calendar_slots[$start_time][0]['slots_count'];
                   $slot_type = $calendar_slots[$start_time][0]['slot_type'];
                   $loop_start = 1;
                   $loop_till = $loop_start + (900 * $slot_count-1);

                   for($k = $loop_start; $k < $slot_count; $k++){
                        $i+=900;
                        $start_time = date('H:i:s', $i);
                        //$calendar_slots[$i] =array(0 => array("slot_type" => "Blocked", "slots_count" => $slot_count));
                        $calendar_slots[$start_time] = array("slot_type" => $slot_type );
                   }

                   //$i = $loop_till;
                }  */

                foreach ($aa as $cs) {
                    if (!empty($cs)) {

                        $slot_count = $cs['slots_count'];
                        $slot_type  = $cs['slot_type'];
                        $loop_start = 1;
                        $loop_till  = $loop_start + (900 * $slot_count - 1);

                        for ($k = $loop_start; $k < $slot_count; $k++) {
                            $i                    += 900;
                            $calendar_slots[$i][] = array("slot_type" => $slot_type . "Extended");
                        }
                    }
                }

            }
            $dates [$key]['slots'] = $calendar_slots;
            $dates[$key]['date']   = $date_db;
        }

        $slots = '';
        foreach ($dates as $date) {
            $slots .= '<div class="calendar-col"> 
                            <div class="day-date">
                                <p class="date">' . date('d', strtotime($date['date'])) . '</p>
                                <p class="day">' . date('l', strtotime($date['date'])) . '</p>
                            </div>
                        <div class="calender-slots-wrap">';

            if (!empty($date['slots'])) {
                foreach ($date['slots'] as $key => $ss) {
                    foreach ($ss as $s) {
                        $slot[0] = $s;
                        //  dd($slot[0]);
                        if (!empty($slot[0]) && is_array($slot[0]) && $slot[0]["slot_type"] == "Blocked") {
                            $slots .= '<div class="slot-box slot-span-' . $slot[0]["slots_count"] . '">
                            <div class="slot-card blocked-slot" id="' . $slot[0]["id"] . '"
                                
                                <p> Blocked <br>' . $slot[0]["comments"] . '</p>
                                <span></span>
                            </div>
                        </div>';
                        }

                        if (!empty($slot[0]) && is_array($slot[0]) && $slot[0]["slot_type"] == "Ordered") {
                            $reserved_days = (array)json_decode(@$slot[0]['reserved_days']);

                            if ($reserved_days && $reserved_days[strtolower(date('l', strtotime($date['date'])))] == 'on' || $date['date'] == @$slot[0]['start_date']) {
                                if (@$slot[0]['reserved_type'] != "Daily") {
                                    $slots .= '<div class="slot-box slot-span-' . $slot[0]["slots_count"] . '">
                                                <div class="slot-card" id="' . $slot[0]["id"] . '">
                                                    <p style="font-size:12px">Booked</p>
                                                    <span></span>
                                                </div>
                                            </div>';
                                }
                            }
                            if ($reserved_days && @$slot[0]['reserved_type'] == "Daily" && $date['date'] >= @$slot[0]['start_date']) {
                                $slots .= '<div class="slot-box slot-span-' . $slot[0]["slots_count"] . '">
                                        <div class="slot-card" id="' . $slot[0]["id"] . '">
                                            <p style="font-size:12px">Booked</p>
                                            <span></span>
                                        </div>
                                    </div>';
                            }
                            if ($reserved_days && @$slot[0]['reserved_type'] == "Daily" && $date['date'] < @$slot[0]['start_date']) {
                                for ($l = 0; $l < $slot[0]["slots_count"]; $l++) {
                                    $slots .= '<div class="slot-box slot-span-1">
                                                <div class="empty-slot">
                                                    <p></p>
                                                </div>
                                            </div>';
                                }
                            }
                        }

                        if ($slot[0]["slot_type"] == "Empty") {

                            $slots .= '<div class="slot-box slot-span-1">
                            <div class="empty-slot">
                                <p></p>
                            </div>
                        </div>';
                        }
                    }
                }
            }
            $slots .= '</div></div>';
        }
        // dd(DB::getQueryLog());
        return json_encode(['html' => $slots, 'message' => 'Slots Data', 'data' => $dates]);
        // return json_encode($dates);
    }

    public function hoursRange($lower = 0, $upper = 23, $step = .25, $format = NULL)
    {

        if ($format === NULL) {
            $format = 'H:i'; // 9:30pm
        }
        $times = array();
        foreach (range($lower, $upper, $step) as $increment) {
            $increment = number_format($increment, 2);
            list($hour, $minutes) = explode('.', $increment);
            $date                          = new DateTime($hour . ':' . $minutes * .6);
            $times[$date->format($format)] = $date->format($format);
        }
        return $times;
    }

    public function resourceCalendar()
    {
        return view('vendor.calendar.resource-calendar')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId      = \Auth::id();
        $user        = $this->userRepository->findWithoutFail($userId);
        $petspace    = $this->petspaceRepository->findWhere(["user_id" => $userId])->first();
        $petspace_id = $petspace->id;

        $technicians = DB::table('petspace_technicians')
            ->select('petspace_technicians.id', 'users.name')
            ->join('users', 'users.id', '=', 'petspace_technicians.user_id')
            ->where('petspace_technicians.petspace_id', $petspace_id)
            ->where('petspace_technicians.status', '!=', 20)
            ->get();

        $techarray = $technicians->toArray();

        $total_technicians = count($techarray);
        if ($_GET['type'] == 'Blocked') {
            return view('vendor.calendar.blocked.create')->with(['alltechnicians' => $techarray, 'technicians_count' => $total_technicians, 'booking_count' => '1']);
        } else {
            return view('vendor.calendar.create')->with(['alltechnicians' => $techarray, 'technicians_count' => $total_technicians, 'booking_count' => '1']);
        }
        //return view('vendor.calendar.create')->with(['alltechnicians' => $techarray, 'technicians_count' => $total_technicians, 'booking_count' =>'1']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId        = \Auth::id();
        $user          = $this->userRepository->findWithoutFail($userId);
        $petspace      = $this->petspaceRepository->findWhere(["user_id" => $userId])->first();
        $petspace_id   = $petspace->id;
        $reserved_days = [
            'saturday'  => $request->input('saturday'),
            'sunday'    => $request->input('sunday'),
            'monday'    => $request->input('monday'),
            'tuesday'   => $request->input('tuesday'),
            'wednesday' => $request->input('wednesday'),
            'thursday'  => $request->input('thursday'),
            'friday'    => $request->input('friday'),
        ];
        $day           = '';

        if ((!is_null($request->input('repeat')) && $request->input('repeat') == 'No Repeat') || $request->input('slot_type') == 'Blocked') {
            $timestamp           = strtotime($request->input('event-date'));
            $day                 = strtolower(date('l', $timestamp));
            $reserved_days[$day] = 'on';

        }


        $reserved_days = json_encode($reserved_days);


        $start_date = date("Y-m-d", strtotime($request->input('event-date')));
        $end_date   = date("Y-m-d", strtotime($request->input('event-date')));

        if ($request->input('saturday') == 'on' || $request->input('sunday') == 'on' || $request->input('monday') == 'on' || $request->input('tuesday') == 'on' || $request->input('wednesday') == 'on' || $request->input('thursday') == 'on' || $request->input('friday') == 'on') {
            $end_date = date("Y-m-d", strtotime('+365 Days', strtotime($request->input('event-date'))));
        }
        if ($request->input('repeat') == 'Custom') {
            $end_date = date("Y-m-d", strtotime($request->input('event-end-date')));
        }
        if ($request->input('block_entire_day') == "on") {
            $block_entire_day = 1;
            $start_time       = '07:00';
            $end_time         = '23:00';
        } else {
            $block_entire_day = 0;
            $start_time       = $request->input('start-time');
            $end_time         = $request->input('end-time');
        }

        $slots_count = ((strtotime($end_time)) - (strtotime($start_time))) / (15 * 60);
        $end_time    = date('H:i', strtotime('-1 minutes', strtotime($end_time)));
        $data        = ['petspace_id' => $petspace_id, 'reserved_days' => $reserved_days, 'reserved_type' => $request->input('repeat'), 'total_booking_count' => $request->input('number-of-bookings'), 'start_date' => $start_date, 'end_date' => $end_date, 'start_time' => $start_time, 'end_time' => $end_time, 'block_entire_day' => $block_entire_day, 'description' => $request->input('description'), 'comments' => $request->input('comments'), 'slots_count' => $slots_count, 'slot_type' => $request->input('slot_type')];
        //dd($data);
        $result = $this->checkSlot(0, $start_time, $end_time, $start_date, $end_date, $petspace_id, $day, $reserved_days, $request->input('slot_type'));
        if (($result)) {
            $this->calendarSlotsRepository->saveRecord($data);
            Flash::success('Slot saved successfully.' . $result);
        } else {
            Flash::error('Can\'t add slot. Time range you selected is reserved');
        }
        return redirect('/calendar?start_date=' . $start_date);
    }

    public function checkSlot($slot_id, $start_time, $end_time, $start_date, $end_date, $petspace_id, $day, $reserved_days, $slot_type)
    {

        if ($day == '') {
            //dd("In If ".$day);
            $reserved_days = json_decode($reserved_days);
            $query         = '';
            $result        = '';
            foreach ($reserved_days as $key => $reserved_day) {
                if ($reserved_day == 'on') {
                    $day   = $key;
                    $query .= "(id !=" . $slot_id . "  AND petspace_id = " . $petspace_id . " AND (start_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' OR end_date BETWEEN'" . $start_date . "' AND '" . $end_date . "') AND('" . $start_time . "'  BETWEEN start_time AND end_time OR '" . $end_time . "'BETWEEN start_time AND end_time) AND (JSON_VALUE(reserved_days,'$." . $day . "') = 'on'))";

                    $result = $this->calendarSlotsRepository->whereRaw("(id !=" . $slot_id . "  AND petspace_id = " . $petspace_id . " AND (start_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' OR end_date BETWEEN'" . $start_date . "' AND '" . $end_date . "') AND('" . $start_time . "'  BETWEEN start_time AND end_time OR '" . $end_time . "'BETWEEN start_time AND end_time) AND (JSON_VALUE(reserved_days,'$." . $day . "') = 'on'))")->get();

                    if (!$result->isEmpty()) {
                        //dd($query);
                        return false;
                    }
                }
            }
            //dd("Else :".$query);
            return true;
        } else {
            //dd("In Else ".$day);
            //dd("(id !=".$slot_id."  AND petspace_id = ".$petspace_id." AND (start_date BETWEEN '".$start_date."' AND '".$end_date."' OR end_date BETWEEN'".$start_date."' AND '".$end_date."') AND ('".$start_time."'  BETWEEN start_time AND end_time OR '".$end_time."'BETWEEN start_time AND end_time) AND (JSON_VALUE(reserved_days,'$.".$day."') = 'on'))", "(id !=".$slot_id."  AND petspace_id = ".$petspace_id." AND ('".$start_date."' BETWEEN start_date AND end_date OR '".$end_date."'BETWEEN start_date AND end_date) AND ('".$start_time."'  BETWEEN start_time AND end_time OR '".$end_time."'BETWEEN start_time AND end_time) AND (JSON_VALUE(reserved_days,'$.".$day."') = 'on'))");

            if ($slot_type == "Blocked") {
                $weekly = $this->calendarSlotsRepository->whereRaw("(id !=" . $slot_id . "  
                                                                AND petspace_id = " . $petspace_id . " 
                                                                AND ('" . $start_time . "'  BETWEEN start_time AND end_time 
                                                                    OR '" . $end_time . "'BETWEEN start_time AND end_time)
                                                                AND reserved_type = 'Weekly'
                                                                AND (JSON_VALUE(reserved_days,'$." . $day . "') = 'on'))")
                    ->get();

                if (!$weekly->isEmpty()) {
                    return false;
                }
                $daily = $this->calendarSlotsRepository->whereRaw("(id !=" . $slot_id . "  
                                                                AND petspace_id = " . $petspace_id . " 
                                                                AND ('" . $start_time . "'  BETWEEN start_time AND end_time 
                                                                    OR '" . $end_time . "'BETWEEN start_time AND end_time)
                                                                AND reserved_type = 'Daily'
                                                                )")
                    ->get();

                if (!$daily->isEmpty()) {
                    return false;
                }
            }

            $result = $this->calendarSlotsRepository->whereRaw("(id !=" . $slot_id . "  
                                                                AND petspace_id = " . $petspace_id . " 
                                                                AND ('" . $start_date . "' BETWEEN start_date AND end_date 
                                                                    OR '" . $end_date . "'BETWEEN start_date AND end_date) 
                                                                AND ('" . $start_time . "'  BETWEEN start_time AND end_time 
                                                                    OR '" . $end_time . "'BETWEEN start_time AND end_time) 
                                                                AND (JSON_VALUE(reserved_days,'$." . $day . "') = 'on'))")
                ->get();

            if (!$result->isEmpty()) {
                return false;
            } else {
                return true;
            }
        }
    }

    /* public function checkslots(Request $request)
     {
         $date = $request->input('event-date');
         for($i=0; $i < 356 ; $i++)
         {
             $d = date("Y-m-d",strtotime("+$i Days",strtotime($request->input('event-date'))));
             $dt[] = $d;
         }

         $times_array = $this->hoursRange('9', '18');
         $counter = -1;
         $dates =array();

         $times_array = $this->hoursRange('9', '18');

         $userId   = \Auth::id();
         $petspace = $this->petspaceRepository->findWhere(["user_id" => $userId])->first();

         foreach($dt as $key => $date_db){
             $day = strtolower(date('l', $key));
             $date_db .= ' 00:00:00';
             $calendar_slots = [];
             $open_time = strtotime(reset($times_array));
             $close_time = strtotime(end($times_array));
             for( $i=$open_time; $i < $close_time; $i+=900) {

                 $start_time = date('H:i:s
     ', $i);

                 $calendar_slots [$i]= $this->calendarSlotsRepository->resetCriteria()->pushCriteria(new CalendarSlotCriteria([
                     'petspace_id' => $petspace->id,
                     'start_date'  => $date_db,
                     'start_time'  => $start_time,
                 ]))->all()->toArray();

                 if(!empty($calendar_slots[$i])){

                    $slot_count = $calendar_slots[$i][0]['slots_count'];
                    $slot_type = $calendar_slots[$i][0]['slot_type'];
                    $loop_start = 1;
                    $loop_till = $loop_start + (900 * $slot_count-1);

                    for($k = $loop_start; $k < $slot_count; $k++){
                         $i+=900;
                         $calendar_slots[$i] = array("slot_type" => $slot_type );
                    }
                 }
             }
              $dates [$key]['slots'] = $calendar_slots;
              $dates[$key]['date'] = $date_db;
         }

         foreach($dates as $date)
         {
              if(!empty($date['slots']))
              {
                 foreach($date['slots'] as $key => $slot)
                 {
                    if(!empty($slot[0]) && is_array($slot[0]) && $slot[0]["slot_type"] == "Blocked")
                    {
                        return false;
                    }

                     if(!empty($slot[0]) && is_array($slot[0]) && $slot[0]["slot_type"] == "Ordered")
                     {
                         $reserved_days = (array)json_decode($slot[0]['reserved_days']);

                         if($reserved_days[strtolower(date('l',strtotime($date['date'])))] == 'on' || $date['date'] == $slot[0]['start_date'])
                         {
                              return false;
                         }
                     }

                     if(empty($slot))
                     {
                         return true;
                     }
                 }
             }
         }
         return true;
     }*/


    /**
     * Display the specified resource.
     *
     * @param  \App\CalendarSlots $calendarSlots
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slot = $this->calendarSlotsRepository->find($id);
        return view('vendor.calendar.view')->with(['slot' => $slot]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CalendarSlots $calendarSlots
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userId      = \Auth::id();
        $user        = $this->userRepository->findWithoutFail($userId);
        $petspace    = $this->petspaceRepository->findWhere(["user_id" => $userId])->first();
        $petspace_id = $petspace->id;

        $technicians = DB::table('petspace_technicians')
            ->select('petspace_technicians.id', 'users.name')
            ->join('users', 'users.id', '=', 'petspace_technicians.user_id')
            ->where('petspace_technicians.petspace_id', $petspace_id)
            ->where('petspace_technicians.status', '!=', 20)
            ->get();

        $techarray = $technicians->toArray();

        $total_technicians = count($techarray);

        $slot = $this->calendarSlotsRepository->find($id);

        $slot->reserved_days = json_decode($slot->reserved_days);


        if ($slot->block_entire_day == 1) {
            $slot->block_entire_day = "checked";
        } else {
            $block_entire_day = "";
        }
        //dd($slot);
        if ($slot->slot_type == 'Ordered') {
            return view('vendor.calendar.edit')->with(['slot' => $slot, 'alltechnicians' => $techarray, 'technicians_count' => $total_technicians, 'booking_count' => $slot->total_booking_count]);
        } elseif ($slot->slot_type == 'Blocked') {
            return view('vendor.calendar.blocked.edit')->with(['slot' => $slot]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\CalendarSlots $calendarSlots
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $calendarSlots = $this->calendarSlotsRepository->find($request->input('id'));

        $reserved_days = [
            'saturday'  => $request->input('saturday'),
            'sunday'    => $request->input('sunday'),
            'monday'    => $request->input('monday'),
            'tuesday'   => $request->input('tuesday'),
            'wednesday' => $request->input('wednesday'),
            'thursday'  => $request->input('thursday'),
            'friday'    => $request->input('friday'),
        ];
        $day           = '';
        if ($request->input('repeat') == 'No Repeat' || $calendarSlots->slot_type == 'Blocked') {
            $timestamp           = strtotime($request->input('event-date'));
            $day                 = strtolower(date('l', $timestamp));
            $reserved_days[$day] = 'on';
        }
        $reserved_days = json_encode($reserved_days);

        $end_date   = date("Y-m-d", strtotime($request->input('event-date')));
        $start_date = date("Y-m-d", strtotime($request->input('event-date')));
        if ($request->input('saturday') == 'on' || $request->input('sunday') == 'on' || $request->input('monday') == 'on' || $request->input('tuesday') == 'on' || $request->input('wednesday') == 'on' || $request->input('thursday') == 'on' || $request->input('friday') == 'on') {
            $end_date = date("Y-m-d", strtotime('+365 Days', strtotime($request->input('event-date'))));
        }
        if ($request->input('repeat') == 'Custom') {
            $end_date = date("Y-m-d", strtotime($request->input('event-end-date')));
        }
        if ($request->input('block_entire_day') == "on") {
            $block_entire_day = 1;
            $start_time       = '07:00:00';
            $end_time         = '23:00:00';
        } else {
            $block_entire_day = 0;
            $start_time       = $request->input('start-time');
            $end_time         = $request->input('end-time');
        }

        $slots_count = ((strtotime($end_time)) - (strtotime($start_time))) / (15 * 60);
        $end_time    = date('H:i', strtotime('-1 minutes', strtotime($end_time)));
        $data        = ['reserved_days' => $reserved_days, 'reserved_type' => $request->input('repeat'), 'total_booking_count' => $request->input('number-of-bookings'), 'start_date' => $start_date, 'end_date' => $end_date, 'start_time' => $start_time, 'end_time' => $end_time, 'block_entire_day' => $block_entire_day, 'description' => $request->input('description'), 'comments' => $request->input('comments'), 'slots_count' => $slots_count];

        $result = $this->checkSlot($request->input('id'), $start_time, $end_time, $start_date, $end_date, $calendarSlots->petspace_id, $day, $reserved_days, $calendarSlots->slot_type);
        if (($result)) {
            $calendarSlots->update($data);
            Flash::success('Slot updated successfully.');
        } else {
            Flash::error('Can\'t update slot. Time range you selected is reserved' . $result);
        }

        return redirect('/calendar?start_date=' . $start_date);
    }

    /**
     * Modal action to add blocked slot in calendar slots
     **/
    function addBlockedSlot(CreateCalendarSlotRequest $request)
    {
        var_dump(request);
        // return;
        //  $data = $this->calendarSlotsRepository->saveRecord($request);

        //return $this->sendResponse(["Data" => $data], 'Technician assigned succussfully');

    }

    function showCalendarUI()
    {
        return view('website.calendar')->with(['title' => $this->BreadCrumbName]);

    }

    /**
     * Remove the specified Order from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        // $slot = $this->calendarSlotsRepository->find($id);
        $order = Order::where('slot_id', $id)->first();

        if ($order) {
            return $this->sendResponse("error", "slot can't be delete, there is order at that slot");
        }

        $result = $this->calendarSlotsRepository->deleteRecord($id);
        //Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return $this->sendResponse("result", $result);
    }
}
