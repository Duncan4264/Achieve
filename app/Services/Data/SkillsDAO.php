<?php
namespace App\Services\Data;

use App\Model\Skill;
use Illuminate\Contracts\Logging\Log;
use PDO;
use PDOException;
use App\Services\Utility\AchieveLogger;
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
            AchieveLogger::info("Entering SkillDAO.findSkill()");
            // Create a new array object
            $jobs = new \ArrayObject();
            
            // Query Statment
            $stmt = $this->db->prepare('SELECT * FROM `skills` WHERE `Users_id`= :userid');
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
                    // Create a new Skill object that adds each data item found into a new data profile
                    $profile= new Skill($data['skill'], $data['id']);
                    $jobs->append($profile);
                    
                    
                    
                }
                AchieveLogger::info("Exiting SkillDAO.findSkill()");
                // Return array of jobs
                return $jobs;
                
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
     * Method to find skill by id
     */
    public function findSkillID($id)
    {
        try {
            AchieveLogger::info("Entering SkillDAO.findSkillID()");
            // Query Statment
            $stmt = $this->db->prepare('SELECT `id`, `skill`, `Users_id` FROM `skills` WHERE `id` = :id');
            // Bind the parameter
            $stmt->bindParam(':id', $id);
            // Execute Query Statement
            $stmt->execute();
            
            
            
            
            
            // Check if the query fetched any rows
            if($stmt->rowCount() > 0)
            {
                // While the query is till fetching information put each itme in a data varaible
                while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    // Create a new Skill object that adds each data item found into a new data profile
                    $jobs= new Skill($data['skill'], $data['id']);
                    
                    
                    
                }
                AchieveLogger::info("Exiting SkillDAO.findSkillID()");
                // Return array of jobs
                return $jobs;
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
     * Method to create skill history
     */
    public function create(Skill $s, $uid)
    {
        try{
            AchieveLogger::info("Entering SkiillDAO.create()");
            // Grab variables from the profile model
            $skill =  $s->getSkill();
  
            
            
            // PDO statement to insert the user into the SKill table
            $stmt = $this->db->prepare('INSERT INTO `skills` (`id`, `skill`, `Users_id`) VALUES (NULL, :skill, :uid)');
            // Bind the variables of the PDO statment to the Skill model variables
            $stmt->bindParam(':skill', $skill);;
            $stmt->bindParam(':uid', $uid);
            $stmt->execute();
            // return true
            return true;
            
            // PDO statement to insert the user into the Skill table
            $stmt = $this->db->prepare('INSERT INTO `JobHistory` (`id`, `jobtitle`, `jobcompany`, `startdate`, `enddate`, `Users_id`)
          VALUES
         (NULL, :jobtitle, :company, :startdate, :enddate, :uid)');
            // Bind the variables of the PDO statment to the profile model variables
            $stmt->bindParam(':jobtitle', $jobTitle);
            $stmt->bindParam(':company', $company);
            $stmt->bindParam(':startdate', $startDate);
            $stmt->bindParam(':enddate', $enddate);
            $stmt->bindParam(':uid', $uid);
            $stmt->execute();
            AchieveLogger::info("Exiting SkiillDAO.create()");
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
     * Method to update Skill
     */
    public function update($id, Skill $s)
    {
        try {
            AchieveLogger::info("Entering SkiillDAO.update()");
            // Grab the Skill perameters
            $skill =  $s->getSkill();
            //Create a new query to update skill where id is equal to the profile id
            $stmt = $this->db->prepare("UPDATE `skills` SET 
             `skill`= :skill
           WHERE `id` = :id");
            // Bind the query parameters
            $stmt->bindParam(':skill', $skill);
            $stmt->bindParam(':id', $id);
            // Result is equal to execute query
            $result  = $stmt->execute();
            // if query is executed corretly
            AchieveLogger::info("Exiting SkiillDAO.update()");
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

