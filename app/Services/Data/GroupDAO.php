<?php
namespace App\Services\Data;


use App\Model\Job;
use Illuminate\Contracts\Logging\Log;
use PDO;
use PDOException;
use App\Services\Utility\AchieveLogger;
use App\Services\Utility\DatabaseException;
use App\Model\Group;

class GroupDAO
{
    private $db;
    
    public function __construct($db)
    {
        $this->db = $db;
    }
    
    /*
     * Method to find specific job
     */
    public function findGroup($id)
    {
        // Log find group
        AchieveLogger::info("Entering  GroupDAO.findGroup()");
        try {
            // Create a new array object
            $groups = new \ArrayObject();
            
            // Query Statment
            $stmt = $this->db->prepare('SELECT * FROM `Groups`');
            // Bind the parameter
            $stmt->bindParam(':userid', $id);
            // Execute Query Statement
            $stmt->execute();
            
            
            
            
            
            // Check if the query fetched any rows
            if($stmt->rowCount() > 0)
            {
                // While the query is till fetching information put each itme in a data varaible
                while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    // Create a new Group object that adds each data item found into a new data profile
                    $profile= new Group($data['GroupName'], $data['GroupDescription'], $data['id'], $data['Users_id']);
                    $groups->append($profile);
                    
                    
                    
                }
                AchieveLogger::info("Exiting GroupDAO.findGroup()");
                // Return array of jobs
                return $groups;
                
            }
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
     * Find Job ID
     */
    public function findGroupID($id)
    {
        try {
            AchieveLogger::info("Entering GroupDAO.findGroupID()");
            // Query Statment
            $stmt = $this->db->prepare('SELECT `id`, `GroupName`, `GroupDescription`, `Users_id` FROM `Groups` WHERE `id` = :userid');
            // Bind the parameter
            $stmt->bindParam(':userid', $id);
            // Execute Query Statement
            $stmt->execute();
            
            
            
            
            
            // Check if the query fetched any rows
            if($stmt->rowCount() > 0)
            {
                // While the query is till fetching information put each itme in a data varaible
                while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    // Create a new Group object that adds each data item found into a new data profile
                    $groups = new Group($data['GroupName'], $data['GroupDescription'], $data['id'], $data['Users_id']);
                    
                    
                    
                }
                AchieveLogger::info("Exiting GroupDAO.findGroupID()");
                // Return array of jobs
                return $groups;
                
            }
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
     * Method to create job
     */
    public function create(Group $g, $uid)
    {
        try{
            AchieveLogger::info("Entering GroupDAO.create()");
            // Grab variables from the group model
           $groupName =  $g->getGroupName();
           $groupDescripton =  $g->getGroupDescripton();
            
            // PDO statement to insert the user into the Groups table
            $stmt = $this->db->prepare('INSERT INTO `Groups` (`id`, `GroupName`, `GroupDescription`, `Users_id`) 
                VALUES 
             (NULL, :groupName,  :groupDescripton, :uid)');
            // Bind the variables of the PDO statment to the profile model variables
            $stmt->bindParam(':groupName', $groupName);
            $stmt->bindParam('groupDescripton', $groupDescripton);
            $stmt->bindParam(':uid', $uid);
            $stmt->execute();
            AchieveLogger::info("Exiting GroupDAO.create()");
            // return true
            return true;
            
            
        }
        //catch if the statement fails and pass through a PDOException peramator
        catch(PDOException $e)
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
     * Method to update Job History
     */
    public function update($id, Group $g)
    {
        try {
            AchieveLogger::info("Entering GroupDAO.update()");
            // Grab the Group perameters
            $groupName = $g->getGroupName();
            $groupDescription = $g->getGroupDescripton();
            //Create a new query to update Group where id is equal to the profile id
            $stmt = $this->db->prepare("UPDATE `Groups` SET 
           `GroupName`=:groupname,`GroupDescription`= :groupdescription WHERE `id` = :id");
            // Bind the query parameters
            $stmt->bindParam(':groupname', $groupName);
            $stmt->bindParam(':groupdescription', $groupDescription);
            $stmt->bindParam(':id', $id);
            // Result is equal to execute query
            $result  = $stmt->execute();
            // if query is executed corretly
            AchieveLogger::info("Exiting GroupDAO.update()");
            if($result)
            {
                // return true
                return true;
            }
            else {
                // else return false
                return false;
            }
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
     * Method to delete group
     */
    public function delete($id)
    {
        try {
            AchieveLogger::info("Entering GroupDAO.delete()");
            //Create a new query to update Group where id is equal to the profile id
            $stmt = $this->db->prepare("DELETE FROM `Groups` 
            WHERE 
            `Groups`.`id` = :uid");
            // Bind the query parameters
            $stmt->bindParam(':uid', $id);
            // Result is equal to execute query
            $result  = $stmt->execute();
            // if query is executed corretly
            AchieveLogger::info("Exiting GroupDAO.delete()");
            if($result)
            {
                // return true
                return true;
            }
            else {
                // else return false
                return false;
            }
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

