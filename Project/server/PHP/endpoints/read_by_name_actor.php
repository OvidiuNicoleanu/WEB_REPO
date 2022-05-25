<?php

use controller\ScreenActorsController;
use PHP\connection\TMDBController;
use PHP\dbconnection\DatabaseConnector;

header('Content-Type:application/json');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
include_once '../dbconnection/DatabaseConnector.php';
include_once '../controller/ScreenActorsController.php';
include_once '../connection/TMDBController.php';

$database = new DatabaseConnector();
$db = $database->getConnection();
$items = new ScreenActorsController($db);
$stmt = $items->getAll();
$itemCount = $stmt->rowCount();
$item = new TMDBController();
$item->personName = "BRAD PITT";
$item->findActor();
if($item->personName != null){
    http_response_code(200);
}

else{
    http_response_code(404);
    echo json_encode("Actors not found.");
}
/*
echo json_encode($itemCount);
if ($itemCount > 0) {

    $actorArr = array();
    $actorArr["itemCount"] = $itemCount;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $e = array(
            "year" => $year,
            "category" => $category,
            "fullname" => $fullname
        );

    }
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}*/
