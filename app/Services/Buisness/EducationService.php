<?php
// Cyrus Duncan
// CST - 256
// This is my own work 
namespace App\Services\Buisness;


use PDO;
use App\Model\Education;
use App\Services\Data\EducationDAO;
use App\Services\Utility\AchieveLogger;

class EducationService
{
    /*
     * Display education information
     */
    public function myEducation($id)
    {
        AchieveLogger::info("Entering EducationService.myEducation()");
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
        // Create a nw Education data access object
        $service = new EducationDAO($db);
        // Grab a specfic user from Education data access layer
        $education = $service->findEducation($id);
        // if education is null
        if($education == null)
        {
            // create a new education placeholder
            $education = new Education("NA", "NA", 2019, 2020, -1);
            $service->create($education, $id);
        }
        AchieveLogger::info("Exiting EducationService.myEducation()");
        // return user
        return $education;
        
    }
    /*
     * Grab display education information
     */
    public function editmyEducation($id)
    {
        AchieveLogger::info("Entering EducationService.editmyEducation()");
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
        // Create a new education data access object
        $service = new EducationDAO($db);
        // Grab a specfic user from Education data access object
        $profile = $service->findEducationID($id);
        AchieveLogger::info("Exiting EducationService.editmyEducation()");
        // return user
        return $profile;
        
    }
    /*
     * Update Education information
     */
    public function updateEducation($id, $education)
    {
        AchieveLogger::info("Entering EducationService.updateEducation()");
        // Connect to the database
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Make a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create a new education Data acess object
        $service = new EducationDAO($db);
        
        
        // Call the data acess object to method to edit education history
        $flag = $service->update($id, $education);
        
        // Close connection
        $db = null;
        AchieveLogger::info("Exiting EducationService.updateEducation()");
        // Return data acess object information
        return $flag;
    }
    /*
     * Create Education 
     */
    public function createEducation(Education $e, $id)
    {
        AchieveLogger::info("Entering EducationService.createEducation()");
        // Connect to the database
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Make a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create a new education Data acess object
        $service = new EducationDAO($db);
        
        
        // Call the data acess object to method to edit education history
        $flag = $service->create($e, $id);
        
        // Close connection
        $db = null;
        
        AchieveLogger::info("Exiting EducationService.createEducation()");
        // Return data acess object information
        return $flag;
    }
}

