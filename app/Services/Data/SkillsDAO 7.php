<?php
namespace App\Services\Data;

use App\Model\Skill;
use Illuminate\Contracts\Logging\Log;
use PDO;
use PDOException;
use App\Services\Utility\DatabaseException;

class SkillsDAO
{
    private $db;
    
    public function __construct($db)
    {
        $this->db = $db;
    }
    /*
     * Method to find specific skill
     */
    public function findSkill($id)
    {
        try {
            // Use PDO Statement to grab profile from database
            $stmt = $this->db->prepare("SELECT `id`, `skill1`, `skill2`, `skill3`, `skill4`, `skill5` FROM `skills` WHERE `Users_id` = :userid");
            // Bind the parameter
            $stmt->bindParam(':userid', $id);
            // Run the query
            $stmt->execute();
            // If the query found something
            if($stmt->rowCount() == 1)
            {
                //fetch the data from the pdo statement
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                // Pass it in a data array and make a new profile object
                $profile= new Skill($data['skill1'], $data['skill2'], $data['skill3'], $data['skill4'], $data['skill5']);
                // return the new profile object
                return $profile;
                
                
            }
            else
            {
                // return null
                return null;
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
    /*
     * Method to create skill history
     */
    public function create(Skill $s, $uid)
    {
        try{
            // Grab variables from the profile model
            $skill1 =  $s->getSkill1();
            $skill2 = $s->getSkill2();
            $skill3 = $s->getSkill3();
            $skill4 = $s->getSkill4();
            $skill5 = $s->getSkill5();
            
            
            // PDO statement to insert the user into the Profile table
            $stmt = $this->db->prepare('INSERT INTO `skills` (`id`, `skill1`, `skill2`, `skill3`, `skill4`, `skill5`, `Users_id`) VALUES
               (NULL, :skill1, :skill2, :skill3, :skill4, :skill5, :uid);');
            // Bind the variables of the PDO statment to the profile model variables
            $stmt->bindParam(':skill1', $skill1);
            $stmt->bindParam(':skill2', $skill2);
            $stmt->bindParam(':skill3', $skill3);
            $stmt->bindParam(':skill4', $skill4);
            $stmt->bindParam(':skill5', $skill5);
            $stmt->bindParam(':uid', $uid);
            $stmt->execute();
            // return true
            return true;
            
            
        }
        //catch if the statement fails and pass through a PDOException peramator
        catch(PDOException $e)
        {
            
            // Log the pdo exception
            Log::error("Exception: ", array("message" => $e->getMessage()));
            //          // Log the database exception
            throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
            // return false;
            return false;
        }
    }
    /*
     * Method to update Education
     */
    public function update($id, Skill $s)
    {
        try {
            // Grab the profiles perameters
            $skill1 =  $s->getSkill1();
            $skill2 = $s->getSkill2();
            $skill3 = $s->getSkill3();
            $skill4 = $s->getSkill4();
            $skill5 = $s->getSkill5();
            //Create a new query to update profile where id is equal to the profile id
            $stmt = $this->db->prepare("UPDATE `skills` SET 
             `skill1`= :skill1,`skill2`= :skill2,`skill3`= :skill3,`skill4`= :skill4,`skill5`= :skill5 
           WHERE `Users_id` = :uid");
            // Bind the query parameters
            $stmt->bindParam(':skill1', $skill1);
            $stmt->bindParam(':skill2', $skill2);
            $stmt->bindParam(':skill3', $skill3);
            $stmt->bindParam(':skill4', $skill4);
            $stmt->bindParam(':skill5', $skill5);
            $stmt->bindParam(':uid', $id);
            // Result is equal to execute query
            $result  = $stmt->execute();
            // if query is executed corretly
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
            Log::error("Exception: ", array("message" => $e->getMessage()));
            //          // Log the database exception
            throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
            // return false;
            return false;
        }
    }
    
}

