<?php
namespace App\Model;

class Recuitment
{
    private $jobTitle;
    private $company;
    private $description;
    private $salary;
    private $requirements;
    private $id;
    



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
     * @return mixed
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }
    
    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }
    
    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }
    
    /**
     * @return mixed
     */
    public function getRequirements()
    {
        return $this->requirements;
    }
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    
}

