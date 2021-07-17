<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\UserAddressDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateUserAddressRequest;
use App\Http\Requests\Admin\UpdateUserAddressRequest;
use App\Repositories\Admin\UserAddressRepository;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class UserAddressController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  UserAddressRepository */
    private $userAddressRepository;

    public function __construct(UserAddressRepository $userAddressRepo)
    {
        $this->userAddressRepository = $userAddressRepo;
        $this->ModelName = 'user-addresses';
        $this->BreadCrumbName = 'User Addresses';
    }

    /**
     * Display a listing of the UserAddress.
     *
     * @param UserAddressDataTable $userAddressDataTable
     * @return Response
     */
    public function index(UserAddressDataTable $userAddressDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $userAddressDataTable->render('admin.user_addresses.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new UserAddress.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.user_addresses.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created UserAddress in storage.
     *
     * @param CreateUserAddressRequest $request
     *
     * @return Response
     */
    public function store(CreateUserAddressRequest $request)
    {
        $userAddress = $this->userAddressRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.user-addresses.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.user-addresses.edit', $userAddress->id));
        } else {
            $redirect_to = redirect(route('admin.user-addresses.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified UserAddress.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userAddress = $this->userAddressRepository->findWithoutFail($id);

        if (empty($userAddress)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.user-addresses.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $userAddress);
        return view('admin.user_addresses.show')->with(['userAddress' => $userAddress, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified UserAddress.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userAddress = $this->userAddressRepository->findWithoutFail($id);

        if (empty($userAddress)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.user-addresses.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $userAddress);
        return view('admin.user_addresses.edit')->with(['userAddress' => $userAddress, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified UserAddress in storage.
     *
     * @param  int              $id
     * @param UpdateUserAddressRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserAddressRequest $request)
    {
        $userAddress = $this->userAddressRepository->findWithoutFail($id);

        if (empty($userAddress)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.user-addresses.index'));
        }

        $userAddress = $this->userAddressRepository->updateRecord($request, $userAddress);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.user-addresses.create'));
        } else {
            $redirect_to = redirect(route('admin.user-addresses.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified UserAddress from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userAddress = $this->userAddressRepository->findWithoutFail($id);

        if (empty($userAddress)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.user-addresses.index'));
        }

        $this->userAddressRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.user-addresses.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
