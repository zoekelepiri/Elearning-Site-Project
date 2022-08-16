<?php

$servername = "webpagesdb.it.auth.gr:3306";
$dbUsername = "zkelepiri";
$dbPassword = "12345";
$dbName = "student3290";



/*$servername = "127.0.0.1";
$dbUsername = "root";
$dbPassword = "";
$dbName = "myDataBase3290";*/


$conn = mysqli_connect($servername,$dbUsername,$dbPassword,$dbName,"3306");


if(!$conn){
    die("Connection failed: ".mysqli_connector_error());
}
?>
