<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\PackageAddonDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreatePackageAddonRequest;
use App\Http\Requests\Admin\UpdatePackageAddonRequest;
use App\Repositories\Admin\PackageAddonRepository;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class PackageAddonController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  PackageAddonRepository */
    private $packageAddonRepository;

    public function __construct(PackageAddonRepository $packageAddonRepo)
    {
        $this->packageAddonRepository = $packageAddonRepo;
        $this->ModelName = 'package-addons';
        $this->BreadCrumbName = 'Package Addons';
    }

    /**
     * Display a listing of the PackageAddon.
     *
     * @param PackageAddonDataTable $packageAddonDataTable
     * @return Response
     */
    public function index(PackageAddonDataTable $packageAddonDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $packageAddonDataTable->render('admin.package_addons.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new PackageAddon.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.package_addons.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created PackageAddon in storage.
     *
     * @param CreatePackageAddonRequest $request
     *
     * @return Response
     */
    public function store(CreatePackageAddonRequest $request)
    {
        $packageAddon = $this->packageAddonRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.package-addons.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.package-addons.edit', $packageAddon->id));
        } else {
            $redirect_to = redirect(route('admin.package-addons.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified PackageAddon.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $packageAddon = $this->packageAddonRepository->findWithoutFail($id);

        if (empty($packageAddon)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.package-addons.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $packageAddon);
        return view('admin.package_addons.show')->with(['packageAddon' => $packageAddon, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified PackageAddon.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $packageAddon = $this->packageAddonRepository->findWithoutFail($id);

        if (empty($packageAddon)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.package-addons.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $packageAddon);
        return view('admin.package_addons.edit')->with(['packageAddon' => $packageAddon, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified PackageAddon in storage.
     *
     * @param  int              $id
     * @param UpdatePackageAddonRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePackageAddonRequest $request)
    {
        $packageAddon = $this->packageAddonRepository->findWithoutFail($id);

        if (empty($packageAddon)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.package-addons.index'));
        }

        $packageAddon = $this->packageAddonRepository->updateRecord($request, $packageAddon);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.package-addons.create'));
        } else {
            $redirect_to = redirect(route('admin.package-addons.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified PackageAddon from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $packageAddon = $this->packageAddonRepository->findWithoutFail($id);

        if (empty($packageAddon)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.package-addons.index'));
        }

        $this->packageAddonRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.package-addons.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
