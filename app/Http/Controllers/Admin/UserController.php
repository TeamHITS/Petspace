<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDataTable;
use App\Helper\BreadcrumbsRegister;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Admin\RoleRepository;
use App\Repositories\Admin\UserDetailRepository;
use App\Repositories\Admin\UserRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Notification;
use App\Services\FirebaseService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Utilities\Request;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    /** ModelName */
    private $ModelName;

    /** ModelName */
    private $BreadCrumbName;

    /** @var  RoleRepository */
    private $roleRepository;

    /** @var  UserDetailRepository */
    private $userDetailRepository;

    public function __construct(UserRepository $userRepo, RoleRepository $roleRepo, UserDetailRepository $detailRepo)
    {
        $this->userRepository       = $userRepo;
        $this->userDetailRepository = $detailRepo;
        $this->roleRepository       = $roleRepo;
        $this->ModelName            = 'users';
        $this->BreadCrumbName       = 'Users';
    }

    /**
     * Display a listing of the User.
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return $userDataTable->render('admin.users.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new User.
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        $roles = $this->roleRepository->all()->where('id', '!=', '1')->pluck('display_name', 'id')->all();
        if (\Auth::id() == 2) {
            $roles = array(
                4 => "Vendor",
                6 => "Manager",
                7 => "Supervisor"
            );
        }

        return view('admin.users.create')->with([
            'title'   => $this->BreadCrumbName,
            'roles'   => $roles,
            'profile' => false,
        ]);
    }

    /**
     * Store a newly created User in storage.
     * @param CreateUserRequest $request
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        if (in_array(6, $request->roles) || in_array(7, $request->roles)) {
            $request->is_verified = 1;
        }
        $user = $this->userRepository->saveRecord($request);

        $this->userDetailRepository->saveRecord($user->id, $request);

        Flash::success('User saved successfully.');
        return redirect(route('admin.users.index'))->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Display the specified User.
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $user);
        return view('admin.users.show')->with(['title' => $this->BreadCrumbName, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified User.
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }

        $roles = $this->roleRepository->all()->where('id', '!=', '1')->pluck('display_name', 'id')->all();
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $user);

        $profile = (auth()->user()->id == $id || $id == Role::ROLE_SUPER_ADMIN) ? true : false;

        return view('admin.users.edit')->with(['user' => $user, 'title' => $this->BreadCrumbName, 'roles' => $roles, 'profile' => $profile,]);
    }

    /**
     * Update the specified User in storage.
     * @param  int $id
     * @param UpdateUserRequest $request
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $input = $request->input();

        $user = $this->userRepository->findWithoutFail($id);
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }

        $user  = $this->userRepository->updateRecord($request, $user);
        $roles = $input['roles'];

        if (is_array($roles)) {
            if (in_array(4, $roles)) {
                $user_id = $user->id;
                $title   = __('notifications.info.personal_info.title');
                $message = __('notifications.info.personal_info.message');

                Notification::create_notification($user_id, $title, $message);
                FirebaseService::sendBellNotification($user_id, $title, $message);
            }
        }

        Flash::success('User updated successfully.');
        return redirect(route('admin.users.index'))->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified User from storage.
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }

        $this->userRepository->deleteRecord($id);

        Flash::success('User deleted successfully.');
        return redirect(route('admin.users.index'))->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function profile()
    {
        $user = Auth::user();
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }
        $this->BreadCrumbName = 'Profile';

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return view('admin.users.edit')->with(['title' => $this->BreadCrumbName, 'user' => $user, 'profile' => true,]);
    }

    public function userActiveInactive($id)
    {

        $user = $this->userRepository->findWithoutFail($id);
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }
        if ($user->status == 1) {
            DB::table('users')
                ->where('id', $id)// find your user by their email
                ->limit(1)// optional - to ensure only one record is updated.
                ->update(array('status' => 0));
        } else {
            DB::table('users')
                ->where('id', $id)// find your user by their email
                ->limit(1)// optional - to ensure only one record is updated.
                ->update(array('status' => 1));
        }

        Flash::success('User updated successfully.');
        return redirect(route('admin.users.index'))->with(['title' => $this->BreadCrumbName]);
    }

    public function getVendorDataTables(Request $request)
    {
        if ($request->ajax()) {
            $data = User::join('role_user', 'users.id', '=', 'role_user.user_id')->whereNotIn('id', [1, Auth::user()->id])->where('role_user.role_id', "=", 4)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('roles', function ($user) {
                    return $user->rolesCsv;
                })
                ->editColumn('status', function ($user) {
                    if ($user->status == 1) {
                        return "Active";
                    } else {
                        return "Deactive";
                    }
                })
                ->addColumn('action', 'admin.users.datatables_actions')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.users.index');
    }

    public function getTechnicianDataTables(Request $request)
    {
        if ($request->ajax()) {
            $data = User::join('role_user', 'users.id', '=', 'role_user.user_id')->whereNotIn('id', [1, Auth::user()->id])->where('role_user.role_id', "=", 5)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('roles', function ($user) {
                    return $user->rolesCsv;
                })
                ->editColumn('status', function ($user) {
                    if ($user->status == 1) {
                        return "Active";
                    } else {
                        return "Deactive";
                    }
                })
                ->addColumn('action', 'admin.users.datatables_actions')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.users.index');
    }

    public function getManagerDataTables(Request $request)
    {
        if ($request->ajax()) {
            $data = User::join('role_user', 'users.id', '=', 'role_user.user_id')->whereNotIn('id', [1, Auth::user()->id])->where('role_user.role_id', "=", 6)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('roles', function ($user) {
                    return $user->rolesCsv;
                })
                ->editColumn('status', function ($user) {
                    if ($user->status == 1) {
                        return "Active";
                    } else {
                        return "Deactive";
                    }
                })
                ->addColumn('action', 'admin.users.datatables_actions')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.users.index');
    }

    public function getSupervisorDataTables(Request $request)
    {
        if ($request->ajax()) {
            $data = User::join('role_user', 'users.id', '=', 'role_user.user_id')->whereNotIn('id', [1, Auth::user()->id])->where('role_user.role_id', "=", 7)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('roles', function ($user) {
                    return $user->rolesCsv;
                })
                ->editColumn('status', function ($user) {
                    if ($user->status == 1) {
                        return "Active";
                    } else {
                        return "Deactive";
                    }
                })
                ->addColumn('action', 'admin.users.datatables_actions')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.users.index');
    }
}