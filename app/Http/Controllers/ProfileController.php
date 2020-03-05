<?php
// Cyrus Duncan
// CST - 256
// This is my own work
namespace App\Http\Controllers;


use App\Services\Buisness\ProfileService;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use PDOException;
use App\Model\Profile;
use App\Services\Utility\AchieveLogger;
use App\Services\Utility\DatabaseException;
use App\Services\Buisness\EducationService;
use App\Services\Buisness\SkillService;
use App\Services\Buisness\JobService;
class ProfileController extends Controller
{
    /*
     * Form validation
     */
    public function validateForm(Request $request)
    {
        AchieveLogger::info("Entering profileController.validateForm()");
        // Rules created for form validation
        $rules = ['firstname' => 'required|string|max:20|regex:/(^[A-Za-z0-9 ]+$)+/',
            'lastname' => 'Required | Between:4,20|regex:/(^[A-Za-z0-9 ]+$)+/',
            'country' => 'required|string|max:20|regex:/(^[A-Za-z0-9 ]+$)+/',
            'state' => 'required|string|max:20|regex:/(^[A-Za-z0-9 ]+$)+/',
            'street' => 'required|string|max:20|regex:/(^[A-Za-z0-9 ]+$)+/',
            'zip' => 'required|numeric'
        ];
        AchieveLogger::info("Exiting profileController.validateForm()");
        // validate form in framework
        $this->validate($request, $rules);
    }
    /*
     * Origination method to process profile creation
     */
   public function  onOrigination(Request $request)
   {
       try {
           AchieveLogger::info("Entering profileController.onOrigination()");
           
       // Call the form data
       $firstname = $request->input('firstname');
       $lastname = $request->input('lastname');
       $country = $request->input('country');
       $state = $request->input('state');
       $city = $request->input('city');
       $street = $request->input('street');
       $zip = $request->input('zip');
       // Create a new profile model
       $profile = new Profile($firstname, $lastname, $country, $state, $city, $street, $zip);
       
       // Create a new Profile Service Object
       $sc = new ProfileService();
       
       $userid = Session::get('ID');
       
       // Pass them into the Profile Service Object
       $status = $sc->origination($profile, $userid);
       
       AchieveLogger::info("Exiting profileController.onOrigination()");
       // Check to see if profile was created
       if($status)
       {
           // Return to show profile with data
           $data = ['model' => $profile];
           return view('register')->with($data);
       }
       else
       {
           // Return to create profile screen
          return view('createProfile');
       }
       } catch(ValidationException $e1){
           throw $e1;
       } catch(\Exception $e2)
       {
           return view('systemException');
       }
   }
   /*
    * Display method to process displaying a profile
    */
   public function display(Request $request)
   {
       try{
           AchieveLogger::info("Entering profileController.display()");
       // Grab id session
       $id = Session::get('ID');
       // create a new profile service passing through the id
       $service = new ProfileService($id);
       // grab a profile from buisness service
       $profile = $service->myProfile($id);
       
       $status = $service->findProfileStatus($id);
       
       if($status == '1')
       {
       Session::put('suspended', $status);
       }
       
       
       //grab skills profile
       $skillService = new SkillService();
       
       $skill = $skillService->mySkills($id);
       
       $educate = new EducationService($id);
       $knowledge = $educate->myEducation($id);
       
   
       //Grab job information
       $jobs = new JobService();
       $job = $jobs->myJobs($id);
       AchieveLogger::info("Exiting profileController.display()");
       // return the profile view with id and profile data
       return view("profile")->with([
           'id' => $id,
           'profile' => $profile,
           'educations' => $knowledge,
           'skills' => $skill,
           'jobs' => $job
       ]);
       
       } catch(ValidationException $e1){
           throw $e1;
       } catch(\Exception $e2)
       {
           return view('systemException');
       }
       
   }
   /*
    * display edited user method to display the profile after a user hase been edited
    */
   public function displayEditUser(Request $request)
   {
       try{
           AchieveLogger::info("Entering profileController.displayEditUser()");
       // Grab id session
       $id = Session::get('ID');
       // create a new profile service passing through the id
       $service = new ProfileService($id);
       // grab a profile from buisness service
       $profile = $service->myProfile($id);
      
       AchieveLogger::info("Exiting profileController.displayEditUser()");
       // return the editProfile view with id and profile data
       return view("editprofile")->with([
           'id' => $id,
           'profile' => $profile,
       ]);
       } catch(ValidationException $e1){
           throw $e1;
       } catch(\Exception $e2)
       {
           return view('systemException');
       }
   }
   /*
    * Annotation method to grab the edit user form data and edit the user as provided.
    */
   public function onAnnotate(Request $request)
   {
       AchieveLogger::info("Entering profileController.onAnnotate()");
       try{
       // Grab Annotate form data
           // Validate form
           $this->validateForm($request);
       $firstname = $request->input('firstname');
       $lastname = $request->input('lastname');
       $country = $request->input('country');
       $state = $request->input('state');
       $city = $request->input('city');
       $street = $request->input('street');
       $zip = $request->input('zip');
       // Create a new profile object
       $p = new Profile($firstname, $lastname, $country, $state, $city, $street, $zip);
       // Grab id session
       $id = Session::get('ID');
       // create a new profile service 
       $service = new ProfileService();
       
       
       //annotate the profile
       $result = $service->annotate($id, $p);
       // Grab the profile for display
       $profile = $service->myProfile($id);
       // Create a controlelr service passing through id
       $educationService = new EducationService();
       // Grab education informatin
       $education = $educationService->myEducation($id);
       // Grab skill information
       $skills = new SkillService();
       $skill = $skills->mySkills($id);
       //Grab job information
       $jobs = new JobService();
       $job = $jobs->myJobs($id);

       AchieveLogger::info("Exiting profileController.onAnnotate()");
       // if result is successful
       if($result)
       {
       // return the profile veiw with id and profile data
       return view("profile")->with([
           'id' => $id,
           'profile' => $profile,
           'educations' => $education,
           'skill' => $skill,
           'jobs' => $job
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
