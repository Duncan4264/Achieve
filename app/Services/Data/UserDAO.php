<?php
// Cyrus Duncan
// CST - 256
// This is my own work
namespace App\Services\Data;
use App\Model\UserModel;
use PDO;
use PDOException;
use App\Model\CredentialModel;
use Illuminate\Contracts\Logging\Log;
use App\Services\Utility\AchieveLogger;
use App\Services\Utility\DatabaseException;

class UserDAO
{
    // Create a private null variable for the database
    private $db = null;
    /*
     * Constructor method to inizalize a database conncetion
     */
    public function __construct($db)
    {
        $this->db = $db;
    }
    /*
     * Method to create a user
     */
    public function createUser(UserModel $user)
    {
        AchieveLogger::info("Entering UserDAO.createUser()");
        // Grab variables from the user model
        $username = $user->getUsername();
        $password = $user->getPassword();
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $email = $user->getEmail();
        $role = $user->getRole();
         try {
         // PDO statement to insert the user into the Users table
        $stmt = $this->db->prepare('INSERT 
       INTO `Users`
       (`id`, `username`, `password`, `email`, `first_name`, `last_name`, `role`)
       VALUES 
       (NULL, :username, :password, :email,  :firstname, :lastname, :role)');
        // Bind the variables of the PDO statment to the user model variables
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        
        
        AchieveLogger::info("Exiting UserDAO.createUser()");
        return true;
        
       
        }
        // catch if the statement fails and pass through a PDOException peramator
        catch(PDOException $e)
        {
           // Log the pdo exception
           AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
          // Log the database exception
         throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
//          // return false;
         return false;
       }
    }
    /*
     * Method to find a user
     */
    public function FindByUser(CredentialModel $user)
    {
        try {
            AchieveLogger::info("Entering UserDAO.createUser()");
            // Get credentials input into the form
            $name = $user->getUsername();
            $pw =  $user->getPassword();
            // Query Statment
            $stmt = $this->db->prepare('SELECT id, username, password, email, first_name, last_name, role FROM `Users` WHERE username = :username AND password = :password');
            // bind the statment variables to the credential model variable
            $stmt->bindParam(':username', $name);
            $stmt->bindParam(':password', $pw);
            // run the execute command
            $stmt->execute();
            
            
            
            
            AchieveLogger::info("Exiting UserDAO.createUser()");
            // Check to see if the query found a row
            if($stmt->rowCount() == 1)
            {
                // make a data variable equal to all of the data caught in the query
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                // Pass data into a new user model
                $user = new CredentialModel($data['username'], $data['password'], $data['id'], $data['role']);
                // Finally return true
 
                return $user;
            }
            else
            {
                // Return false is query statement is not found
                return false;
            }
        } catch(PDOException $e)
        {
            // Log the pdo exception
            AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
            // Log the database exception
            throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
            // return false;
            return false;
        }
        
    }
    
    /*
     * Method to find a user
     */
    public function FindByUsername(CredentialModel $user)
    {
        try {
            AchieveLogger::info("Entering UserDAO.FindByUsername()");
            // Get credentials input into the form
            $name = $user->getUsername();
            // Query Statment
            $stmt = $this->db->prepare('SELECT id, username, password, email, first_name, last_name, role FROM `Users` WHERE username = :username');
            // bind the statment variables to the credential model variable
            $stmt->bindParam(':username', $name);
            // run the execute command
            $stmt->execute();
            
            
            
            
            AchieveLogger::info("Exiting UserDAO.FindByUsername()");
            // Check to see if the query found a row
            if($stmt->rowCount() == 1)
            {
                return true;
            }
            else
            {
                // Return false is query statement is not found
                return false;
            }
        } catch(PDOException $e)
        {
            // Log the pdo exception
            AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
            // Log the database exception
            throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
            // return false;
            return false;
        }
        
    }
    /*
     * Method to find user role
     */
    
    public function findUserRole(CredentialModel $user)
    {
        try {
            AchieveLogger::info("Entering UserDAO.FindByUserRole()");
            // Get credentials input into the form
            $name = $user->getUsername();
            $pw =  $user->getPassword();
            // Query Statment
            $stmt = $this->db->prepare('SELECT id, username, password, email, first_name, last_name, role FROM `Users` WHERE username = :username AND password = :password');
            // bind the statment variables to the credential model variable
            $stmt->bindParam(':username', $name);
            $stmt->bindParam(':password', $pw);
            // run the execute command
            $stmt->execute();
            
            
            
            
            AchieveLogger::info("Exiting UserDAO.FindByUserRole()");
            // Check to see if the query found a row
            if($stmt->rowCount() == 1)
            {
                // make a data variable equal to all of the data caught in the query
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                // Pass data into a new user model
                if($data['role'] == 'admin')
                {
                    return true;
                }
                else {
                    return false;
                }
            }
            else
            {
                // Return false is query statement is not found
                return false;
            }
        } catch(PDOException $e)
        {
            // Log the pdo exception
            AchieveLogger::error("Exception: ", array("message" => $e->getMessage()));
            // Log the database exception
            throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
            // return false;
            return false;
        }
        
    }
  
}

