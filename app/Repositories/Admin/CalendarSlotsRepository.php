<?php

namespace App\Repositories\Admin;

use App\Models\CalendarSlots;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CalendarSlotsRepository
 * @package App\Repositories\Admin
 * @version March 17, 2021, 9:17 pm UTC
 *
 * @method CalendarSlots findWithoutFail($id, $columns = ['*'])
 * @method CalendarSlots find($id, $columns = ['*'])
 * @method CalendarSlots first($columns = ['*'])
*/
class CalendarSlotsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        "petspace_id",
        "start_time",
        "end_time", 
        "start_date", 
        "end_date",
        "slots_count" , 
       /*"order_ids", 
        "assigned_technicians_ids",*/ 
        "reserved_days", 
        "reserved_type", 
        "total_booking_count",
        "available_booking_count", 
        "comments", 
        "slot_type"
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CalendarSlots::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        if(is_array($request)){
            $input = $request;
        }else{
            $input = $request->all();
        }
        $CalendarSlots = $this->create($input);
        
        return $CalendarSlots;
    }

    /**
     * @param $request
     * @param $CalendarSlots
     * @return mixed
     */
    public function updateRecord($request, $CalendarSlots)
    {
        if(is_array($request)){
            $input = $request;
        }else{
            $input = $request->all();
        }
        $CalendarSlots = $this->update($input, $CalendarSlots->id);
        return $CalendarSlots;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $CalendarSlots = $this->delete($id);
        return $CalendarSlots;
    }
}
