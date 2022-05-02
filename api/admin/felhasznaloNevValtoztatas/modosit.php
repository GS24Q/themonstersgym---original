<?php

error_reporting(0);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

session_start();

$admin = $_SESSION["monstersgymadminid"];

if(!isset($admin)){
	
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

$id=$bejovo->id;
$bejovoFelhasznaloNev=$bejovo->felhasznaloNev;
$bejovoFelhasznaloNevMegegyszer=$bejovo->felhasznaloNevMegegyszer;

if(!isset($id)){
	$hiba=true;
}

if($id!=$admin){
	$hiba=true;
}

if(empty($bejovoFelhasznaloNev)){
	$hiba=true;
}

if(empty($bejovoFelhasznaloNevMegegyszer)){
	$hiba=true;
}

if($bejovoFelhasznaloNev!=$bejovoFelhasznaloNevMegegyszer){
	$hiba=true;
}

if(!$hiba){
	
include("../../adatok.php");
	
$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
	
	$sql = "UPDATE `adminok` SET `felhasznalonev`='".$bejovoFelhasznaloNev."' WHERE id=".$id."";

	if ($conn->query($sql) === TRUE) {
		$siker=1;
	} else {
		$siker=0;
	}
	
}

if($siker){

	http_response_code(201);
	$valasz = new stdClass();
	$valasz->valasz = "Sikeresen megváltoztattam a jelszót";
	
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
