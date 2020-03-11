<?php
// Cyrus Duncan
// CST - 256
// This is my own work
namespace App\Http\Controllers;

use App\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use PDOException;
use App\Services\Buisness\UserService;
use App\Services\Utility\AchieveLogger;
use App\Services\Utility\DatabaseException;
use App\Model\CredentialModel;




class RegisterController extends Controller
{
    /*
    * Handle Validation for regisration form
    */
    public function validateForm(Request $request)
    {
        AchieveLogger::info("Entering RegisterController.validateForm()");
        $rules = ['username' => 'required|string|max:20|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'password' => 'Required | Between:4,20',
            'firstname' => 'required|string|max:20|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'lastname' => 'required|string|max:20|regex:/(^([a-zA-Z]+)(\d+)?$)/u'
        ];
        AchieveLogger::info("Exiting RegisterController.validateForm()");
        $this->validate($request, $rules);
    }
   /*
    * Register method to process register controller
    */
  public function onRegister(Request $request)
  {
      AchieveLogger::info("Entering RegisterController.ongRegister()");
      try{
          $this->validateForm($request);
     // Grab form data
      $username = $request->input('username');
      $password = $request->input('password');
      $email = $request->input('email');
      $firstname = $request->input('firstname');
      $lastname = $request->input('lastname');
      $role = null; 
      
      // Create a new User object
 $user = new UserModel($firstname, $lastname, $username, $password, $email, $role);
      
      // Create a new security service object
      $sc = new UserService();
      // Check to see if the user is registered
      $credentals = new CredentialModel($username, $password, -1, $role);
      
      $registered = $sc->isRegistered($credentals);
      

     
      if($registered)
      {
          return view ("register")->withErrors(['', 'User already exists!']);
      }
      
      // Pass data into Security service object method.
    $status = $sc->register($user);
    
    //Render a failed or success response view and pass the user Model
    AchieveLogger::info("Exiting RegisterController.onRegister()");
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
}
