<?php
namespace App\Model;

// Cyrus Duncan
// CST - 256
// This is my own work

class CredentialModel
{
    // Private username and password variable
    private $username;
    private $password;
    private $id;
    private $role;
    
    /*
     * Constructor to inizialize varaibles
     */
    public function __construct($username, $password, $id, $role) 
    {
        $this->username = $username;
        $this->password = $password;
        $this->id = $id;
        $this->role = $role;
    }
    /*
     * Method to get role
     */
    public function getRole()
    {
       return $this->role; 
    }
    /*
     * Method to get username
     */
    public function getUsername()
    {
        return $this->username;
    }
    /*
     * Method to get the password
     */
    public function getPassword()
    {
        return $this->password;
    }
    /*
     * Method to get the id
     */
    public function getID()
    {
        return $this->id;
    }

    
}

