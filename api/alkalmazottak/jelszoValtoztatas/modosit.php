<?php

error_reporting(0);


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//$bejovo_id = $_SESSION["monstersgymid"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

session_start();

$sima = $_SESSION["monstersgymid"];

if(!isset($sima)){
	
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
$bejovoJelszo=$bejovo->jelszo;
$bejovoJelszoMegegyszer=$bejovo->jelszoMegegyszer;

//echo $teremZarolasa;


//$adatok = json_decode($bejovo);

if(!isset($id)){
	$hiba=true;
}

if($id!=$sima){
	$hiba=true;
}


if(empty($bejovoJelszo)){
	$hiba=true;
}

if(empty($bejovoJelszoMegegyszer)){
	$hiba=true;
}


if($bejovoJelszo!=$bejovoJelszoMegegyszer){
	$hiba=true;
}


if(!$hiba){
	


include("../../adatok.php");
	
$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');

	
	
	$sql = "UPDATE `pultosok` SET `jelszo`='".crypt($bejovoJelszo,$titkositas)."' WHERE id=".$id."";

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
	$valasz->valasz = "Sikeresen megváltoztattam a jelszót";
	
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