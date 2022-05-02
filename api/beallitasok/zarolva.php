<?php

error_reporting(0);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include("../adatok.php");


$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');

$mehet=true;
$adatok = array();

$sql = "SELECT * FROM beallitasok";

$valasz = $conn->query($sql);



if($mehet){

global $adatok;

$szamlalo = 0;

if ($valasz->num_rows > 0) {
  while($row = $valasz->fetch_assoc()) {
	$adatok[] = $row["zarolva"];
	$szamlalo++;
	  }
} else {

}
$conn->close();

}


if(empty($adatok)){
	print json_encode($adatok,JSON_UNESCAPED_UNICODE);
}else{
	
	if(empty($adatok[1])){
		$adat = $adatok[0];
		print json_encode($adat,JSON_UNESCAPED_UNICODE);
		http_response_code(200);
	}else{
		
		print json_encode($adatok,JSON_UNESCAPED_UNICODE);
		http_response_code(200);

	}
}
