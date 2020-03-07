<?php
// Cyrus Duncan
// CST - 256
// This is my own work
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use PDOException;
use App\Services\Buisness\GroupService;
use App\Services\Buisness\ProfileService;
use App\Model\Member;
use App\Services\Buisness\MemberService;
use App\Services\Utility\AchieveLogger;
use App\Services\Utility\DatabaseException;




class MemberController extends Controller
{
    /*
     * Method to join group
     */
    public function joinGroup(Request $request)
    {
        try {
        // Grab group id
        $groupID = $request->input('id');
        // Grab user id
        $id = Session::get('ID');
        // create profileService
        $profileService = new ProfileService();
        $profile = $profileService->myProfile($id);
        // Get user first name
        $userFirstName = $profile->getFirstname();
        $userLastName = $profile->getLastname();
        
        //create groupService
        $groupService = new GroupService();
        // grab group by id
        $group = $groupService->myGroupID($groupID);
        // grab all groups
        $groups = $groupService->myGroups($id);
        // Get group name
        $groupName = $group->getGroupName();
        // create new member object
        $member = new Member($groupName, $userFirstName, $userLastName, $id, $groupID);
       
        // create new member service
        $mermberService = new MemberService();
        // join group
        $newmember = $mermberService->joinGroup($id, $member);
        if($newmember)
        {
            return view('group')->with([
                'groups' => $groups
            ]);
        }
        else 
        {
            return view('group')->with('', 'Add Member failed');
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
     * Method to Leave group
     */
    public function leaveGroup(Request $request)
    {
        try {
            // Grab group id
            $groupID = $request->input('id');
            // Grab user id
            $id = Session::get('ID');
            // create profileService
            $profileService = new ProfileService();
            $profile = $profileService->myProfile($id);
            // Get user first name
            $userFirstName = $profile->getFirstname();
            // get user last name
            $userLastName = $profile->getLastname();
            
            //create groupService
            $groupService = new GroupService();
            // grab group by id
            $group = $groupService->myGroupID($groupID);
            // grab all groups
            $groups = $groupService->myGroups($id);
            // Get group name
            $groupName = $group->getGroupName();
            // create new member object
            $member = new Member($groupName, $userFirstName, $userLastName, $id, $groupID);
            
            // create new member service
            $mermberService = new MemberService();
            // join group
            $newmember = $mermberService->leaveGroup($id, $member);
            if($newmember)
            {
                return view('group')->with([
                    'groups' => $groups
                ]);
            }
            else
            {
                return view('group')->with('', 'Add Member failed');
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
