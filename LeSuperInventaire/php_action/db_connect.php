<?php 	

$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "lesuperinventaire";
$store_url = "http://localhost/LeSuperInventaire/";

$connect = new mysqli($localhost, $username, $password, $dbname);

if($connect->connect_error) {
  die("Vous n'avez pas pu vous connecter au serveur : " . $connect->connect_error);
} else {
  
}

?>