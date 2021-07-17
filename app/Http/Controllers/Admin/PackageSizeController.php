<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\PackageSizeDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreatePackageSizeRequest;
use App\Http\Requests\Admin\UpdatePackageSizeRequest;
use App\Repositories\Admin\PackageSizeRepository;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class PackageSizeController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  PackageSizeRepository */
    private $packageSizeRepository;

    public function __construct(PackageSizeRepository $packageSizeRepo)
    {
        $this->packageSizeRepository = $packageSizeRepo;
        $this->ModelName = 'package-sizes';
        $this->BreadCrumbName = 'Package Sizes';
    }

    /**
     * Display a listing of the PackageSize.
     *
     * @param PackageSizeDataTable $packageSizeDataTable
     * @return Response
     */
    public function index(PackageSizeDataTable $packageSizeDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $packageSizeDataTable->render('admin.package_sizes.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new PackageSize.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.package_sizes.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created PackageSize in storage.
     *
     * @param CreatePackageSizeRequest $request
     *
     * @return Response
     */
    public function store(CreatePackageSizeRequest $request)
    {
        $packageSize = $this->packageSizeRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.package-sizes.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.package-sizes.edit', $packageSize->id));
        } else {
            $redirect_to = redirect(route('admin.package-sizes.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified PackageSize.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $packageSize = $this->packageSizeRepository->findWithoutFail($id);

        if (empty($packageSize)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.package-sizes.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $packageSize);
        return view('admin.package_sizes.show')->with(['packageSize' => $packageSize, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified PackageSize.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $packageSize = $this->packageSizeRepository->findWithoutFail($id);

        if (empty($packageSize)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.package-sizes.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $packageSize);
        return view('admin.package_sizes.edit')->with(['packageSize' => $packageSize, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified PackageSize in storage.
     *
     * @param  int              $id
     * @param UpdatePackageSizeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePackageSizeRequest $request)
    {
        $packageSize = $this->packageSizeRepository->findWithoutFail($id);

        if (empty($packageSize)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.package-sizes.index'));
        }

        $packageSize = $this->packageSizeRepository->updateRecord($request, $packageSize);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.package-sizes.create'));
        } else {
            $redirect_to = redirect(route('admin.package-sizes.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified PackageSize from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $packageSize = $this->packageSizeRepository->findWithoutFail($id);

        if (empty($packageSize)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.package-sizes.index'));
        }

        $this->packageSizeRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.package-sizes.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
