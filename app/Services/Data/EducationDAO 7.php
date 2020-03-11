<?php
namespace App\Services\Data;

use PDO;
use PDOException;
use App\Model\Education;
use Illuminate\Contracts\Logging\Log;
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
            // Use PDO Statement to grab profile from database
            $stmt = $this->db->prepare("SELECT `id`, `degree_name`, `university`, `startDate`, `endDate`, `Users_id` FROM `Education` WHERE `Users_id` = :userid");
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
                $profile= new Education($data['degree_name'], $data['university'], $data['startDate'], $data['endDate']);
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
     * Method to create a new education history
     */
    public function create(Education $p, $uid)
    {
        try{
            // Grab variables from the profile model
            $degreename =  $p->getDegreeName();
            $enddate = $p->getEndDate();
            $startdate = $p->getStartDate();
            $university = $p->getUniversity();
            

            //       try {
            // PDO statement to insert the user into the Profile table
            $stmt = $this->db->prepare('INSERT INTO `Education` (`id`, `degree_name`, `university`, `startDate`, `endDate`, `Users_id`) VALUES
               (NULL, :degreename, :university, :startdate, :enddate, :uid)');
            // Bind the variables of the PDO statment to the profile model variables
            $stmt->bindParam(':degreename', $degreename);
            $stmt->bindParam(':enddate', $enddate);
            $stmt->bindParam(':startdate', $startdate);
            $stmt->bindParam(':university', $university);
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
         * Method to update Education history
         */
        public function update($id, Education $education)
        {
            try {
                // Grab the profiles perameters
                 $degreename = $education->getDegreeName();
                 $enddate = $education->getEndDate();
                 $startdate = $education->getStartDate();
                 $university = $education->getUniversity();
                //Create a new query to update education where id is equal to the profile id
                $stmt = $this->db->prepare("UPDATE `Education` SET 
         `degree_name`=:degreename,`university`=:university,`startDate`=:startdate,
         `endDate`=:enddate 
               WHERE Users_id = :uid");
                // Bind the query parameters
                $stmt->bindParam(':degreename', $degreename);
                $stmt->bindParam(':university', $university);
                $stmt->bindParam(':startdate', $startdate);
                $stmt->bindParam(':enddate', $enddate);
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
    

