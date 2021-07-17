<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\OrderServiceAddonDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateOrderServiceAddonRequest;
use App\Http\Requests\Admin\UpdateOrderServiceAddonRequest;
use App\Repositories\Admin\OrderServiceAddonRepository;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class OrderServiceAddonController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  OrderServiceAddonRepository */
    private $orderServiceAddonRepository;

    public function __construct(OrderServiceAddonRepository $orderServiceAddonRepo)
    {
        $this->orderServiceAddonRepository = $orderServiceAddonRepo;
        $this->ModelName = 'order-service-addons';
        $this->BreadCrumbName = 'Order Service Addons';
    }

    /**
     * Display a listing of the OrderServiceAddon.
     *
     * @param OrderServiceAddonDataTable $orderServiceAddonDataTable
     * @return Response
     */
    public function index(OrderServiceAddonDataTable $orderServiceAddonDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $orderServiceAddonDataTable->render('admin.order_service_addons.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new OrderServiceAddon.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.order_service_addons.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created OrderServiceAddon in storage.
     *
     * @param CreateOrderServiceAddonRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderServiceAddonRequest $request)
    {
        $orderServiceAddon = $this->orderServiceAddonRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.order-service-addons.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.order-service-addons.edit', $orderServiceAddon->id));
        } else {
            $redirect_to = redirect(route('admin.order-service-addons.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified OrderServiceAddon.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderServiceAddon = $this->orderServiceAddonRepository->findWithoutFail($id);

        if (empty($orderServiceAddon)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.order-service-addons.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $orderServiceAddon);
        return view('admin.order_service_addons.show')->with(['orderServiceAddon' => $orderServiceAddon, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified OrderServiceAddon.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderServiceAddon = $this->orderServiceAddonRepository->findWithoutFail($id);

        if (empty($orderServiceAddon)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.order-service-addons.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $orderServiceAddon);
        return view('admin.order_service_addons.edit')->with(['orderServiceAddon' => $orderServiceAddon, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified OrderServiceAddon in storage.
     *
     * @param  int              $id
     * @param UpdateOrderServiceAddonRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderServiceAddonRequest $request)
    {
        $orderServiceAddon = $this->orderServiceAddonRepository->findWithoutFail($id);

        if (empty($orderServiceAddon)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.order-service-addons.index'));
        }

        $orderServiceAddon = $this->orderServiceAddonRepository->updateRecord($request, $orderServiceAddon);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.order-service-addons.create'));
        } else {
            $redirect_to = redirect(route('admin.order-service-addons.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified OrderServiceAddon from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderServiceAddon = $this->orderServiceAddonRepository->findWithoutFail($id);

        if (empty($orderServiceAddon)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.order-service-addons.index'));
        }

        $this->orderServiceAddonRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.order-service-addons.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
