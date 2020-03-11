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
use App\Model\Education;
use App\Services\Buisness\EducationService;
use App\Services\Buisness\SkillService;
use App\Services\Buisness\JobService;

class EducationController extends Controller
{
    /*
     * display edited user method to display the Education after it hase been edited
     */
    public function validateForm(Request $request)
    {
        // rules to validate form
        $rules = ['degreename' => 'required|string|max:20|regex:/(^[A-Za-z0-9 ]+$)+/',
            'university' => 'Required | Between:1,20',
            'startdate' => 'Required|numeric',
            'enddate' => 'Required|numeric'
        ];
        // call framework validation
        $this->validate($request, $rules);
    }
    public function displayEditEducation(Request $request)
    {
        try{
            // Grab id session
            $id = Session::get('ID');
            // create a new Education service passing through the id
            $service = new EducationService($id);
            // grab prior Education from buisness service
            $education = $service->myEducation($id);
            
            // return the editEducation view with id and profile data
            return view("editeducation")->with([
                'id' => $id,
                'educate' => $education
            ]);
        } catch(ValidationException $e1){
            throw $e1;
        } catch(\Exception $e2)
        {
            return view('systemException');
        }
    }
    public function EditEducation(Request $request)
    {
        try{
            $this->validateForm($request);
            // Grab Edit Educaton form data
            $degreeName = $request->input('degreename');
            $university = $request->input('university');
            $startDate = $request->input('startdate');
            $endDate = $request->input('enddate');
            // Create a new Education object
            $e = new Education($degreeName, $university, $startDate, $endDate);
            // Grab id session
            $id = Session::get('ID');
            // create a new Education service
            $service = new EducationService();
            
            
            //edit the Education History
            $result = $service->updateEducation($id, $e);
            //grab the education profile
            $education = $service->myEducation($id);
            // Grab the profile for display
            $profileService = new ProfileService();
            $profile = $profileService->myProfile($id);
            
            //Grab the skill for display
            $skillService = new SkillService();
            $skill = $skillService->mySkills($id);
            
            // Grab the job for display
            $jobService = new JobService();
            $job = $jobService->myJobs($id);
            // if result is successful
            if($result)
            {
                // return the profile veiw with id and Education data
                return view("profile")->with([
                    'id' => $id,
                    'profile' => $profile,
                    'education' => $education,
                    'skill' => $skill,
                    'jobs' => $job
                ]);
            }
        } catch(ValidationException $e1){
            throw $e1;
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
