<?php
// Cyrus Duncan
// CST - 256
// This is my own work
namespace App\Model;

class UserModel
{
    // Private variables to make up the user object
    private $firstname;
    private $lastname;
    private $username;
    private $password;
    private $email;
    private $role;

    
    
    /*
     * Constructor to inialize the variables
     */
    public function __construct($firstname, $lastname, $username, $password, $email)
    {
        //commands to inialize the variables
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }
    
    
    
    /*
     * Method to return the role
     */
    public function getRole()
    {
        // command to return role variable
        return $this->role;
    }
    
   /*
    * Method to return the firstname
    */
    public function getFirstname()
    {
        // command to return first name variable
        return $this->firstname;
    }
   /*
    * Method to return the lastname
    */
    public function getLastname()
    {
        // command to return the last name variable
        return $this->lastname;
    } 
    /*
     * Method to return the username
     */
    public function getUsername()
    {
        // command to return the username
        return $this->username;
    }

   /*
    * Method to return the password
    */
    public function getPassword()
    {
        // command to return the password
        return $this->password;
    }
 /*
  * Method to return the email
  */
    public function getEmail()
    {
        // command to return the email
        return $this->email;
    }

   
    
   
    
}

