<?php

error_reporting(0);

session_start();
$belepve = $_SESSION["monstersgymid"];

if (!isset($belepve)) {

	header('Location: ./bejelentkezes.php');
	die();
}

include_once("szerver/oldalCim.php");
include_once("szerver/beallitasok.php");
include_once("szerver/tagStatisztika.php");
include_once("szerver/bevetelStatisztika.php");
include_once("szerver/belepesStatisztika.php");

?>

<html>

<head>

	<meta charset="UTF-8">
	<title><?php beallitas_keres("nev") ?> - Főoldal</title>
	<link rel="icon" type="image/png" href="<?php echo oldalCim(); ?>media/ikonok/ikon.png" />
	<meta name="theme-color" content="<?php beallitas_keres("hatterSzin"); ?>" />
	<meta name="msapplication-navbutton-color" content="<?php beallitas_keres("hatterSzin"); ?>">
	<meta name="apple-mobile-web-app-status-bar-style" content="<?php beallitas_keres("hatterSzin"); ?>">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="viewport-fit=cover, user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">

	<link rel="stylesheet" href="kliens/css/index.css">
	<link rel="stylesheet" href="kliens/css/oldalsoSav.css">
	<link rel="stylesheet" href="../kliens/bootstrap/bootstrap.min.css">

	<script src="../kliens/bootstrap/jquery.slim.min.js"></script>
	<script src="../kliens/bootstrap/popper.min.js"></script>
	<script src="../kliens/bootstrap/bootstrap.bundle.min.js"></script>


</head>

<body>

	<div id="navigacio" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">
		<img id="menuNyito" src="media/ikonok/menu_f.png" height="30px">
		<div id="cimResz"><?php beallitas_keres("nev") ?></div>
		<a class="nav-link" href="javascript:kijelentkezes();"><img src="media/ikonok/kijelentkezes_f.png" height="30px"></a>
	</div>

	<div id="oldalso-sav" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">

		<?php include_once("szerver/oldalsoSav.php") ?>

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
						<div class="card-body">Ebben az évben: <?php tagStatisztika("ev"); ?></div>
					</div>
				</div><br>
				<div class="col-md-6">
					<div class="card text-white m-2" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">
						<div class="card-body">Ebben a hónapban: <?php tagStatisztika("honap"); ?></div>
					</div>
				</div>
			</div><br>

			<h2>Bevétel</h2>

			<div class="row">
				<div class="col-md-6">
					<div class="card text-white m-2" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">
						<div class="card-body">Ebben az évben: <?php bevetelStatisztika("ev"); ?> FT</div>
					</div>
				</div><br>
				<div class="col-md-6">
					<div class="card text-white m-2" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">
						<div class="card-body">Ebben a hónapban: <?php bevetelStatisztika("honap"); ?> FT</div>
					</div>
				</div>
			</div><br>

			<h2>Belépések</h2>

			<div class="row">
				<div class="col-md-6">
					<div class="card text-white m-2" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">
						<div class="card-body">Ebben az évben: <?php belepesStatisztika("ev"); ?></div>
					</div>
				</div><br>
				<div class="col-md-6">
					<div class="card text-white m-2" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">
						<div class="card-body">Ebben a hónapban: <?php belepesStatisztika("honap"); ?></div>
					</div>
				</div>
			</div>

		</div>
	</div>

</body>


<script>
	var link = "<?php echo oldalCim(); ?>";
</script>

<script src="kliens/js/oldalValtas.js"></script>
<script src="kliens/js/kijelentkezes.js"></script>
<script src="kliens/js/index.js"></script>
<script src="kliens/js/oldalsoSav.js"></script>

<style>
	html,
	body {
		background-color: black;
	}

	#oldal {
		background-color: white;
	}


	body.modal-open> :not(.modal) {
		-webkit-filter: blur(12px);
		-moz-filter: blur(12px);
		-o-filter: blur(12px);
		-ms-filter: blur(12px);
		filter: blur(12px);
	}
</style>

</html>