<?php
namespace App\Services\Buisness;

use PDO;

use App\Model\Member;
use App\Services\Utility\AchieveLogger;
use App\Services\Data\GroupDAO;



class GroupService
{
    /*
     * Display Group Information
     */
    public function myGroups($id)
    {
        AchieveLogger::info("Entering GroupService.myGroups()");
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
        // Create a new group data access object
        $groupService = new GroupDAO($db);
        // Grab a specfic user from group data access object
        $group = $groupService->findGroup($id);
        
        AchieveLogger::info("Exiting GroupService.myGroup()");
        // return user
        return $group;
        
    }
    /*
     * Find Group Information By ID
     */
    public function myGroupID($id)
    {
        
        AchieveLogger::info("Entering GroupService.myGroupID()");
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
        // Create a new group data access object
        $groupService = new GroupDAO($db);
        // Grab a specfic user from  group data access object
        $group = $groupService->findGroupID($id);
        AchieveLogger::info("Exiting GroupService.myGroupID()");
        // return user
        return $group;
        
    }
    /*
     * Update Group
     */
    public function updateGroup($id, $g)
    {
        AchieveLogger::info("Entering GroupService.updateGroup()");
        // Connect to the database
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Make a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create a new group Data acess object
        $groupService = new GroupDAO($db);
        
        
        // Call the data acess object to method to edit a group
        $group = $groupService->update($id, $g);
        
        // Close connection
        $db = null;
        
        AchieveLogger::info("Exiting GroupService.updateGroup()");
        // Return data acess object information
        return $group;
    }
    /*
     * Create Group
     */
    public function createGroup($id, $g)
    {
        AchieveLogger::info("Entering GroupService.createGroup()");
        // Connect to the database
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Make a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create a new group Data acess object
        $groupService = new GroupDAO($db);
        
        
        // Call the data acess object to method to edit a group
        $group = $groupService->create($g, $id);
        
        // Close connection
        $db = null;
        
        AchieveLogger::info("Exiting GroupService.createGroup()");
        // Return data acess object information
        return $group;
    }
    /*
     * Delete Group
     */
    public function deleteGroup($id)
    {
        AchieveLogger::info("Entering GroupService.deleteGroup()");
        // Connect to the database
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Make a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create a new group Data acess object
        $groupService = new GroupDAO($db);
        
        
        // Call the data acess object to method to edit a group
        $group = $groupService->delete($id);
        
        // Close connection
        $db = null;
        
        AchieveLogger::info("Exiting GroupService.deleteGroup()");
        // Return data acess object information
        return $group;
    }
    /*
     * Find Group Information By Name and userid
     */
    public function myGroupName($groupname, $id)
    {
        
        AchieveLogger::info("Entering GroupService.myGroupName()");
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
        // Create a new group data access object
        $groupService = new GroupDAO($db);
        // Grab a specfic user from  group data access object
        $group = $groupService->findGroupName($groupname, $id);
        AchieveLogger::info("Exiting GroupService.myGroupName()");
        // return user
        return $group;
        
    }

}

