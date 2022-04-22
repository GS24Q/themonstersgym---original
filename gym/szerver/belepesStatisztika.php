<?php

function belepesStatisztika($tipus){

	include("adatok.php");

	$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);

	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	$mehet = false;
	$mostaniEv = date("Y");
	$mostaniHonap = date("m");
	
	$sql ="";
	switch ($tipus) {
	  case "ev":
		$sql = "SELECT COUNT(*) as osszes FROM forgalom WHERE mit = 1 and year(mikor) = ".$mostaniEv."";
		$mehet = true;
		break;
	  case "honap":
		$sql = "SELECT COUNT(*) as osszes FROM forgalom WHERE mit = 1 and year(mikor) = ".$mostaniEv." and month(mikor) = ".$mostaniHonap."";
		$mehet = true;
		break;
	  default:
		$sql ="";
}
	
	if($mehet){

	$result =  $conn->query($sql);

	
	
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo $row["osszes"];
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