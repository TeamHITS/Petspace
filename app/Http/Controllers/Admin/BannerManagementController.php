<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\BannerManagementDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateBannerManagementRequest;
use App\Http\Requests\Admin\UpdateBannerManagementRequest;
use App\Repositories\Admin\BannerManagementRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class BannerManagementController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  BannerManagementRepository */
    private $bannerManagementRepository;

    public function __construct(BannerManagementRepository $bannerManagementRepo)
    {
        $this->bannerManagementRepository = $bannerManagementRepo;
        $this->ModelName                  = 'banner-managements';
        $this->BreadCrumbName             = 'Banner Managements';
    }

    /**
     * Display a listing of the BannerManagement.
     *
     * @param BannerManagementDataTable $bannerManagementDataTable
     * @return Response
     */
    public function index(BannerManagementDataTable $bannerManagementDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return $bannerManagementDataTable->render('admin.banner_managements.index', ['title' => "Banner Management"]);
    }

    /**
     * Show the form for creating a new BannerManagement.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return view('admin.banner_managements.create')->with(['title' => "Banner Management"]);
    }

    /**
     * Store a newly created BannerManagement in storage.
     *
     * @param CreateBannerManagementRequest $request
     *
     * @return Response
     */
    public function store(CreateBannerManagementRequest $request)
    {
        $bannerManagement = $this->bannerManagementRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.banner-managements.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.banner-managements.edit', $bannerManagement->id));
        } else {
            $redirect_to = redirect(route('admin.banner-managements.index'));
        }
        return $redirect_to->with([
            'title' => "Banner Management"
        ]);
    }

    /**
     * Display the specified BannerManagement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bannerManagement = $this->bannerManagementRepository->findWithoutFail($id);

        if (empty($bannerManagement)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.banner-managements.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $bannerManagement);
        return view('admin.banner_managements.show')->with(['bannerManagement' => $bannerManagement, 'title' => "Banner Management"]);
    }

    /**
     * Show the form for editing the specified BannerManagement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bannerManagement = $this->bannerManagementRepository->findWithoutFail($id);

        if (empty($bannerManagement)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.banner-managements.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $bannerManagement);
        return view('admin.banner_managements.edit')->with(['bannerManagement' => $bannerManagement, 'title' => "Banner Management"]);
    }

    /**
     * Update the specified BannerManagement in storage.
     *
     * @param  int $id
     * @param UpdateBannerManagementRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBannerManagementRequest $request)
    {
        $bannerManagement = $this->bannerManagementRepository->findWithoutFail($id);

        if (empty($bannerManagement)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.banner-managements.index'));
        }

        $bannerManagement = $this->bannerManagementRepository->updateRecord($request, $bannerManagement);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.banner-managements.create'));
        } else {
            $redirect_to = redirect(route('admin.banner-managements.index'));
        }
        return $redirect_to->with(['title' => "Banner Management"]);
    }

    /**
     * Remove the specified BannerManagement from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bannerManagement = $this->bannerManagementRepository->findWithoutFail($id);

        if (empty($bannerManagement)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.banner-managements.index'));
        }

        $this->bannerManagementRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.banner-managements.index'))->with(['title' => "Banner Management"]);
    }

    public function bannerActiveInactive($id)
    {

        $banner = $this->bannerManagementRepository->findWithoutFail($id);
        if (empty($banner)) {
            Flash::error('Banner not found');
            return redirect(route('admin.banner-managements.index'));
        }
        if ($banner->status == 1) {
            DB::table('banner_managements')
                ->where('id', $id)
                ->limit(1)
                ->update(array('status' => 0));
        } else {
            DB::table('banner_managements')
                ->where('id', $id)
                ->limit(1)
                ->update(array('status' => 1));
        }

        Flash::success('Banner updated successfully.');
        return redirect(route('admin.banner-managements.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
