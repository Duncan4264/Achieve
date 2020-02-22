<?php
// Cyrus Duncan
// CST - 256
// This is my own work

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

Route::get('/', function () {
    return view('login');
});
// Goes to the register view
    Route::get('/register', function () {
       return view('register'); 
});
// Goes to the login view
Route::get('/login', function () {
            return view('login');
});
// Goes to profile view
    Route::get('/profile', "ProfileController@display");
// Goes to the edit profile view
        Route::get('/editprofile', "ProfileController@displayEditUser");
        // Goes to the create profile view
        Route::get('/createprofile', function() {
                return view('createprofile');
            });
        // Goes to the admin view
        Route::get('/admin', "AdminController@grabAllProfiles");
        
        Route::get('/editeducation', "EducationController@displayEditEducation");
        
        Route::get('/editskill', "SkillController@displayeditSkill");
        
        Route::get('/editjob', "JobController@displayeditjob");

// Route to the profile controller after creating a new profile
Route::post('/processOrigination', "ProfileController@onOrigination");
// Route to the profile controller after edit a new profile
Route::post('/processAnnotation', "ProfileController@onAnnotate");
// Routes to the Register controller after submitting register forum
Route::post('/processRegister', "RegisterController@onRegister");
// Routes to the login controller after submitting the login forum
Route::get('/processLogin', "LoginController@onLogin");
// Routes to the admin controller Confermation Method after submitting the admin request
Route::post('/adminAction', "AdminController@onConfirm");

// Routes to the admin controller Suspend menthod after submitting the admin request
Route::post('/confirmSuspend', "AdminController@confirmSuspend");

//Rousts to process suspend after

// Routes to the admin controller  Delete Method after submitting the admin request
Route::post('/confirmDelete', "AdminController@confirmDelete");

Route::post('/processDelete', "AdminController@deleteProfile");
Route::post('/processSuspend', "AdminController@suspendProfile");
// Routes to the admin controller unsuspend method after submitting the admin request
Route::post('/confirmUnsuspend', "AdminController@confirmUnsuspend");
Route::post('/processUnsuspend', "AdminController@unSuspendProfile");

Route::post('/processEducation', "EducationController@editEducation");

Route::post('/processSkill', "SkillController@editSkill");
Route::post('/processJob', "JobController@editJob");





Route::get('/logout', "LoginController@logout");


