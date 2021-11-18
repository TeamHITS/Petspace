<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/get-google-reviews', 'Web\PetspaceController@getGoogleReviews');
Route::get('/home-web', "SiteController@index");
Route::get('/become-partner', "SiteController@beAPartner");
Route::get('/about', "SiteController@about");
Route::get('/contact', "SiteController@contact");
Route::get('/terms', "SiteController@terms");
Route::get('/privacy-policy', "SiteController@policy");
Route::post('/send-to-mail', 'MailChimpController@subscribeMailChimp');
Route::post('/sendmail2', 'SiteController@storeContactForm');

Route::namespace("Websiteadmin")->prefix('websiteadmin')->group(function () {
    Route::resource('how-it-works', 'HowItWorksController');
    Route::resource('testimonials', 'TestimonialsController');
    Route::resource('faqs', 'FAQSController');
    Route::get("templates/{page}", "TemplatesController@index");
    Route::post("templates/{page}", "TemplatesController@store");
});

Route::get('/', function () {
    //if (!\Auth::check()) {
       return view('welcome');
    //}
    //return redirect('/dashboard');
});//->middleware('userRole:vendor');//->middleware('userRole:vendor');

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('website.login');
});
Route::get('/forgot-password', function () {
    return view('website.forgot-password');
});

Route::get('/payment-authorized', function () {
    return view('website.payment.payment-authorized');
});

Route::get('/payment-declined', function () {
    return view('website.payment.payment-declined');
});

Route::get('/payment-cancelled', function () {
    return view('website.payment.payment-cancelled');
});

//Auth::routes();
Route::middleware('userRole:vendor')->group(function () {

    Route::get('/dashboard', 'Web\PetspaceController@dashboard');
    Route::get('/setup-store', 'Web\PetspaceController@setupStore');

    Route::post('/store-petspace', 'Web\PetspaceController@store');
    Route::post('/update-vendor', 'Web\UserController@updateVendorInfo');

    Route::get('/tech-list', 'Web\PetspaceController@technician');
    Route::get('/service-menu', 'Web\PetspaceController@serviceMenu');

    Route::get('/submenu/{id}', 'Web\PetspaceController@submenu');

    Route::get('/orders', 'Web\PetspaceController@orderList');

    Route::get('/order/{id}', 'Web\PetspaceController@orderDetail');

    Route::get('/store-setting', 'Web\PetspaceController@storeSetting');

    //Modals
    Route::get('/add-tech-modal', 'Web\PetspaceController@addTechnicianModal');
    Route::get('/edit-tech-modal/{id}', 'Web\PetspaceController@editTechnicianModal');
    Route::get('/delete-tech-modal/{id}', 'Web\PetspaceController@deleteTechnicianModal');
    Route::get('/assign-tech-modal/{id}', 'Web\PetspaceController@assignTechModal');

    Route::get('/active-order-modal/{id}', 'Web\PetspaceController@activeOrderModal');
    Route::get('/schedule-order-modal/{id}', 'Web\PetspaceController@scheduleOrderModal');

    Route::get('/get-order-list', 'Web\PetspaceController@getOrderList');

    //End Modal

    Route::post('/add-tech', 'Web\PetspaceController@addTechnician');
    Route::post('/edit-tech', 'Web\PetspaceController@editTechnician');
    Route::post('/delete-tech', 'Web\PetspaceController@deletetTechnician');

    Route::post('/assign-tech', 'Web\PetspaceController@assignTechnician');

    Route::post('/update-petspace', 'Web\PetspaceController@updatePetspaces');
    Route::post('/update-vendor-password', 'Web\UserController@updateVendorPasword');

    Route::resource('petspace', 'PetspaceController');

    Route::post('/update-services-stock', 'Web\PetspaceController@updateServiceStock');
    Route::post('/update-sub-services-stock', 'Web\PetspaceController@updateSubServiceStock');

    Route::get('/calendar', 'Web\PetspaceController@calendar');

    //Calender Routes
    Route::get('calendar/resource', 'Web\CalendarSlotsController@resourceCalendar');
    Route::resource('/calendar', 'Web\CalendarSlotsController');
    Route::post('calendar/save', 'Web\CalendarSlotsController@update');
    Route::post('calendar/getSlots', 'Web\CalendarSlotsController@getSlots');
    Route::get('calendar/getSlots', 'Web\CalendarSlotsController@getSlots');
});
//
//Route::get('/order-confirm/{id}', 'Web\PetspaceController@orderConfirmEmail');
Route::get('/home', 'HomeController@index')->name('home');

Route::post('/logining', 'Web\UserController@login');
Route::get('/logout', 'Web\UserController@logout');

Route::post('/forgot-password', 'Web\UserController@getForgetPasswordCode');

/* verify code */
Route::get('/verify-code', function () {
    return view('website.verify-code');
});
Route::post('/verify-code', 'Web\UserController@verifyCode');

/* reset password */
Route::get('reset-password', 'Web\UserController@resetPassword');
Route::post('reset-password', 'Web\UserController@updatePassword');

Route::get('/get-technician-min-order-fee/{id}', 'Web\PetspaceController@getTechnicianMinOrderFee');

/************ TECHNICIAN END ROUTES ************/

Route::get('/technician', function () {
    if (!Auth::check()) {
        return redirect('/technician/login');
    }
    return redirect('/technician/home');
})->middleware('userRole:technician');

Route::get('/technician/login', function () {
    if (Auth::check()) {
        return redirect('/technician');
    }
    return view('technician.technician-login');
});

Route::post('/technician/logining', 'Web\PetspaceTechnicianController@login');
Route::get('/technician/logout', 'Web\PetspaceTechnicianController@logout');

Route::middleware('userRole:technician')->group(function () {

    Route::get('/technician/home', 'Web\PetspaceTechnicianController@home');
    Route::get('/technician/order-detail/{id}', 'Web\PetspaceTechnicianController@orderDetail');
    Route::get('/technician/account', 'Web\PetspaceTechnicianController@accountDetail');

    Route::get('/technician/start-order/{id}/{progress}', 'Web\PetspaceTechnicianController@orderProgress');
    Route::get('/technician/end-order/{id}', 'Web\PetspaceTechnicianController@endOrder');

//    Route::get('/technician/logout', 'Web\PetspaceTechnicianController@logout');
});

/************ END TECHNICIAN ROUTES ************/

//firebase push notification
Route::post('/save-token', 'FirebaseNotificationController@saveToken')->name('save-token');
Route::post('/fcm/subscribe', 'FirebaseNotificationController@subscribe');

//technician notification
Route::get('technician/bell-notifications', 'NotificationController@index')->name('notifications.index');
Route::get('technician/notification-mark-as-read', 'NotificationController@markAsRead')->name('notifications.markAsRead');
// Route::post('technician/bell-notifications/{id}/mark-as-read', 'NotificationController@markAsRead')->name('notifications.markAsRead');

//Vender notification
Route::get('bell-notifications', 'NotificationController@index')->name('notifications.index');
Route::get('notification-mark-as-read', 'NotificationController@markAsRead')->name('notifications.markAsRead');
// Route::post('bell-notifications/{id}/mark-as-read', 'NotificationController@markAsRead')->name('notifications.markAsRead');
