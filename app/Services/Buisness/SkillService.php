<?php
namespace App\Services\Buisness;

use PDO;
use App\Model\Education;
use App\Services\Data\EducationDAO;
use App\Model\Skill;
use App\Services\Data\SkillsDAO;
class SkillService
{
    /*
     * Method to display skills
     */
    public function mySkills($id)
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
        $service = new SkillsDAO($db);
        // Grab a specfic user from  profile data access layer
        $profile = $service->findSkill($id);
        // if user is null
        if($profile == null)
        {
            // create new skill with NA to print not avaiable
            $profile = new Skill("NA", "NA", "NA", "NA", "NA");
            $service->create($profile, $id);
        }
        // return user
        return $profile;
        
    }
    /*
     * Update skills
     */
    public function updateSkills($id, $s)
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
        // Create a new Skills Data acess object
        $service =  new SkillsDAO($db);
        
        
        // Call the skill acess object to method to edit a profile
        $flag = $service->update($id, $s);
        
        // Close connection
        $db = null;
        
        // Return data acess object information
        return $flag;
    }
}

