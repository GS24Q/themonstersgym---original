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

$ujVezetekNev=$bejovo->ujVezetekNev;
$ujKeresztNev=$bejovo->ujKeresztNev;
$ujUtoNev=$bejovo->ujUtoNev;
$ujNeme=$bejovo->ujNeme;
$ujszuletesiDatum=$bejovo->ujszuletesiDatum;
$ujSzemelyiId=$bejovo->ujSzemelyiId;
$ujTelefonszam=$bejovo->ujTelefonszam;
$ujLakcim=$bejovo->ujLakcim;

$ujFelhasznalonev=$bejovo->ujFelhasznalonev;
$ujJelszo=$bejovo->ujJelszo;
$ujJelszoMegegyszer=$bejovo->ujJelszoMegegyszer;
$ujEmail=$bejovo->ujEmail;
$ujBecenev=$bejovo->ujBecenev;
$kartya=$bejovo->kartya;

if(empty($ujVezetekNev)){
	$hiba=true;
}

if(empty($ujKeresztNev)){
	$hiba=true;
}

if(empty($ujUtoNev)){
	$ujUtoNev="";
}

if(empty($ujNeme)){
	$hiba=true;
}

if(empty($ujszuletesiDatum)){
	$hiba=true;
}

if(!isset($ujSzemelyiId)){
	$hiba=true;
}

if(!isset($ujTelefonszam)){
	$hiba=true;
}

if(empty($ujLakcim)){
	$hiba=true;
}

if(empty($ujFelhasznalonev)){
	$hiba=true;
}
if(empty($ujJelszo)){
	$hiba=true;
}
if(empty($ujJelszoMegegyszer)){
	$hiba=true;
}
if($ujJelszo!=$ujJelszoMegegyszer){
	$hiba=true;
}
if(empty($ujEmail)){
	$hiba=true;
}
if(empty($ujBecenev)){
	$hiba=true;
}
if(empty($kartya)){
	$hiba=true;
}


if(!$hiba){
	$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	$conn->set_charset('utf8mb4');
	
	
	$sql = "INSERT INTO `pultosok`(`felhasznalonev`, `jelszo`, `vezetekNev`, `keresztNev`, `utoNev`, `nem`, `szuletesiDatum`, `szemelyiId`, `telefonszam`, `lakcim`, `regisztracioDatum`, `email`, `becenev`, `kartya`) VALUES ('".$ujFelhasznalonev."','".crypt($ujJelszo,$titkositas)."','".$ujVezetekNev."','".$ujKeresztNev."','".$ujUtoNev."','".$ujNeme."','".$ujszuletesiDatum."','".$ujSzemelyiId."','".$ujTelefonszam."','".$ujLakcim."',current_timestamp(),'".$ujEmail."','".$ujBecenev."','".$kartya."')";

	if ($conn->query($sql) === TRUE) {
		$siker=1;
	} else {
		$siker=0;
	}
	
	
}

if($siker){

	http_response_code(201);
	$valasz = new stdClass();
	$valasz->valasz = "Sikeresen hozzáadtam az új tagot";
	
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
