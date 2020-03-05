<?php
namespace App\Model;

class Job
{
    // Private variables that make up the Education object
    private $jobTitle;
    private $company;
    private $startDate;
    private $endDate;
    private $id;
     
    /*
     * Constructor to inialize the variables
     */
    public function __construct($jobTitle, $company, $startDate, $endDate, $id)
    {
        $this->company = $company;
        $this->jobTitle = $jobTitle;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
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
    public function getStartDate()
    {
        return $this->startDate;
    }
    
    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

}

