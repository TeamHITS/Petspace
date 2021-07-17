<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\SubmenuListDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateSubmenuListRequest;
use App\Http\Requests\Admin\UpdateSubmenuListRequest;
use App\Repositories\Admin\SubmenuListRepository;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class SubmenuListController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  SubmenuListRepository */
    private $submenuListRepository;

    public function __construct(SubmenuListRepository $submenuListRepo)
    {
        $this->submenuListRepository = $submenuListRepo;
        $this->ModelName = 'submenu-lists';
        $this->BreadCrumbName = 'Submenu Lists';
    }

    /**
     * Display a listing of the SubmenuList.
     *
     * @param SubmenuListDataTable $submenuListDataTable
     * @return Response
     */
    public function index(SubmenuListDataTable $submenuListDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $submenuListDataTable->render('admin.submenu_lists.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new SubmenuList.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.submenu_lists.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created SubmenuList in storage.
     *
     * @param CreateSubmenuListRequest $request
     *
     * @return Response
     */
    public function store(CreateSubmenuListRequest $request)
    {
        $submenuList = $this->submenuListRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.submenu-lists.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.submenu-lists.edit', $submenuList->id));
        } else {
            $redirect_to = redirect(route('admin.submenu-lists.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified SubmenuList.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $submenuList = $this->submenuListRepository->findWithoutFail($id);

        if (empty($submenuList)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.submenu-lists.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $submenuList);
        return view('admin.submenu_lists.show')->with(['submenuList' => $submenuList, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified SubmenuList.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $submenuList = $this->submenuListRepository->findWithoutFail($id);

        if (empty($submenuList)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.submenu-lists.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $submenuList);
        return view('admin.submenu_lists.edit')->with(['submenuList' => $submenuList, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified SubmenuList in storage.
     *
     * @param  int              $id
     * @param UpdateSubmenuListRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubmenuListRequest $request)
    {
        $submenuList = $this->submenuListRepository->findWithoutFail($id);

        if (empty($submenuList)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.submenu-lists.index'));
        }

        $submenuList = $this->submenuListRepository->updateRecord($request, $submenuList);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.submenu-lists.create'));
        } else {
            $redirect_to = redirect(route('admin.submenu-lists.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified SubmenuList from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $submenuList = $this->submenuListRepository->findWithoutFail($id);

        if (empty($submenuList)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.submenu-lists.index'));
        }

        $this->submenuListRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.submenu-lists.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
