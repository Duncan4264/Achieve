<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Services\Utility\AchieveLogger;
use App\Model\DTO;
use App\Services\Buisness\RecruitmentService;

class JobRestController extends Controller
{
    /**
     * Grabs all of the jobs and converts them into JSON
     */
    public function index()
    {
        try {
            //Call Service to get all users
            $service = new RecruitmentService();
            // Grab all jobs
            $jobs = $service->getAllJobs();
            // Create a DAO
            if($jobs == null)
            {
                $dto = new DTO(-1, "Jobs Not Found", "");
            }
            else 
            {
            $dto = new DTO(0, "OK", $jobs);
            }
            // encode dto object to json
            $json = json_encode($dto);
            // return json
            return $json;
            // catch the exception
        } catch(Exception $e1)
        {
            // log the excetpion
            AchieveLogger::error("Exception: ", array("message" => $e1->getMessage()));
            
            // return DTO back to the user DTO
            $dto = new DTO(-2, $e1->getMessage(), "");
            // encode to json
            return json_encode($dto);
        }
    }
    /**
     * Grabs a certian job and converts it into JSON
     */
    public function show($id)
    {
        try {
            // Call service to get users
            $service = new RecruitmentService();
            // find the job
            $job = $service->findJob($id);
            
            
            // Create a DAO
            if($job == null)
            {
                $dto = new DTO(-1, "Job Not Found", "");
            }
            else
            {
                $dto = new DTO(0, "OK", $job);
                
            }
            // encode object into json
            $json = json_encode($dto);
            // return the json
            return $json;
            
        } catch (Exception $e1)
        {
            // log the exception
            AchieveLogger::error("Exception: ", array("message" => $e1->getMessage()));
            
            //return an error back to the user in the DTO
            $dto = new DTO(-2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }
}
