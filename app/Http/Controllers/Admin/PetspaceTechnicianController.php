<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\PetspaceTechnicianDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreatePetspaceTechnicianRequest;
use App\Http\Requests\Admin\UpdatePetspaceTechnicianRequest;
use App\Repositories\Admin\PetspaceTechnicianRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class PetspaceTechnicianController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  PetspaceTechnicianRepository */
    private $petspaceTechnicianRepository;

    public function __construct(PetspaceTechnicianRepository $petspaceTechnicianRepo)
    {
        $this->petspaceTechnicianRepository = $petspaceTechnicianRepo;
        $this->ModelName                    = 'petspace-technicians';
        $this->BreadCrumbName               = 'Petspace Technicians';
    }

    /**
     * Display a listing of the PetspaceTechnician.
     *
     * @param PetspaceTechnicianDataTable $petspaceTechnicianDataTable
     * @return Response
     */
    public function index(PetspaceTechnicianDataTable $petspaceTechnicianDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return $petspaceTechnicianDataTable->render('admin.petspace_technicians.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new PetspaceTechnician.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return view('admin.petspace_technicians.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created PetspaceTechnician in storage.
     *
     * @param CreatePetspaceTechnicianRequest $request
     *
     * @return Response
     */
    public function store(CreatePetspaceTechnicianRequest $request)
    {
        $petspaceTechnician = $this->petspaceTechnicianRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.petspace-technicians.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.petspace-technicians.edit', $petspaceTechnician->id));
        } else {
            $redirect_to = redirect(route('admin.petspace-technicians.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified PetspaceTechnician.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $petspaceTechnician = $this->petspaceTechnicianRepository->findWithoutFail($id);

        if (empty($petspaceTechnician)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.petspace-technicians.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $petspaceTechnician);
        return view('admin.petspace_technicians.show')->with(['petspaceTechnician' => $petspaceTechnician, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified PetspaceTechnician.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $petspaceTechnician = $this->petspaceTechnicianRepository->findWithoutFail($id);

        if (empty($petspaceTechnician)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.petspace-technicians.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $petspaceTechnician);
        return view('admin.petspace_technicians.edit')->with(['petspaceTechnician' => $petspaceTechnician, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified PetspaceTechnician in storage.
     *
     * @param  int $id
     * @param UpdatePetspaceTechnicianRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePetspaceTechnicianRequest $request)
    {
        $petspaceTechnician = $this->petspaceTechnicianRepository->findWithoutFail($id);

        if (empty($petspaceTechnician)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.petspace-technicians.index'));
        }

        $petspaceTechnician = $this->petspaceTechnicianRepository->updateRecord($request, $petspaceTechnician);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.petspace-technicians.create'));
        } else {
            $redirect_to = redirect(route('admin.petspace-technicians.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified PetspaceTechnician from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $petspaceTechnician = $this->petspaceTechnicianRepository->findWithoutFail($id);

        if (empty($petspaceTechnician)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.petspace-technicians.index'));
        }

        $this->petspaceTechnicianRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.petspace-technicians.index'))->with(['title' => $this->BreadCrumbName]);
    }

    public function approveTechnician($id)
    {

        $user = $this->petspaceTechnicianRepository->findWithoutFail($id);
        if (empty($user)) {
            Flash::error('Technician not found');
            return redirect(route('admin.petspace_technicians.index'));
        }

        DB::table('petspace_technicians')
            ->where('id', $id)// find your user by their email
            ->limit(1)// optional - to ensure only one record is updated.
            ->update(array('is_approved' => 1));

        Flash::success('Technician approved.');
        return redirect(route('admin.petspace_technicians.index'))->with(['title' => $this->BreadCrumbName]);
    }

    public function addArea(Request $request){

        $input =$request->toArray() ;

        DB::table('technician_areas')->insert([
            'technician_id' => $input['technician_id'],
            'min_order' => $input['min_order'],
            'delivery_fee' => $input['delivery_fee'],
            'cordinates' => $input['polygon']
        ]);
        return response(['message' => "New Area has been succussfully added"]);
    }
}
