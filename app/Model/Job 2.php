<?php
namespace App\Model;

class Job
{
    // Private variables that make up the Education object
    private $jobTitle;
    private $company;
    private $startDate;
    private $endDate;
    
    /*
     * Constructor to inialize the variables
     */
    public function __construct($jobTitle, $company, $startDate, $endDate)
    {
        $this->company = $company;
        $this->jobTitle = $jobTitle;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
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

}

