<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/session.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$session = new Session($db);
 
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
 
// query products
$stmt = $session->verifLogin($keywords);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    echo json_encode(
        array("message" => "Products found.")
    );
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>