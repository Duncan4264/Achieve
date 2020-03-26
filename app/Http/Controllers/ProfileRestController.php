<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Services\Buisness\ProfileService;
use App\Model\DTO;
use App\Services\Utility\AchieveLogger;

class ProfileRestController extends Controller
{
    public function show($id)
    {
        try {
            // Call service to get users
            $service = new ProfileService();
            // service to get profile by id
            $profile = $service->myProfileID($id);
     
            
            // Create a DAO
            if($profile == null)
            {
                $dto = new DTO(-1, "Profile Not Found", "");
            }
            else
            {
                $dto = new DTO(0, "OK", $profile);
                
            }
            // encode the dto object to json
            $json = json_encode($dto);
            
            // return the json
            return $json;
         // catch the exception   
        } catch (Exception $e1)
        {
            // log the exception error
            AchieveLogger::error("Exception: ", array("message" => $e1->getMessage()));
            
            //return an error back to the user in the DTO
            $dto = new DTO(-2, $e1->getMessage(), "");
            // return the json encode
            return json_encode($dto);
        }
    }
}
