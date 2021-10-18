<?php

namespace App\Serivces;

use App\Env;
use App\Models\Robot;
use App\Requests\RobotRequest;

class RobotService
{
    private Robot $robot;

    private array $data;
    
    public function __construct(array $data, Robot $robot)
    {
        $this->setData($data);
        $this->setRobot($robot);
    }

    public function move() : Robot
    {
        $x = 0;
        $y = 0;
        for ($i=0; $i < count($this->getData()); $i++) {
            if($this->getData()[$i] == 'R'){
                $x+=1;
                $this->getRobot()->setX($x);
            }
            if($this->getData()[$i] == 'L'){
                $x = ($x > 0 ? $x-=1 : 0);
                $this->getRobot()->setX($x);
            }

            if($this->getData()[$i] == 'F'){
                $y+=1;
                $this->getRobot()->setY($y);
            }
            if($this->getData()[$i] == 'B'){
                $y = ($y > 0 ? $y-=1 : 0);
                $this->getRobot()->setY($y);
            }
            $this->appendToFile($this->getRobot()->position());
        }
        $this->appendToFile("Final ".$this->getRobot()->position());
        return $this->getRobot();
    }

    /**
     * @param mixed $text
     * 
     * @return void
     */
    public function appendToFile($text) : void
    {
        if (!file_exists(__DIR__."/../Output")) {
            mkdir(__DIR__."/../Output", 0777, true);
        }
        file_put_contents(__DIR__."/../Output/".implode($this->getData(),"").".txt", $text."\n", FILE_APPEND | LOCK_EX);
    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of robot
     */ 
    public function getRobot()
    {
        return $this->robot;
    }

    /**
     * Set the value of robot
     *
     * @return  self
     */ 
    public function setRobot($robot)
    {
        $this->robot = $robot;

        return $this;
    }
}
