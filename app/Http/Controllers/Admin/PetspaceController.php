<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PetspaceTechnicianDataTable;
use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\PetspaceDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreatePetspaceRequest;
use App\Http\Requests\Admin\UpdatePetspaceRequest;
use App\Models\PetspaceTechnician;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\CategoryServiceRepository;
use App\Repositories\Admin\OrderRepository;
use App\Repositories\Admin\PetspaceRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Admin\PetspaceTechnicianRepository;
use App\Repositories\Admin\SettingRepository;
use App\Repositories\Admin\SubmenuListRepository;
use App\Repositories\Admin\SubmenuServiceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class PetspaceController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  PetspaceRepository */
    private $petspaceRepository;
    private $categoryRepository;
    private $categoryServiceRepository;
    private $submenuListRepository;
    private $submenuServiceRepository;
    private $petspaceTechnicianRepository;
    private $settingRepository;
    private $orderRepository;

    public function __construct(PetspaceRepository $petspaceRepo,
                                CategoryRepository $categoryRepo,
                                CategoryServiceRepository $categoryServiceRepos,
                                SubmenuListRepository $submenuListRepo,
                                SubmenuServiceRepository $submenuServiceRepo,
                                PetspaceTechnicianRepository $petspaceTechnicianRepo,
                                SettingRepository $settingRepo,
                                OrderRepository $orderRepo
    )
    {
        $this->petspaceRepository           = $petspaceRepo;
        $this->categoryRepository           = $categoryRepo;
        $this->categoryServiceRepository    = $categoryServiceRepos;
        $this->submenuListRepository        = $submenuListRepo;
        $this->submenuServiceRepository     = $submenuServiceRepo;
        $this->petspaceTechnicianRepository = $petspaceTechnicianRepo;
        $this->settingRepository            = $settingRepo;
        $this->orderRepository              = $orderRepo;
        $this->ModelName                    = 'petspaces';
        $this->BreadCrumbName               = 'Petspaces';
    }

    /**
     * Display a listing of the Petspace.
     *
     * @param PetspaceDataTable $petspaceDataTable
     * @return Response
     */
    public function index(PetspaceDataTable $petspaceDataTable)
    {

        $setting = $this->settingRepository->first();

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return $petspaceDataTable->render('admin.petspaces.index', ['title' => "Shops", "is_shops_open" => $setting->is_shops_open, "settings" => $setting]);
    }

    /**
     * Show the form for creating a new Petspace.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return view('admin.petspaces.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created Petspace in storage.
     *
     * @param CreatePetspaceRequest $request
     *
     * @return Response
     */
    public function store(CreatePetspaceRequest $request)
    {
        $petspace = $this->petspaceRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.petspaces.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.petspaces.edit', $petspace->id));
        } else {
            $redirect_to = redirect(route('admin.petspaces.index'));
        }
        return $redirect_to->with([
            'title' => "Shops"
        ]);
    }

    /**
     * Display the specified Petspace.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id, PetspaceTechnicianDataTable $petspaceTechnicianDataTable)
    {
        $petspace = $this->petspaceRepository->findWithoutFail($id);

        if (empty($petspace)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.petspaces.index'));
        }

        $petspaceTechnicianDataTable->petspace_id = $petspace->id;

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $petspace);
        return $petspaceTechnicianDataTable->render('admin.petspaces.show', [
            'petspace' => $petspace,
            'title'    => "Shops"
        ]);

//        return view('admin.petspaces.show')->with(['petspace' => $petspace, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified Petspace.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $petspace = $this->petspaceRepository->findWithoutFail($id);
        if (empty($petspace)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.petspaces.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $petspace);
        return view('admin.petspaces.edit')->with(['petspace' => $petspace, 'title' => "Shops"]);
    }

    /**
     * Update the specified Petspace in storage.
     *
     * @param  int $id
     * @param UpdatePetspaceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePetspaceRequest $request)
    {
        $petspace = $this->petspaceRepository->findWithoutFail($id);

        if (empty($petspace)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.petspaces.index'));
        }

        $petspace = $this->petspaceRepository->updateRecord($request, $petspace);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.petspaces.create'));
        } else {
            $redirect_to = redirect(route('admin.petspaces.index'));
        }
        return $redirect_to->with(['title' => "Shops"]);
    }

    /**
     * Remove the specified Petspace from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $petspace = $this->petspaceRepository->findWithoutFail($id);

        if (empty($petspace)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.petspaces.index'));
        }

        $this->petspaceRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.petspaces.index'))->with(['title' => $this->BreadCrumbName]);
    }

    public function menuBuilder($id)
    {
        $petspace = $this->petspaceRepository->findWithoutFail($id);
        $category = $this->categoryRepository->findWhere(["petspace_id" => $petspace->id]);

        if (empty($petspace)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.petspaces.index'));
        }
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $petspace);
        return view('admin.petspaces.menu-builder')->with([
            'categories' => $category->toArray(),
            'petspace'   => $petspace->toArray(),
            'title'      => 'Service Menu']);
    }

    public function submenuBuilder($id)
    {
        $categoryService = $this->categoryServiceRepository->findWhere(["id" => $id])->first();
        $submenu         = $this->submenuListRepository->findWhere(["cat_service_id" => $id]);

//        dd($submenu->toArray());
        return view('admin.petspaces.submenu')->with([
            'service'  => $categoryService->toArray(),
            'submenus' => $submenu->toArray(),
            'title'    => "Service Submenu"]);
    }


    public function addCategoryModal($petspaceId, $categoryId = 0)
    {
        $view = view('admin.layouts.add-new-category-modal')->with(["petspaceId" => $petspaceId]);
        return $this->sendResponse($view->render(), '');
    }

    public function addServiceModal($categoryId = 0, $serviceId = 0)
    {
        $view = view('admin.layouts.add-new-service-modal')->with(["categoryId" => $categoryId]);
        return $this->sendResponse($view->render(), '');
    }

    public function addSubmenuModal($catServiceId)
    {
        $view = view('admin.layouts.add-new-submenu-modal')->with(["catServiceId" => $catServiceId]);
        return $this->sendResponse($view->render(), '');
    }

    public function addSubmenuServiceModal($submenuId = 0)
    {
        $view = view('admin.layouts.add-new-submenu-service-modal')->with(["submenuId" => $submenuId]);
        return $this->sendResponse($view->render(), '');
    }

    public function addCategory(Request $request)
    {
        $category = $this->categoryRepository->saveRecord($request);
        return response(['message' => "New category has been succussfully added"]);
    }

    public function addService(Request $request)
    {
        $service = $this->categoryServiceRepository->saveRecord($request);
        if (!$service) {
            return response(['message' => "failed"]);
        }
        return response(['message' => "New service has been succussfully added"]);
    }

    public function addSubmenu(Request $request)
    {
        $service = $this->submenuListRepository->saveRecord($request);
        if (!$service) {
            return response(['message' => "failed"]);
        }
        return response(['message' => "New submenu has been succussfully added"]);
    }

    public function addSubmenuService(Request $request)
    {
        $service = $this->submenuServiceRepository->saveRecord($request);
        if (!$service) {
            return response(['message' => "failed"]);
        }
        return response(['message' => "New service has been succussfully added"]);
    }


    /*EDIT MODAL START*/
    public function editCategoryModal($id)
    {
        $category = $this->categoryRepository->findWithoutFail($id);
        $view     = view('admin.layouts.edit-category-modal')->with(["category" => $category->toArray()]);
        return $this->sendResponse($view->render(), '');
    }

    public function editServiceModal($id)
    {
        $service = $this->categoryServiceRepository->findWithoutFail($id);
//        dd($service->toArray());
        $view = view('admin.layouts.edit-service-modal')->with(["service" => $service->toArray()]);
        return $this->sendResponse($view->render(), '');
    }

    public function editSubmenuModal($id)
    {
        $submenu = $this->submenuListRepository->findWithoutFail($id);
        $view    = view('admin.layouts.edit-submenu-modal')->with(["submenu" => $submenu->toArray()]);
        return $this->sendResponse($view->render(), '');
    }

    public function editSubmenuServiceModal($id)
    {
        $service = $this->submenuServiceRepository->findWithoutFail($id);
        $view    = view('admin.layouts.edit-submenu-service-modal')->with(["service" => $service]);
        return $this->sendResponse($view->render(), '');
    }

    public function deleteService($id)
    {
        $service  = $this->categoryServiceRepository->findWithoutFail($id);
        $category = $this->categoryRepository->findWithoutFail($service->category_id);
        $this->categoryServiceRepository->deleteRecord($id);
        return redirect(url('admin/petspaces/service-menu') . '/' . $category->petspace_id);
    }

    public function deleteSubmenuService($id)
    {
        $service = $this->submenuServiceRepository->findWithoutFail($id);
        $submenu = $this->submenuListRepository->findWithoutFail($service->submenu_id);
        $this->submenuServiceRepository->deleteRecord($id);
        return redirect(url('admin/petspaces/service-submenu') . '/' . $submenu->cat_service_id);
    }

    public function updateCategory(Request $request)
    {

        $category = $this->categoryRepository->findWithoutFail($request->id);
        $category = $this->categoryRepository->updateRecord($request, $category);
        if (!$category) {
            return response(['message' => "failed"]);
        }
        return response(['message' => "Category succussfully updated"]);

    }

    public function updateService(Request $request)
    {

        $service = $this->categoryServiceRepository->findWithoutFail($request->id);
        if (!$service) {
            return response(['message' => "failed"]);
        }
        $service = $this->categoryServiceRepository->updateRecord($request, $service);

        return response(['message' => "Category service updated"]);

    }

    public function updateSubmenu(Request $request)
    {

        $submenu = $this->submenuListRepository->findWithoutFail($request->id);
        if (!$submenu) {
            return response(['message' => "failed"]);
        }
        $submenu = $this->submenuListRepository->updateRecord($request, $submenu);

        return response(['message' => "Submenu updated"]);

    }

    public function updateSubmenuService(Request $request)
    {

        $service = $this->submenuServiceRepository->findWithoutFail($request->id);
        if (!$service) {
            return response(['message' => "failed"]);
        }
        $service = $this->submenuServiceRepository->updateRecord($request, $service);

        return response(['message' => "Submenu Service updated"]);

    }

    public function approvePetspace($id)
    {

        $user = $this->petspaceRepository->findWithoutFail($id);
        if (empty($user)) {
            Flash::error('Shop not found');
            return redirect(route('admin.petspaces.index'));
        }

        DB::table('petspaces')
            ->where('id', $id)// find your user by their email
            ->limit(1)// optional - to ensure only one record is updated.
            ->update(array('is_approved' => 1));

        Flash::success('Shop approved.');
        return redirect(route('admin.petspaces.index'))->with(['title' => $this->BreadCrumbName]);
    }

    public function mapRestriction($id)
    {
        $petspace    = $this->petspaceRepository->findWithoutFail($id);
        $technicians = $this->petspaceTechnicianRepository->findWhere(array("petspace_id" => $id));
//        $areas = DB::table('technician_areas')
//            ->where('technician_id', '=', $id)
//            ->get();
        if (empty($petspace)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.petspaces.index'));
        }
//        dd($areas->toArray());
        return view('admin.petspace_technicians.technician_map')->with(['petspace' => $petspace->toArray(), 'technicians' => $technicians->toArray(), 'title' => $this->BreadCrumbName]);
    }

    public function getTechnicianAreas($id)
    {
        $areas = DB::table('technician_areas')
            ->where('technician_id', '=', $id)
            ->get();

        return $this->sendResponse(["areas" => $areas], 'Promo Code deleted successfully');
    }

    public function shopOpenClose($id)
    {

        if ($id == 1) {
            $affected = DB::table('settings')
                ->update(['is_shops_open' => 1]);
        } else if ($id == 2) {
            $affected = DB::table('settings')
                ->update(['is_shops_open' => 0]);
        }
        return $this->sendResponse([], 'Updated successfully');
    }

    public function shopTimings(Request $request)
    {
//        dd($request->all());
        $input = $request->all();

       $settings = DB::table('settings')
            ->update(['start_time' => $input['start_time'],'close_time' => $input['close_time']]);
        return redirect(route('admin.petspaces.index'))->with(['title' => $this->BreadCrumbName]);
    }

    public function reviews($id)
    {
        $review = DB::table('orders')
            ->whereNotNull(['rating'])
            ->where('petspace_id', '=', $id)
            ->where('rating', '>', 0)
            ->get();

//        dd($review->toArray());
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return view('admin.petspaces.reviews')->with(['reviews' => $review->toArray(),"petspace_id" => $id,'title' => $this->BreadCrumbName]);
    }

    public function getReviewDataTables($id)
    {
        $review = DB::table('orders')
            ->whereNotNull(['rating'])
            ->where('petspace_id', '=', $id)
            ->where('rating', '>', 0)
            ->latest()->get();

            return Datatables::of($review)
                ->make(true);

//        return view('admin.users.index');
    }
}
