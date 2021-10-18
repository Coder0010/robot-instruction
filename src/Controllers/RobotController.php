<?php

namespace App\Controllers;

use App\Models\Robot;
use App\Requests\RobotRequest;
use App\Serivces\RobotService;

class RobotController
{
    public function handle(RobotRequest $request)
    {
        if($request->getStatus()){
            print("instructions right \n");
            $robotRervice = new RobotService($request->getRequest(), new Robot());
            $robotRervice = $robotRervice->move();
        }else{
            print("instructions wrong \n");
        }
    }
}
