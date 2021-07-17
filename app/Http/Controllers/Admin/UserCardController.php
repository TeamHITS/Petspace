<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\UserCardDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateUserCardRequest;
use App\Http\Requests\Admin\UpdateUserCardRequest;
use App\Repositories\Admin\UserCardRepository;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class UserCardController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  UserCardRepository */
    private $userCardRepository;

    public function __construct(UserCardRepository $userCardRepo)
    {
        $this->userCardRepository = $userCardRepo;
        $this->ModelName = 'user-cards';
        $this->BreadCrumbName = 'User Cards';
    }

    /**
     * Display a listing of the UserCard.
     *
     * @param UserCardDataTable $userCardDataTable
     * @return Response
     */
    public function index(UserCardDataTable $userCardDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $userCardDataTable->render('admin.user_cards.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new UserCard.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.user_cards.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created UserCard in storage.
     *
     * @param CreateUserCardRequest $request
     *
     * @return Response
     */
    public function store(CreateUserCardRequest $request)
    {
        $userCard = $this->userCardRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.user-cards.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.user-cards.edit', $userCard->id));
        } else {
            $redirect_to = redirect(route('admin.user-cards.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified UserCard.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userCard = $this->userCardRepository->findWithoutFail($id);

        if (empty($userCard)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.user-cards.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $userCard);
        return view('admin.user_cards.show')->with(['userCard' => $userCard, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified UserCard.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userCard = $this->userCardRepository->findWithoutFail($id);

        if (empty($userCard)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.user-cards.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $userCard);
        return view('admin.user_cards.edit')->with(['userCard' => $userCard, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified UserCard in storage.
     *
     * @param  int              $id
     * @param UpdateUserCardRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserCardRequest $request)
    {
        $userCard = $this->userCardRepository->findWithoutFail($id);

        if (empty($userCard)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.user-cards.index'));
        }

        $userCard = $this->userCardRepository->updateRecord($request, $userCard);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.user-cards.create'));
        } else {
            $redirect_to = redirect(route('admin.user-cards.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified UserCard from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userCard = $this->userCardRepository->findWithoutFail($id);

        if (empty($userCard)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.user-cards.index'));
        }

        $this->userCardRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.user-cards.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
