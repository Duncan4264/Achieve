<?php
namespace App\Model;

class Member
{
    // grab private variables
    private $groupName;
    private $userFirstName;
    private $userLastName;
    private $userid;
    private $groupid;



    // Inizalize private variables
    public function __construct($groupName, $userFirstName, $userLastName, $userid, $groupid)
    {
        $this->groupName = $groupName;
        $this->userFirstName = $userFirstName;
        $this->userLastName = $userLastName;
        $this->userid = $userid;
        $this->groupid = $groupid;
    }
    /**
     * return user last name
     */
    public function getUserLastName()
    {
        return $this->userLastName;
    }
    
    /**
     * return group name
     */
    public function getGroupName()
    {
        return $this->groupName;
    }
    
    /**
     * return first name
     */
    public function getUserFirstName()
    {
        return $this->userFirstName;
    }
    
    /**
     * return userid
     */
    public function getUserid()
    {
        return $this->userid;
    }
    
    /**
     * return groupid
     */
    public function getGroupid()
    {
        return $this->groupid;
    }
    
    
}

