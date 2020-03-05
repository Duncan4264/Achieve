<?php
namespace App\Services\Data;


use App\Model\Job;
use Illuminate\Contracts\Logging\Log;
use PDO;
use PDOException;
use App\Services\Utility\AchieveLogger;
use App\Services\Utility\DatabaseException;

class JobDAO
{
    private $db;
    
    public function __construct($db)
    {
        $this->db = $db;
    }
    
    /*
     * Method to find specific job
     */
    public function findJob($id)
    {
        AchieveLogger::info("Entering  JobDAO.findJob()");
        try {
            // Create a new array object
            $jobs = new \ArrayObject();
            
            // Query Statment
            $stmt = $this->db->prepare('SELECT * FROM `JobHistory` WHERE `Users_id`= :userid');
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
                    // Create a new Job object that adds each data item found into a new data profile
                    $profile= new Job($data['jobtitle'], $data['jobcompany'], $data['startdate'], $data['enddate'], $data['id']);
                    $jobs->append($profile);
                    
                    
                    
                }
                AchieveLogger::info("Exiting JobDAO.findJob()");
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
     * Find Job ID
     */
    public function findJobID($id)
    {
        try {
            AchieveLogger::info("Entering JobDAO.findJobID()");
            // Query Statment
            $stmt = $this->db->prepare('SELECT `id`, `jobtitle`, `jobcompany`, `startdate`, `enddate`, `Users_id` FROM `JobHistory` WHERE `id` = :userid');
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
                    // Create a new Job object that adds each data item found into a new data profile
                    $jobs= new Job($data['jobtitle'], $data['jobcompany'], $data['startdate'], $data['enddate'], $data['id']);
                    
                    
                    
                }
                AchieveLogger::info("Exiting JobDAO.findJobID()");
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
     * Method to create job
     */
    public function create(Job $j, $uid)
    {
        try{
            AchieveLogger::info("Entering JobDAO.create()");
            // Grab variables from the job model
           $jobTitle =  $j->getJobTitle();
           $company =  $j->getCompany();
            $startDate = $j->getStartDate();
            $enddate = $j->getEndDate();
            
            // PDO statement to insert the user into the Job table
            $stmt = $this->db->prepare('INSERT INTO `JobHistory` (`id`, `jobtitle`, `jobcompany`, `startdate`, `enddate`, `Users_id`) 
          VALUES 
         (NULL, :jobtitle, :company, :startdate, :enddate, :uid)');
            // Bind the variables of the PDO statment to the Job model variables
            $stmt->bindParam(':jobtitle', $jobTitle);
            $stmt->bindParam(':company', $company);
            $stmt->bindParam(':startdate', $startDate);
            $stmt->bindParam(':enddate', $enddate);
            $stmt->bindParam(':uid', $uid);
            $stmt->execute();
            AchieveLogger::info("Exiting JobDAO.create()");
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
    public function update($id, Job $j)
    {
        try {
            AchieveLogger::info("Entering JobDAO.update()");
            // Grab the Job perameters
             $jobTitle = $j->getJobTitle();
             $company = $j->getCompany();
             $startDate =  $j->getStartDate();
             $endDate = $j->getEndDate();
            //Create a new query to update Job where id is equal to the profile id
            $stmt = $this->db->prepare("UPDATE `JobHistory` SET `jobtitle` = :jobtitle, `jobcompany` = :jobcompany, `startdate` = :startdate, `enddate` = :enddate 
           WHERE 
           `JobHistory`.`id` = :uid");
            // Bind the query parameters
            $stmt->bindParam(':jobtitle', $jobTitle);
            $stmt->bindParam(':jobcompany', $company);
            $stmt->bindParam(':startdate', $startDate);
            $stmt->bindParam(':enddate', $endDate);
            $stmt->bindParam(':uid', $id);
            // Result is equal to execute query
            $result  = $stmt->execute();
            // if query is executed corretly
            AchieveLogger::info("Exiting JobDAO.update()");
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

