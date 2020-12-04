<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/gallery.php';


$database = new Database();
$conn = $database->getConnection();

$portfolio = new Portfolio($conn);



if (isset($_GET['id'])) {
    $result = $portfolio->portfolioItem($_GET['id']);
} else {
    $result = $portfolio->allPortfolioItems();
}

echo json_encode($result);
exit;