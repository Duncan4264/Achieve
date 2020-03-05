<?php
namespace App\Services\Buisness;
use PDO;
use App\Model\Recuitment;
use App\Services\Data\RecuitmentDAO;
use App\Services\Utility\AchieveLogger;

class RecruitmentService
{
    /*
     * Buisness logic to find all Jobs
     */
    public function getAllJobs($id)
    {
        AchieveLogger::info("Entering RecruitmentService.getAllJobs()");
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
        // Create a new recruitment data access object
        $job = new RecuitmentDAO($db);
        $profiles = $job->findAllJobs($id);
        AchieveLogger::info("Exiting RecruitmentService.getAllJobs()");
        return $profiles;
        
    }
    /*
     * Buisness Logic to create Jobs
     */
    public function createJob(Recuitment $r)
    {
        AchieveLogger::info("Entering RecruitmentService.createJob()");
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
        // Create a new recruitment data access object
        $job = new RecuitmentDAO($db);
        $profiles = $job->create($r);
        AchieveLogger::info("Exiting RecruitmentService.createJob()");
        return $profiles;
        
    }
    /*
     * Method to make a connection to delete a profile
     */
    public function deleteJob($id)
    {
        AchieveLogger::info("Entering RecruitmentService.deleteJob()");
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
        // Create a new recruitment data access object
        $profile = new RecuitmentDAO($db);
        $profiles = $profile->DeleteJob($id);
        AchieveLogger::info("Exiting RecruitmentService.deleteJob()");
        return $profiles;
    }
    /*
     * Method to make a connection to find a Job
     */
    public function findJob($id)
    {
        AchieveLogger::info("Entering RecruitmentService.findJob()");
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
        // Create a new recruitment data access object
        $profile = new RecuitmentDAO($db);
        $profiles = $profile->findJob($id);
        AchieveLogger::info("Exiting RecruitmentService.findJob()");
        return $profiles;
    }
    /*
     * Buisness logic to edit a profile
     */
    public function editJob(Recuitment $job)
    {
        AchieveLogger::info("Entering RecruitmentService.editJob()");
        // Connect to the database
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Make a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create a new recruitment Data acess object
        $service = new RecuitmentDAO($db);
        
        
        // Call the data acess object to method to edit a job posting
        $flag = $service->updatejob($job);
        
        // Close connection
        $db = null;
        
        AchieveLogger::info("Exiting RecruitmentService.editJob()");
        // Return data acess object information
        return $flag;
        
    }
    
}


