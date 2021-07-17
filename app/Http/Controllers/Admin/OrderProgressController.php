<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\OrderProgressDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateOrderProgressRequest;
use App\Http\Requests\Admin\UpdateOrderProgressRequest;
use App\Repositories\Admin\OrderProgressRepository;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class OrderProgressController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  OrderProgressRepository */
    private $orderProgressRepository;

    public function __construct(OrderProgressRepository $orderProgressRepo)
    {
        $this->orderProgressRepository = $orderProgressRepo;
        $this->ModelName = 'order-progresses';
        $this->BreadCrumbName = 'Order Progresses';
    }

    /**
     * Display a listing of the OrderProgress.
     *
     * @param OrderProgressDataTable $orderProgressDataTable
     * @return Response
     */
    public function index(OrderProgressDataTable $orderProgressDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $orderProgressDataTable->render('admin.order_progresses.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new OrderProgress.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.order_progresses.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created OrderProgress in storage.
     *
     * @param CreateOrderProgressRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderProgressRequest $request)
    {
        $orderProgress = $this->orderProgressRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.order-progresses.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.order-progresses.edit', $orderProgress->id));
        } else {
            $redirect_to = redirect(route('admin.order-progresses.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified OrderProgress.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderProgress = $this->orderProgressRepository->findWithoutFail($id);

        if (empty($orderProgress)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.order-progresses.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $orderProgress);
        return view('admin.order_progresses.show')->with(['orderProgress' => $orderProgress, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified OrderProgress.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderProgress = $this->orderProgressRepository->findWithoutFail($id);

        if (empty($orderProgress)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.order-progresses.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $orderProgress);
        return view('admin.order_progresses.edit')->with(['orderProgress' => $orderProgress, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified OrderProgress in storage.
     *
     * @param  int              $id
     * @param UpdateOrderProgressRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderProgressRequest $request)
    {
        $orderProgress = $this->orderProgressRepository->findWithoutFail($id);

        if (empty($orderProgress)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.order-progresses.index'));
        }

        $orderProgress = $this->orderProgressRepository->updateRecord($request, $orderProgress);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.order-progresses.create'));
        } else {
            $redirect_to = redirect(route('admin.order-progresses.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified OrderProgress from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderProgress = $this->orderProgressRepository->findWithoutFail($id);

        if (empty($orderProgress)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.order-progresses.index'));
        }

        $this->orderProgressRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.order-progresses.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
