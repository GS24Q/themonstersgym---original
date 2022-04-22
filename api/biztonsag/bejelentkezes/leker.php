<?php

//error_reporting(0);

//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: GET");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function hibasBejelentkezesEllenorzese($pultosid){
	
include("../adatok.php");
$mehet=true;
$adatok = array();

// Create connection
$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');

$sql = "SELECT hibasBejelentkezesek,legutobbiProbalkozas FROM pultosok WHERE id=".$pultosid;

$valasz = $conn->query($sql);

if($mehet){

global $adatok;

$szamlalo = 0;

if ($valasz->num_rows > 0) {
  // output data of each row
  while($row = $valasz->fetch_assoc()) {	
		    $adatok[] = $row;
			$szamlalo++;
	  }
} else {
	
}
$conn->close();


//return json_encode($adatok[0],JSON_UNESCAPED_UNICODE);
return json_encode($adatok[0],true);

}


}



?>