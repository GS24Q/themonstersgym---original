<?php

//$mit = $_GET["mit"];

function bevetelStatisztika($tipus){

	//error_reporting(0);
	include("adatok.php");

	// Create connection
	$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	$mehet = false;
	$mostaniEv = date("Y");
	$mostaniHonap = date("m");
	
	$sql ="";
	switch ($tipus) {
	  case "ev":
		//echo "Your favorite color is red!";
		//$sql = "SELECT COUNT(*) as osszes FROM tagok WHERE regisztracioDatum like '2021-".$mostaniHonap."-%%'";
		$sql = "SELECT SUM(mennyit) as osszes FROM tranzakciok WHERE year(mikor) = ".$mostaniEv."";
		
		$mehet = true;
		break;
	  case "honap":
		//echo "Your favorite color is blue!";
		//$sql = "SELECT COUNT(*) as osszes FROM tagok WHERE regisztracioDatum like '".$mostaniEv."-%%-%%'";
		//$sql = "SELECT COUNT(*) as osszes FROM tagok WHERE year(regisztracioDatum) = ".$mostaniEv." and month(regisztracioDatum) = ".$mostaniHonap."";
		$sql = "SELECT SUM(mennyit) as osszes FROM tranzakciok WHERE year(mikor) = ".$mostaniEv." and month(`mikor`) = ".$mostaniHonap."";
		$mehet = true;
		break;
	  default:
		//echo "Your favorite color is neither red, blue, nor green!";
		$sql ="";
}
	



	if($mehet){

	$result =  $conn->query($sql);

	
	
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			if($row["osszes"]!=null){
			echo $row["osszes"];
			}else{
				echo "0";
			}
		}
	} else {
		echo "Hiba";
	}

	}else{
		echo "Hiba.";
	}
	$conn->close();

}



?>