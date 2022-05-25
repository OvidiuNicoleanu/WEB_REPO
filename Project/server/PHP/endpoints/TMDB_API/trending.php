<?php

header('Content-Type:application/json');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../connection/TMDBController.php';
$item = new TMDBController();

$item->media_type = $_GET['media_type'] ?? die();
$item->time_window = $_GET['time_window'] ?? die();
$item->trending();
if($item->media_type!="all" || $item->media_type!="movie" || $item->media_type!="tv" || $item->media_type!="person")
{
    http_response_code(404);
    echo json_encode("Bad format of the media_type addres");
}
else if($item->time_window!="day" || $item->time_window!="week"){
    http_response_code(404);
    echo json_encode("Bad format of the time_window addres");
}
else{
    http_response_code(200);
    echo json_encode($item->file);
}
