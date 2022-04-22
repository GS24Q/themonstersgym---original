<?php

function beallitas_keres($mit_keresunk){

	include("adatok.php");

	$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
	
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM beallitasok";

	$result =  $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo $row[$mit_keresunk];
		}
	} else {
		echo "Hiba";
	}

	$conn->close();
	
}

?>