<?php
// Cyrus Duncan
// CST - 256
// This is my own work 
namespace App\Services\Buisness;
use \PDO;


use App\Model\UserModel;
use App\Model\CredentialModel;
use App\Services\Data\UserDAO;
use App\Services\Utility\AchieveLogger;

class UserService
{
/*
 * Buisness Logic for logging in a user
 */
    public function authenticate(CredentialModel $credentials)
    {
        AchieveLogger::info("Entering UserService.authenticate()");
        // Call database variables from configeration file
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Create a PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Pass connection to the Data Access Object
        $service = new UserDAO($db);
        // find the user to authenticate in data access object
        $flag = $service->FindByUser($credentials);
        
        AchieveLogger::info("Exiting UserService.authenticate()");
        
        // Close connection
        $db = null;
        
        if($flag != null)
        {
            return $flag;
        } else 
            {
                return false;
            }

    }
    /*
     * Buisness Logic to register a user
     */
    public function register(UserModel $user)
    {
        AchieveLogger::info("Entering UserService.register()");
        // Call the database config variables
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Create a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Pass connection to Data Access Object
        $service = new UserDAO($db);
        // Create user in Data Acess Object
        $flag = $service->createUser($user);
        // Close database connection
        $db = null;
        AchieveLogger::info("Extiing UserService.register()");
        // Return data from Data Access Object
        return $flag;
    }
    /*
     * Check to see if the user is registered
     */
    public function isRegistered(CredentialModel $user)
    {
        AchieveLogger::info("Entering UserService.isRegistered()");
        // Call the database config variables
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Create a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Pass connection to Data Access Object
        $service = new UserDAO($db);
        // Create user in Data Acess Object
        $flag = $service->FindByUsername($user);
        // Close database connection
        $db = null;
        AchieveLogger::info("Exiting UserService.isRegistered()");
        // Return data from Data Access Object
        return $flag;  
    }
    /*
    * Method to find the role of a user
    */
    public function findRole(CredentialModel $user)
    {
        AchieveLogger::info("Entering UserService.findRole()");
        // Call the database config variables
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        // Create a new PDO connection
        $db  = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Pass connection to Data Access Object
        $service = new UserDAO($db);
        // Create find role in Data Acess Object
        $flag = $service->findUserRole($user);
        // Close database connection
        $db = null;
        AchieveLogger::info("Exiting UserService.findRole()");
        // Return data from Data Access Object
        return $flag;
    }
}

