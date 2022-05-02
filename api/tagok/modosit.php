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

$modositandoId=$bejovo->id;
$modositandoVezetekNev=$bejovo->modositandoVezetekNev;
$modositandoKeresztNev=$bejovo->modositandoKeresztNev;
$modositandoUtoNev=$bejovo->modositandoUtoNev;
$modositandoNeme=$bejovo->modositandoNeme;
$modositandoSzuletesiDatum=$bejovo->modositandoSzuletesiDatum;
$modositandoSzemelyiId=$bejovo->modositandoSzemelyiId;
$modositandoTelefonszam=$bejovo->modositandoTelefonszam;
$modositandoLakcim=$bejovo->modositandoLakcim;
$modositandoKartya=$bejovo->modositandoKartya;

if(!isset($modositandoId)){
	$hiba=true;
	echo "Id";
}

if(empty($modositandoVezetekNev)){
	$hiba=true;
	echo "Vezetéknév";
}

if(empty($modositandoKeresztNev)){
	$hiba=true;
	echo "Keresztnév";
}

if(empty($modositandoUtoNev)){
	$ujUtoNev="";
}

if(empty($modositandoNeme)){
	$hiba=true;
	echo "Nem";
}

if(empty($modositandoSzuletesiDatum)){
	$hiba=true;
	echo "Születési";
}

if(!isset($modositandoSzemelyiId)){
	$hiba=true;
	echo "Személyi";
}

if(!isset($modositandoTelefonszam)){
	$hiba=true;
	echo "Telefonszám";
}

if(empty($modositandoLakcim)){
	$hiba=true;
	echo "Lakcim";
}


if(empty($modositandoKartya)){
	$hiba=true;
	echo "Bérlet";
}

if(!$hiba){
	$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	$conn->set_charset('utf8mb4');
	
	$sql = "UPDATE `tagok` SET `vezetekNev`='".$modositandoVezetekNev."',`keresztNev`='".$modositandoKeresztNev."',`utoNev`='".$modositandoUtoNev."',`nem`='".$modositandoNeme."',`szuletesiDatum`='".$modositandoSzuletesiDatum."',`szemelyiId`='".$modositandoSzemelyiId."',`telefonszam`='".$modositandoTelefonszam."',`lakcim`='".$modositandoLakcim."', `berletId`='".$modositandoKartya."' WHERE id=".$modositandoId;

	if ($conn->query($sql) === TRUE) {
		$siker=1;
	} else {
		echo "Error updating record: " . $conn->error;
		$siker=0;
	}
	
	
}

if($siker){

	http_response_code(201);
	$valasz = new stdClass();
	$valasz->valasz = "Sikeresen megváltoztattam a beállításokat";
	
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
