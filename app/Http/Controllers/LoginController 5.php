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
use Exception;
use PDOException;
use App\User;
use App\Model\CredentialModel;
use App\Services\Utility\DatabaseException;

class LoginController extends Controller
{
    /*
     * Login method to process Logging in
     */
 public function  onLogin(Request $request)
 {
     try {
     // Call the form data
     $username = $request->input('username');
     $password = $request->input('password');
     
     // Create a new Security Service Object
     $sc = new UserService();
     
     $credentials = new CredentialModel($username, $password, -1);
     
     // Pass them into the Security Service Object
     $status = $sc->authenticate($credentials);
     if($status)
     {
         // return a success view with the data
         $uid = $status->getID();
         $first = $status->getFirstname();
         $last = $status->getLastname();
         $email = $status->getEmail();
         $us = $status->getUsername();
         $pw = $status->getPassword();
         $role = $status->getRole();
         // Set session for each item being passed
         Session::put('users', $status);
         Session::put('ID', $uid);
         Session::put('first', $first);
         Session::put('last', $last);
         Session::put('email', $email);
         Session::put('username', $us);
         Session::put('password', $pw);
         if($role == 'admin')
         {
             Session::put('admin', $role);
         }
         
        
         
         
         // return view feed
         return view('feed');
     }
     else
     {
         // return view login
         return view('login');
     }
     } catch(PDOException $e)
     {
         
         // Log the pdo exception
         Log::error("Exception: ", array("message" => $e->getMessage()));
         //          // Log the database exception
         throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
         // return false;
         return false;
     }
       
    
    
 }
 public function Logout(Request $request)
 {
     $request->session()->forget('users');
     $request->session()->forget('admin');
     return view('login');
 }
}
