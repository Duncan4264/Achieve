<?php
// Cyrus Duncan
// CST - 256
// This is my own work
namespace App\Http\Controllers;


use App\Services\Buisness\UserService;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

use App\Model\CredentialModel;

use PDOException;
use App\Services\Utility\AchieveLogger;
use App\Services\Utility\DatabaseException;
use App\Services\Utility\AchieveLoggerService;

class LoginController extends Controller
{
     // Logger variable 
//     protected $logger;
    
//     /*
//      * Constructor to inizalize logger variable with achieve logger service
//      */
//     public function __construct(AchieveLoggerService $logger)
//     {
//         $this->logger = $logger;
//     }
    /*
     * Method to validate form
     */
    public function validateForm(Request $request)
    {
        // call the logger and make info we are in the validateForm
        AchieveLogger::info("Entering LoginController.validateForm()");
        // rules to validate form
        $rules = ['username' => 'required|string|max:255|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'password' => 'required', 
               'min:6', 
               'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/', 
               'confirmed'];
        // call the logger and make info we are exiting validateForm
        AchieveLogger::info("Exiting LoginController.validateForm()");
        // call framework validation
        $this->validate($request, $rules);
    }
    
    /*
     * Login method to process Logging in
     */
 public function onLogin(Request $request)
 {
     try {
         // call the logger and make info we are entering onLogin()
         AchieveLogger::info("Entering LoginController.onLogin()");
         $this->validateForm($request);
     // Call the form data
     $username = $request->input('username');
     $password = $request->input('password');
     
     // Create a new Security Service Object
     $sc = new UserService();
     
     $credentials = new CredentialModel($username, $password, -1, null);
     
     // Pass them into the Security Service Object
     $status = $sc->authenticate($credentials);
     if($status)
     {
         // return a success view with the data
         $uid = $status->getID();
         $us = $status->getUsername();
         $pw = $status->getPassword();
         $role = $status->getRole();
         // Set session for each item being passed
         Session::put('users', $status);
      
         Session::put('ID', $uid);
         Session::put('username', $us);
         Session::put('password', $pw);
         if($role == 'admin')
         {
             Session::put('admin', $role);
         }
         
        // call the logger service to exiting the loginController
         AchieveLogger::info("Exiting LoginController.onLogin()");
         // return view feed
         return view('feed');
     }
     else
     {
         // return view login
         return view('login');
     }
     } catch(ValidationException $e1){
         throw $e1;
     } catch(PDOException $e)
     {
         
         // Log the pdo exception
         AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
         //          // Log the database exception
         throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
         // return false;
         return false;
     }
       
    
    
 }
 public function Logout(Request $request)
 {
     try{
     AchieveLogger::info("Entering LoginController.logout()");
     $request->session()->forget('users');
     $request->session()->forget('admin');
     $request->session()->forget('suspended');
     AchieveLogger::info("exiting LoginController.logout()");
     return view('login');
     }
     catch(PDOException $e)
     {
         
         // Log the pdo exception
         AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
         //          // Log the database exception
         throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
         // return false;
         return false;
     }
 }
}
