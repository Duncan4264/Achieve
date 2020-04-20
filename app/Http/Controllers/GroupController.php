<?php
// Cyrus Duncan
// CST - 256
// This is my own work
namespace App\Http\Controllers;

use App\Services\Utility\AchieveLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use PDOException;
use App\Services\Buisness\GroupService;
use App\Services\Buisness\SkillService;
use App\Services\Buisness\EducationService;
use App\Model\Group;
use App\Services\Utility\DatabaseException;
use App\Services\Buisness\UserService;
use App\Services\Buisness\ProfileService;
use App\Model\Member;
use App\Services\Buisness\MemberService;




class GroupController extends Controller
{
    /*
    * Handle Validation for GroupController form
    */
    public function validateForm(Request $request)
    {
        AchieveLogger::info("Entering GroupController.validateForm()");
        $rules = ['GroupName' => 'required|string|max:20',
            'GroupDescription' => 'Required | Between:5,30'
        ];
        AchieveLogger::info("Exiting GroupController.validateForm()");
        $this->validate($request, $rules);
    }
    /*
     * display Group method to display the groups
     */
    public function displayGroup(Request $request)
    {
        AchieveLogger::info("Entering GroupController.displayGroup()");
        try{
            // Grab id session
            $id = Session::get('ID');
            // create a new Group service passing through the id
            $jobService = new GroupService();
            $group = $jobService->myGroups($id);
            
            AchieveLogger::info("Exiting GroupController.validateForm()");
            // return the group view with id and gru[ data
            return view("group")->with([
                'groups' => $group,
                'id' => $id
            ]);
        } catch(ValidationException $e1){
            throw $e1;
        } catch(\Exception $e2)
        {
            return view('systemException');
        }
    }
    /*
     * create Group method to create group
     */
    public function createGroup(Request $request)
    {
      try{
            AchieveLogger::info("Entering GroupController.createGroup()");
            $this->validateForm($request);
            // Grab Edit Group form data
            $groupName = $request->input('GroupName');
            $groupDescripton = $request->input('GroupDescription');
            // Grab id session
            $id = Session::get('ID');
            // Create a new Group object
            $g = new Group($groupName, $groupDescripton, -1, $id);
            // grab group service
            $groupSevice = new GroupService();
            //create group from group service
            $result = $groupSevice->createGroup($id, $g);
            // Group id
            $group = $groupSevice->myGroupName($groupName, $id);
            
            // grab group id
            $groupid = $group->getId();
            // create a new user service
            $profileService = new profileService();
            // grab the user
            $profile = $profileService->myProfile($id);
            // grab first name
            $userFirstName = $profile->getFirstname();
            // grab last name
            $userLastName = $profile->getLastname();
            // create a new member object
            $member = new Member($groupName, $userFirstName, $userLastName, $id, $groupid);
            // create a new member service
            $memberService = new MemberService();
            // Add the creator to the group
            $memberService->joinGroup($id, $member);
            // display groups service
            $groups = $groupSevice->myGroups($id);
            
            AchieveLogger::info("Exiting GroupController.createGroup()");
            // if result is successful
            if($result)
            {
                // return the group view with id and Education data
                return view("group")->with([
                    'groups' => $groups,
                    'id' => $id
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
     * Method to confrim delete group
     */
    public function confirmDeleteGroup(Request $request)
    {
        try{
        // Logger info
        AchieveLogger::info("Entering GroupController.confrimDeleteGroup()");
        // grab input group
        $groupname = $request->input('group');
        // grab the id group
        $id = $request->input('id');
        // Log confirm Delete Group
        AchieveLogger::info("Exiting AdminController.confirmDelete()");
        // return view to confirm delete group
        return view('confirmdeletegroup')->with([
            'id' => $id,
            'groupname' => $groupname
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
     * Method to delete group
     */
    public function deleteGroup(Request $request)
    {
        try{
        AchieveLogger::info("Entering GroupController.DeleteGroup()");
        // grab the id
        $id = $request->input('id');
        // create a group service
        $groupService = new GroupService();
        // call delete group
        $group = $groupService->deleteGroup($id);
        // grab the session id
        $id = Session::get('ID');
        // display the groups
        $groups = $groupService->myGroups($id);
        // if the group deleted returns true
        AchieveLogger::info("Exiting GroupController.DeleteGroup()");
        if($group)
        {
            // return group with groups information
             return view('group')->with([
                 'groups' => $groups,
                 'id' => $id
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
     * Method to display edit group
     */
    public function displayeditGroup(Request $request)
    {
        
        try{
            // log dispay edit group
            AchieveLogger::info("Entering GroupController.displayEditGroup()");
            // Grab id session
            $id = $request->input('id');
            // create a new Group service passing through the id
            $jobService = new GroupService();
            // grab prior Group from buisness service
            $group = $jobService->myGroupID($id);
            
            AchieveLogger::info("Exiting GroupController.displayEditGrup()");
            // return the editgroup view with id and profile data
            return view("editGroup")->with([
                'id' => $id,
                'group' => $group
            ]);
        } catch(ValidationException $e1){
            throw $e1;
        } catch(\Exception $e2)
        {
            return view('systemException');
        }
    }
    /*
     * Method to edit group
     */
    public function editGroup(Request $request)
    {
        try{
            AchieveLogger::info("Entering GroupController.editGroup()");
            // Grab id session
            $id = $request->input('id');
            $groupName = $request->input('groupname');
            $groupDescription = $request->input('groupdescription');
            // Grab Session ID
            $userID = Session::get('ID');
            // Create Group Object
            $group = new Group($groupName, $groupDescription, $id, $userID);
            // create a new Group service passing through the id
            $groupService = new GroupService();
            // grab prior Group from buisness service
            $group = $groupService->updateGroup($id, $group);
            // grab all of the groups
            $groups = $groupService->myGroups($id);
            // Log leaving group
            AchieveLogger::info("Exiting GroupController.editGroup()");
            // return the group view with id and profile data
            return view("group")->with([
                'id' => $id,
                'groups' => $groups
            ]);
        } catch(ValidationException $e1){
            throw $e1;
        } catch(\Exception $e2)
        {
            return view('systemexception');
        }
    }
    /*
     * Method to show group
     */
    public function showGroup(Request $request)
    {
        try{
            AchieveLogger::info("Entering GroupController.displayGroup()");
            // Grab id session
            $groupID = $request->input('id');
            // create a new Group service
           $groupService = new GroupService();
            // grab group by id
            $group = $groupService->myGroupID($groupID);
            // Make new MemberService
            $memberService = new MemberService();
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
            // Get group name
            $groupName = $group->getGroupName();
            // create new member object
            $member = new Member($groupName, $userFirstName, $userLastName, $id, $groupID);
            $members = $memberService->findGroups($id, $member);
            // Log leaving group
            AchieveLogger::info("Exiting GroupController.displayGroup()");
            // return the group view with id and profile data
            return view("agroup")->with([
                'id' => $id,
                'group' => $group,
                'members' => $members
            ]);
        } catch(ValidationException $e1){
            throw $e1;
        } catch(\Exception $e2)
        {
            return view('systemexception');
        }
    }


}
