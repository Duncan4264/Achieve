<?php
namespace App\Model;

/**
 * @author cyrusduncan
 *
 */
class Education
{
    // Private variables that make up the Education object
    private $degreeName;
    private $university;
    private $startDate;
    private $endDate;
    private $id;
    

    /*
     * Constructor to inialize the variables
     */
    public function __construct($degreeName, $university, $startDate, $endDate, $id)
    {
        $this->degreeName = $degreeName;
        $this->university = $university;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->id = $id;
    }
    /**
     * return degreename
     */
    public function getDegreeName()
    {
        return $this->degreeName;
    }

    /**
     * return university
     */
    public function getUniversity()
    {
        return $this->university;
    }

    /**
     * return start date
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * return end date
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
    
    /**
     * return id
     */
    public function getId()
    {
        return $this->id;
    }
    
    


}

