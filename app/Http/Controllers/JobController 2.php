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
     * display edited user method to display the Education after it hase been edited
     */
    public function displayJob(Request $request)
    {
        try{
            // Grab id session
            $id = Session::get('ID');
            // create a new Job service passing through the id
            $jobService = new JobService($id);
            $jobs = $jobService->myJobs($id);
            
            // grab prior skills
            $service = new SkillService($id);
            $skills = $service->mySkills($id);
            // grab prior Education from buisness service
            $educationService = new EducationService($id);
            
            $education = $educationService->myEducation($id);
            
            // return the editEducation view with id and profile data
            return view("editeducation")->with([
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
    public function displayEditJob(Request $request)
    {
        try{
            // Grab id session
            $id = Session::get('ID');
            // create a new Job service passing through the id
            $jobService = new JobService($id);
            // grab prior Jobs from buisness service
            $job = $jobService->myJobs($id);
            
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
    public function editJob(Request $request)
    {
        try{
            // Grab skill form data
            $jobtitle = $request->input('jobtitle');
            $company = $request->input('company');
            $startDate = $request->input('startdate');
            $endDate = $request->input('enddate');
            // Create a new skills object
            $j = new Job($jobtitle, $company, $startDate, $endDate);
            // Grab id session
            $id = Session::get('ID');
            // create a new  job service
            $jobService = new JobService();
            
            
          
            // Update the jobs with the new job object
            $result = $jobService->updateSkills($id, $j);
            // grab job infromation
            $job = $jobService->myJobs($id);
            
            
            // Grab the skills
            $skillsService = new SkillService();
            $skill = $skillsService->mySkills($id);
            //grab the education profile
            $service = new EducationService();
            $education = $service->myEducation($id);
            // Grab the profile for display
            $profileService = new ProfileService();
            $profile = $profileService->myProfile($id);
            // if result is successful
            if($result)
            {
                // return the profile veiw with id, profile data, education, skills and jobs
                return view("profile")->with([
                    'id' => $id,
                    'profile' => $profile,
                    'education' => $education,
                    'skill' => $skill,
                    'jobs' => $job
                ]);
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
