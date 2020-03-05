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
use App\Services\Utility\AchieveLogger;
use App\Services\Utility\DatabaseException;
use App\Services\Buisness\EducationService;

use App\Services\Buisness\ProfileService;
use App\Model\Skill;
use App\Services\Buisness\SkillService;
use App\Services\Buisness\JobService;
use App\Services\Data\JobDAO;
use App\Model\Job;

class JobController extends Controller
{
    /*
    * Method to validated job edit and job create form
    */
    public function validateForm(Request $request)
    {
        AchieveLogger::info("Entering JobController.validateForm()");
        // rules to validate form
        $rules = ['jobtitle' => 'required|string| Between:1,20|regex:/(^[A-Za-z0-9 ]+$)+/',
            'company' => 'Required | Between:1,20|regex:/(^[A-Za-z0-9 ]+$)+/',
            'startdate' => 'Required|numeric',
            'enddate' => 'Required|numeric'
        ];
        AchieveLogger::info("Exiting JobController.validateForm()");
        // call framework validation
        $this->validate($request, $rules);
    }
    /*
     * display edited user method to display the Job after it hase been edited
     */
    public function displayJob(Request $request)
    {
        AchieveLogger::info("Entering JobController.displayJob()");
        try{
            // Grab id session
            $id = Session::get('ID');
            // create a new Job service passing through the id
            $jobService = new JobService($id);
            $jobs = $jobService->myJobs($id);
            
            // grab prior skills
            $service = new SkillService($id);
            $skills = $service->mySkills($id);
            // grab prior Job from buisness service
            $educationService = new EducationService($id);
            
            $education = $educationService->myEducation($id);
            
            AchieveLogger::info("Exiting JobController.validateForm()");
            // return the profile view with id and profile data
            return view("profile")->with([
                'id' => $id,
                'educate' => $education,
                'skills' => $skills,
                'jobs' => $jobs
            ]);
        } catch(ValidationException $e1){
            throw $e1;
        } catch(\Exception $e2)
        {
            return view('systemException');
        }
    }
    /*
     * display edited Job form
     */
    public function displayEditJob(Request $request)
    {
        try{
            AchieveLogger::info("Entering JobController.displayEditJob()");
            // Grab id session
            $id = $request->input('id');
            // create a new Job service passing through the id
            $jobService = new JobService();
            // grab prior Jobs from buisness service
            $job = $jobService->myJobID($id);
            
            AchieveLogger::info("Exiting JobController.displayEditJob()");
            // return the editJob view with id and profile data
            return view("editjob")->with([
                'id' => $id,
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
     * Handle edit job form
     */
    public function editJob(Request $request)
    {
        try{
            AchieveLogger::info("Entering JobController.editJob()");
            $this->validateForm($request);
            // Grab Job form data
            $jobtitle = $request->input('jobtitle');
            $company = $request->input('company');
            $startDate = $request->input('startdate');
            $endDate = $request->input('enddate');
            // Create a new Job object
            $j = new Job($jobtitle, $company, $startDate, $endDate, -1);
            // Grab id session
            $id = $request->input('id');
            // create a new Job service
            $jobService = new JobService();
            
            
          
            // Update the Jobs with the new Job object
            $result = $jobService->updateJobs($id, $j);
            // grab Job infromation
            $id = Session::get('ID');
            // Grab the jobs 
            $job = $jobService->myJobs($id);
            
            
            // Grab the Skill
            $skillsService = new SkillService();
            $skill = $skillsService->mySkills($id);
            //grab the Education profile
            $service = new EducationService();
            $education = $service->myEducation($id);
            // Grab the profile for display
            $profileService = new ProfileService();
            $profile = $profileService->myProfile($id);
            
            AchieveLogger::info("Exiting JobController.editJob()");
            // if result is successful
            if($result)
            {
                // return the profile veiw with id, profile data, education, skills and jobs
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
    /*
     * Method to create Job
     */
    public function createJob(Request $request)
    {
        try{
            AchieveLogger::info("Entering JobController.createJob()");
            $this->validateForm($request);
            // Grab Create Job form data
            $degreeName = $request->input('jobtitle');
            $university = $request->input('company');
            $startDate = $request->input('startdate');
            $endDate = $request->input('enddate');
            // Create a new Job object
            $e = new Job($degreeName, $university, $startDate, $endDate, -1);
            // Grab id session
            $id = Session::get('ID');
            // create a new Job service
            $service = new JobService();
            
            
            //create the Job History
            $result = $service->createJob($e, $id);
            //grab the education profile
            $eService = new EducationService();
            $education = $eService->myEducation($id);
            // Grab the profile for display
            $profileService = new ProfileService();
            $profile = $profileService->myProfile($id);
            
            //Grab the skill for display
            $skillService = new SkillService();
            $skill = $skillService->mySkills($id);
            
            // Grab the job for display
            $jobService = new JobService();
            $job = $jobService->myJobs($id);
            AchieveLogger::info("Exiting JobController.createJob()");
            // if result is successful
            if($result)
            {
                // return the profile veiw with id and Education data
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
