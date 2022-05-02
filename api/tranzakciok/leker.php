<?php

error_reporting(0);
include("../adatok.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

session_start();

$sima = $_SESSION["monstersgymid"];
$admin = $_SESSION["monstersgymadminid"];

if(!isset($sima) && !isset($admin)){
	
	http_response_code(405);
	$valasz = new stdClass();
	$valasz->valasz = "Hozzáférés megtagadva";
	
	$kiirando = json_encode($valasz,JSON_UNESCAPED_UNICODE);

	echo $kiirando;
	
	die();
	
}

$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');

$id = $_GET["id"];

$mehet=true;
$adatok = array();


if(!empty($id)) {
	$sql = "SELECT * FROM tranzakciok WHERE ki=".$id;
}else{
	$sql = "SELECT * FROM tranzakciok";
}
$valasz = $conn->query($sql);



if($mehet){

global $adatok;

$szamlalo = 0;

if ($valasz->num_rows > 0) {
  while($row = $valasz->fetch_assoc()) {
		$adatok[] = $row;
		$szamlalo++;
	  }
} else {

}
$conn->close();

}

http_response_code(200);

if(empty($adatok)){

	print json_encode($adatok,JSON_UNESCAPED_UNICODE);
}else{
	print json_encode($adatok,JSON_UNESCAPED_UNICODE);
}