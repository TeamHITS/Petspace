<?php

namespace App\Http\Controllers\Web;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\PetspaceTechnicianDataTable;
use App\Events\BellNotification;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreatePetspaceTechnicianRequest;
use App\Http\Requests\Admin\UpdatePetspaceTechnicianRequest;
use App\Http\Requests\Api\LoginAPIRequest;
use App\Models\Order;
use App\Models\PetspaceTechnician;
use App\Repositories\Admin\OrderProgressRepository;
use App\Repositories\Admin\OrderRepository;
use App\Repositories\Admin\PetspaceTechnicianRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Admin\UserRepository;
use App\Services\FirebaseService;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class PetspaceTechnicianController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  PetspaceTechnicianRepository */
    private $petspaceTechnicianRepository;
    private $userRepository;
    private $orderRepository;
    private $orderProgressRepository;

    public function __construct(PetspaceTechnicianRepository $petspaceTechnicianRepo, UserRepository $userRepo, OrderRepository $orderRepo, OrderProgressRepository $orderProgressRepo)
    {
        $this->petspaceTechnicianRepository = $petspaceTechnicianRepo;
        $this->userRepository               = $userRepo;
        $this->orderRepository              = $orderRepo;
        $this->orderProgressRepository      = $orderProgressRepo;
        $this->ModelName                    = 'petspace-technicians';
        $this->BreadCrumbName               = 'Petspace Technicians';
    }

    /**
     * Display a listing of the PetspaceTechnician.
     *
     * @param PetspaceTechnicianDataTable $petspaceTechnicianDataTable
     * @return Response
     */
    public function index(PetspaceTechnicianDataTable $petspaceTechnicianDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return $petspaceTechnicianDataTable->render('admin.petspace_technicians.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new PetspaceTechnician.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return view('admin.petspace_technicians.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created PetspaceTechnician in storage.
     *
     * @param CreatePetspaceTechnicianRequest $request
     *
     * @return Response
     */
    public function store(CreatePetspaceTechnicianRequest $request)
    {
        $petspaceTechnician = $this->petspaceTechnicianRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.petspace-technicians.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.petspace-technicians.edit', $petspaceTechnician->id));
        } else {
            $redirect_to = redirect(route('admin.petspace-technicians.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified PetspaceTechnician.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $petspaceTechnician = $this->petspaceTechnicianRepository->findWithoutFail($id);

        if (empty($petspaceTechnician)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.petspace-technicians.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $petspaceTechnician);
        return view('admin.petspace_technicians.show')->with(['petspaceTechnician' => $petspaceTechnician, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified PetspaceTechnician.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $petspaceTechnician = $this->petspaceTechnicianRepository->findWithoutFail($id);

        if (empty($petspaceTechnician)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.petspace-technicians.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $petspaceTechnician);
        return view('admin.petspace_technicians.edit')->with(['petspaceTechnician' => $petspaceTechnician, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified PetspaceTechnician in storage.
     *
     * @param  int $id
     * @param UpdatePetspaceTechnicianRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePetspaceTechnicianRequest $request)
    {
        $petspaceTechnician = $this->petspaceTechnicianRepository->findWithoutFail($id);

        if (empty($petspaceTechnician)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.petspace-technicians.index'));
        }

        $petspaceTechnician = $this->petspaceTechnicianRepository->updateRecord($request, $petspaceTechnician);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.petspace-technicians.create'));
        } else {
            $redirect_to = redirect(route('admin.petspace-technicians.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified PetspaceTechnician from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $petspaceTechnician = $this->petspaceTechnicianRepository->findWithoutFail($id);

        if (empty($petspaceTechnician)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.petspace-technicians.index'));
        }

        $this->petspaceTechnicianRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.petspace-technicians.index'))->with(['title' => $this->BreadCrumbName]);
    }

    public function login(LoginAPIRequest $request)
    {
        $credentials = request(['email', 'password']);
        $user        = $this->userRepository->getUserByEmail($request->email);
        if ($user->status == 0) {
            return $this->sendErrorWithData([
                "loginFailed" => "Inactive User"
            ], 403, []);
        }
        if (!Auth::attempt($credentials)) {
            return $this->sendErrorWithData([
                "loginFailed" => "Invalid Login Credentials"
            ], 403, []);
        }
        $user = \Auth::user();
        return $this->sendResponse(['user' => $user, 'url' => 'technician/home'], 'Logged in successfully');
    }

    public function home()
    {
        $userId         = \Auth::id();
        $user           = $this->petspaceTechnicianRepository->findWhere(["user_id" => $userId])->first();
        $currentDate = date('Y-m-d');
        $futureDate = date('Y-m-d',(strtotime($currentDate) + (3600*48)));
	 //echo $currentDate .'-------------'. $futureDate; die;
        $activeOrders   = $this->orderRepository->whereRaw("technician_id = ".$user->id." AND status = ". 20 . " AND DATE(date_time) BETWEEN  '" . $currentDate  ."' AND '". $futureDate."'" )->get();
        $scheduleOrders   = $this->orderRepository->whereRaw("technician_id = ".$user->id." AND status = ". 10 . " AND DATE(date_time) BETWEEN  '" . $currentDate ."' AND '". $futureDate."'")->get();

        $activeOrders   = $activeOrders->toArray();
        $scheduleOrders = $scheduleOrders->toArray();

        $orders = array_merge($activeOrders, $scheduleOrders);

        return view('technician.technician-home')->with([
            'user'   => $user->toArray(),
            'orders' => $orders,
            'title'  => "Home"

        ]);
    }

    public function orderDetail($id)
    {
        $userId = \Auth::id();
        $user   = $this->petspaceTechnicianRepository->findWhere(["user_id" => $userId])->first();
        $order  = $this->orderRepository->findWhere(["id" => $id])->first();

//                dd($order->toArray());
        return view('technician.technician-single-order')->with([
            'user'  => $user->toArray(),
            'order' => $order->toArray()

        ]);
    }

    public function accountDetail()
    {
        $userId = \Auth::id();
        $user   = $this->petspaceTechnicianRepository->findWhere(["user_id" => $userId])->first();


        return view('technician.technician-account')->with([
            'user' => $user->toArray()
        ]);
    }

    public function orderProgress($id, $progress)
    {
        $userId     = \Auth::id();
        $user       = $this->petspaceTechnicianRepository->findWhere(["user_id" => $userId])->first();
        $technician = $this->petspaceTechnicianRepository->findWhere(["user_id" => $userId])->first();
        $order      = $this->orderRepository->findWhere(["id" => $id])->first();

        $isActiveOrder = $this->orderRepository->findWhere(["technician_id" => $technician->id, "status" => Order::ACTIVE])->first();

        //dd($order->toArray());
        if (isset($isActiveOrder) && $isActiveOrder->id != $id) {
            return view('technician.technician-single-order')->with([
                'user'  => $user->toArray(),
                'order' => $order->toArray()
            ]);
        }
        $progressData = array(
            "order_id"        => $id,
            "progress_status" => $progress,
            "date_time"       => date("Y-m-d H:i:s")
        );
        if (!isset($isActiveOrder)) {
            $this->orderRepository->update(array("status" => Order::ACTIVE, "progress_status" => $progress), $id);

            $technician->status = PetspaceTechnician::DELIVERY;
            $technician->save();
            $this->orderProgressRepository->create($progressData);
        } else if ($isActiveOrder->progress_status < $progress && isset(Order::$PROGRESS_STATUS[$progress])) {
            $this->orderRepository->update(array("progress_status" => $progress), $id);
            $this->orderProgressRepository->create($progressData);
        }

        $order         = $this->orderRepository->findWhere(["id" => $id])->first();
        $orderProgress = $this->orderProgressRepository->orderBy('progress_status')->findWhere(["order_id" => $id]);

        return view('technician.technician-start-order')->with([
            'user'          => $user->toArray(),
            'order'         => $order->toArray(),
            'orderProgress' => $orderProgress->toArray()
        ]);
    }

    public function endOrder($id)
    {
        $userId     = \Auth::id();
        $user       = $this->petspaceTechnicianRepository->findWhere(["user_id" => $userId])->first();
        $technician = $this->petspaceTechnicianRepository->findWhere(["user_id" => $userId])->first();
        $order      = $this->orderRepository->findWhere(["id" => $id])->first();

        if (isset($order) && $order->progress_status != 40) {
            return view('technician.technician-single-order')->with([
                'user'  => $user->toArray(),
                'order' => $order->toArray()
            ]);
        } else {
            $technician->status = PetspaceTechnician::AVAILABLE;
            $technician->save();
            $this->orderRepository->update(array("status" => Order::COMPLETE), $id);
        }
        return redirect('/technician/home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/technician/login');
    }
}
