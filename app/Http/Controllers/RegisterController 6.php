<?php
// Cyrus Duncan
// CST - 256
// This is my own work
namespace App\Http\Controllers;

use App\Model\UserModel;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PDOException;
use App\Services\Buisness\UserService;
use App\Services\Utility\DatabaseException;




class RegisterController extends Controller
{
   /*
    * Register method to process register controller
    */
  public function onRegister(Request $request)
  {
      try{
     // Grab form data
      $username = $request->input('username');
      $password = $request->input('password');
      $email = $request->input('email');
      $firstname = $request->input('firstname');
      $lastname = $request->input('lastname');
      
      // Create a new User object
 $user = new UserModel($firstname, $lastname, $username, $password, $email);
      
      // Create a new security service object
      $sc = new UserService();
      
      // Pass data into Security service object method.
    $status = $sc->register($user);
    
    //Render a failed or success response view and pass the user Model
    
    if($status)
    {
        // return login view on success
        return view('login');
    }
    else
    {
     // return register view on success
        return view('register');
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
}
