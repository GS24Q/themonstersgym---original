<?php

error_reporting(0);
include("../adatok.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

$hiba=false;
$siker=false;

$hibak = "";

$bejovo = json_decode(file_get_contents("php://input"));


$ki=$bejovo->ki;
$mit=$bejovo->mit;
$kulcs=$bejovo->kulcs;

if(!isset($ki)){
	$hiba=true;
}

if(!isset($mit)){
	$hiba=true;
}else{
	if($mit==1){
		if(!isset($kulcs)){
			$hiba=true;
		}
	}
}

if(!$hiba){
	$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	$conn->set_charset('utf8mb4');
	
	if($mit==1){
	
		$sql = "INSERT INTO `forgalom`(`ki`, `mikor`, `mit`, `kulcs`) VALUES ('".$ki."',CURRENT_TIMESTAMP,'1',".$kulcs.")";

	}elseif($mit==0){
		
		$sql = "INSERT INTO `forgalom`(`ki`, `mikor`, `mit`) VALUES ('".$ki."',CURRENT_TIMESTAMP,'0')";
		
	}

	if ($conn->query($sql) === TRUE) {
		$siker=1;
	} else {
		$siker=0;
	}
	
	
}

if($siker){

	http_response_code(201);
	$valasz = new stdClass();
	if($mit==1){
		$valasz->valasz = "Sikeresen beléptettem";
	}else{
		$valasz->valasz = "Sikeresen kiléptettem";
	}
	$kiirando = json_encode($valasz);

	echo $kiirando;

}else{
	http_response_code(200);
	$valasz = new stdClass();
	$valasz->valasz = "Valami nem jó";
	
	$kiirando = json_encode($valasz);

	echo $kiirando;
	
}

}
