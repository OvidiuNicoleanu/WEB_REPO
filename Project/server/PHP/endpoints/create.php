<?php

use controller\ScreenActorsController;
use PHP\dbconnection\DatabaseConnector;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../dbconnection/DatabaseConnector.php';
include_once '../controller/ScreenActorsController.php';
$database = new DatabaseConnector();
$db = $database->getConnection();
$item = new ScreenActorsController($db);
$data = json_decode(file_get_contents("php://input"));
$item->year = $data->year;
$item->category = $data->category;
$item->fullname = $data->fullname;
if ($item->add()) {
    echo 'Actor added successfully.';
} else {
    echo 'Actor could not be added.';
}
