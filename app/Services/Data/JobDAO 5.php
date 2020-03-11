<?php
namespace App\Services\Data;

use App\Model\Education;
use App\Model\Job;
use App\Model\Skill;
use Illuminate\Contracts\Logging\Log;
use PDO;
use PDOException;
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
        try {
            // Use PDO Statement to grab job from database
            $stmt = $this->db->prepare(
                "SELECT `id`, `jobtitle`, `jobcompany`, `startdate`, `enddate`, `Users_id`
                FROM 
              `JobHistory` WHERE `Users_id` = :userid"
                );
            // Bind the parameter
            $stmt->bindParam(':userid', $id);
            // Run the query
            $stmt->execute();
            // If the query found something
            if($stmt->rowCount() == 1)
            {
                //fetch the data from the pdo statement
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                // Pass it in a data array and make a new job object
                $job = new Job($data['jobtitle'], $data['jobcompany'], $data['startdate'], $data['enddate']);
                // return the new profile object
                return $job;
                
                
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
     * Method to create job
     */
    public function create(Job $j, $uid)
    {
        try{
            // Grab variables from the job model
           $jobTitle =  $j->getJobTitle();
           $company =  $j->getCompany();
            $startDate = $j->getStartDate();
            $enddate = $j->getEndDate();
            
            // PDO statement to insert the user into the Job table
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
     * Method to update Job History
     */
    public function update($id, Job $j)
    {
        try {
            // Grab the Job perameters
             $jobTitle = $j->getJobTitle();
             $company = $j->getCompany();
             $startDate =  $j->getStartDate();
             $endDate = $j->getEndDate();
            //Create a new query to update Job where id is equal to the profile id
            $stmt = $this->db->prepare("UPDATE `JobHistory` SET 
            `jobtitle`=:jobtitle,`jobcompany`=:jobcompany,`startdate`= :startdate,`enddate`= :enddate,`Users_id`= :uid 
             WHERE 
            `Users_id`");
            // Bind the query parameters
            $stmt->bindParam(':jobtitle', $jobTitle);
            $stmt->bindParam(':jobcompany', $company);
            $stmt->bindParam(':startdate', $startDate);
            $stmt->bindParam(':enddate', $endDate);
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

