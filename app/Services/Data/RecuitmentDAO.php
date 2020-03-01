<?php
namespace App\Services\Data;
use App\Model\Recuitment;
use Illuminate\Support\Facades\Log;
use PDO;
use PDOException;
use App\Services\Utility\DatabaseException;



class RecuitmentDAO
{
    private $db;
    
    public function __construct($db)
    {
        $this->db = $db;
    }
    /*
     * Method to create job
     */
    public function create(Recuitment $r) 
    {
        try{
            // Grab variables from the Recuitment model
            $jobTitle = $r->getJobTitle();
            $company = $r->getCompany();
            $description =  $r->getDescription();
            $salary = $r->getSalary();
            $requirements = $r->getRequirements();
            
            // PDO statement to insert the Job into the Job table
            $stmt = $this->db->prepare('INSERT INTO `JobPosting` (`id`, `jobtitle`, `company`, `description`, `salary`, `requirements`) 
           VALUES 
          (NULL, :jobtitle, :company, :description, :salary, :requirements)');
            // Bind the variables of the PDO statment to the profile model variables
            $stmt->bindParam(':jobtitle', $jobTitle);
            $stmt->bindParam(':company', $company);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':salary', $salary);
            $stmt->bindParam(':requirements', $requirements);
            $stmt->execute();
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
     * Function to find all Job Postings
     */
    public function findAllJobs()
    {
        try{
            
            // Create a new array object
            $profiles = new \ArrayObject();
            
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
                        $profiles->append($profile);
                    
                    
                    
                }
                // Return array of profiles
                return $profiles;
                
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
     * Method to delete a Job
     */
    public function DeleteJob($id)
    {
        try{
            // Query string
            $stmt = $this->db->prepare('DELETE FROM `JobPosting` 
                   WHERE `id` = :id');
            // bind the parameter
            $stmt->bindParam(':id', $id);
            //run query
            $stmt->execute();
            // Perform true
            return true;
            
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
     * Method to find specific Job
     */
    public function findJob($id)
    {
        try {
            // Use PDO Statement to grab profile from database
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
                // Pass it in a data array and make a new profile object
                $profile= new Recuitment($data['jobtitle'], $data['company'], $data['description'], $data['salary'], $data['requirements'], $data['id']);
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
     * Method to update profile
     */
    public function updateJob(Recuitment $r)
    {
        try {
            // Grab the profiles perameters
            $jobTitle = $r->getJobTitle();
            $company = $r->getCompany();
            $salary = $r->getSalary();
            $description = $r->getDescription();
            $requirements = $r->getRequirements();
            $id = $r->getId();
            
            //Create a new query to update profile where id is equal to the Recruitment id
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

