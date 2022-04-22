<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include("../adatok.php");
include("../biztonsag/bejelentkezes/leker.php");
include("../biztonsag/bejelentkezes/kezel.php");

$zarolva=false;
$meddigvanzarolva=0;
$sikerult=false;

function beleptet($kiebe){
	
	session_start();
	$_SESSION["monstersgymid"]=$kiebe;
	
}

function hbh($kit,$allapot){
	
	hibasBejelentkezesHozzairasa($kit,$allapot);
	
}

function zarolasEllenorzes($kiet){
	
				global $sikerult,$zarolva,$meddigvanzarolva;
				$lehetsegesZarolas = hibasBejelentkezesEllenorzese($kiet);
				$adatok = json_decode($lehetsegesZarolas);
				
				$hibasBejelentkezesekSzama = $adatok->hibasBejelentkezesek;
				$UtolsoBejelentkezesIdeje = $adatok->legutobbiProbalkozas;
				
				if($hibasBejelentkezesekSzama>=3){
					
					$mostaniDatum = date('Y-m-d H:i:s');
					
					$kul = strtotime($mostaniDatum) - strtotime($UtolsoBejelentkezesIdeje);
										
					if($kul>=30){ //Ha megvan 30 mp:
						hbh($kiet,1);
						$sikerult=true;
						$zarolva=false;
						beleptet($kiet);
					}else{ //Ha nincs meg a 30 mp akkor:
						$sikerult=true;
						$meddigvanzarolva=30-$kul;
						$zarolva=true;
					}
				}else{//Ha kevesebb mint 3 próbálkozás történt
					hbh($kiet,1);
					$sikerult=true;
					$zarolva=false;
					beleptet($kiet);
				}
	
	
	
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

$hiba=false;

$bejovo = json_decode(file_get_contents("php://input"));
$bejovo_felhasznalonev=$bejovo->felhasznalonev;
$bejovo_jelszo=$bejovo->jelszo;

if(empty($bejovo_felhasznalonev)){
	$hiba=true;
}

if(empty($bejovo_jelszo)){
	$hiba=true;
}

if($hiba){
	
		http_response_code(200);
		$valasz = new stdClass();
		$valasz->valasz = "Hiányos adatok";
		
		$kiirando = json_encode($valasz,JSON_UNESCAPED_UNICODE);
		
		echo $kiirando;

	
die();
}else{

	// Adatbázis kapcsolat létrehozása
	$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
	// Adatbázis kapcsolat ellenörzése
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$az = -1;

	$sql = "SELECT * FROM pultosok WHERE felhasznalonev='".$bejovo_felhasznalonev."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
		  //if($row["jelszo"]==$bejovo_jelszo){
		  if($row["jelszo"]==crypt($bejovo_jelszo,$titkositas)){
			  
				zarolasEllenorzes($row["id"],true);
				break;

		  }

		  hibasBejelentkezesHozzairasa($row["id"],0);
		}
	} else {
	  
	  $sikerult=false;
	  
	}
	$conn->close();

	if($sikerult){
		
		if($zarolva){
			
			http_response_code(200);
			$valasz = new stdClass();
			$valasz->valasz = "A fiók ideiglenesen zárolva van.";
			$valasz->meddig = $meddigvanzarolva;
		
			$kiirando = json_encode($valasz,JSON_UNESCAPED_UNICODE);

			echo $kiirando;
			
		}else{
			
			http_response_code(201);
			$valasz = new stdClass();
			$valasz->valasz = "Sikeres bejelentkezés";
		
			$kiirando = json_encode($valasz,JSON_UNESCAPED_UNICODE);

			echo $kiirando;
	}
		
	}else{
		
		http_response_code(200);
		$valasz = new stdClass();
		$valasz->valasz = "Valami nem jó";
		
		$kiirando = json_encode($valasz,JSON_UNESCAPED_UNICODE);
		
		echo $kiirando;
		
	}
	


}

}


?>