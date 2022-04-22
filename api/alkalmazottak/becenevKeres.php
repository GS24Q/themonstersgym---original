<?php

error_reporting(0);
include("../adatok.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

session_start();

//$sima = $_SESSION["monstersgymid"];
$admin = $_SESSION["monstersgymid"];

if(!isset($admin)){
	
	
	http_response_code(405);
	$valasz = new stdClass();
	$valasz->valasz = "Hozzáférés megtagadva";
	
	$kiirando = json_encode($valasz,JSON_UNESCAPED_UNICODE);

	echo $kiirando;
	
	
	die();
	
}


$bejovo = json_decode(file_get_contents("php://input"));

$id=$bejovo->id;



//$bejovo_id = $_SESSION["monstersgymid"];

// Create connection
$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');



$mehet=true;
$adatok = array();


$sql = "SELECT becenev FROM pultosok WHERE id=".$id;


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
			
		    $adatok[] = $row["becenev"];
			break;

		$szamlalo++;
	  }
} else {
	//echo "Hibás felhasználónév vagy jelszó";
 //echo "Nincs ilyen felhasználó";
}
$conn->close();

}




if(!empty($adatok)){
	//echo "Hiba";
	//print json_encode($adatok,JSON_PRETTY_PRINT);
	http_response_code(201);
	print json_encode($adatok,JSON_UNESCAPED_UNICODE);
}else{
	//print json_encode($adatok,JSON_PRETTY_PRINT);
	http_response_code(200);
	$valasz = new stdClass();
	$valasz->valasz = "Valami nem jó";
	
	$kiirando = json_encode($valasz);

	echo $kiirando;
}


//echo json_encode($result);


?>