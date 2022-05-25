<?php

use controller\ScreenActorsController;
use PHP\dbconnection\DatabaseConnector;

header('Content-Type:application/json');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
include_once '../dbconnection/DatabaseConnector.php';
include_once '../controller/ScreenActorsController.php';
$database = new DatabaseConnector();
$db = $database->getConnection();
$items = new ScreenActorsController($db);
$items->year = $_GET['year'] ?? die();
$items->category = $_GET['category'] ?? die();
$stmt = $items->getAllByYearCategory();
$itemCount = $stmt->rowCount();
echo json_encode($itemCount);
if ($itemCount > 0 &&$items->year!=null &&$items->category!=null) {

    $actorArr = array();
    $actorArr["body"] = array();
    $actorArr["itemCount"] = $itemCount;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $e = array(
            "year" => $year,
            "category" => $category,
            "fullname" => $fullname
        );
        $actorArr["body"][] = $e;
    }
    echo json_encode($actorArr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}
