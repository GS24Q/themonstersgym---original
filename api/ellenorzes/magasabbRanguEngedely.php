<?php

error_reporting(0);
include("../adatok.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

session_start();

$sima = $_SESSION["monstersgymid"];
$admin = $_SESSION["monstersgymadminid"];




//if(!isset($sima) || !isset($admin)){
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


$bejovo = json_decode(file_get_contents("php://input"));

$kartya=$bejovo->kartya;


//$adatok = json_decode($bejovo);
if(empty($kartya)){
	$hiba=true;
}


if(!$hiba){

		//$bejovo_id = $_SESSION["monstersgymid"];

		// Create connection
		$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
		$conn->set_charset('utf8mb4');



		$mehet=true;
		//$adatok = array();


		$sql = "SELECT id FROM adminok WHERE kartya='".$kartya."'";


		$valasz = $conn->query($sql);



		if($mehet){

			if ($valasz->num_rows > 0) {
			  // output data of each row
			  while($row = $valasz->fetch_assoc()) {
					//echo "
					
						//tagok[".$szamlalo."] = new Tag(".$row["id"].", '".$row["vezetekNev"]."', '".$row["keresztNev"]."', '".$row["utoNev"]."', '".$row["nem"]."', '".$row["lakcim"]."', '".$row["szuletesiDatum"]."','".$row["szemelyiId"]."','".$row["telefonszam"]."');

					
					//";
						global $siker;
						$siker=true;
						break;
						//$adatok[] = $row;

						//$szamlalo++;
				  }
			} else {
				//echo "Hibás felhasználónév vagy jelszó";
			 //echo "Nincs ilyen felhasználó";
			}
			$conn->close();

		}

}

//http_response_code(200);



$valasz = new stdClass();


if(!$siker){
	//echo "Hiba";
	//print json_encode($adatok,JSON_PRETTY_PRINT);
	//print json_encode($adatok,JSON_UNESCAPED_UNICODE);
	
	http_response_code(403);
	$valasz = new stdClass();
	$valasz->valasz = "Sikertelen azonosítás";
	
	$kiirando = json_encode($valasz,JSON_UNESCAPED_UNICODE);

	echo $kiirando;
	
	
	
}else{
	http_response_code(202);
	$valasz->valasz = "Sikeres azonosítás";
	
	$kiirando = json_encode($valasz,JSON_UNESCAPED_UNICODE);

	echo $kiirando;
	//print json_encode($adatok,JSON_PRETTY_PRINT);
	//print json_encode($adatok,JSON_UNESCAPED_UNICODE);
}




//echo json_encode($result);


?>