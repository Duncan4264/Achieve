<?php
namespace App\Services\Buisness;

use App\Model\Member;
use App\Services\Utility\AchieveLogger;
use App\Services\Data\MemberDAO;
use PDO;

class MemberService
{
    /*
     * Join group
     */
    public function joinGroup($id, Member $m)
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
        $memberService = new MemberDAO($db);
        
        
        // Call the data acess object to method to edit a group
        $group = $memberService->create($id, $m);
        
        // Close connection
        $db = null;
        
        AchieveLogger::info("Exiting GroupService.deleteGroup()");
        // Return data acess object information
        return $group;
    }
    /*
     * Join group
     */
    public function leaveGroup($id, Member $m)
    {
        AchieveLogger::info("Entering GroupService.leaveGroup()");
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
        $memberService = new MemberDAO($db);
        
        
        // Call the data acess object to method to edit a group
        $group = $memberService->delete($id, $m);
        
        // Close connection
        $db = null;
        
        AchieveLogger::info("Exiting GroupService.leaveGroup()");
        // Return data acess object information
        return $group;
    }
    /*
     * find groups
     */
    public function findGroups($id, Member $m)
    {
        AchieveLogger::info("Entering GroupService.findGroup()");
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
        $memberService = new MemberDAO($db);
        
        
        // Call the data acess object to method to edit a group
        $group = $memberService->find($id, $m);
        
        // Close connection
        $db = null;
        
        AchieveLogger::info("Exiting GroupService.findGroup()");
        // Return data acess object information
        return $group;
    }
}


