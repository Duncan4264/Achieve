<?php
namespace App\Model;

class Group
{
    // Group Variables
   private $groupName;
   private $groupDescripton;
   private $id;
   private $userID;
   

   /*
    * Method to inizialize group variables
    */
public function __construct($groupName, $groupDescripton, $id, $userID)
   {
       $this->groupName = $groupName;
       $this->groupDescripton = $groupDescripton;
       $this->id = $id;
       $this->userID = $userID;
   }
   /**
    * Return Group Name
    */
   public function getGroupName()
   {
       return $this->groupName;
   }
   
   /**
    * Return Group Description
    */
   public function getGroupDescripton()
   {
       return $this->groupDescripton;
   }
   
   /*
    * Return the Group ID
    */
   public function getId()
   {
       return $this->id;
   }
   
   /**
    * Return User ID
    */
   public function getUserID()
   {
       return $this->userID;
   }
   
   

   
}

