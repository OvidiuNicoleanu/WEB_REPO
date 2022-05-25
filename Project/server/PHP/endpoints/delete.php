<?php

use controller\ScreenActorsController;
use PHP\dbconnection\DatabaseConnector;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../dbconnection/DatabaseConnector.php';
include_once '../controller/ScreenActorsController.php';

$database = new DatabaseConnector();
$db = $database->getConnection();

$item = new ScreenActorsController($db);

$data = json_decode(file_get_contents("php://input"));

$item->fullname = $data->fullname;

if ($item->delete()) {

    echo json_encode("Actor deleted.");
} else {
    echo json_encode("Actor could not be deleted");
}

