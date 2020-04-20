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
// Default route 
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
        // Goes to the form to create Job Posting
        Route::get('/createRecruitment', function()
        {
            return view('createrecruitment');
        });
        // Goes to the admin view
        Route::get('/admin', "AdminController@grabAllProfiles");
        // Goes to edit Education view
        Route::post('/editeducation', "EducationController@displayeditEducation");
        // Goes to edit Skill view
        Route::post('/editskill', "SkillController@displayeditSkill");
        // Goes to edit Job view
        Route::post('/editjob', "JobController@displayEditJob");
        // Goes to job admin view
        Route::get('/jobadmin', "AdminController@grabAllJobs");
        // Goes to create education view
        Route::get('/createeducation', function () {
           return view('createeducation'); 
        });
        // Goes to create job view
       Route::get('/createjob', function () {
                return view('createjob');
        });
       // goes to create skill view
       Route::get('/createskill', function () {
               return view('createSkill');
         });
       // goes to create group view
           Route::get('/createGroup', function() {
               return view('createGroup');
           });
               //Routes to the feed
               Route::get('/feed', function() {
                   return view('feed');
               });
           // goes to display all groups
       Route::get('/groups', "GroupController@displayGroup");
                 

// Route to the profile controller after creating a new profile
Route::post('/processOrigination', "ProfileController@onOrigination");
// Route to the profile controller after edit a new profile
Route::post('/processAnnotation', "ProfileController@onAnnotate");
// Routes to the Register controller after submitting register forum
Route::post('/processRegister', "RegisterController@onRegister");
// Routes to the login controller after submitting the login forum
Route::post('/processLogin', "LoginController@onLogin");
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
// Routes to the admin controller to process unsuspend
Route::post('/processUnsuspend', "AdminController@unSuspendProfile");
// Routes to the education controller to process education
Route::post('/processEducation', "EducationController@editEducation");
// Routes to the skill controller to process edit skill
Route::post('/processSkill', "SkillController@editSkill");
// Routes to the job controller to porcess  the edit job
Route::post('/processJob', "JobController@editJob");
//Routes to the creat job form
Route::post('/processRecuitment', "AdminController@createJob");
// Routes to process Recruitment deletion
Route::post('/processDeleteRecruitment', "AdminController@deleteJob");
// Routes to confrim Recruitment deletion
Route::post('/confirmDeleteRecuritment', "AdminController@confirmDeleteJob");
// Routes to display edit form
Route::post('/displayEditRecuritment', "AdminController@displayEditRecuritment");
// Routes to process edit recruitment
Route::post('/processEditRecruitment', "AdminController@editRecruitment");
// Education controller create education
Route::post('/createEducation', "EducationController@createEducation");
// create Job
Route::post('/createJob', "JobController@createJob");
// create Skill
Route::post('/processCreateSkill', "SkillController@addSkill");
// Group Controller to create a group
Route::post('/processCreateGroup', "GroupController@createGroup");
// Group Controller to confirm delete
Route::post('/confirmgroupdelete', "GroupController@confirmDeleteGroup");

// Group Controller to delete group
Route::post('/deletegroup', "GroupController@deleteGroup");
// Group Controller to display edit group
Route::post('/displayeditgroup', "GroupController@displayeditGroup");
// Group Controller to edit groups
Route::post('/editGroup', "GroupController@editGroup");
// Member controller to join group
Route::post('/joinGroup', "MemberController@joinGroup");
// Member controller to leave group
Route::post('/leaveGroup', "MemberController@leaveGroup");
// Group controller to show group
Route::post('/showGroup', "GroupController@showGroup");
// Job Controller to search Jobs
Route::post('/search', "JobController@searchJob");
//Job Controller to Display Job
Route::post('/displayjob', "JobController@displayajob");
// Job Controller to Handle Cancel Applying
Route::post('/cancelJob', "JobController@searchJob");
// Job Controller to Handle Applying for a Job
Route::post('/apply', "JobController@apply");

// Routes to logouts
Route::get('/logout', "LoginController@logout");

// Routes to get profile rest service
Route::resource('/profilerest', 'ProfileRestController');
// Routes to get job rest service
Route::resource('/jobrest', 'JobRestController');




