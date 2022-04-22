<?php

error_reporting(0);
include("../adatok.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//$bejovo_id = $_SESSION["monstersgymid"];

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

//echo $teremZarolasa;

if(!isset($modositandoId)){
	$hiba=true;
	echo "Id";
}

//$adatok = json_decode($bejovo);
if(empty($modositandoVezetekNev)){
	$hiba=true;
	echo "Vezetéknév";
}

if(empty($modositandoKeresztNev)){
	$hiba=true;
	echo "Keresztnév";
}

if(empty($modositandoUtoNev)){
	//$hiba=true;
	$ujUtoNev="";
	//echo "Utónév";
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

//print($bejovo->teremZarolasa);
//echo "<>";
//$hiba=true;
//print json_encode($bejovo,JSON_UNESCAPED_UNICODE);

//$hiba=true;

if(!$hiba){
	// Create connection
	$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	$conn->set_charset('utf8mb4');
	
	
	$sql = "UPDATE `tagok` SET `vezetekNev`='".$modositandoVezetekNev."',`keresztNev`='".$modositandoKeresztNev."',`utoNev`='".$modositandoUtoNev."',`nem`='".$modositandoNeme."',`szuletesiDatum`='".$modositandoSzuletesiDatum."',`szemelyiId`='".$modositandoSzemelyiId."',`telefonszam`='".$modositandoTelefonszam."',`lakcim`='".$modositandoLakcim."' WHERE id=".$modositandoId;

	if ($conn->query($sql) === TRUE) {
		//echo "Record updated successfully";
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
	
	//$json = ({"valasz":"Sikeresen megváltoztattam a beállításokat"});
	//print json_encode($json,JSON_UNESCAPED_UNICODE);

}else{
	http_response_code(200);
	$valasz = new stdClass();
	$valasz->valasz = "Valami nem jó";
	
	$kiirando = json_encode($valasz);
	//$kiirando = json_encode($bejovo);
	//$kiirando = $hiba;

	echo $kiirando;
	
}
//var_dump(json_decode($json));

//print json_encode($adat,JSON_UNESCAPED_UNICODE);
//print_r($data);






//$sql = "SELECT * FROM tagok LIMIT 5";



}


?>