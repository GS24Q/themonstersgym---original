<?php

//error_reporting(0);

//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: GET");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function hibasBejelentkezesHozzairasa($kinek,$nullaz){
	
include("../../adatok.php");
$mostaniDatum = date('Y-m-d H:i:s');

// Create connection
$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');

$akcio=false;

if($nullaz==0){
	
}else{
	
}

include_once("leker.php");
$lehetsegesZarolas = hibasBejelentkezesEllenorzese($kinek);

$bejovoadatok = json_decode($lehetsegesZarolas);

$hibasBejelentkezesekSzama = $bejovoadatok->hibasBejelentkezesek;

$UtolsoBejelentkezesIdeje = $bejovoadatok->legutobbiProbalkozas;

$akcio=true;

$siker=0;

if($akcio){
	// Create connection
	$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	$conn->set_charset('utf8mb4');
	
	$sql="";
if(!empty($nullaz)){
	$sql = "UPDATE `adminok` SET `hibasBejelentkezesek`='0' WHERE id=".$kinek;
}else{
	if($hibasBejelentkezesekSzama>=3){
		$sql = "UPDATE `adminok` SET `legutobbiProbalkozas`='".$mostaniDatum."' WHERE id=".$kinek;
	}else{
		$sql = "UPDATE `adminok` SET `hibasBejelentkezesek`=".($hibasBejelentkezesekSzama+1).",`legutobbiProbalkozas`='".$mostaniDatum."' WHERE id=".$kinek;
	}
}
	if ($conn->query($sql) === TRUE) {
		//echo "Record updated successfully";
		$siker=1;
	} else {
		//echo "Error updating record: " . $conn->error;
		$siker=0;
	}
}

}

?>