<?php
// Cyrus Duncan
// CST - 256
// This is my own work 
namespace App\Services\Buisness;

use App\Model\Profile;
use App\Services\Data\ProfileDAO;
use App\Services\Utility\AchieveLogger;

use PDO;

class ProfileService
{
    /*
     * Buisness logic to create a new profile
     */
    public function origination(Profile $myProfile, $uid)
    {
        AchieveLogger::info("Entering ProfileService.Origination()");
        // Connect to the database
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Make a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create a new profile Data acess object 
        $service = new ProfileDAO($db);
        
        
        // Call the data acess object to method to create a profile
        $flag = $service->createProfile($myProfile, $uid);
        
        // Close connection
        $db = null;
        
        AchieveLogger::info("Exiting ProfileService.Origination()");
        // Return data acess object information
        return $flag;
    }
    /*
     * Buisness logic to edit a profile
     */
    public function annotate($id, $profile)
    {
        AchieveLogger::info("Entering ProfileService.annotate()");
        // Connect to the database
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Make a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create a new profile Data acess object
        $service = new ProfileDAO($db);
        
        
        // Call the data acess object to method to edit a profile
        $flag = $service->updateProfile($id, $profile);
        
        // Close connection
        $db = null;
        
        AchieveLogger::info("Exiting ProfileService.annotate()");
        // Return data acess object information
        return $flag;
        
    }
    /*
     * Buisness Logic to display a user
     */
    public function myProfile($id)
    {
        AchieveLogger::info("Entering ProfileService.myProfile()");
        // create a new database connection
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Make a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        // PDO set attribute for error exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create a new profile data access layer
        $service = new ProfileDAO($db);
        // Grab a specfic user from  profile data access layer
        $profile = $service->findProfile($id);
        // if user is null
        if($profile == null)
        { 
            // create new profile with NA to print not avaiable
            $profile = new Profile("NA", "NA", "NA", "NA", "NA", "NA", "NA");
            $createProfile = $service->createProfile($profile, $id);
        }
        AchieveLogger::info("Exiting ProfileService.myProfile()");
        // return user
        return $profile;
        
    }
    /*
     * Buisness logic to find all profiles
     */
    public function getAllProfiles($id)
    {
        AchieveLogger::info("Entering ProfileService.getAllProfiles()");
        // create a new database connection
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Make a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        // PDO set attribute for error exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create a new profile data access layer
        $profile = new ProfileDAO($db);
        $profiles = $profile->findProfiles($id);
        AchieveLogger::info("Exiting ProfileService.getAllProfiles()");
        return $profiles;
        
    }
   /*
    * Method to make a connection to delete a profile
    */
    public function deleteProfile($id)
    {
        AchieveLogger::info("Entering ProfileService.deleteProfile()");
        // create a new database connection
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Make a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        // PDO set attribute for error exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create a new profile data access layer
        $profile = new ProfileDAO($db);
        $profiles = $profile->DeleteProfile($id);
        AchieveLogger::info("Deleting ProfileService.deleteProfile()");
        return $profiles;
    }
    /*
    * Method to make a connection to suspend a profile
    */
    public function suspendProfile($id)
    {
        AchieveLogger::info("Entering ProfileService.suspendProfile()");
        // create a new database connection
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Make a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        // PDO set attribute for error exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create a new profile data access layer
        $p= new ProfileDAO($db);
        $status = $p->findStatusByID($id);
        $profiles = $p->updateProfileStatus($id, $status);
        AchieveLogger::info("Exiting ProfileService.suspendProfile()");
            return $profiles;
        
        
    }
    /*
    * Method to unSuspendProfile
    */
    public function unSuspendprofile($id)
    {
        AchieveLogger::info("Entering ProfileService.unsuspendprofile()");
        // create a new database connection
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Make a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        // PDO set attribute for error exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create a new profile data access layer
        $p= new ProfileDAO($db);
        $status = $p->findStatusByID($id);
        $profiles = $p->updateProfileStatus($id, $status);
        AchieveLogger::info("Exiting ProfileService.unSuspendprofile()");
        return $profiles;
    }
    /*
    * Method to find the profile status
    */
    public function findProfileStatus($id)
    {
        AchieveLogger::info("Entering ProfileService.findProfileStatus()");
        // create a new database connection
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Make a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        // PDO set attribute for error exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create a new profile data access layer
        $p= new ProfileDAO($db);
        $status = $p->findStatus($id);
        AchieveLogger::info("Entering ProfileService.findProfileStatus()");
        return $status;
    }
}

