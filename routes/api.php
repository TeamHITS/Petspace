<?php

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Images Resize Route
Route::get('/resize/{img}', function ($img) {

    ob_end_clean();
    try {
        $w      = request()->get('w');
        $h      = request()->get('h');
        $crop   = request()->get('crop', false);
        $method = ($crop) ? "fit" : "resize";
        if ($h && $w) {
            // Image Handler lib
            return Image::make(asset("storage/app/$img"))->$method($w, $h, function ($c) {
                $c->upsize();
                $c->aspectRatio();
            })->response('png');
        } else {
            return response(file_get_contents(storage_path("/app/$img")))
                ->header('Content-Type', 'image/png');
        }

    } catch (\Exception $e) {
//        dd($e->getMessage());
        return abort(404, $e->getMessage());
    }
})->name('resize')->where('img', '(.*)');


/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

## No Token Required
Route::post('v1/register', 'AuthAPIController@register')->name('register');

Route::post('v1/login', 'AuthAPIController@login')->name('login');
Route::post('v1/social_login', 'AuthAPIController@socialLogin')->name('socialLogin');
Route::get('v1/check-email', 'AuthAPIController@checkEmail')->name('checkEmail');

Route::get('v1/forget-password', 'AuthAPIController@getForgetPasswordCode')->name('forget-password');
Route::get('v1/verify-number', 'AuthAPIController@getVerificationCode')->name('verify-number');
Route::get('v1/verify-new-number', 'AuthAPIController@getNewPhoneVerificationCode')->name('verify-new-number');
//Route::post('v1/resend-code', 'AuthAPIController@resendCode');
Route::post('v1/verify-reset-code', 'AuthAPIController@verifyCode')->name('verify-code');
Route::post('v1/verify-phone-code', 'AuthAPIController@verifyPhoneCode')->name('verify-phone-code');
Route::post('v1/verify-new-phone-code', 'AuthAPIController@verifyNewPhoneCode')->name('verify-new-phone-code');
Route::post('v1/reset-password', 'AuthAPIController@updatePassword')->name('reset-password');
Route::resource('v1/settings', 'SettingAPIController');
Route::post('v1/refresh', 'AuthAPIController@refresh');

Route::post('v1/send-notification', 'NotificationAPIController@sendNotification');

Route::get('v1/valid', function () {
    return response()->json(['valid' => auth()->check()]);
});

Route::get('v1/restricted', [
    'before' => 'jwt-auth',
    function () {
        $token = JWTAuth::getToken();
        $user  = JWTAuth::toUser($token);

        return Response::json([
            'data' => [
                'email'         => $user->email,
                'registered_at' => $user->created_at->toDateTimeString()
            ]
        ]);
    }
]);


Route::resource('v1/banner-managements', 'BannerManagementAPIController');

Route::middleware('auth:api')->group(function () {
    ## Token Required to below APIs


    Route::post('v1/logout', 'AuthAPIController@logout');

    Route::post('v1/change-password', 'AuthAPIController@changePassword');

    Route::post('v1/me', 'AuthAPIController@me');

    Route::resource('v1/users', 'UserAPIController');
    Route::post('v1/profile', 'UserAPIController@profile');
    Route::post('v1/cancel-order', 'OrderAPIController@cancel');
    Route::post('v1/orders/rating', 'OrderAPIController@addRating');

    Route::post('v1/check-transaction', 'UserCardAPIController@checkTransaction');
    Route::post('v1/save-transaction', 'UserCardAPIController@saveTransaction');

    Route::resource('v1/roles', 'RoleAPIController');
    Route::resource('v1/permissions', 'PermissionAPIController');

    Route::resource('v1/languages', 'LanguageAPIController');

    Route::resource('v1/pages', 'PageAPIController');

    Route::resource('v1/contactus', 'ContactUsAPIController');

    Route::resource('v1/notifications', 'NotificationAPIController');

    Route::resource('v1/menus', 'MenuAPIController');

    Route::post('v1/pets-new', 'UserPetAPIController@creatOrUpdate');

    Route::resource('v1/user-pets', 'UserPetAPIController');

    Route::resource('v1/user-addresses', 'UserAddressAPIController');

    Route::resource('v1/orders', 'OrderAPIController');

    Route::resource('v1/order-services', 'OrderServiceAPIController');

    Route::resource('v1/order-services', 'OrderServiceAPIController');

    Route::resource('v1/order-service-addons', 'OrderServiceAddonAPIController');

    Route::resource('v1/promo-codes', 'PromoCodeAPIController');

    Route::resource('v1/user-cards', 'UserCardAPIController');

    //Route::post('v1/order-reference', 'OrderAPIController@orderReference');


});
Route::post('v1/order-reference', 'OrderAPIController@orderReference');
Route::post('v1/petspace-restrict-technicians', 'PetspaceTechnicianAPIController@getRestrictedTechnicians');

Route::resource('v1/petspaces', 'PetspaceAPIController');

Route::resource('v1/categories', 'CategoryAPIController');

Route::resource('v1/category-services', 'CategoryServiceAPIController');

Route::resource('v1/submenu-lists', 'SubmenuListAPIController');

Route::resource('v1/submenu-services', 'SubmenuServiceAPIController');

Route::resource('v1/email-templates', 'EmailTemplateAPIController');

Route::resource('v1/petspace-technicians', 'PetspaceTechnicianAPIController');

Route::get('v1/server-time', 'AuthAPIController@getServerTime');


Route::resource('v1/order-progresses', 'OrderProgressAPIController');


//Route::resource('v1/transactions', 'TransactionAPIController');

Route::resource('v1/promotions', 'PromotionAPIController');

Route::resource('v1/order-service-pets', 'OrderServicePetAPIController');
