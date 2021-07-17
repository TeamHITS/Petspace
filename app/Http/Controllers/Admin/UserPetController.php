<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\UserPetDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateUserPetRequest;
use App\Http\Requests\Admin\UpdateUserPetRequest;
use App\Repositories\Admin\UserPetRepository;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class UserPetController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  UserPetRepository */
    private $userPetRepository;

    public function __construct(UserPetRepository $userPetRepo)
    {
        $this->userPetRepository = $userPetRepo;
        $this->ModelName = 'user-pets';
        $this->BreadCrumbName = 'User Pets';
    }

    /**
     * Display a listing of the UserPet.
     *
     * @param UserPetDataTable $userPetDataTable
     * @return Response
     */
    public function index(UserPetDataTable $userPetDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $userPetDataTable->render('admin.user_pets.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new UserPet.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.user_pets.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created UserPet in storage.
     *
     * @param CreateUserPetRequest $request
     *
     * @return Response
     */
    public function store(CreateUserPetRequest $request)
    {
        $userPet = $this->userPetRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.user-pets.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.user-pets.edit', $userPet->id));
        } else {
            $redirect_to = redirect(route('admin.user-pets.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified UserPet.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userPet = $this->userPetRepository->findWithoutFail($id);

        if (empty($userPet)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.user-pets.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $userPet);
        return view('admin.user_pets.show')->with(['userPet' => $userPet, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified UserPet.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userPet = $this->userPetRepository->findWithoutFail($id);

        if (empty($userPet)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.user-pets.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $userPet);
        return view('admin.user_pets.edit')->with(['userPet' => $userPet, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified UserPet in storage.
     *
     * @param  int              $id
     * @param UpdateUserPetRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserPetRequest $request)
    {
        $userPet = $this->userPetRepository->findWithoutFail($id);

        if (empty($userPet)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.user-pets.index'));
        }

        $userPet = $this->userPetRepository->updateRecord($request, $userPet);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.user-pets.create'));
        } else {
            $redirect_to = redirect(route('admin.user-pets.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified UserPet from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userPet = $this->userPetRepository->findWithoutFail($id);

        if (empty($userPet)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.user-pets.index'));
        }

        $this->userPetRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.user-pets.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
