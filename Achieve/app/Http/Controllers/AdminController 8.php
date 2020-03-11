<?php
// Cyrus Duncan
// CST - 256
// This is my own work
namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use PDOException;
use App\User;
use App\Model\CredentialModel;
use App\Services\Utility\DatabaseException;

use App\Services\Buisness\ProfileService;

class AdminController extends Controller
{
    /*
     * Method to grab all profiles
     */
    public function grabAllProfiles(Request $request)
{
    try{
        // grab ide and role through sessions
    $id = Session::get('first');
    $role = Session::get('role');
    // create a new profile service
    $service = new ProfileService();
    // grab all profiles
    $profiles = $service->getAllProfiles($id);
    // return view admin with all profiles and role passed into it
    return view("admin")->with([
        'profile' => $profiles,
        'role' => $role
    ]);
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
 /*
  * Method to confirm delete 
  */
 public function confirmDelete(Request $request)
 {
     $id = $request->input('id');
     return view('confirmDelete')->with([
         'id' => $id
     ]);

     
     
 }
 /*
  * Method to  confirm suspend
  */
 public function confirmSuspend(Request $request)
 {
      // Grab the id
     $id = $request->input('id');
     // return confirm view with id
     return view('confirmSuspend')->with([
         'id' => $id
     ]);
     
     
 }
 /*
  * Method to confirm unsuspend
  */
 public function confirmUnsuspend(Request $request)
 {
     // grab id
     $id = $request->input('id');
     // return view with id
     return view('confirmUnsuspend')->with([
         'id' => $id
     ]); 
 }
 /*
  * Method to delete Profile
  */
 public function deleteProfile(Request $request)
 {
     // grab input id
     $id = $request->input('id');
     // create profile service 
     $service = new ProfileService();
     // delete profile with id passed
     $service->deleteProfile($id);
     // if delete passed return admin with all profiles
    if($service)
    {
        // grab all profiles
        $profiles = $service->getAllProfiles($id);
        // pass it into admin
        return view("admin")->with([
            'profile' => $profiles
        ]);
    }
     
     
     
 }
 /*
  * Method to suspend Profile
  */
 public function suspendProfile(Request $request){
     // grab profile id input
     $id = $request->input('id');
     // get sesision for user id
     $uid = Session::get('id');
     // create new profile service
     $service = new ProfileService();
     // call profile service to suspend profile with user and profile id
     $service->suspendProfile($id, $uid);
     // grab all the profiles with id
         $profiles = $service->getAllProfiles($id);
         // return admin with profiles passed through
         return view("admin")->with([
             'profile' => $profiles
         ]);
 }
 /*
  * Method to unsuspend profile
  */
 public function unSuspendProfile(Request $request)
 {
     // grab profile id input
     $id = $request->input('id');
     // get sesision for user id
     $uid = Session::get('id');
     // create new profile service
     $service = new ProfileService($id);
     // call profile service to suspend profile with user and profile id
     $service->unSuspendProfile($id, $uid);
     
     // grab all the profiles with id
         $profiles = $service->getAllProfiles($id);
         return view("admin")->with([
             'profile' => $profiles
         ]);

 }
 
}
