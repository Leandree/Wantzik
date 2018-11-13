<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/utilisateur.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$utilisateur = new Utilisateur($db);
 
// get keywords
$mailsent=isset($_GET["mail"]) ? $_GET["mail"] : "";
$passwdsent=isset($_GET["passwd"]) ? $_GET["passwd"] : "";
 
// query products
$stmt = $utilisateur->verifMailPasswd($mailsent, $passwdsent);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
 		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);
 
        $utilisateur_item=array(
            "id" => $id,
            "pseudo" => $pseudo,
            "mail" => $mail
        );

    }
 
    
 
    echo json_encode($utilisateur_item);
}
 
else{
    echo json_encode(
        array("message" => "No user found.")
    );
}
?>