<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\PromotionDataTable;
use App\Helper\NotificationsHelper;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreatePromotionRequest;
use App\Http\Requests\Admin\UpdatePromotionRequest;
use App\Repositories\Admin\PromotionRepository;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class PromotionController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  PromotionRepository */
    private $promotionRepository;

    public function __construct(PromotionRepository $promotionRepo)
    {
        $this->promotionRepository = $promotionRepo;
        $this->ModelName = 'promotions';
        $this->BreadCrumbName = 'Promotions';
    }

    /**
     * Display a listing of the Promotion.
     *
     * @param PromotionDataTable $promotionDataTable
     * @return Response
     */
    public function index(PromotionDataTable $promotionDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $promotionDataTable->render('admin.promotions.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new Promotion.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.promotions.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created Promotion in storage.
     *
     * @param CreatePromotionRequest $request
     *
     * @return Response
     */
    public function store(CreatePromotionRequest $request)
    {
        $devices = app('App\Repositories\Admin\UDeviceRepository')->get();
        $notificationsHelper = new NotificationsHelper();
        $notificationsHelper->sendPushNotifications($request->message, $devices);

        $promotion = $this->promotionRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        $redirect_to = redirect(route('admin.promotions.index'));

        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified Promotion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $promotion = $this->promotionRepository->findWithoutFail($id);

        if (empty($promotion)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.promotions.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $promotion);
        return view('admin.promotions.show')->with(['promotion' => $promotion, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified Promotion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $promotion = $this->promotionRepository->findWithoutFail($id);

        if (empty($promotion)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.promotions.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $promotion);
        return view('admin.promotions.edit')->with(['promotion' => $promotion, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified Promotion in storage.
     *
     * @param  int              $id
     * @param UpdatePromotionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePromotionRequest $request)
    {
        $promotion = $this->promotionRepository->findWithoutFail($id);

        if (empty($promotion)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.promotions.index'));
        }

        $promotion = $this->promotionRepository->updateRecord($request, $promotion);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.promotions.create'));
        } else {
            $redirect_to = redirect(route('admin.promotions.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified Promotion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $promotion = $this->promotionRepository->findWithoutFail($id);

        if (empty($promotion)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.promotions.index'));
        }

        $this->promotionRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.promotions.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
