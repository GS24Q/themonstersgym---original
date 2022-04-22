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

$ujKartya=$bejovo->ujKartya;
$ujVezetekNev=$bejovo->ujVezetekNev;
$ujKeresztNev=$bejovo->ujKeresztNev;
$ujUtoNev=$bejovo->ujUtoNev;
$ujNeme=$bejovo->ujNeme;
$ujszuletesiDatum=$bejovo->ujszuletesiDatum;
$ujSzemelyiId=$bejovo->ujSzemelyiId;
$ujTelefonszam=$bejovo->ujTelefonszam;
$ujLakcim=$bejovo->ujLakcim;

//echo $teremZarolasa;


//$adatok = json_decode($bejovo);

if(empty($ujKartya)){
	$hiba=true;
}

if(empty($ujVezetekNev)){
	$hiba=true;
}

if(empty($ujKeresztNev)){
	$hiba=true;
}

if(empty($ujUtoNev)){
	//$hiba=true;
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
	
	
	$sql = "INSERT INTO `tagok`(`vezetekNev`, `keresztNev`, `utoNev`, `nem`, `szuletesiDatum`, `szemelyiId`, `telefonszam`, `lakcim`, `regisztracioDatum`, `hanyszorVoltNalunk`, `berletId`) VALUES ('".$ujVezetekNev."','".$ujKeresztNev."','".$ujUtoNev."','".$ujNeme."','".$ujszuletesiDatum."','".$ujSzemelyiId."','".$ujTelefonszam."','".$ujLakcim."',current_timestamp(),0,'".$ujKartya."')";

	if ($conn->query($sql) === TRUE) {
		//echo "Record updated successfully";
		$siker=1;
	} else {
		//echo "Error updating record: " . $conn->error;
		$siker=0;
	}
	
	
}

if($siker){

	http_response_code(201);
	$valasz = new stdClass();
	$valasz->valasz = "Sikeresen hozzáadtam az új tagot";
	
	$kiirando = json_encode($valasz);

	echo $kiirando;
	
	//$json = ({"valasz":"Sikeresen megváltoztattam a beállításokat"});
	//print json_encode($json,JSON_UNESCAPED_UNICODE);

}else{
	http_response_code(200);
	$valasz = new stdClass();
	$valasz->valasz = "Valami nem jó";
	
	$kiirando = json_encode($valasz);

	echo $kiirando;
	
}
//var_dump(json_decode($json));

//print json_encode($adat,JSON_UNESCAPED_UNICODE);
//print_r($data);






//$sql = "SELECT * FROM tagok LIMIT 5";



}


?>