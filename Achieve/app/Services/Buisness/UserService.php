<?php
// Cyrus Duncan
// CST - 256
// This is my own work 
namespace App\Services\Buisness;
use \PDO;


use App\Model\UserModel;
use App\Model\CredentialModel;
use App\Services\Data\UserDAO;

class UserService
{
/*
 * Buisness Logic for logging in a user
 */
    public function authenticate(CredentialModel $credentials)
    {
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
        
        if($flag != null)
        {
            return $flag;
        } else 
            {
                return false;
            }
        // Close connection
        $db = null;
        
        // return data from data access  object
        return $flag;
    }
    /*
     * Buisness Logic to register a user
     */
    public function register(UserModel $user)
    {
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
        // Return data from Data Access Object
        return $flag;
    }
    public function findRole(CredentialModel $user)
    {
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
        $flag = $service->FindByUser($user);
        // Close database connection
        $db = null;
        // Return data from Data Access Object
        return $flag;
    }
}

