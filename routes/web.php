<?php

//Auth::routes();
// to start Page
// login page
Route::get('/', 'Auth\LoginController@loginPage')->name('user.login');

// to get login controller
Route::post('/auth/login', 'Auth\LoginController@customLogin')->name('auth.login');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');

Route::get('/register', 'Auth\RegisterController@register')->name('register');

Route::post('/auth/register', 'Auth\RegisterController@store')->name('register.store');

// to get change password form
Route::get('/changePassword', 'ChangePasswordsController@changePasswordForm')->name('user.changePassword');

// to change password
Route::post('/changingPassword', 'ChangePasswordsController@changePassword')->name('changePassword.store');

// to change role
Route::get('/changeRole/{id}', 'ChangeRolesController@changeRole')->name('user.changeRole');

// custom 404 route 
Route::get('/404', 'ErrorsController@notFound')->name('404');

// custom 404 route 
Route::get('/500', 'ErrorsController@fatal')->name('500');

// admin Routes
//////////////////////////////////////////////////////////////////////////////////////////////////////
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isIdNumber', 'role:Admin']], function(){
    // to get to dashboard of admin page
    // admins first page
    Route::get('/dashboard', 'AdminsController@index')->name('admin.dashboard');

    // Department resource routes
    Route::resource('departments', 'DepartmentsController');

    // Role resource routes
    Route::resource('roles', 'RolesController');

    // Users resource routes
    Route::resource('users', 'UsersController');

    // Deactivate users routes
    Route::post('/user/deactivate', 'UsersController@deactivateUser')->name('users.deactivate');

    // Activate users routes
    Route::post('/user/activate', 'UsersController@activateUser')->name('users.activate');

    // assign role
    // create assign role
    Route::get('assignRole/create/{id}', 'AssignRolesController@createAssignRole')->name('assignRole.assign');

    // store assigned role
    Route::post('assignRole/store', 'AssignRolesController@storeAssignRole')->name('assignRole.store');

    // Remove assigned role
    Route::delete('assignedRole/delete/{user_id}/{role_id}', 'AssignRolesController@removeAssignedRole')->name('assignRole.remove');

});

// Alumni Routes
//////////////////////////////////////////////////////////////////////////////////////////////////////
Route::group(['prefix' => 'alumni', 'middleware' => ['auth', 'isIdNumber', 'role:Alumni']], function(){
    // to get to dashboard of Alumnies page
    // alumnies first page
    Route::get('/home', 'AlumniesController@index')->name('alumnies.home');

    // Alumni Profile Resource routes
    Route::resource('alumniesProfile', 'AlumniProfilesController');

    // Alumnie Pg study info for delete
    Route::delete('/pgStudy/{id}', 'AlumniProfilesController@destroyPgStudy')->name('destroyPgStudy'); 

     // Alumnie Certificate info for delete
     Route::delete('/certificate/{id}', 'AlumniProfilesController@destroyCertificate')->name('destroyCertificate'); 

    // Alumni Profile Resource routes
    Route::resource('documentRequest', 'DocumentRequestsController');

    // get list of alumnies
    Route::get('/alumniList', 'AlumniesController@alumnieList')->name('alumnies.list');

    // get alumnies detail
    Route::get('/alumniDetail/{id}', 'AlumniesController@alumniDetail')->name('alumnies.detail');

    // Advanced alumni Search Request route
    Route::post('/advancedSearch', 'AlumniesController@advancedSearch')->name('advancedSearch');

    // Post Resource Routes
    Route::resource('posts', 'PostsController');

    // Comments Resource Routes
    Route::resource('comments', 'CommentsController');

    // Alumnie detail info for comments and posts
    Route::get('/alumniInfo/{id}', 'AlumniesController@alumniInfo')->name('alumniInfo'); 

});

// Registrar Routes
//////////////////////////////////////////////////////////////////////////////////////////////////////
Route::group(['prefix' => 'registrar', 'middleware' => ['auth', 'isIdNumber', 'role:Registrar']], function(){
    // to get to dashboard of Registrar page
    // registrars first page
    Route::get('/home', 'registrarsController@index')->name('registrar.home');

    // Alumni Resource routes
    Route::resource('alumnies', 'AlumnisController');

    // Membership Request List route
    Route::get('/membershipRequests', 'MembershipRequestsController@index')->name('membershipRequests.index');

    // Membership Request approve route
    Route::post('/membershipRequests/approve', 'MembershipRequestsController@approveRequest')->name('membershipRequests.approve');

    // Report Route
    Route::get('/reports', 'ReportsController@reports')->name('reports');

    // Document Request List route
    Route::get('/documentRequests', 'registrarsController@documentRequests')->name('documentRequests');

    // Document Request Detail route
    Route::get('/documentRequests/{id}', 'registrarsController@documentRequestDetail')->name('documentRequest.detail');

    // Document Request Detail route
    Route::post('/documentRequests/status', 'registrarsController@documentRequestStatus')->name('documentRequest.status');

    // Advanced Report Request route
    Route::post('/advancedReport', 'AdvancedReportsController@advancedReport')->name('advancedReports');

});

// Department Head Routes
//////////////////////////////////////////////////////////////////////////////////////////////////////
Route::group(['prefix' => 'departmentHead', 'middleware' => ['auth', 'isIdNumber', 'role:Department Head']], function(){
    // to get to dashboard of Department Head page
    // department heads first page
    Route::get('/home', 'DepartmentHeadsController@index')->name('departmentHead.home');

    // Department Alumni Resource routes
    Route::resource('departmentAlumnies', 'DepartmentAlumniesController');

     // Alumnies Advanced Report Request route
     Route::post('/advancedReport', 'DepartmentHeadsController@advancedReport')->name('departmentAdvancedReports');

});

