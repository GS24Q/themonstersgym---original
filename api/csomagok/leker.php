<?php

error_reporting(0);


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//$bejovo_id = $_SESSION["monstersgymid"];




session_start();
//$admin = $_SESSION["monstersgymadminid"];

/*$sima = $_SESSION["monstersgymid"];
$admin = $_SESSION["monstersgymadminid"];

if(!isset($sima) && !isset($admin)){
	
	
	http_response_code(405);
	$valasz = new stdClass();
	$valasz->valasz = "Hozzáférés megtagadva";
	
	$kiirando = json_encode($valasz,JSON_UNESCAPED_UNICODE);

	echo $kiirando;
	
	
	die();
	
}*/
include("../adatok.php");


// Create connection
$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');



//$sql = "SELECT * FROM tagok LIMIT 5";


//ECHO $tabla."\n";
//ECHO $ertek."\n";


$mehet=true;
$adatok = array();

$sql = "SELECT * FROM csomagok";

$valasz = $conn->query($sql);



if($mehet){

global $adatok;

$szamlalo = 0;

if ($valasz->num_rows > 0) {
  // output data of each row
  while($row = $valasz->fetch_assoc()) {
		//echo "
		
			//tagok[".$szamlalo."] = new Tag(".$row["id"].", '".$row["vezetekNev"]."', '".$row["keresztNev"]."', '".$row["utoNev"]."', '".$row["nem"]."', '".$row["lakcim"]."', '".$row["szuletesiDatum"]."','".$row["szemelyiId"]."','".$row["telefonszam"]."');

		
		//";
			
		    $adatok[] = $row;
			 

		$szamlalo++;
	  }
} else {
	//echo "Hibás felhasználónév vagy jelszó";
 //echo "Nincs ilyen felhasználó";
}
$conn->close();

}


if(empty($adatok)){
	//echo "Hiba";
	//print json_encode($adatok,JSON_PRETTY_PRINT);
	print json_encode($adatok,JSON_UNESCAPED_UNICODE);
}else{
	
	if(empty($adatok[1])){
		$adat = $adatok[0];
		print json_encode($adat,JSON_UNESCAPED_UNICODE);
		http_response_code(200);
	}else{
		
		print json_encode($adatok,JSON_UNESCAPED_UNICODE);
		http_response_code(200);

	}
	//print json_encode($adatok,JSON_PRETTY_PRINT);
}


//echo json_encode($result);



?>