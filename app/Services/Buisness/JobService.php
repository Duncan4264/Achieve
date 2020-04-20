<?php
namespace App\Services\Buisness;

use PDO;
use App\Services\Data\JobDAO;
use App\Services\Utility\AchieveLogger;
use App\Model\Job;



class JobService
{
    /*
     * Display Job Information
     */
    public function myJobs($id)
    {
        AchieveLogger::info("Entering JobService.myJobs()");
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
        // Create a new Job data access object
        $service = new JobDAO($db);
        // Grab a specfic user from  job data access object
        $job = $service->findJob($id);
        // if job is null
        if($job == null)
        {
            // create a new job placeholder
//             $job = new Job("NA", "NA", 2019, 2020, -1);
//             $service->create($job, $id);
        }
        
        AchieveLogger::info("Exiting JobService.myJobs()");
        // return user
        return $job;
        
    }
    /*
     * Find Job Information By ID
     */
    public function myJobID($id)
    {
        
        AchieveLogger::info("Entering JobService.myJobID()");
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
        $service = new JobDAO($db);
        // Grab a specfic user from job data access object
        $job = $service->findJobID($id);
        AchieveLogger::info("Exiting JobService.myJobID()");
        // return user
        return $job;
        
    }
    /*
     * Update skills
     */
    public function updateJobs($id, $j)
    {
        AchieveLogger::info("Entering JobService.updateJobs()");
        // Connect to the database
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Make a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create a new job Data acess object
        $service =  new JobDAO($db);
        
        
        // Call the data acess object to method to edit a job
        $flag = $service->update($id, $j);
        
        // Close connection
        $db = null;
        
        AchieveLogger::info("Exiting JobService.updateJobs()");
        // Return data acess object information
        return $flag;
    }
    /*
     * Create Job
     */
    public function createJob($id, $j)
    {
        AchieveLogger::info("Entering JobService.createJob()");
        // Connect to the database
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Make a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create a new job Data acess object
        $service =  new JobDAO($db);
        
        
        // Call the data acess object to method to edit a job
        $flag = $service->create($id, $j);
        
        // Close connection
        $db = null;
        
        AchieveLogger::info("Exiting JobService.createJob()");
        // Return data acess object information
        return $flag;
    }
}

