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

$csomagNev=$bejovo->csomagNev;
$csomagAr=$bejovo->csomagAr;
$csomagLeiras=$bejovo->csomagLeiras;

if(empty($csomagNev)){
	$hiba=true;
}

if(!isset($csomagAr)){
	$hiba=true;
}else{
	if($csomagAr<0){
		$hiba=true;
	}
}

if(empty($csomagLeiras)){
	$hiba=true;
}


if(!$hiba){
	$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	$conn->set_charset('utf8mb4');
	
	$sql = "INSERT INTO `csomagok`(`nev`, `ar`, `leiras`) VALUES ('".$csomagNev."','".$csomagAr."','".$csomagLeiras."')";

	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
		$siker=1;
	} else {
		echo "Error updating record: " . $conn->error;
		$siker=0;
	}
	
	
}

if($siker){

	http_response_code(201);
	$valasz = new stdClass();
	$valasz->valasz = "Sikeresen hozzáadtam az új csomagot";
	
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
