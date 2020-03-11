<?php
namespace App\Services\Data;
use App\Model\Recuitment;
use Illuminate\Support\Facades\Log;
use PDO;
use PDOException;
use App\Services\Utility\AchieveLogger;
use App\Services\Utility\DatabaseException;



class RecuitmentDAO
{
    private $db;
    
    public function __construct($db)
    {
        $this->db = $db;
    }
    /*
     * Method to create job posting
     */
    public function create(Recuitment $r) 
    {
        try{
            AchieveLogger::info("Entering ProfileDAO.create()");
            // Grab variables from the Recuitment model
            $jobTitle = $r->getJobTitle();
            $company = $r->getCompany();
            $description =  $r->getDescription();
            $salary = $r->getSalary();
            $requirements = $r->getRequirements();
            
            // PDO statement to insert the Job posting into the Jobposting table
            $stmt = $this->db->prepare('INSERT INTO `JobPosting` (`id`, `jobtitle`, `company`, `description`, `salary`, `requirements`) 
           VALUES 
          (NULL, :jobtitle, :company, :description, :salary, :requirements)');
            // Bind the variables of the PDO statment to the recruitment model variables
            $stmt->bindParam(':jobtitle', $jobTitle);
            $stmt->bindParam(':company', $company);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':salary', $salary);
            $stmt->bindParam(':requirements', $requirements);
            $stmt->execute();
            AchieveLogger::info("Exiting ProfileDAO.create()");
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
     * Function to find all Job Postings
     */
    public function findAllJobs()
    {
        try{
            AchieveLogger::info("Entering ProfileDAO.findAllJobs()");
            // Create a new array object
            $jobs = new \ArrayObject();
            
            // Query Statment
            $stmt = $this->db->prepare('SELECT * FROM `JobPosting`');
            // Execute Query Statement
            $stmt->execute();
            
            
            
            
            
            // Check if the query fetched any rows
            if($stmt->rowCount() > 0)
            {
                // While the query is till fetching information put each itme in a data varaible
                while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    // Create a new Recuitment object that adds each data item found into a new data profile
                    $profile = new Recuitment($data['jobtitle'], $data['company'], $data['description'], $data['salary'], $data['requirements'], $data['id']);
                        $jobs->append($profile);
                    
                    
                    
                }
                AchieveLogger::info("Exiting ProfileDAO.findAllJobs()");
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
     * Method to delete a Job
     */
    public function DeleteJob($id)
    {
        try{
            AchieveLogger::info("Entering ProfileDAO.DeleteJob()");
            // Query string
            $stmt = $this->db->prepare('DELETE FROM `JobPosting` 
                   WHERE `id` = :id');
            // bind the parameter
            $stmt->bindParam(':id', $id);
            //run query
            $stmt->execute();
            AchieveLogger::info("Exiting ProfileDAO.DeleteJob()");
            // Perform true if true
            return true;
            
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
     * Method to find specific Job
     */
    public function findJob($id)
    {
        try {
            AchieveLogger::info("Entering ProfileDAO.findJob()");
            // Use PDO Statement to grab REcruitment from database
            $stmt = $this->db->prepare("SELECT `id`, `jobtitle`, `company`, `description`, `salary`, `requirements` FROM `JobPosting` WHERE `id` = :userid");
            // Bind the parameter
            $stmt->bindParam(':userid', $id);
            // Run the query
            $stmt->execute();
            // If the query found something
            if($stmt->rowCount() == 1)
            {
                //fetch the data from the pdo statement
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                // Pass it in a data array and make a new recruitment object
                $profile= new Recuitment($data['jobtitle'], $data['company'], $data['description'], $data['salary'], $data['requirements'], $data['id']);
                AchieveLogger::info("Exiting ProfileDAO.findJob()");
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
            AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
            //          // Log the database exception
            throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
            // return false;
            return false;
        }
    }
    /*
     * Method to update job
     */
    public function updateJob(Recuitment $r)
    {
        try {
            AchieveLogger::info("Entering ProfileDAO.updateJob()");
            // Grab the job posting perameters
            $jobTitle = $r->getJobTitle();
            $company = $r->getCompany();
            $salary = $r->getSalary();
            $description = $r->getDescription();
            $requirements = $r->getRequirements();
            $id = $r->getId();
            
            //Create a new query to update job where id is equal to the Recruitment id
            $stmt = $this->db->prepare("UPDATE `JobPosting` SET 
        `jobtitle` = :jobtitle, `company` = :company, `description` = :description, `salary` = :salary, `requirements` = :requirements 
     WHERE
          `JobPosting`.`id` = :id");
            // Bind the query parameters
            $stmt->bindParam(':jobtitle', $jobTitle);
            $stmt->bindParam(':company', $company);
            $stmt->bindParam(':salary', $salary);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':requirements', $requirements);
            $stmt->bindParam(':id', $id);
            // Result is equal to execute query
            $result  = $stmt->execute();
            // if query is executed corretly
            AchieveLogger::info("Exiting ProfileDAO.updateJob()");
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
     * Method to find specific Job
     */
    public function findJobName($search)
    {
        try{
            AchieveLogger::info("Entering RecuitmentDAO.JobName()");
            // Create a new array object
            $jobs = new \ArrayObject();
            
            // bind s to a wildcard search
            $s= "%$search%";
            // Query Statment
            $stmt = $this->db->prepare("SELECT * FROM `JobPosting` WHERE `jobtitle` LIKE :search OR `company` LIKE :search");
            // bind parameters
            $stmt->bindParam(':search', $s);
            // Execute Query Statement
            $stmt->execute();
            
            
            
            
            
            // Check if the query fetched any rows
            if($stmt->rowCount() > 0)
            {
                // While the query is till fetching information put each itme in a data varaible
                while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    // Create a new Recuitment object that adds each data item found into a new data profile
                    $profile = new Recuitment($data['jobtitle'], $data['company'], $data['description'], $data['salary'], $data['requirements'], $data['id']);
                    $jobs->append($profile);
                    
                    
                    
                }
                AchieveLogger::info("Exiting RecuitmentDAO.findJobName()");
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
}

