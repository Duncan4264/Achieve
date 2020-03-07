<?php
namespace App\Services\Buisness;

use PDO;
use App\Model\Skill;
use App\Services\Data\SkillsDAO;
use App\Services\Utility\AchieveLogger;
class SkillService
{
    /*
     * Method to display skills
     */
    public function mySkills($id)
    {
        AchieveLogger::info("Entering SkillService.mySkills()");
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
        // Create a new skill data access layer
        $service = new SkillsDAO($db);
        // Grab a specfic user from  skill data access layer
        $skills = $service->findSkill($id);
        // if skills is null
        if($skills == null)
        {
            // create a new skill place holder
            $skills = new Skill("NA", -1);
            $service->create($skills, $id);
        }
        
        AchieveLogger::info("Exiting SkillService.mySkills()");
        // return user
        return $skills;
        
    }
    /*
     * Method to display skill by id
     */
    public function mySkillID($id)
    {
        AchieveLogger::info("Entering SkillService.mySkillID()");
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
        // Create a new skill data access object
        $service = new SkillsDAO($db);
        // Grab a specfic user from  skill data access object
        $profile = $service->findSkillID($id);
        
        AchieveLogger::info("Exiting SkillService.mySkillID()");
        // return user
        return $profile;
        
    }
    /*
     * Update skills
     */
    public function updateSkills($id, $s)
    {
        AchieveLogger::info("Entering SkillService.updateSkills()");
        // Connect to the database
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Make a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create a new Skill Data acess object
        $service =  new SkillsDAO($db);
        
        
        // Call the skill acess object to method to edit a skill
        $flag = $service->update($id, $s);
        
        // Close connection
        $db = null;
        
        AchieveLogger::info("Exiting SkillService.updateSkills()");
        // Return data acess object information
        return $flag;
    }
    /*
     * add skills
     */
    public function addSkills(Skill $j, $id)
    {
        AchieveLogger::info("Entering SkillService.addSkills()");
        // Connect to the database
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Make a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Create a new Skills Data acess object
        $service =  new SkillsDAO($db);
        
        
        // Call the skill acess object to method to edit a skill
        $flag = $service->create($j, $id);
        
        // Close connection
        $db = null;
        
        AchieveLogger::info("Exiting SkillService.addSkills()");
        // Return data acess object information
        return $flag;
    }
    
}

