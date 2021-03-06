<?php

namespace App\Http\Controllers\Web;

use App\Criteria\OrderCriteria;
use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\PetspaceDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreatePetspaceRequest;
use App\Http\Requests\Admin\UpdatePetspaceRequest;
use App\Jobs\GetGoogleReviews;
use App\Models\Order;
use App\Models\Petspace;
use App\Models\PetspaceTechnician;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CategoryServiceRepository;
use App\Repositories\Admin\OrderRepository;
use App\Repositories\Admin\PetspaceRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Notification;
use App\Repositories\Admin\PetspaceTechnicianRepository;
use App\Repositories\Admin\SubmenuListRepository;
use App\Repositories\Admin\SubmenuServiceRepository;
use App\Repositories\Admin\UserDetailRepository;
use App\Repositories\Admin\UserRepository;
use App\Repositories\Admin\UserAddressRepository;
use App\Services\FirebaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;
use Location\Coordinate;
use Location\Polygon;

class PetspaceController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  PetspaceRepository */
    private $petspaceRepository;

    private $userRepository;
    private $userDetailRepository;
    private $userAddressRepository;

    private $petspaceTechnicianRepository;
    private $orderRepository;
    private $categoryRepository;
    private $submenuListRepository;
    private $categoryServiceRepository;
    private $submenuServiceRepository;

    public function __construct(PetspaceRepository $petspaceRepo, UserDetailRepository $userDetailRepo, UserRepository $userRepo, PetspaceTechnicianRepository $petspaceTechnicianRepo, OrderRepository $orderRepo, CategoryRepository $categoryRepo, CategoryServiceRepository $categoryServiceRepo, SubmenuListRepository $submenuListRepo, SubmenuServiceRepository $submenuServiceRepo, UserAddressRepository $userAddressRepository)
    {
        $this->petspaceRepository           = $petspaceRepo;
        $this->userRepository               = $userRepo;
        $this->userAddressRepository        = $userAddressRepository;
        $this->userDetailRepository         = $userDetailRepo;
        $this->petspaceTechnicianRepository = $petspaceTechnicianRepo;
        $this->orderRepository              = $orderRepo;
        $this->categoryRepository           = $categoryRepo;
        $this->categoryServiceRepository    = $categoryServiceRepo;
        $this->submenuListRepository        = $submenuListRepo;
        $this->submenuServiceRepository     = $submenuServiceRepo;
        $this->ModelName                    = 'petspaces';
        $this->BreadCrumbName               = 'Petspaces';
    }

    /**
     * Display a listing of the Petspace.
     *
     * @param PetspaceDataTable $petspaceDataTable
     * @return Response
     */
    public function index(PetspaceDataTable $petspaceDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return $petspaceDataTable->render('admin.petspaces.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new Petspace.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return view('admin.petspaces.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created Petspace in storage.
     *
     * @param CreatePetspaceRequest $request
     *
     * @return Response
     */
    public function store(CreatePetspaceRequest $request)
    {
        $input = $request->all();
        $id   = \Auth::id();
        $user = $this->userRepository->findWithoutFail($id);
        if (empty($user)) {
            Flash::error('User not found');
            return $this->sendErrorWithData(['User not found!']);
        }

        $user = $this->userDetailRepository->updateRecord($id, $request);
        $request->request->add(['user_id' => $id]);
        $request->request->add(['name' => $request->name]);

        if(isset($input['latitude'])){

            $name = str_replace(' ', '%20', $request->name);
            $url = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?inputtype=textquery&fields=photos,formatted_address,name,opening_hours,rating&locationbias=circle:2000@" . $request->latitude . ",%20" . $request->longitude . "&key=AIzaSyAtE6o_3Gvd8ud0Xt_NJcpAiNPik03Ubuk&input=". $name;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_HTTPHEADER     => array(
                    "Postman-Token: ed685e3b-46b1-41fd-bbde-bc7233a4d3c7",
                    "cache-control: no-cache"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                $request->request->add(['google_rating' => 0]);
            } else {
                $response = json_decode($response);
                if($response->status == "OK"){
                    $request->request->add(['google_rating' => $response->candidates[0]->rating]);
                }else{
                    $request->request->add(['google_rating' => 0]);
                }
            }
        }

        $petspace = $this->petspaceRepository->saveRecord($request);

        return $this->sendResponse(['petspace' => $petspace, 'url' => 'dashboard'], 'Store detail updated successfully.');
    }

    /**
     * Display the specified Petspace.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $petspace = $this->petspaceRepository->findWithoutFail($id);

        if (empty($petspace)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.petspaces.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $petspace);
        return view('admin.petspaces.show')->with(['petspace' => $petspace, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified Petspace.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $petspace = $this->petspaceRepository->findWithoutFail($id);

        if (empty($petspace)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.petspaces.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $petspace);
        return view('admin.petspaces.edit')->with(['petspace' => $petspace, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified Petspace in storage.
     *
     * @param  int $id
     * @param UpdatePetspaceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePetspaceRequest $request)
    {
        $petspace = $this->petspaceRepository->findWithoutFail($id);

        if (empty($petspace)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect('/store-setting');
        }

        $petspace = $this->petspaceRepository->updateRecord($request, $petspace);

        if (isset($request->continue)) {
            $redirect_to = redirect(route('web.petspaces.create'));
        } else {
            $redirect_to = redirect(route('web.petspaces.index'));
        }
        return $this->sendResponse(['petspace' => $petspace, 'url' => 'store-setting'], 'Store detail updated successfully.');
    }

    /**
     * Remove the specified Petspace from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $petspace = $this->petspaceRepository->findWithoutFail($id);

        if (empty($petspace)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.petspaces.index'));
        }

        $this->petspaceRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.petspaces.index'))->with(['title' => $this->BreadCrumbName]);
    }

    public function dashboard()
    {
        $userId   = \Auth::id();
        $user     = $this->userRepository->findWithoutFail($userId);
        $petspace = $this->petspaceRepository->findWhere(["user_id" => $userId])->first();
        if (empty($petspace)) {
            return redirect('/setup-store');
        }
        $scheduleOrders = Order::where(['petspace_id' => $petspace->id, "status" => Order::SCHEDULE])
            ->whereNotNull('technician_id')->get();

        $newOrders = Order::where(['petspace_id' => $petspace->id, "status" => Order::SCHEDULE])
            ->whereNull('technician_id')->get();
        //        dd($newOrders->toArray());
        $activeOrders = $this->orderRepository->findWhere(["petspace_id" => $petspace->id, "status" => Order::ACTIVE]);
//        $order      = $this->orderRepository->findWhere(["id" => $id])->first();

        return view('website.dashboard')->with([
            'user'           => $user->toArray(),
            'petspace'       => $petspace->toArray(),
            'scheduleOrders' => $scheduleOrders->toArray(),
            'activeOrders'   => $activeOrders->toArray(),
            'newOrders'      => $newOrders->toArray(),
            'title'          => "Dashboard"

        ]);
    }

    public function setupStore()
    {
        $userId = \Auth::id();
        $user   = $this->userRepository->findWithoutFail($userId);
        return view('website.store-setup')->with(['user' => $user->toArray()]);
    }

    public function technician()
    {
        $userId   = \Auth::id();
        $user     = $this->userRepository->findWithoutFail($userId);
        $petspace = $this->petspaceRepository->findWhere(["user_id" => $userId])->first();

        $technicians          = $this->petspaceTechnicianRepository->findWhere(["petspace_id" => $petspace->id]);
        $availableTechnicians = $this->petspaceTechnicianRepository->findWhere(["petspace_id" => $petspace->id, "status" => PetspaceTechnician::AVAILABLE]);
        $inactiveTechnicians  = $this->petspaceTechnicianRepository->findWhere(["petspace_id" => $petspace->id, "status" => PetspaceTechnician::INACTIVE]);
        $deliveryTechnicians  = $this->petspaceTechnicianRepository->findWhere(["petspace_id" => $petspace->id, "status" => PetspaceTechnician::DELIVERY]);

        if (empty($petspace)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('website.booking'));
        }

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $petspace);
//dd( $technicians->toArray());
        return view('website.technician')->with(['user'                 => $user->toArray(),
                                                 'technicians'          => $technicians->toArray(),
                                                 'availableTechnicians' => $availableTechnicians->toArray(),
                                                 'inactiveTechnicians'  => $inactiveTechnicians->toArray(),
                                                 'deliveryTechnicians'  => $deliveryTechnicians->toArray(),
                                                 'title'                => "Technicians"]);
    }

    //Modals
    public function addTechnicianModal()
    {
        $view = view('website.layouts.add-technician-modal');
        return $this->sendResponse($view->render(), '');
    }

    public function editTechnicianModal($id)
    {
        $technician = $this->petspaceTechnicianRepository->findWhere(["user_id" => $id])->first();

        $view       = view('website.layouts.edit-technician-modal')->with(['technician' => $technician]);
        return $this->sendResponse($view->render(), '');
    }

    public function deleteTechnicianModal($id)
    {
        $view = view('website.layouts.delete-technician-modal')->with(['user_id' => $id]);
        return $this->sendResponse($view->render(), '');
    }

    public function assignTechModal($id)
    {
        $order = $this->orderRepository->findWhere(["id" => $id])->first();

        $userAddress = $this->userAddressRepository->findWhere(["id" => $order->user_address_id])->first();

        $latitude = $userAddress->latitude;

        $longitude = $userAddress->longitude;

        $techniciansArray = [];

        $technicians = DB::table('petspace_technicians')
            ->select('petspace_technicians.id', 'users.name')
            ->join('users', 'users.id', '=', 'petspace_technicians.user_id')
            ->where('petspace_technicians.petspace_id', $order->petspace_id)
            ->where('petspace_technicians.status', '!=', 20)
            ->get();

        $techarray = $technicians->toArray();

        foreach ($techarray as $tech) {
            $techniciansArray[] = $tech;
        }
        $technicians = $this->getGeoFencing($latitude, $longitude, $techniciansArray);

        $view = view('website.layouts.assign-tech-modal')->with(['order' => $order->toArray(), 'technicians' => $technicians, 'alltechnicians' => $techarray]);
        return $this->sendResponse($view->render(), '');
    }

    public function getGeoFencing($latitude, $longitude, $technicians)
    {
        $insidePoint   = new Coordinate($latitude, $longitude);
        $technicianids = [];
        foreach ($technicians as $tech) {

            $techId = $tech->id;

            $areas = DB::table('technician_areas')
                ->where('technician_id', '=', $techId)
                ->get();

            $geofence = new Polygon();
            foreach ($areas as $key => $coordinates) {
                $coordinates = json_decode($coordinates->cordinates, true);
                foreach ($coordinates as $coordinate) {
                    $lat = $coordinate[0];
                    $lng = $coordinate[1];
                    $geofence->addPoint(new Coordinate($lat, $lng));

                }

                if ($geofence->contains($insidePoint)) {
                    $technicianids[$techId]['id']   = $techId;
                    $technicianids[$techId]['name'] = $tech->name;

                }
            }

        }
        return $technicianids;

    }

    public function activeOrderModal($id)
    {
        $order = $this->orderRepository->findWhere(["id" => $id])->first();
//        dd($order->toArray());
        $view = view('website.layouts.active-order-modal')->with(['order' => $order]);
        return $this->sendResponse($view->render(), '');
    }

    public function scheduleOrderModal($id)
    {
        $order       = $this->orderRepository->findWhere(["id" => $id])->first();
        $technicians = DB::table('petspace_technicians')
            ->select('petspace_technicians.id', 'users.name')
            ->join('users', 'users.id', '=', 'petspace_technicians.user_id')
            ->where('petspace_technicians.petspace_id', $order->petspace_id)
            ->where('petspace_technicians.status', '!=', 20)
            ->get();

//        dd($order->toArray());
        $view = view('website.layouts.schedule-order-modal')->with(['order' => $order, 'technicians' => $technicians->toArray()]);
        return $this->sendResponse($view->render(), '');
    }

    // //Modals Action
    public function addTechnician(Request $request)
    {
        $userId   = \Auth::id();
        $user     = $this->userRepository->findWithoutFail($userId);
        $petspace = $this->petspaceRepository->findWhere(["user_id" => $userId])->first();

        $request->request->add(['roles' => [5]]);

        $name = $request->input('first_name') . " " . $request->input('last_name');
        $request->request->add(['name' => $name]);
        $technician = $this->userRepository->saveRecord($request);
        $this->userDetailRepository->saveRecord($technician->id, $request);

        $data = array(
            "user_id"     => $technician->id,
            "petspace_id" => $petspace->id,
            "status"      => 10
        );
        $this->petspaceTechnicianRepository->saveRecord($data);

        return response(['message' => "New technician has been succussfully added"]);
    }

    public function editTechnician(Request $request)
    {
        $userId             = $request->input('id');
        $user               = $this->userRepository->findWithoutFail($userId);
        $petspaceTechnician = $this->petspaceTechnicianRepository->findWhere(["user_id" => $userId])->first();

        $serviceAssignment             = $request->input('service_assignment');
        $request['service_assignment'] = ($serviceAssignment != null) ? true : false;

        if (empty($petspaceTechnician)) {
            Flash::error('Technician not found');
            return $this->sendErrorWithData(['Technician not found!']);
        }
        $petspaceTechnician = $this->petspaceTechnicianRepository->updateRecord($request, $petspaceTechnician);

        $name = $request->input('first_name') . " " . $request->input('last_name');
        $request->request->add(['name' => $name]);

        if ($request->has('first_name')) {

            if ($request->has('user_status')) {
                $request->request->add(['status' => 1]);
            } else {
                $request->request->add(['status' => 0]);
            }
            $this->userRepository->updateRecord($request, $user);
        }
        if ($this->userDetailRepository->updateRecord($userId, $request)) {
            if ($request->has('device_token')) {
                $this->uDevice->saveRecord(\Auth::id(), $request);
            }
            $title = __('notifications.info.personal_info.title');
            $message =  __('notifications.info.personal_info.message');

            Notification::create_notification($userId, $title, $message);
            FirebaseService::sendBellNotification($userId, $title, $message);

            return response(['message' => "Technician updated succussfully"]);
        }
        return $this->sendErrorWithData(['Something Went Wrong!']);
    }

    public function deletetTechnician(Request $request)
    {
        $userId             = $request->input('id');
        $user               = $this->userRepository->findWithoutFail($userId);
        $petspaceTechnician = $this->petspaceTechnicianRepository->findWhere(["user_id" => $userId])->first();


        if (empty($petspaceTechnician)) {
            Flash::error('Technician not found');
            return $this->sendErrorWithData(['Technician not found!']);
        } else if ($petspaceTechnician->status == PetspaceTechnician::DELIVERY) {
            return $this->sendErrorWithData(['Technician is on delivery!']);
        }
        $this->petspaceTechnicianRepository->deleteRecord($petspaceTechnician->id);

        return $this->sendResponse(['url' => 'technician'], 'Technician deleted succussfully');
//        return response(['message' => "Technician deleted succussfully"]);

    }

    public function assignTechnician(Request $request)
    {
        $order_id = $request->input('order_id');
        $order    = $this->orderRepository->findWithoutFail($order_id);
        
        if (empty($order)) {
            Flash::error('Technician not found');
            return $this->sendErrorWithData(['Order not found!']);
        }
        $order = $this->orderRepository->updateRecord($request, $order);
        
        $technicians = PetspaceTechnician::where('id',$request->technician_id)->first(); 
        $technician_id = $technicians->user_id;
        $title = __('notifications.order.assign_order.title');
        $message =  __('notifications.order.assign_order.message');

        Notification::create_notification($technician_id, $title, $message);
        FirebaseService::sendBellNotification($technician_id, $title, $message);

        return $this->sendResponse(['url' => '/order/' . $order_id], 'Technician assigned succussfully');
//        return response(['message' => "Technician deleted succussfully"]);

    }


    public function storeSetting()
    {
        $userId   = \Auth::id();
        $user     = $this->userRepository->findWithoutFail($userId);
        $petspace = $this->petspaceRepository->findWhere(["user_id" => $userId])->first();

        if (empty($petspace)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('website.booking'));
        }

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $petspace);
        return view('website.store-setting')->with(['user' => $user->toArray(), 'petspace' => $petspace->toArray(), 'title' => "Store Settings"]);
    }

    public function updatePetspaces(\Illuminate\Http\Request $request)
    {
        $id       = $request->input('id');
        $petspace = $this->petspaceRepository->findWithoutFail($id);

        if (empty($petspace)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect('/store-setting');
        }

        $petspace = $this->petspaceRepository->updateRecord($request, $petspace);

        return $this->sendResponse(['petspace' => $petspace, 'url' => 'store-setting'], 'Store detail updated successfully.');
    }

    public function orderList()
    {
        $userId   = \Auth::id();
        $user     = $this->userRepository->findWithoutFail($userId);
        $petspace = $this->petspaceRepository->findWhere(["user_id" => $userId])->first();

        $technicians = $this->petspaceTechnicianRepository->findWhere(["petspace_id" => $petspace->id]);
//        $orders      = $this->orderRepository->findWhere(["petspace_id" => $petspace->id])->orderBy('id', 'desc');

        $orders = $this->orderRepository->resetCriteria()->pushCriteria(new OrderCriteria([
            'petspace_id' => $petspace->id,
            'latest'      => 1,
        ]))->all();

//        dd($orders->toArray());
        return view('website.order-list')->with(['technicians' => $technicians->toArray(), 'orders' => $orders->toArray(), 'title' => "Orders"]);
    }

    public function orderDetail($id)
    {

        $order       = $this->orderRepository->findWhere(["id" => $id])->first();
        $technicians = $this->petspaceTechnicianRepository->findWhere(["petspace_id" => $order->petspace_id]);
        //dd($technicians->toArray());
        return view('website.order-detail')->with(['order' => $order->toArray(), 'technicians' => $technicians->toArray(), 'title' => "Orders"]);
    }

    public function serviceMenu()
    {
        $userId   = \Auth::id();
        $petspace = $this->petspaceRepository->findWhere(["user_id" => $userId])->first();

        $category = $this->categoryRepository->findWhere(["petspace_id" => $petspace->id]);

//        dd($category->toArray());
        return view('website.service-menu')->with([
            'categories' => $category->toArray(),
            'petspace'   => $petspace->toArray(),
            'title'      => "Service Menu"]);
    }

    public function submenu($id)
    {
        $userId          = \Auth::id();
        $categoryService = $this->categoryServiceRepository->findWhere(["id" => $id])->first();
        $submenu         = $this->submenuListRepository->findWhere(["cat_service_id" => $id]);

//        dd($submenu->toArray());
        return view('website.service-sub-menu')->with([
            'service'  => $categoryService->toArray(),
            'submenus' => $submenu->toArray(),
            'title'    => "Service Menu"]);
    }

    public function getGoogleReviews()
    {
        GetGoogleReviews::dispatch();
    }

    public function updateServiceStock(Request $request)
    {

        $input = $request->toArray();
        foreach ($input['data'] as $data) {
            $categoryService = $this->categoryServiceRepository->findWhere(["id" => $data['id']])->first();

            $categoryService = $this->categoryServiceRepository->updateRecord($data, $categoryService);
        }
        return $this->sendResponse([], 'Detail updated successfully.');
    }

    public function updateSubServiceStock(Request $request)
    {

        $input = $request->toArray();
        foreach ($input['data'] as $data) {
            $service = $this->submenuServiceRepository->findWhere(["id" => $data['id']])->first();

            $subService = $this->submenuServiceRepository->updateRecord($data, $service);
        }
        return $this->sendResponse([], 'Detail updated successfully.');
    }

    public function getOrderList(Request $request)
    {

//        dd($request->all());
        $userId   = \Auth::id();
        $petspace = $this->petspaceRepository->findWhere(["user_id" => $userId])->first();
        $where    = array(
            "petspace_id" => $petspace->id
        );
        if (isset($request->status)) {
            $where['status'] = $request->status;
        }
        if (isset($request->tech)) {
            $where['technician_id'] = $request->tech;
        }
        $orders = $this->orderRepository->findWhere($where);
        $orders = $orders->toArray();
        $result = array();
        foreach ($orders as $order) {
            if ($order['date_time'] >= $request->start && $order['date_time'] <= $request->end) {
                $result[] = array(
                    "order_id"   => $order['id'],
                    "service"    => $order['services'][0]['service_name'],
                    "date"       => date('d-m-Y', strtotime($order['date_time'])),
                    "time"       => date('H:i', strtotime($order['date_time'])),
                    "technician" => ($order['technician']) ? $order['technician']['user']['name'] : "",
                    "status"     => '<span class="pill ' . $order["status_lable_color"] . '">' . $order["status_text"] . '</span>'
                );
            }
        }

        return $this->sendResponse(["orders" => $result], 'Detail updated successfully.');
//        $orders      = $this->orderRepository->findWhereBetween('date_time', [$request->start, $request->end]);
//        $orders = DB::table('orders')
//            ->where('date_time', '>=', $request->start)
//            ->where('date_time', '<=', $request->end)->get();
//        dd($result);
    }

    public function getTechnicianMinOrderFee($id)
    {
        $areas = DB::select('select * from petspace.technician_areas where min_order=(select max(min_order) from petspace.technician_areas where technician_id = ' . $id . ')');

        $technicianids = [];
        if (count($areas) > 0) {
            foreach ($areas as $key => $value) {
                $technicianids['id']           = $id;
                $technicianids['min_order']    = $value->min_order;
                $technicianids['delivery_fee'] = $value->delivery_fee;
            }
        }
        return response()->json(['status' => true, 'data' => $technicianids]);
    }

    /**
     * Show the form for editing the specified Petspace.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function calendar()
    {

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, []);
        return view('admin.petspaces.calendar')->with(['petspace' => [], 'title' => $this->BreadCrumbName]);
    }
}
