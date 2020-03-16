<?php
namespace App\Model;

class Recuitment
{
    // Grab Recruitment Variables
    private $jobTitle;
    private $company;
    private $description;
    private $salary;
    private $requirements;
    private $id;
    


    /*
     * Inizalize Reruitment Variables
     */
    public function __construct($jobTitle, $company, $description, $salray, $requirements, $id)
    {
     $this->jobTitle = $jobTitle;
     $this->company = $company;
     $this->description = $description;
     $this->salary = $salray;
     $this->requirements = $requirements;
     $this->id = $id;
    }
    /**
     * return Job Title
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }
    
    /**
     * return Company
     */
    public function getCompany()
    {
        return $this->company;
    }
    
    /**
     * return description
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /*
     * return salary
     */
    public function getSalary()
    {
        return $this->salary;
    }
    
    /**
     * return requirements
     */
    public function getRequirements()
    {
        return $this->requirements;
    }
    
    /**
     * return id
     */
    public function getId()
    {
        return $this->id;
    }
    
    
}

