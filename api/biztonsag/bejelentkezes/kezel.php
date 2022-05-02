<?php
	
	function hibasBejelentkezesHozzairasa($kinek,$nullaz){
		
		include("../adatok.php");
		$mostaniDatum = date('Y-m-d H:i:s');
		
		$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
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
			$conn = new mysqli($szero, $felhasznalo, $jelszo, $adatbazis);
			
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			$conn->set_charset('utf8mb4');
			
			$sql="";
			if(!empty($nullaz)){
				$sql = "UPDATE `pultosok` SET `hibasBejelentkezesek`='0' WHERE id=".$kinek;
				}else{
				if($hibasBejelentkezesekSzama>=3){
					$sql = "UPDATE `pultosok` SET `legutobbiProbalkozas`='".$mostaniDatum."' WHERE id=".$kinek;
					}else{
					$sql = "UPDATE `pultosok` SET `hibasBejelentkezesek`=".($hibasBejelentkezesekSzama+1).",`legutobbiProbalkozas`='".$mostaniDatum."' WHERE id=".$kinek;
				}
			}
			if ($conn->query($sql) === TRUE) {
					$siker=1;
				} else {
					$siker=0;
			}
		}
		
	}
