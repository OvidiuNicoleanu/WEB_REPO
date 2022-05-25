<?php

use Router\Router;
use Router\Request;
use Router\Response;
include_once './Router.php';
include_once './Request.php';
include_once './Response.php';

$request = new Request();
$response = new Response();

$application = new Application($response, $request);