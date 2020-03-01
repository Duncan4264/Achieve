<?php
namespace App\Services\Buisness;
use PDO;
use App\Model\Recuitment;
use App\Services\Data\RecuitmentDAO;

class RecruitmentService
{
    /*
     * Buisness logic to find all Jobs
     */
    public function getAllJobs($id)
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
        $job = new RecuitmentDAO($db);
        $profiles = $job->findAllJobs($id);
        return $profiles;
        
    }
    /*
     * Buisness Logic to create Jobs
     */
    public function createJob(Recuitment $r)
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
        $job = new RecuitmentDAO($db);
        $profiles = $job->create($r);
        return $profiles;
        
    }
    /*
     * Method to make a connection to delete a profile
     */
    public function deleteJob($id)
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
        $profile = new RecuitmentDAO($db);
        $profiles = $profile->DeleteJob($id);
        return $profiles;
    }
    /*
     * Method to make a connection to find a Job
     */
    public function findJob($id)
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
        $profile = new RecuitmentDAO($db);
        $profiles = $profile->findJob($id);
        return $profiles;
    }
    /*
     * Buisness logic to edit a profile
     */
    public function editJob(Recuitment $job)
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
        // Create a new profile Data acess object
        $service = new RecuitmentDAO($db);
        
        
        // Call the data acess object to method to edit a profile
        $flag = $service->updatejob($job);
        
        // Close connection
        $db = null;
        
        // Return data acess object information
        return $flag;
        
    }
    
}


