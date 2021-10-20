<?php

namespace App\Requests;

use App\Env;

class RobotRequest
{
    private array $request;

    private bool $status = false;
    
    public function __construct($request)
    {
        $this->setRequest($request);
    }

    public function validated()
    {
        if(is_array($this->getRequest()) && !empty($this->getRequest())){
            foreach ($this->getRequest() as $value) {
                if(in_array($value, Env::MOVMENTS)){
                    $this->setStatus(true);
                }else{
                    $this->setStatus(false);
                    break;
                }
            }
        }
        return $this;
    }

    /**
     * Get the value of request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set the value of request
     * remove any integers or special char from request 
     * set request to uppercase
     * convert it to array
     * @return  self
     */
    public function setRequest($request)
    {
        $this->request = str_split(preg_replace("/[^a-zA-Z0-9]+/", "", strtoupper($request)));

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public static function availableMovments() : string
    {
        return implode(array_merge(Env::MOVMENTS, array_keys(Env::MOVMENTS)), ', ');
    }
}
