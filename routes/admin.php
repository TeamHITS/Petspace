<?php


Auth::routes();

Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('/home', 'HomeController@index')->name('dashboard');
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('about', 'HomeController@index');

Route::resource('roles', 'RoleController');

Route::resource('modules', 'ModuleController');

Route::get('/module/step1/{id?}', 'ModuleController@getStep1')->name('modules.create');
Route::get('/module/step2/{tablename?}', 'ModuleController@getStep2')->name('modules.create');
Route::get('/getJoinFields/{tablename?}', 'ModuleController@getJoinFields');
Route::get('/module/step3/{tablename?}', 'ModuleController@getStep3')->name('modules.create');

Route::post('/step1', 'ModuleController@postStep1');
Route::post('/step2', 'ModuleController@postStep2');
Route::post('/step3', 'ModuleController@postStep3');


Route::resource('users', 'UserController');

Route::resource('permissions', 'PermissionController');

//Route::resource('profile', 'UserController');

Route::get('user/profile', 'UserController@profile')->name('users.profile');
//Route::patch('users/profile-update/{id}', 'UserController@profileUpdate')->name('users.profile-update');

Route::resource('languages', 'LanguageController');

Route::resource('pages', 'PageController');

Route::resource('contactus', 'ContactUsController');

Route::resource('notifications', 'NotificationController');

Route::resource('menus', 'MenuController');

//Menu #TODO need to be fixed
Route::get('statusChange/{id}', 'MenuController@statusChange');

Route::post('updateChannelPosition', 'MenuController@update_channel_position')->name('channels');
Route::resource('settings', 'SettingController');

Route::resource('email-templates', 'EmailTemplateController');

Route::resource('user-pets', 'UserPetController');

Route::resource('user-addresses', 'UserAddressController');

Route::get('petspaces/service-menu/{id}', 'PetspaceController@menuBuilder');
Route::get('petspaces/service-submenu/{id}', 'PetspaceController@submenuBuilder');

#Add Modal
Route::get('petspaces/add-category-modal/{id}', 'PetspaceController@addCategoryModal');
Route::get('petspaces/add-service-modal/{id}', 'PetspaceController@addServiceModal');
Route::get('petspaces/add-submenu-modal/{id}', 'PetspaceController@addSubmenuModal');
Route::get('petspaces/add-submenu-service-modal/{id}', 'PetspaceController@addSubmenuServiceModal');

Route::post('petspaces/add-category', 'PetspaceController@addCategory');
Route::post('petspaces/add-service', 'PetspaceController@addService');
Route::post('petspaces/add-submenu', 'PetspaceController@addSubmenu');
Route::post('petspaces/add-submenu-service', 'PetspaceController@addSubmenuService');

#Edit Modal
Route::get('petspaces/edit-category-modal/{id}', 'PetspaceController@editCategoryModal');
Route::get('petspaces/edit-service-modal/{id}', 'PetspaceController@editServiceModal');
Route::get('petspaces/edit-submenu-modal/{id}', 'PetspaceController@editSubmenuModal');
Route::get('petspaces/edit-submenu-service-modal/{id}', 'PetspaceController@editSubmenuServiceModal');

Route::post('petspaces/update-category', 'PetspaceController@updateCategory');
Route::post('petspaces/update-service', 'PetspaceController@updateService');
Route::post('petspaces/update-submenu', 'PetspaceController@updateSubmenu');
Route::post('petspaces/update-submenu-service', 'PetspaceController@updateSubmenuService');

#Delete
Route::get('petspaces/delete-service/{id}', 'PetspaceController@deleteService');
Route::get('petspaces/delete-submenu-service/{id}', 'PetspaceController@deleteSubmenuService');

Route::get('petspaces/block-user/{id}', 'UserController@userActiveInactive');
Route::get('petspace-approved/{id}', 'PetspaceController@approvePetspace');
Route::get('order-cancel/{id}', 'OrderController@cancelOrder');
Route::get('tech-approved/{id}', 'PetspaceTechnicianController@approveTechnician');

Route::get('map-restriction/{id}', 'PetspaceController@mapRestriction');
Route::get('petspaces/reviews/{id}', 'PetspaceController@reviews');

Route::get('get-areas/{id}', 'PetspaceController@getTechnicianAreas');
Route::get('del-areas/{id}', 'PetspaceController@deleteTechnicianArea');
Route::post('add-area', 'PetspaceTechnicianController@addArea');

Route::get('shop-open-close/{id}', 'PetspaceController@shopOpenClose');
Route::post('shop-timings', 'PetspaceController@shopTimings');

Route::get('get-vendor-table', 'UserController@getVendorDataTables');
Route::get('get-technician-table', 'UserController@getTechnicianDataTables');
Route::get('get-manager-table', 'UserController@getManagerDataTables');
Route::get('get-supervisor-table', 'UserController@getSupervisorDataTables');

Route::get('/get-reviews-table/{id}', 'PetspaceController@getReviewDataTables');


Route::resource('petspaces', 'PetspaceController');

Route::resource('packages', 'PackageController');

Route::resource('package-sizes', 'PackageSizeController');

Route::resource('package-types', 'PackageTypeController');

Route::resource('package-addons', 'PackageAddonController');

Route::resource('orders', 'OrderController');

Route::resource('categories', 'CategoryController');

Route::resource('category-services', 'CategoryServiceController');

Route::resource('submenu-lists', 'SubmenuListController');

Route::resource('submenu-services', 'SubmenuServiceController');

Route::resource('petspace-technicians', 'PetspaceTechnicianController');

Route::resource('order-services', 'OrderServiceController');

Route::resource('order-services', 'OrderServiceController');

Route::resource('order-service-addons', 'OrderServiceAddonController');

Route::resource('order-progresses', 'OrderProgressController');

Route::resource('promo-codes', 'PromoCodeController');

Route::resource('banner-managements', 'BannerManagementController');

Route::resource('user-cards', 'UserCardController');

Route::resource('transactions', 'TransactionController');

Route::resource('promotions', 'PromotionController');

/* by Waqas Hafeez @vicky92727*/

/*route to edit order at admin*/

Route::get('orders/edit/{id}', 'OrderController@edit');
Route::post('remove_order_services_addon', 'OrderController@removeOrderServicesAddon');
Route::get('get_order_services_addon/{user_id}/{id}', 'CategoryServiceController@getServicesWithAddon');
Route::post('update_order_services_addon', 'OrderController@updateOrderServicesAddon');
Route::post('make_payment', 'OrderController@makePayment');
Route::post('make_latepayment', 'OrderController@makeLatePayment');
Route::post('confirm_payment', 'OrderController@confirmPayment');


Route::get('banner-active/{id}', 'BannerManagementController@bannerActiveInactive');
Route::resource('order-service-pets', 'OrderServicePetController');