<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\CategoryServiceDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateCategoryServiceRequest;
use App\Http\Requests\Admin\UpdateCategoryServiceRequest;
use App\Repositories\Admin\CategoryServiceRepository;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;
use App\Criteria\CategoryServiceCriteria;
use App\Models\UserPet;
class CategoryServiceController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  CategoryServiceRepository */
    private $categoryServiceRepository;

    public function __construct(CategoryServiceRepository $categoryServiceRepo)
    {
        $this->categoryServiceRepository = $categoryServiceRepo;
        $this->ModelName = 'category-services';
        $this->BreadCrumbName = 'Category Services';
    }

    /**
     * Display a listing of the CategoryService.
     *
     * @param CategoryServiceDataTable $categoryServiceDataTable
     * @return Response
     */
    public function index(CategoryServiceDataTable $categoryServiceDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $categoryServiceDataTable->render('admin.category_services.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new CategoryService.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.category_services.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created CategoryService in storage.
     *
     * @param CreateCategoryServiceRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryServiceRequest $request)
    {
        $categoryService = $this->categoryServiceRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.category-services.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.category-services.edit', $categoryService->id));
        } else {
            $redirect_to = redirect(route('admin.category-services.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified CategoryService.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categoryService = $this->categoryServiceRepository->findWithoutFail($id);

        if (empty($categoryService)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.category-services.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $categoryService);
        return view('admin.category_services.show')->with(['categoryService' => $categoryService, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified CategoryService.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categoryService = $this->categoryServiceRepository->findWithoutFail($id);

        if (empty($categoryService)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.category-services.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $categoryService);
        return view('admin.category_services.edit')->with(['categoryService' => $categoryService, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified CategoryService in storage.
     *
     * @param  int              $id
     * @param UpdateCategoryServiceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryServiceRequest $request)
    {
        $categoryService = $this->categoryServiceRepository->findWithoutFail($id);

        if (empty($categoryService)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.category-services.index'));
        }

        $categoryService = $this->categoryServiceRepository->updateRecord($request, $categoryService);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.category-services.create'));
        } else {
            $redirect_to = redirect(route('admin.category-services.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified CategoryService from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $categoryService = $this->categoryServiceRepository->findWithoutFail($id);

        if (empty($categoryService)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.category-services.index'));
        }

        $this->categoryServiceRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.category-services.index'))->with(['title' => $this->BreadCrumbName]);
    }

    public function getServicesWithAddon($user_id,$id)
    {
        $categoryService = $this->categoryServiceRepository->resetCriteria()
            ->pushCriteria(new CategoryServiceCriteria(
                [
                    'with_submenu' => true,
                    'category_id' => $id
                ]
            ))->get();

            $userpets = UserPet::where('user_id',$user_id)->get();
            //dd($userpets);
        $view = view('admin.orders.modalbody', compact('categoryService','userpets'))->render();
        return response()->json(['code' => 1, 'html'=>$view]);
    }
}
