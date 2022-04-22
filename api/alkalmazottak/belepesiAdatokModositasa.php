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

$modositandoId=$bejovo->id;
$modositandoFelhasznalonev=$bejovo->modositandoFelhasznalonev;
$modositandoJelszo=$bejovo->modositandoJelszo;
$modositandoJelszoMegegyszer=$bejovo->modositandoJelszoMegegyszer;
$modositandoEmail=$bejovo->modositandoEmail;
$modositandoBecenev=$bejovo->modositandoBecenev;
$modositandoKartya=$bejovo->modositandoKartya;

//echo $teremZarolasa;

if(!isset($modositandoId)){
	$hiba=true;
}


//$adatok = json_decode($bejovo);
if(empty($modositandoFelhasznalonev)){
	$hiba=true;
}

if(empty($modositandoJelszo)){
	//$hiba=true;
}else{
	if(empty($modositandoJelszoMegegyszer)){
		$hiba=true;
	}else{
		if($modositandoJelszo!=$modositandoJelszoMegegyszer){
			$hiba=true;
		}
	}
}







if(empty($modositandoEmail)){
	$hiba=true;
}

if(empty($modositandoBecenev)){
	$hiba=true;
}

if(empty($modositandoKartya)){
	$hiba=true;
}



//print($bejovo->teremZarolasa);
//echo "<>";
//$hiba=true;
//print json_encode($bejovo,JSON_UNESCAPED_UNICODE);

if(!$hiba){
	// Create connection
	$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	$conn->set_charset('utf8mb4');
	
	if(empty($modositandoJelszo)){
		$sql = "UPDATE `pultosok` SET `felhasznalonev`='".$modositandoFelhasznalonev."',`email`='".$modositandoEmail."',`becenev`='".$modositandoBecenev."',`kartya`='".$modositandoKartya."' WHERE id = ".$modositandoId;
	}else{
		$sql = "UPDATE `pultosok` SET `felhasznalonev`='".$modositandoFelhasznalonev."',`jelszo`='".crypt($modositandoJelszo,$titkositas)."',`email`='".$modositandoEmail."',`becenev`='".$modositandoBecenev."',`kartya`='".$modositandoKartya."' WHERE id = ".$modositandoId;
	}
	
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
	$valasz->valasz = "Sikeresen megváltoztattam a pultos profilját";
	
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