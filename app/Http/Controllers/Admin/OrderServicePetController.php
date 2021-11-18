<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\OrderServicePetDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateOrderServicePetRequest;
use App\Http\Requests\Admin\UpdateOrderServicePetRequest;
use App\Repositories\Admin\OrderServicePetRepository;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class OrderServicePetController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  OrderServicePetRepository */
    private $orderServicePetRepository;

    public function __construct(OrderServicePetRepository $orderServicePetRepo)
    {
        $this->orderServicePetRepository = $orderServicePetRepo;
        $this->ModelName = 'order-service-pets';
        $this->BreadCrumbName = 'Order Service Pets';
    }

    /**
     * Display a listing of the OrderServicePet.
     *
     * @param OrderServicePetDataTable $orderServicePetDataTable
     * @return Response
     */
    public function index(OrderServicePetDataTable $orderServicePetDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $orderServicePetDataTable->render('admin.order_service_pets.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new OrderServicePet.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.order_service_pets.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created OrderServicePet in storage.
     *
     * @param CreateOrderServicePetRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderServicePetRequest $request)
    {
        $orderServicePet = $this->orderServicePetRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.order-service-pets.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.order-service-pets.edit', $orderServicePet->id));
        } else {
            $redirect_to = redirect(route('admin.order-service-pets.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified OrderServicePet.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderServicePet = $this->orderServicePetRepository->findWithoutFail($id);

        if (empty($orderServicePet)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.order-service-pets.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $orderServicePet);
        return view('admin.order_service_pets.show')->with(['orderServicePet' => $orderServicePet, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified OrderServicePet.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderServicePet = $this->orderServicePetRepository->findWithoutFail($id);

        if (empty($orderServicePet)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.order-service-pets.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $orderServicePet);
        return view('admin.order_service_pets.edit')->with(['orderServicePet' => $orderServicePet, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified OrderServicePet in storage.
     *
     * @param  int              $id
     * @param UpdateOrderServicePetRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderServicePetRequest $request)
    {
        $orderServicePet = $this->orderServicePetRepository->findWithoutFail($id);

        if (empty($orderServicePet)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.order-service-pets.index'));
        }

        $orderServicePet = $this->orderServicePetRepository->updateRecord($request, $orderServicePet);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.order-service-pets.create'));
        } else {
            $redirect_to = redirect(route('admin.order-service-pets.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified OrderServicePet from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderServicePet = $this->orderServicePetRepository->findWithoutFail($id);

        if (empty($orderServicePet)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.order-service-pets.index'));
        }

        $this->orderServicePetRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.order-service-pets.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
