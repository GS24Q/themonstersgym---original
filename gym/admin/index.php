


<?php
//error_reporting(0);

include_once("../szerver/beallitasok.php");

include_once("../szerver/tagStatisztika.php");
include_once("../szerver/bevetelStatisztika.php");
include_once("../szerver/belepesStatisztika.php");

include_once("../szerver/oldalCim.php");




session_start();
$belepve = $_SESSION["monstersgymadminid"];

if(!isset($belepve)){
	
	header('Location: ./bejelentkezes.php');
	
}



?>








<html>

<head>
	<meta charset="UTF-8">
	<title><?php beallitas_keres("nev") ?> - Főoldal</title>
	<link rel="icon" type="image/png" href="<?php echo oldalCim(); ?>media/ikonok/ikon.png"/>
	<meta name="theme-color" content="<?php beallitas_keres("hatterSzin"); ?>" />
	<meta name="msapplication-navbutton-color" content="<?php beallitas_keres("hatterSzin"); ?>">
	<meta name="apple-mobile-web-app-status-bar-style" content="<?php beallitas_keres("hatterSzin"); ?>">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="viewport-fit=cover, user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="../kliens/css/oldalsoSav.css">
	<link rel="stylesheet" href="../kliens/css/index.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>



<div id="navigacio" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">
  <img id="menuNyito" src="../media/ikonok/menu_f.png" height="30px">	
		<div id="cimResz"><?php beallitas_keres("nev") ?></div>
        <a class="nav-link" href="javascript:adminKijelentkezes();"><img src="../media/ikonok/kijelentkezes_f.png" height="30px"></a>

</div>


	<div id="oldalso-sav" style="background-color:<?php beallitas_keres("hatterSzin") ?>;">

		<?php include_once("../szerver/adminOldalsoSav.php") ?>


	</div>


<div id="oldal">

	<div id="tartalom">
			<div class="card text-white m-2" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">
				<div class="card-body" id="jelenlegiIdo">---</div>
			</div><br>
		<h2>Új felhasználók</h2>
		<div class="row">

		<div class="col-md-6">
			<div class="card text-white m-2" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">
				<div class="card-body">Ebben az évben:<?php tagStatisztika("ev"); ?></div>
			</div>
		</div>
			<br>
		<div class="col-md-6">
			<div class="card text-white m-2" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">
				<div class="card-body">Ebben a hónapban:<?php tagStatisztika("honap"); ?></div>
			</div>
		</div>
		</div><br>
		
		<h2>Bevétel</h2>

		
		<div class="row">
		<div class="col-md-6">
			<div class="card text-white m-2" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">
				<div class="card-body">Ebben az évben:<?php bevetelStatisztika("ev"); ?> FT</div>
			</div>
		</div>
			<br>
		<div class="col-md-6">
			<div class="card text-white m-2" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">
				<div class="card-body">Ebben a hónapban:<?php bevetelStatisztika("honap"); ?> FT</div>
			</div>
		</div>
		</div><br>
		
		<h2>Belépések</h2>

		
		<div class="row">
		<div class="col-md-6">
			<div class="card text-white m-2" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">
				<div class="card-body">Ebben az évben:<?php belepesStatisztika("ev"); ?></div>
			</div>
		</div>
			<br>
		<div class="col-md-6">
			<div class="card text-white m-2" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">
				<div class="card-body">Ebben a hónapban:<?php belepesStatisztika("honap"); ?></div>
			</div>
		</div>
		</div>
		
	</div>
</div>




</body>


<script>

var link = "<?php echo oldalCim("nev"); ?>";

</script>

<style>

html,body{
	background-color:black;
}

#oldal{
	background-color:white;
}

</style>


<script src="../kliens/js/kijelentkezes.js"></script>
<script src="../kliens/js/adminOldalValtas.js"></script>
<script src="../kliens/js/index.js"></script>
<script src="../kliens/js/oldalsoSav.js"></script>

</html>