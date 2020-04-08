<?php
// Cyrus Duncan
// CST - 256
// This is my own work
namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use PDOException;
use App\Services\Utility\DatabaseException;

use App\Services\Buisness\ProfileService;
use App\Services\Buisness\RecruitmentService;
use App\Model\Recuitment;
use App\Services\Utility\AchieveLogger;


class AdminController extends Controller
{
    /*
     * Method to validate edit from controller
     */
    public function validateForm(Request $request)
    {
        AchieveLogger::info("Entering AdminController.validateForm()");
        // Rules created for form validation
        $rules = ['jobtitle' => 'required|string|max:20|regex:/(^[A-Za-z0-9 ]+$)+/',
            'company' => 'Required | Between:4,20|regex:/(^[A-Za-z0-9 ]+$)+/',
            'descripton' => 'required|string|max:20|regex:/(^[A-Za-z0-9 ]+$)+/',
            'requirements' => 'required|string|max:20|regex:/(^[A-Za-z0-9 ]+$)+/',
            'salary' => 'required|numeric'
        ];
        AchieveLogger::info("Exiting AdminController.validateForm()");
        // validate form in framework
        $this->validate($request, $rules);
    }
    /*
     * Method to grab all profiles
     */
    public function grabAllProfiles(Request $request)
{
    try{
        AchieveLogger::info("Entering AdminController.grabAllProfiles()");
        // grab ide and role through sessions
    $id = Session::get('ID');
    $role = Session::get('role');
    // create a new profile service
    $service = new ProfileService();
    // grab all profiles
    $profiles = $service->getAllProfiles($id);
    // return view admin with all profiles and role passed into it
    AchieveLogger::info("Exiting AdminController.grabAllProfiles()");
    return view("admin")->with([
        'profile' => $profiles,
        'role' => $role
    ]);
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
 /*
  * Method to confirm delete 
  */
 public function confirmDelete(Request $request)
 {
     try{
     AchieveLogger::info("Entering AdminController.confrimDelete()");
     $id = $request->input('id');
     AchieveLogger::info("Exiting AdminController.confirmDelete()");
     return view('confirmDelete')->with([
         'id' => $id
     ]);
     }catch(PDOException $e)
     {
         
         // Log the pdo exception
         AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
         //          // Log the database exception
         throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
         // return false;
         return false;
     }

     
     
 }
 /*
  * Method to  confirm suspend
  */
 public function confirmSuspend(Request $request)
 {
     try{
     AchieveLogger::info("Entering AdminController.confrimSuspend()");
      // Grab the id
     $id = $request->input('id');
     AchieveLogger::info("Extings AdminController.confirmSuspend()");
     // return confirm view with id
     return view('confirmSuspend')->with([
         'id' => $id
     ]);
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
 /*
  * Method to confirm unsuspend
  */
 public function confirmUnsuspend(Request $request)
 {
     try{
     AchieveLogger::info("Entering AdminController.confirmUnsuspend()");
     // grab id
     $id = $request->input('id');
     // return view with id
     AchieveLogger::info("Exiting AdminController.grabAllProfiles()");
     return view('confirmUnsuspend')->with([
         'id' => $id
     ]); 
     }catch(PDOException $e)
     {
         
         // Log the pdo exception
         AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
         //          // Log the database exception
         throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
         // return false;
         return false;
     }
 }
 /*
  * Method to delete Profile
  */
 public function deleteProfile(Request $request)
 {
     try{
     AchieveLogger::info("Entering AdminController.deleteprofile()");
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
        AchieveLogger::info("Exiting AdminController.deleteProfile()");
        return view("admin")->with([
            'profile' => $profiles
        ]);
    }
     }catch(PDOException $e)
     {
         
         // Log the pdo exception
         AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
         //          // Log the database exception
         throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
         // return false;
         return false;
     }
     
     
     
 }
 /*
  * Method to suspend Profile
  */
 public function suspendProfile(Request $request){
     try{
     AchieveLogger::info("Entering AdminController.suspendProfile()");
     // grab profile id input
     $id = $request->input('id');
     // create new profile service
     $service = new ProfileService();
     // call profile service to suspend profile with user and profile id
     $service->suspendProfile($id);
     // grab all the profiles with id
     $uid = Session::get('uid');
         $profiles = $service->getAllProfiles($uid);
         AchieveLogger::info("Exiting AdminController.suspendProfile()");
         // return admin with profiles passed through
         return view("admin")->with([
             'profile' => $profiles
         ]);
     }catch(PDOException $e)
     {
         
         // Log the pdo exception
         AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
         //          // Log the database exception
         throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
         // return false;
         return false;
     }
 }
 /*
  * Method to unsuspend profile
  */
 public function unSuspendProfile(Request $request)
 {
     try{
     AchieveLogger::info("Entering AdminController.suspendProfile()");
     // grab profile id input
     $id = $request->input('id');
     // create new profile service
     $service = new ProfileService();
     // call profile service to suspend profile with user and profile id
     $service->unSuspendprofile($id);
     // grab all the profiles with id
     $profiles = $service->getAllProfiles($id);
     // return admin with profiles passed through
     AchieveLogger::info("exiting AdminController.unsuspendProfile()");
     return view("admin")->with([
         'profile' => $profiles
     ]);
     }catch(PDOException $e)
     {
         
         // Log the pdo exception
         AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
         //          // Log the database exception
         throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
         // return false;
         return false;
     }

 }
 /*
 * Display Edit Job
 */
 public function displayEditRecuritment(Request $request)
   {
        try{
            AchieveLogger::info("Entering AdminController.displayEditRecuritment()");
       // Grab id session
       $id = $request->input('id');
       // create a new profile service passing through the id
       $service = new RecruitmentService();
       // grab a profile from buisness service
       $job = $service->findJob($id);
      
       AchieveLogger::info("Exiting AdminController.displayeditRecruitment()");
       // return the editRecruitment view with id and profile data
       return view("editRecruitment")->with([
           'id' => $id,
           'job' => $job,
       ]);
       } catch(ValidationException $e1){
           throw $e1;
       } catch(\Exception $e2)
       {
           return view('systemException');
       }
   }
/*
 * Display Create Job Post
 */
   public function createJob(Request $request)
   {
       try{
           AchieveLogger::info("Entering AdminController.createJob()");
           $jobTitle = $request->input('jobtitle');
           $company = $request->input('company');
          $description =  $request->input('description');
           $salary = $request->input('salary');
           $requirements = $request->input('requirements');
           $role = Session::get('role');
           $id = Session::get('ID');
           
           
           $rec = new Recuitment($jobTitle, $company, $description, $salary, $requirements, -1);
           // create a new profile service passing through the id
           $service = new RecruitmentService();
           // grab a profile from buisness service
           $job = $service->createJob($rec);
           $jobs = $service->getAllJobs($id);
           
           AchieveLogger::info("Exiting AdminController.createJob()");
           if($job)
           {
               return view("jobAdmin")->with([
                   'job' => $jobs,
                   'role' => $role
               ]);
           }
           else
           {
               return view("jobAdmin")->with([
                   'job' => $jobs,
                   'role' => $role
               ]);
           }
           
       } catch(ValidationException $e1){
           throw $e1;
       } catch(\Exception $e2)
       {
           return view('systemException');
       }
   }
   /*
    * Method to grab all profiles
    */
   public function grabAllJobs(Request $request)
   {
       try{
           AchieveLogger::info("Entering AdminController.grabAllJobs()");
           // grab ide and role through sessions
           $id = Session::get('ID');
           $role = Session::get('role');
           // create a new profile service
           $service = new RecruitmentService();
           // grab all profiles
           $jobs = $service->getAllJobs($id);
           // return view admin with all profiles and role passed into it
           AchieveLogger::info("Exiting AdminController.grabAllProfiles()");
           return view("jobAdmin")->with([
               'job' => $jobs,
               'role' => $role
           ]);
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
   /*
    * Method to delete Job
    * 
    */
   public function deleteJob(Request $request)
   {
       try{
       AchieveLogger::info("Entering AdminController.deleteJob()");
       // grab input id
       $id = $request->input('id');
       // create Recruitment service
       $service = new RecruitmentService();
       // delete Job with id passed
       $service->deleteJob($id);
       // if delete passed return admin with all Job postings
       if($service)
       {
           // grab all profiles
           $jobs = $service->getAllJobs($id);
           
           AchieveLogger::info("Exiting AdminController.deleteJob()");
           // pass it into admin
           return view("jobAdmin")->with([
               'job' => $jobs
           ]);
       }
       }catch(PDOException $e)
       {
           
           // Log the pdo exception
           AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
           //          // Log the database exception
           throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
           // return false;
           return false;
       }
   }
   /*
    * Method to delete display confirm delete
    */
     public function confirmDeleteJob(Request $request)
     {
         try{
         AchieveLogger::info("Entering AdminController.confrimDeleteJob()");
         $id = $request->input('id');
         AchieveLogger::info("Exiting AdminController.confrimDeleteJob()");
         return view('confirmdeleterecuritment')->with([
             'id' => $id
         ]);  
         }catch(PDOException $e)
         {
             
             // Log the pdo exception
             AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
             //          // Log the database exception
             throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
             // return false;
             return false;
         }
     }
     /*
      * Edit recruitment method to edit job postings
      */
     public function editRecruitment(Request $request)
     {
         try{
             AchieveLogger::info("Entering AdminController.editRecruitment()");
             // Grab recruitment edit form data
             // Validate form
             $jobTitle = $request->input('jobtitle');
             $company = $request->input('company');
             $description = $request->input('descripton');
             $salary = $request->input('salary');
             $requirements = $request->input('requirements');
             $id = $request->input('id');
             // Create a new Recruitments object
             $r = new Recuitment($jobTitle, $company, $description, $salary, $requirements, $id);
             // Grab role session
             $role = Session::get('role');
             // create a new Recruitment service
             $service = new RecruitmentService();
             $result = $service->editJob($r);
             
             // if result is successful
             if($result)
             {
                 // grab all Job Postings
                 $jobs = $service->getAllJobs($id);
                 // return view admin with all Jobs and role passed into it
                 AchieveLogger::info("Exiting AdminController.grabAllProfiles()");
                 return view("jobAdmin")->with([
                     'job' => $jobs,
                     'role' => $role
                 ]);
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
