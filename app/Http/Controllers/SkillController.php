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

use App\Services\Utility\AchieveLogger;
use App\Services\Utility\DatabaseException;
use App\Services\Buisness\EducationService;

use App\Services\Buisness\ProfileService;
use App\Model\Skill;
use App\Services\Buisness\SkillService;
use App\Services\Buisness\JobService;

class SkillController extends Controller
{
    /*
     * Handle validation for skill creation and edit forms 
     */
    public function validateForm(Request $request)
    {
        AchieveLogger::info("Entering SkillController.validateForm()");
        // rules to validate form
        $rules = ['skill' => 'required|string|max:20|regex:/(^([a-zA-Z]+)(\d+)?$)/u'
        ];
        AchieveLogger::info("Exiting SkillController.validateForm()");
        // call framework validation
        $this->validate($request, $rules);
    }
    /*
     * display edited user method to display the Skill  after it hase been edited
     */
    public function displaySkill(Request $request)
    {
        AchieveLogger::info("Entering SkillController.displaySkill()");
        try{
            // Grab id session
            $id = Session::get('ID');
            // create a new Skill service passing through the id
            $service = new SkillService();
            // grab prior Skills from buisness service
            $skills = $service->mySkills($id);
            // grab education information
            $educationService = new EducationService();
            $education = $educationService->myEducation($id);
            //grab skill information
            $jobService = new JobService();
            $job = $jobService->myJobs($id);
            AchieveLogger::info("Entering SkillController.displaySkill()");
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
    /*
     * display edit skill
     */
    public function displayEditSkill(Request $request)
    {
        AchieveLogger::info("Entering SkillController.displayEditSkill()");
        try{
            // Grab id session
            $id = $request->input('id');
            // create a new Skill service passing through the id
            $jobService = new SkillService();
            // grab prior Jobs from buisness service
            $skill = $jobService->mySkillID($id);
            
            AchieveLogger::info("Entering SkillController.displayEditSkill()");
            // return the editSkill view with id and profile data
            return view("editskill")->with([
                'id' => $id,
                'skill' => $skill
            ]);
        } catch(ValidationException $e1){
            throw $e1;
        }
    }
    /*
     * Handle post edit skill form
     */
    public function editSkill(Request $request)
    {
        AchieveLogger::info("Entering SkillController.editSkill()");
        try{
            $this->validateForm($request);
            // Grab skill form data
             $skill = $request->input('skill');
            // Create a new skills object
            $s = new Skill($skill, -1);
            // Grab id session
            $id = $request->input('id');
            // create a new Skill service
            $skillService = new SkillService();
            
            
            
            // Update the Skill with the new job object
            $result = $skillService->updateSkills($id, $s);
            // Grab ID frrom Session
            $id = Session::get('ID');
            // grab job infromation
            $jobService = new JobService();
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
            AchieveLogger::info("Entering SkillController.editSkill()");
            // if result is successful
            if($result)
            {
                // return the profile veiw with id, profile data, education, skills and jobs
                return view("profile")->with([
                    'id' => $id,
                    'profile' => $profile,
                    'educations' => $education,
                    'skills' => $skill,
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
     * display add skill
     */
    public function addSkill(Request $request)
    {
        try{
            AchieveLogger::info("Entering SkillController.addSkill()");
            // Grab add Skill input
            $j = $request->input('skill');
            
           
            // Grab id session
            $id = Session::get('ID');
            $j = new Skill($j, $id);
            // create a new Skill service passing through the id
            $service = new SkillService();
            // grab prior Skill from buisness service
            $skill = $service->addSkills($j, $id);
            
            // create a new profile service passing through the id
            $service = new ProfileService($id);
            // grab a profile from buisness service
            $profile = $service->myProfile($id);
            
           
            //grab skills profile
            $skillService = new SkillService();
            $skill = $skillService->mySkills($id);
            // return the editEducation view with id and profile data
            $educate = new EducationService($id);
            $knowledge = $educate->myEducation($id);
            
            
            //Grab job information
            $jobs = new JobService();
            $job = $jobs->myJobs($id);
            AchieveLogger::info("Exiting SkillController.validateForm()");
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
    
    
 
}
