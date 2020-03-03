<?php
// Cyrus Duncan
// CST - 256
// This is my own work 
namespace App\Services\Buisness;

use App\Model\Profile;
use App\Services\Data\ProfileDAO;
use PDO;
use App\Model\Education;
use App\Services\Data\EducationDAO;

class EducationService
{
    /*
     * Display education information
     */
    public function myEducation($id)
    {
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
        $service = new EducationDAO($db);
        // Grab a specfic user from Education data access layer
        $profile = $service->findEducation($id);
        // if user is null
        if($profile == null)
        {
            // create new Education with NA to print not avaiable
            $profile = new Education("NA", "NA", "NA", "NA");
            $service->create($profile, $id);
        }
        // return user
        return $profile;
        
    }
    /*
     * Update Education information
     */
    public function updateEducation($id, $education)
    {
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
        
        // Return data acess object information
        return $flag;
    }
}

