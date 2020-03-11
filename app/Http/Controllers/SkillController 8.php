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

class SkillController extends Controller
{
    /*
     * display edited user method to display the Skill  after it hase been edited
     */
    public function displaySkill(Request $request)
    {
        try{
            // Grab id session
            $id = Session::get('ID');
            // create a new Skill service passing through the id
            $service = new SkillService();
            // grab prior Skils from buisness service
            $skills = $service->mySkills($id);
            // grab education information
            $educationService = new EducationService();
            $education = $educationService->myEducation($id);
            //grab skill information
            $jobService = new JobService();
            $job = $jobService->myJobs($id);
            // return the profile view with id 
            return view("profile")->with([
                'id' => $id,
                'educate' => $education,
                'skills' => $skills,
                'jobs' => $job
            ]);
        } catch(ValidationException $e1){
            throw $e1;
        } catch(\Exception $e2)
        {
            return view('systemException');
        }
    }
    public function displayEditSkill(Request $request)
    {
        try{
            // Grab id session
            $id = Session::get('ID');
            // create a new Skill service passing through the id
            $service = new SkillService($id);
            // grab prior Skill from buisness service
            $skill = $service->mySkills($id);
            
            // return the editEducation view with id and profile data
            return view("editskill")->with([
                'id' => $id,
                'skill' => $skill
            ]);
        } catch(ValidationException $e1){
            throw $e1;
        } catch(\Exception $e2)
        {
            return view('systemException');
        }
    }
    public function editSkill(Request $request)
    {
        try{
            // Grab skill form data
            $skill1 = $request->input('skill1');
            $skill2 = $request->input('skill2');
            $skill3 = $request->input('skill3');
            $skill4  = $request->input('skill4');
            $skill5  = $request->input('skill5');
            // Create a new skills object
            $s = new Skill($skill1, $skill2, $skill3, $skill4, $skill5);
            // Grab id session
            $id = Session::get('ID');
            // create a new Skill service
            $profileService = new SkillService();
            
            // update skills
            $result = $profileService->updateSkills($id, $s);
            
            // grab skills
            $skill = $profileService->mySkills($id);
            
  
            //grab the education profile
            $service = new EducationService();
            $education = $service->myEducation($id);
            // Grab the profile for display
            $profileService = new ProfileService();
            $profile = $profileService->myProfile($id);
            // Grab the job for display
            $jobService = new JobService();
            $job = $jobService->updateSkills($id, $j);
            // if result is successful
            if($result)
            {
                // return the profile veiw with id and profile data
                return view("profile")->with([
                    'id' => $id,
                    'profile' => $profile,
                    'education' => $education,
                    'skill' => $skill,
                    'job' => $job
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
