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
$item = new TMDBController();
$stmt = $items->getAll();
$itemCount = $stmt->rowCount();
$list_of_actors = array();
$array_of_actors=array();
$list=array();
function splitFullname($full_name): array
{
    $actors = array();
    $array_of_actors=explode(";",$full_name);
    foreach ($array_of_actors as $value){
        if($value!=null) {
            //echo $value."\n";
            array_push($actors, $value);
        }
       // echo $value;
    }
    return $actors;

}
echo json_encode($itemCount);
if ($itemCount > 0) {

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
        foreach (splitFullname($fullname) as &$actor)
        {
            array_push($list_of_actors, $actor);
        }
        //echo $fullname;
        /*$item->personName = $fullname;
        $item->findActor();
        if($item->personName != null){
            http_response_code(200);
        }

        else{
            http_response_code(404);
            echo json_encode("Actors not found.");
        }*/
        $actorArr["body"][] = $e;
    }
    $result=array_unique($list_of_actors);
    $contor=0;
    foreach ($result as $actor)
    {
        $contor++;
        if($contor<10) {
            $item->personName = $actor;
            $item->findActor();
            if ($item->personName != null) {
                http_response_code(200);
            } else {
                http_response_code(404);
                echo json_encode("Actors not found.");
            }
        }
    }

    //echo json_encode($actorArr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}
