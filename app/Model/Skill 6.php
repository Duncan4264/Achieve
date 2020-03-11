<?php
namespace App\Model;

class Skill
{
    private $skill1;
    private $skill2;
    private $skill3;
    private $skill4;
    private $skill5;
    
    
    
    
    public function __construct($skill1, $skill2, $skill3, $skill4, $skill5)
    {
        $this->skill1 = $skill1;
        $this->skill2 = $skill2;
        $this->skill3 = $skill3;
        $this->skill4 = $skill4;
        $this->skill5 = $skill5;
    }
    
    /**
     * @return mixed
     */
    public function getSkill1()
    {
        return $this->skill1;
    }

    /**
     * @return mixed
     */
    public function getSkill2()
    {
        return $this->skill2;
    }

    /**
     * @return mixed
     */
    public function getSkill3()
    {
        return $this->skill3;
    }

    /**
     * @return mixed
     */
    public function getSkill4()
    {
        return $this->skill4;
    }

    /**
     * @return mixed
     */
    public function getSkill5()
    {
        return $this->skill5;
    }

}

