<?php
namespace App\Model;

class Skill
{
    // Skill variables
    private $skill;
    private $id;
    
    
    
    /*
     * Method to inizalize Skill variables
     */
    public function __construct($skill, $id)
    {
        $this->skill = $skill;
        $this->id = $id;
    }
    
    /**
     * return skill id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * return skill
     */
    public function getSkill()
    {
        return $this->skill;
    }

}

