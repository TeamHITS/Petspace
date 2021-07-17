<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\PackageTypeDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreatePackageTypeRequest;
use App\Http\Requests\Admin\UpdatePackageTypeRequest;
use App\Repositories\Admin\PackageTypeRepository;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class PackageTypeController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  PackageTypeRepository */
    private $packageTypeRepository;

    public function __construct(PackageTypeRepository $packageTypeRepo)
    {
        $this->packageTypeRepository = $packageTypeRepo;
        $this->ModelName = 'package-types';
        $this->BreadCrumbName = 'Package Types';
    }

    /**
     * Display a listing of the PackageType.
     *
     * @param PackageTypeDataTable $packageTypeDataTable
     * @return Response
     */
    public function index(PackageTypeDataTable $packageTypeDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $packageTypeDataTable->render('admin.package_types.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new PackageType.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.package_types.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created PackageType in storage.
     *
     * @param CreatePackageTypeRequest $request
     *
     * @return Response
     */
    public function store(CreatePackageTypeRequest $request)
    {
        $packageType = $this->packageTypeRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.package-types.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.package-types.edit', $packageType->id));
        } else {
            $redirect_to = redirect(route('admin.package-types.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified PackageType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $packageType = $this->packageTypeRepository->findWithoutFail($id);

        if (empty($packageType)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.package-types.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $packageType);
        return view('admin.package_types.show')->with(['packageType' => $packageType, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified PackageType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $packageType = $this->packageTypeRepository->findWithoutFail($id);

        if (empty($packageType)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.package-types.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $packageType);
        return view('admin.package_types.edit')->with(['packageType' => $packageType, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified PackageType in storage.
     *
     * @param  int              $id
     * @param UpdatePackageTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePackageTypeRequest $request)
    {
        $packageType = $this->packageTypeRepository->findWithoutFail($id);

        if (empty($packageType)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.package-types.index'));
        }

        $packageType = $this->packageTypeRepository->updateRecord($request, $packageType);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.package-types.create'));
        } else {
            $redirect_to = redirect(route('admin.package-types.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified PackageType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $packageType = $this->packageTypeRepository->findWithoutFail($id);

        if (empty($packageType)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.package-types.index'));
        }

        $this->packageTypeRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.package-types.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
