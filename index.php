<?php

use App\Requests\RobotRequest;
use App\Controllers\RobotController;

require_once realpath("vendor/autoload.php");

echo "available movment ". RobotRequest::availableMovments() . "\n";
$input = readline("Enter Robot instructions: ");
$request = (new RobotRequest($input))->validated();
(new RobotController)->handle($request);
