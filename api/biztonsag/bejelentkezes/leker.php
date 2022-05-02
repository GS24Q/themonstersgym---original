<?php

error_reporting(0);
function hibasBejelentkezesEllenorzese($pultosid){
	
include("../adatok.php");
$mehet=true;
$adatok = array();

$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
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
  while($row = $valasz->fetch_assoc()) {	
		    $adatok[] = $row;
			$szamlalo++;
	  }
} else {
	
}
$conn->close();

return json_encode($adatok[0],true);

}


}
