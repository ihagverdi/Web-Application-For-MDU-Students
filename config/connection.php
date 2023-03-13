<?php 
header('Access-Control-Allow-Origin: *');
include_once $_SERVER['DOCUMENT_ROOT'].'/config/database.php';

$database = new Database();
$db = $database->connect();

?>