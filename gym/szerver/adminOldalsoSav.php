<?php

$hanyadik = 0;
$cimek = array();
$ikonok = array();
$eleresek = array();
//$alapcim=$_SERVER['SERVER_NAME'].":28840";
$protokol = "http://";


if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protokol = 'https://';
}
else {
  $protokol = 'http://';
}



$alapcim=$protokol.$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'];


function ujLehetoseg($cim,$ikon,$eleres){
	global $hanyadik,$cimek,$ikonok,$eleresek;
	$cimek[$hanyadik]=$cim;
	$ikonok[$hanyadik]=$ikon;
	$eleresek[$hanyadik]=$eleres;
	$hanyadik++;
}


//<a href="'.$alapcim."/gym/admin".$eleresek[$x].'">

function kiir(){
	global $hanyadik,$cimek,$ikonok,$eleresek,$alapcim;
	for($x = 0; $x < $hanyadik; $x++) {
		echo '
		<a href="javascript:oldalValtas(\''.$eleresek[$x].'\')">
		<div class="elem">
			<img class="elemKep" src="'.$alapcim.'/gym/media/ikonok/'.$ikonok[$x].'">
			<p class="elemCim">'.$cimek[$x].'</p>
		</div>
		</a>';
	}
}



ujLehetoseg("Főoldal","dash_f.png","");
ujLehetoseg("Alkalmazottak","felhasznalo_f.png","/alkalmazottak");
ujLehetoseg("Felhasználók","felhasznalo_f.png","/felhasznalok");
ujLehetoseg("Csomagok","csomagok_f.png","/csomagok");
ujLehetoseg("Beállítások","beallitasok_f.png","/beallitasok");

//ujLehetoseg("Felszerelések","felszerelesek_f.png","/felszerelesek");
//ujLehetoseg("Tranzakciók","fizetes_f.png","/tranzakciok");
//ujLehetoseg("Csomagok","csomagok_f.png","/csomagok");
//ujLehetoseg("Beállítások","beallitasok_f.png","/beallitasok");


kiir();




?>