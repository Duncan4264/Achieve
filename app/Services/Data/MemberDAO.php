<?php
namespace App\Services\Data;

use App\Model\Member;
use App\Services\Utility\AchieveLogger;
use PDO;
use PDOException;
use App\Services\Utility\DatabaseException;
use Illuminate\Support\Facades\Session;

class MemberDAO
{
    private $db;
    
    public function __construct($db)
    {
        $this->db = $db;
    }
    /*
     * Method to Join group
     */
    public function create($id, Member $m)
    {
        try{
            AchieveLogger::info("Entering MemberDAO.create()");
            // Grab variables from the job model
        $groupName = $m->getGroupName();
        $firstName = $m->getUserFirstName();
        $lastName = $m->getUserLastName();
        $groupID = $m->getGroupid();
        $userID = $m->getUserid();
            
            // PDO statement to insert the user into the Job table
            $stmt = $this->db->prepare('INSERT INTO `Members` (`id`, `groupname`, `userfirstname`, `userlastname`, `users_id`, `groups_id`) 
                  VALUES 
            (NULL, :groupname, :firstname, :lastname, :userid, :groupid)');
            // Bind the variables of the PDO statment to the Job model variables
            $stmt->bindParam(':groupname', $groupName);
            $stmt->bindParam(':firstname', $firstName);
            $stmt->bindParam(':lastname', $lastName);
            $stmt->bindParam(':groupid', $groupID);
            $stmt->bindParam(':userid', $userID);
            $stmt->execute();
            AchieveLogger::info("Exiting MemberDAO.create()");
            // return true
            return true;
            
            
        //catch if the statement fails and pass through a PDOException peramator
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
    public function delete($id, Member $m)
    {
        try{
            AchieveLogger::info("Entering MemberDAO.delete()");
            // Grab variables from the job model
            $groupID = $m->getGroupid();
            $userID = $m->getUserid();
            
            // PDO statement to insert the user into the Job table
            $stmt = $this->db->prepare('DELETE FROM `Members` WHERE `Members`.`users_id` = :userid AND `Members`.`groups_id` = :groupid');
            // Bind the variables of the PDO statment to the Job model variables
            $stmt->bindParam(':groupid', $groupID);
            $stmt->bindParam(':userid', $userID);
            $stmt->execute();
            AchieveLogger::info("Exiting MemberDAO.delete()");
            // return true
            return true;
            
            
            //catch if the statement fails and pass through a PDOException peramator
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
     * Method to find all members
     */
    public function find($id, Member $m)
    {
//         try{
            // Log find group
            AchieveLogger::info("Entering  MemberDAO.find()");
            // Grab variables from the job model
            $groupID = $m->getGroupid();
            
                // Create a new array object
                $groups = new \ArrayObject();
                
                // PDO statement to insert the user into the Job table
                $stmt = $this->db->prepare('SELECT * FROM `Members` WHERE `groups_id` = :groupid');
                // Bind the variables of the PDO statment to the Job model variables
                $stmt->bindParam(':groupid', $groupID);
                $stmt->execute();
              
                // Check if the query fetched any rows
                if($stmt->rowCount() > 0)
                {
                    // While the query is till fetching information put each itme in a data varaible
                    while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        // Create a new Group object that adds each data item found into a new data profile
                        $profile= new Member($data['groupname'], $data['userfirstname'], $data['userlastname'], $data['users_id'], $data['groups_id']);
                        $groups->append($profile);
                        
                        
                        
                    }
                    AchieveLogger::info("Exiting GroupDAO.find()");
                    // Return array of jobs
                    return $groups;
                    
                }
            AchieveLogger::info("Entering MemberDAO.delete()");
            //catch if the statement fails and pass through a PDOException peramator
//         } catch(PDOException $e)
//         {
            
//             // Log the pdo exception
//             AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
//             //          // Log the database exception
//             throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
//             // return false;
//             return false;
//         }
    }
}

