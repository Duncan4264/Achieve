<?php
// Cyrus Duncan
// CST - 256
// This is my own work
namespace App\Model;

class Profile
{
    // Private variables that make up the profile object
    private $firstname;
    private $lastname;
    private $country;
    private $state;
    private $city;
    private $street;
    private $zip;
    private $id;
    
/*
 *  Constructor that inizializes the profile variables
 */
    public function __construct($firstname, $lastname, $country, $state, $city, $street, $zip)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->country = $country;
        $this->state = $state;
        $this->city = $city;
        $this->street = $street;
        $this->zip = $zip;
    }
    /*
     * returns the first name
     */
    public function getFirstname()
    {
        return $this->firstname;
    }
    /*
     * returns the last name
     */
    public function getLastname()
    {
        return $this->lastname;
    }
    /*
     * returns the country
     */
    public function getCountry()
    {
        return $this->country;
    }
    /*
     * returns the state
     */
    public function getState()
    {
        return $this->state;
    }
    /*
     * returns the city
     */
    public function getCity()
    {
        return $this->city;
    }
    /*
     * returns the street
     */
    public function getStreet()
    {
        return $this->street;
    }
    /*
     *  returns the zip
     */
    public function getZip()
    {
        return $this->zip;
    }
    public function getID()
    {
        return $this->id;
    }
    
}

