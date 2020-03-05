<?php
namespace App\Services\Data;

use PDO;
use PDOException;
use App\Model\Education;
use Illuminate\Contracts\Logging\Log;
use App\Services\Utility\AchieveLogger;
use App\Services\Utility\DatabaseException;

class EducationDAO
{
    private $db;
    
    public function __construct($db)
    {
        $this->db = $db;
    }
    /*
     * Method to find specfic education history from profile
     */
    public function findEducation($id)
    {
       try {
           AchieveLogger::info("Entering EducationDAO.findEducation()");
            // Create a new array object
            $jobs = new \ArrayObject();
            
            // Query Statment
            $stmt = $this->db->prepare('SELECT * FROM `Education` WHERE `Users_id` = :userid');
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
                    // Create a new Education object that adds each data item found into a new data profile
                    $profile= new Education($data['degree_name'], $data['university'], $data['startDate'], $data['endDate'], $data['id']);
                    $jobs->append($profile);
                    
                    
                    
                }
                AchieveLogger::info("Exiting EducationDAO.findEducation()");
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
     * Method to create a new education history
     */
    public function create(Education $p, $uid)
    {
        try{
            AchieveLogger::info("Entering EducationDAO.create()");
            // Grab variables from the Education model
            $degreename =  $p->getDegreeName();
            $enddate = $p->getEndDate();
            $startdate = $p->getStartDate();
            $university = $p->getUniversity();
            

            //       try {
            // PDO statement to insert the user into the Education table
            $stmt = $this->db->prepare('INSERT INTO `Education` (`id`, `degree_name`, `university`, `startDate`, `endDate`, `Users_id`) VALUES
               (NULL, :degreename, :university, :startdate, :enddate, :uid)');
            // Bind the variables of the PDO statment to the education model variables
            $stmt->bindParam(':degreename', $degreename);
            $stmt->bindParam(':enddate', $enddate);
            $stmt->bindParam(':startdate', $startdate);
            $stmt->bindParam(':university', $university);
            $stmt->bindParam(':uid', $uid);
            $stmt->execute();
            
            
            AchieveLogger::info("Exiting EducationDAO.create()");
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
         * Method to update Education history
         */
        public function update($id, Education $education)
        {
            try {
                AchieveLogger::info("Entering EducationDAO.update()");
                // Grab the education perameters
                 $degreename = $education->getDegreeName();
                 $enddate = $education->getEndDate();
                 $startdate = $education->getStartDate();
                 $university = $education->getUniversity();
                //Create a new query to update education where id is equal to the profile id
                $stmt = $this->db->prepare("UPDATE
           `Education`
        SET `degree_name` = :degreename, `university` = :university, `startDate` = :startdate, `endDate` = :enddate WHERE `Education`.`id` = :uid");
                // Bind the query parameters
                $stmt->bindParam(':degreename', $degreename);
                $stmt->bindParam(':university', $university);
                $stmt->bindParam(':startdate', $startdate);
                $stmt->bindParam(':enddate', $enddate);
                $stmt->bindParam(':uid', $id);
                // Result is equal to execute query
                $result  = $stmt->execute();
                // if query is executed corretly
                AchieveLogger::info("Exiting EducationDAO.update()");
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
         * Method to find specfic education history by id
         */
        public function findEducationID($id)
        {
            try {
                AchieveLogger::info("Entering EducationDAO.findEducationID()");
                // Query Statment
                $stmt = $this->db->prepare('SELECT `id`, `degree_name`, `university`, `startDate`, `endDate`, `Users_id` FROM `Education` WHERE `id` = :userid');
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
                        // Create a new Education object that adds each data item found into a new data profile
                        $education = new Education($data['degree_name'], $data['university'], $data['startDate'], $data['endDate'], $data['id']);
                        
                        
                        
                    }
                    AchieveLogger::info("Exiting EducationDAO.findEducationID()");
                    // Return array of jobs
                    return $education;
                    
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
    

