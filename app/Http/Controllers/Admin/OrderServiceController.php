<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\OrderServiceDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateOrderServiceRequest;
use App\Http\Requests\Admin\UpdateOrderServiceRequest;
use App\Repositories\Admin\OrderServiceRepository;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class OrderServiceController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  OrderServiceRepository */
    private $orderServiceRepository;

    public function __construct(OrderServiceRepository $orderServiceRepo)
    {
        $this->orderServiceRepository = $orderServiceRepo;
        $this->ModelName = 'order-services';
        $this->BreadCrumbName = 'Order Services';
    }

    /**
     * Display a listing of the OrderService.
     *
     * @param OrderServiceDataTable $orderServiceDataTable
     * @return Response
     */
    public function index(OrderServiceDataTable $orderServiceDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $orderServiceDataTable->render('admin.order_services.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new OrderService.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.order_services.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created OrderService in storage.
     *
     * @param CreateOrderServiceRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderServiceRequest $request)
    {
        $orderService = $this->orderServiceRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.order-services.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.order-services.edit', $orderService->id));
        } else {
            $redirect_to = redirect(route('admin.order-services.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified OrderService.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderService = $this->orderServiceRepository->findWithoutFail($id);

        if (empty($orderService)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.order-services.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $orderService);
        return view('admin.order_services.show')->with(['orderService' => $orderService, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified OrderService.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderService = $this->orderServiceRepository->findWithoutFail($id);

        if (empty($orderService)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.order-services.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $orderService);
        return view('admin.order_services.edit')->with(['orderService' => $orderService, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified OrderService in storage.
     *
     * @param  int              $id
     * @param UpdateOrderServiceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderServiceRequest $request)
    {
        $orderService = $this->orderServiceRepository->findWithoutFail($id);

        if (empty($orderService)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.order-services.index'));
        }

        $orderService = $this->orderServiceRepository->updateRecord($request, $orderService);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.order-services.create'));
        } else {
            $redirect_to = redirect(route('admin.order-services.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified OrderService from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderService = $this->orderServiceRepository->findWithoutFail($id);

        if (empty($orderService)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.order-services.index'));
        }

        $this->orderServiceRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.order-services.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
