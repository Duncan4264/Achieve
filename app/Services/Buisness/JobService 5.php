<?php
namespace App\Services\Buisness;

use PDO;
use App\Services\Data\JobDAO;
use App\Model\Job;



class JobService
{
    /*
     * Display Job Information
     */
    public function myJobs($id)
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
        $service = new JobDAO($db);
        // Grab a specfic user from  profile data access layer
        $job = $service->findJob($id);
        // if user is null
        if($job == null)
        {
            // create new profile with NA to print not avaiable
            $job = new Job("NA", "NA", "NA", "NA");
            $service->create($job, $id);
        }
        // return user
        return $job;
        
    }
    /*
     * Update skills
     */
    public function updateSkills($id, $j)
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
        $service =  new JobDAO($db);
        
        
        // Call the data acess object to method to edit a profile
        $flag = $service->update($id, $j);
        
        // Close connection
        $db = null;
        
        // Return data acess object information
        return $flag;
    }
}

