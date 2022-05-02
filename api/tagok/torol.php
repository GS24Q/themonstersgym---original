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
$siker=0;

$hibak = "";

$bejovo = json_decode(file_get_contents("php://input"));

$id=$bejovo->id;

if(empty($id)){
	$hiba=true;
}

if(!$hiba){
	$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	$conn->set_charset('utf8mb4');
	
	$sql = "DELETE FROM `tagok` WHERE id=".$id;

	if ($conn->query($sql) === TRUE) {
		$siker++;
	} else {
		$siker=0;
	}
	
	$sql = "DELETE FROM `forgalom` WHERE ki=".$id;
	if ($conn->query($sql) === TRUE) {
		$siker++;
	}else{
		$siker=0;
	}
	
	$sql = "DELETE FROM `tranzakciok` WHERE ki=".$id;
	if ($conn->query($sql) === TRUE) {
		$siker++;
	}else{
		$siker=0;
	}
	
}

if($siker==3){

	http_response_code(201);
	$valasz = new stdClass();
	$valasz->valasz = "Sikeresen eltávolítottam a felhasználót";
	
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
