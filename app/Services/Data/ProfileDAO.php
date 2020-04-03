<?php
// Cyrus Duncan
// CST - 256
// This is my own work
namespace App\Services\Data;
use App\Model\Profile;
use PDO;
use PDOException;
use Illuminate\Contracts\Logging\Log;
use App\Services\Utility\AchieveLogger;
use App\Services\Utility\DatabaseException;

class ProfileDAO
{
    // Create a private null variable for the database
    private $db = null;
    /*
     * Constructor method to inizalize database connection
     */
    public function __construct($db)
    {
        $this->db = $db;
    }
   /*
    * Method to create profile
    */ 
    public function createProfile(Profile $p, $uid)
    {
        try{
            AchieveLogger::info("Entering ProfileDAO.createProfile()");
        // Grab variables from the profile model
        $firstname = $p->getFirstname();
        $lastname = $p->getLastname();
        $country = $p->getCountry();
        $state = $p->getState();
        $city = $p->getCity();
        $street = $p->getStreet();
        $zip = $p->getZip();
        $status = 0;
                // PDO statement to insert the user into the Profile table
                $stmt = $this->db->prepare('INSERT INTO `Profiles` (`id`, `firstname`, `lastname`, `country`, `state`, `city`, `street`, `zip`, `status`, `Users_id`) VALUES
                (NULL, :firstname, :lastname, :country, :state, :city, :street, :zip, :status, :uid)');
                // Bind the variables of the PDO statment to the profile model variables
                $stmt->bindParam(':firstname', $firstname);
                $stmt->bindParam(':lastname', $lastname);
                $stmt->bindParam(':country', $country);
                $stmt->bindParam(':state', $state);
                $stmt->bindParam(':city', $city);
                $stmt->bindParam(':street', $street);
                $stmt->bindParam(':zip', $zip);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':uid', $uid);
                $stmt->execute();
                AchieveLogger::info("Exiting ProfileDAO.createProfile()");
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
         * Method to find specific profile
         */
        public function findProfile($id)
        {
            try {
                AchieveLogger::info("Entering ProfileDAO.findProfile()");
            // Use PDO Statement to grab profile from database
            $stmt = $this->db->prepare("SELECT `id`, `firstname`, `lastname`, `country`, `state`, `city`, `street`, `zip`, `status`, `Users_id` FROM `Profiles` WHERE `Users_id` = :userid");
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
                $profile= new Profile($data['firstname'], $data['lastname'], $data['country'], $data['state'], $data['city'], $data['street'], $data['zip'], $data['status'], $data['id']);
                // return the new profile object
                AchieveLogger::info("Exiting ProfileDAO.findProfile()");
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
                return false;
                return false;
            }
        }
        
        /*
         * Method to find specific profile by id
         */
        public function findProfileID($id)
        {
            try {
                AchieveLogger::info("Entering ProfileDAO.findProfileID()");
                // Use PDO Statement to grab profile from database
                $stmt = $this->db->prepare("SELECT `id`, `firstname`, `lastname`, `country`, `state`, `city`, `street`, `zip`, `status`, `Users_id` FROM `Profiles` WHERE `id` = :id");
                // Bind the parameter
                $stmt->bindParam(':id', $id);
                // Run the query
                $stmt->execute();
                // If the query found something
                if($stmt->rowCount() == 0)
                {
                    AchieveLogger::info("Exit ProfileDAO.findByProfileID() with false");
                    return null;
                }
                else
                {   
                 //fetch the data from the pdo statement
                  $data = $stmt->fetch(PDO::FETCH_ASSOC);
                  // Pass it in a data array and make a new profile object
                $profile = new Profile($data['firstname'], $data['lastname'], $data['country'], $data['state'], $data['city'], $data['street'], $data['zip'], $data['id']);
                 return $profile;
                }
            } catch(PDOException $e)
            {
                
                // Log the pdo exception
                AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
                //          // Log the database exception
                throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
                return false;
                return false;
            }
        }
        /*
         * Method to find specific profile status
         */
        public function findStatus($id)
        {
            try {
                AchieveLogger::info("Entering ProfileDAO.findStatus()");
            // Use PDO Statement to grab profile from database
            $stmt = $this->db->prepare("SELECT `status` FROM `Profiles` WHERE `Users_id` = :userid");
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
                $status = $data['status'];
                
                AchieveLogger::info("Exiting ProfileDAO.findStatus()");
                // return the new profile object
                return $status;
                
                
            }
            else
            {
                // return null
                return null;
            }
        } catch(PDOException $e)
        {
            
//             // Log the pdo exception
            AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
               // Log the database exception
            throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
            // return false;
            return false;
        }
            
        }
        /*
         * Method to find specific profile status
         */
        public function findStatusByID($id)
        {
            try {
                AchieveLogger::info("Entering ProfileDAO.findStatusID()");
                // Use PDO Statement to grab profile from database
                $stmt = $this->db->prepare("SELECT `status` FROM `Profiles` WHERE `id` = :id");
                // Bind the parameter
                $stmt->bindParam(':id', $id);
                // Run the query
                $stmt->execute();
                // If the query found something
                if($stmt->rowCount() == 1)
                {
                    //fetch the data from the pdo statement
                    $data = $stmt->fetch(PDO::FETCH_ASSOC);
                    // Pass it in a data array and make a new profile object
                    $status = $data['status'];
                    AchieveLogger::info("Exiting ProfileDAO.findStatusID()");
                    // return the new profile object
                    return $status;
                    
                    
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
         * Method to update profile
         */
        public function updateProfile($id, $profile)
        {
            try {
                AchieveLogger::info("Entering ProfileDAO.findupdateProfile()");
            // Grab the profiles perameters
            $firstname = $profile->getFirstname();
            $lastname = $profile->getLastname();
            $country = $profile->getCountry();
            $state = $profile->getState();
            $city = $profile->getCity();
            $street = $profile->getStreet();
            $zip = $profile->getZip();
             //Create a new query to update profile where id is equal to the profile id
            $stmt = $this->db->prepare("UPDATE `Profiles`
           SET `firstname`=:firstname,`lastname`=:lastname,`country`=:country,`state`=:state,`city`=:city,`street`=:street,`zip`=:zip
        WHERE `Users_id` = :uid");
            // Bind the query parameters
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':state', $state);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':street', $street);
            $stmt->bindParam(':zip', $zip);
            $stmt->bindParam(':uid', $id);
            // Result is equal to execute query
            $result  = $stmt->execute();
            AchieveLogger::info("Exiting ProfileDAO.findupdateProfile()");
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
            AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
            //          // Log the database exception
            throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
            return false;
        }
            
        }
        /*
         * Method to find all of the profiles
         */
        public function findProfiles($id)
        {
            try{
                AchieveLogger::info("Entering ProfileDAO.findProfiles()");
            // Create a new array object
            $profiles = new \ArrayObject();
            
            // Query Statment
            $stmt = $this->db->prepare('SELECT *
                                   FROM Profiles');
            // Execute Query Statement
            $stmt->execute();
            
          
            
            
           
            // Check if the query fetched any rows
            if($stmt->rowCount() > 0)
            {
                // While the query is till fetching information put each itme in a data varaible
                while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    // Create a new profie object that adds each data item found into a new data profile
                    $profile = new Profile($data['firstname'], $data['lastname'], $data['id'], $data['state'], $data['city'], $data['street'], $data['zip'], $data['status'], $data['Users_id'], $data['id']);
                  
                    if($data['Users_id'] != $id)
                    {
                        $profiles->append($profile);
                    }
                    
                  
                }
                AchieveLogger::info("Entering ProfileDAO.findProfiles()");
                // Return array of profiles
                return $profiles;
                
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
         * Method to delete a profile
         */
        public function DeleteProfile($id)
        {
            try{
                AchieveLogger::info("Entering ProfileDAO.DeleteProfile()");
            // Query string 
            $stmt = $this->db->prepare('DELETE FROM `Profiles` WHERE id = :id');
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
                AchieveLogger::info("Exiting ProfileDAO.DeleteProfile()");
                // return false;
                return false;
            }
        }
        /*
         * Update profile status
         */
        public function updateProfileStatus($id, $status)
        {
            try{
                AchieveLogger::info("Entering ProfileDAO.updateProfileStatus()");
            // if profile status is equal to 1
            if($status == 1)
            {
                // unsuspend it by setting it to 0 in the query string
            $stmt = $this->db->prepare('UPDATE `Profiles` SET `status`= 0 WHERE `id` = :id');
            // bind id parameter
            $stmt->bindParam(':id', $id);
            // execute command
            $stmt->execute();
            // return true
            return true;
            }
            // if profile status is equal to 0
            else if($status == 0)
            {
                // create query string to suspend it
                $stmt = $this->db->prepare('UPDATE `Profiles` SET `status`= 1 WHERE `id` = :id ');
                // bind parameter
                $stmt->bindParam(':id', $id);
                // execute query
                $stmt->execute();
                AchieveLogger::info("Exiting ProfileDAO.updateProfileStatus()");
                // return true
                return true;
            }
            else {
                // of nothing happens return false
                return false;
            }
            } catch(PDOException $e)
            {
                
                // Log the pdo exception
                AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
                // Log the database exception
                throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
                // return false;
                return false;
            }
        }
        
        
    }

