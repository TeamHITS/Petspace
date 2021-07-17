<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\SubmenuServiceDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateSubmenuServiceRequest;
use App\Http\Requests\Admin\UpdateSubmenuServiceRequest;
use App\Repositories\Admin\SubmenuServiceRepository;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class SubmenuServiceController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  SubmenuServiceRepository */
    private $submenuServiceRepository;

    public function __construct(SubmenuServiceRepository $submenuServiceRepo)
    {
        $this->submenuServiceRepository = $submenuServiceRepo;
        $this->ModelName = 'submenu-services';
        $this->BreadCrumbName = 'Submenu Services';
    }

    /**
     * Display a listing of the SubmenuService.
     *
     * @param SubmenuServiceDataTable $submenuServiceDataTable
     * @return Response
     */
    public function index(SubmenuServiceDataTable $submenuServiceDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $submenuServiceDataTable->render('admin.submenu_services.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new SubmenuService.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.submenu_services.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created SubmenuService in storage.
     *
     * @param CreateSubmenuServiceRequest $request
     *
     * @return Response
     */
    public function store(CreateSubmenuServiceRequest $request)
    {
        $submenuService = $this->submenuServiceRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.submenu-services.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.submenu-services.edit', $submenuService->id));
        } else {
            $redirect_to = redirect(route('admin.submenu-services.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified SubmenuService.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $submenuService = $this->submenuServiceRepository->findWithoutFail($id);

        if (empty($submenuService)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.submenu-services.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $submenuService);
        return view('admin.submenu_services.show')->with(['submenuService' => $submenuService, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified SubmenuService.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $submenuService = $this->submenuServiceRepository->findWithoutFail($id);

        if (empty($submenuService)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.submenu-services.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $submenuService);
        return view('admin.submenu_services.edit')->with(['submenuService' => $submenuService, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified SubmenuService in storage.
     *
     * @param  int              $id
     * @param UpdateSubmenuServiceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubmenuServiceRequest $request)
    {
        $submenuService = $this->submenuServiceRepository->findWithoutFail($id);

        if (empty($submenuService)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.submenu-services.index'));
        }

        $submenuService = $this->submenuServiceRepository->updateRecord($request, $submenuService);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.submenu-services.create'));
        } else {
            $redirect_to = redirect(route('admin.submenu-services.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified SubmenuService from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $submenuService = $this->submenuServiceRepository->findWithoutFail($id);

        if (empty($submenuService)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.submenu-services.index'));
        }

        $this->submenuServiceRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.submenu-services.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
