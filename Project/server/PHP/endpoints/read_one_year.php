<?php

use controller\ScreenActorsController;
use PHP\dbconnection\DatabaseConnector;

header('Content-Type:application/json');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../dbconnection/DatabaseConnector.php';
include_once '../controller/ScreenActorsController.php';
$database = new DatabaseConnector();
$db = $database->getConnection();
$item = new ScreenActorsController($db);
$item->year = $_GET['year'] ?? die();
$item->getOneYear();
if ($item->year != null) {

    $emp_arr = array(
        "year" => $item->year,
        "category" => $item->category,
        "fullname" => $item->fullname
    );

    http_response_code(200);
    echo json_encode($emp_arr);
} else {
    http_response_code(404);
    echo json_encode("Actors not found.");
}
