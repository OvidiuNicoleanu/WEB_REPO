<?php

header('Content-Type:application/json');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../connection/TMDBController.php';
$item = new TMDBController();
$item->keyword = $_GET['keyword'] ?? die();
$item->findByKeywords();
if($item->keyword != null){
    http_response_code(200);
    echo json_encode($item->file);
}

else{
    http_response_code(404);
    echo json_encode("Keyword not found.");
}