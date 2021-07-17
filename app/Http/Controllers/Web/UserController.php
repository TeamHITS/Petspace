<?php

namespace App\Http\Controllers\Web;

use App\DataTables\Admin\UserDataTable;
use App\Helper\BreadcrumbsRegister;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Requests\Api\ForgotPasswordCodeRequest;
use App\Http\Requests\Api\LoginAPIRequest;
use App\Http\Requests\Api\UpdateForgotPasswordRequest;
use App\Http\Requests\Api\VerifyCodeRequest;
use App\Models\Role;
use App\Repositories\Admin\RoleRepository;
use App\Repositories\Admin\UserDetailRepository;
use App\Repositories\Admin\UserRepository;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 * @package App\Http\Controllers\Web
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
        $this->userRepository = $userRepo;
        $this->userDetailRepository = $detailRepo;
        $this->roleRepository = $roleRepo;
        $this->ModelName = 'users';
        $this->BreadCrumbName = 'Users';
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
        return view('admin.users.create')->with([
            'title' => $this->BreadCrumbName,
            'roles' => $roles,
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
        $user = $this->userRepository->findWithoutFail($id);
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }

        $this->userRepository->updateRecord($request, $user);

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

    public function updateVendorInfo(Request $request)
    {
        $id = \Auth::id();
        $user = $this->userRepository->findWithoutFail($id);
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('/store-setting'));
        }

        $this->userDetailRepository->updateRecord($id, $request);

        return $this->sendResponse(['user' => $user,'url' => 'store-setting'], 'User detail updated.');
    }

    /**
     * @param LoginAPIRequest $request
     * @return mixed
     */
    public function login(LoginAPIRequest $request)
    {
        $credentials = request(['email', 'password']);
        $user = $this->userRepository->getUserByEmail($request->email);
        if($user->status == 0){
            return $this->sendErrorWithData([
                "loginFailed" => "Inactive User"
            ], 403, []);
        }
        if (!Auth::attempt($credentials)) {
            return $this->sendErrorWithData([
                "loginFailed" => "Invalid Login Credentials"
            ], 403, []);
        }
        $user = \Auth::user();
        return $this->sendResponse(['user' => $user, 'url' => ''], 'Logged in successfully');
    }

    public function getForgetPasswordCode(ForgotPasswordCodeRequest $request)
    {
        $user = $this->userRepository->getUserByEmail($request->email);
        if (!$user) {

            return $this->sendErrorWithData(["Email" => "Email address not found."], 403);
        }

        $code = rand(1111, 9999);

        $subject = "Forgot Password Verification Code";
        try {
            $email = $user->email;
            $name  = $user->name;

            $check = DB::table('password_resets')->where('email', $email)->first();
            if ($check) {
                DB::table('password_resets')->where('email', $email)->delete();
            }

            DB::table('password_resets')->insert(['email' => $email, 'code' => $code, 'created_at' => Carbon::now()]);
            Mail::send('email.verify', ['name' => $user->name, 'verification_code' => $code],
                function ($mail) use ($email, $name, $subject) {
                    $mail->from(getenv('MAIL_FROM_ADDRESS'), getenv('APP_NAME'));
                    $mail->to($email, $name);
                    $mail->subject($subject);
                });
        } catch (\Exception $e) {
            return $this->sendErrorWithData(["loginEmail" => $e->getMessage()], 403, []);
        }
//        $this->sendErrorWithData([
//            "loginFailed" => "Password and Confirm Password must be same."
//        ], 403, []);
        return $this->sendResponse(['url' => 'verify-code'], 'Verification Code Send To Your Email');
    }

    public function verifyCode(VerifyCodeRequest $request)
    {
        $code = $request->verification_code;

        $check = DB::table('password_resets')->where('code', $code)->first();
        if (!is_null($check)) {
            $data['email'] = $check->email;
            $data['code']  = "valid";
            $url           = base64_encode('email=' . $check->email . '&key=' . $code);
//            DB::table('password_resets')->where('code', $check->email)->delete();
            return $this->sendResponse(['user' => $data, 'url' => 'reset-password?' . $url], 'Verified');
        } else {
            return $this->sendErrorWithData(['Code Is Invalid'], 403);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resetPassword(Request $request)
    {
        $inputs = $request->all();
        $params = explode("&", base64_decode(array_key_first($inputs)));
        $email  = explode("=", $params[0]);
        $code   = explode("=", $params[1]);

        $data = [
            "email" => $email[1],
            "key"   => $code[1],

        ];
        return view('website.new-password')->with(['data' => $data]);
    }

    public function updatePassword(UpdateForgotPasswordRequest $request)
    {
        $code = $request->verification_code;

        $check = DB::table('password_resets')->where(['code' => $code, 'email' => $request->email])->first();
        if (!is_null($check)) {
            $postData['password'] = bcrypt($request->password);
            try {
                $data = $this->userRepository->getUserByEmail($request->email);
                $user = $this->userRepository->update($postData, $data->id);
                DB::table('password_resets')->where(['code' => $code, 'email' => $request->email])->delete();

                return $this->sendResponse(['user' => $user, 'url' => 'login'], 'Password Changed');
            } catch (\Exception $e) {
                return $this->sendErrorWithData([$e->getMessage()], 403);
            }
        } else {
            return $this->sendErrorWithData(['Code Is Invalid'], 403);
        }
    }

    public function updateVendorPasword(Request $request)
    {
        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {

            if($request->new_password == $request->confirm_password){

                $this->userRepository->update(['password' => bcrypt($request->new_password)], $user->id);
                return $this->sendResponse(['url' => 'store-setting'], 'Password Successfully Updated');
            }
            return $this->sendErrorWithData(['Password and confirm password should be same'], 403);
        }else {
            return $this->sendErrorWithData(['Current Password Is Invalid'], 403);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}