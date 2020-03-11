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
use Symfony\Component\HttpFoundation\Session\Session;
use App\Services\Utility\DatabaseException;
use App\Model\Profile;

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
        // Grab variables from the user model
        $username = $user->getUsername();
        $password = $user->getPassword();
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $email = $user->getEmail();
        // Create a check user statement to fetch the database for the username typed in
        $checkUser = $this->db->prepare("
         SELECT count(1)
         FROM Users
         WHERE username = :username
         ");
        // Bind the paramate of the string variable to user model username variable
        $checkUser->bindParam(':username', $username);
        $checkUser->execute();
      
        // check to see if the user exists
        if($checkUser->rowCount() == 0) 
        {
         // Return false and stop the program;
            return false;
        }
        try {
         // PDO statement to insert the user into the Users table
        $stmt = $this->db->prepare('INSERT 
       INTO `Users`
       (`id`, `username`, `password`, `email`, `first_name`, `last_name`) VALUES (NULL, :username, :password, :email,  :firstname, :lastname)');
        // Bind the variables of the PDO statment to the user model variables
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->execute();
        
        

        return true;
        
        //$sql_statement = "INSERT INTO `Users` (`id`, `username`, `password`, `email`) VALUES (NULL, '$user->userName', '$user->Password', '$user->email')";
        }
        // catch if the statement fails and pass through a PDOException peramator
        catch(PDOException $e)
        {
            // Log the pdo exception
          log::error("Exception: ", array("message" => $e->getMessage()));
//          // Log the database exception
         throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
         // return false;
          return false;
        }
    }
    /*
     * Method to find a user
     */
    public function FindByUser(CredentialModel $user)
    {
        try {
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
            
            
            
            
            
            // Check to see if the query found a row
            if($stmt->rowCount() == 1)
            {
                // make a data variable equal to all of the data caught in the query
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                // Pass data into a new user model
                $user = new UserModel($data['id'], $data['username'], $data['password'], $data['email'], $data['first_name'], $data['last_name'], $data['role']);
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
            Log::error("Exception: ", array("message" => $e->getMessage()));
            // Log the database exception
            throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
            // return false;
            return false;
        }
        
    }
    public function findUserRole(CredentialModel $user)
    {
        try {
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
            
            
            
            
            
            // Check to see if the query found a row
            if($stmt->rowCount() == 1)
            {
                // make a data variable equal to all of the data caught in the query
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                // Pass data into a new user model
                $role = $data['role'];
                if($role == "admin")
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
            Log::error("Exception: ", array("message" => $e->getMessage()));
            // Log the database exception
            throw new DatabaseException(($e->getMessage()) . "Database Exception" . $e->getMessage(), 0, $e);
            // return false;
            return false;
        }
        
    }
  
}

