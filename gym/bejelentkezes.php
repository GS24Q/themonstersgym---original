<?php

error_reporting(0);

session_start();
$belepve = $_SESSION["monstersgymid"];

if (isset($belepve)) {
	header('Location: ./');
}

include_once("szerver/beallitasok.php");
include_once("szerver/oldalCim.php");
$videoHatter = false;
$IOS = false;

if (!isset($_COOKIE["themonstersgym_videoHatter"])) {
	$sutiNev = "themonstersgym_videoHatter";
	$sutiErtek = "ki";
	setcookie($sutiNev, $sutiErtek, time() + (86400 * 30), "/"); // 86400 = 1 day
} else {
	if ($_COOKIE["themonstersgym_videoHatter"] == "be") {
		$videoHatter = true;
	}
}

$iPod    = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
$iPad    = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");

if ($iPhone) {
	$IOS = true;
	$videoHatter = false; //ios-en sajnos a háttérben lévő videó nem kezelhető
}

if ($iPod) {
	$IOS = true;
	$videoHatter = false; //ios-en sajnos a háttérben lévő videó nem kezelhető
}

if ($iPad) {
	$IOS = true;
	$videoHatter = false; //ios-en sajnos a háttérben lévő videó nem kezelhető
}


?>

<!DOCTYPE html>
<html lang="hu">

<head>
	<title><?php beallitas_keres("nev") ?> - Bejelentkezés</title>
	<link rel="icon" type="image/png" href="<?php echo oldalCim(); ?>media/ikonok/ikon.png" />
	<meta name="theme-color" content="<?php beallitas_keres("hatterSzin"); ?>" />
	<link rel="stylesheet" type="text/css" href="kliens/css/bejelentkezes.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="viewport" content="viewport-fit=cover, user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="mobile-web-app-capable" content="yes">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" href="../kliens/bootstrap/bootstrap.min.css">

	<script src="../kliens/bootstrap/jquery.slim.min.js"></script>
	<script src="../kliens/bootstrap/popper.min.js"></script>
	<script src="../kliens/bootstrap/bootstrap.bundle.min.js"></script>
</head>

<body>

	<?php

	if ($videoHatter) {
		echo '
				<video autoplay muted loop id="videoHatter">
				<source src="../media/videok/hatter.mp4" type="video/mp4">
				</video>
				
				<div id="hatter" style="display:none;"></div>
				';
	} else {
		echo '
				<div id="hatter"></div>
				
				<video muted loop id="videoHatter">
				<source src="../media/videok/hatter.mp4" type="video/mp4">
				</video>
				';
	}

	?>

	<audio id="hang">
		<source src="media/hangok/hiba.mp3" type="audio/mpeg">
	</audio>

	<div class="modal fade" id="valasz">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title" id="valaszCim">Minden sikerült</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body" id="valaszSzoveg">
					...
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Bezárás</button>
				</div>

			</div>
		</div>
	</div>

	<div id="alap">
		<div id="bejelentkezes">
			<div id="bejelentkezes-belso">
				<div id="beallitasReszleg">
					<?php
					if (!$IOS) {
						if ($videoHatter) {
							echo '<img class="beallitasReszlegIkonok" src="media/ikonok/szunet.png" id="hatterKezeloGomb">';
						} else {
							echo '<img class="beallitasReszlegIkonok" src="media/ikonok/indit.png" id="hatterKezeloGomb">';
						}
					}
					?>
				</div>
				<header>
					<!--h1>THEMONSTERSGYM</h1!-->
					<img id="logo" src="media/ikonok/alkalmazottLogo.png">
				</header>
				<section class="azonositas form">
					<form id="azonosit" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
						<input type="text" id="felhasznalonev" name="felhasznalonev" placeholder="Felhasználónév"><br>
						<input type="password" id="jelszo" name="jelszo" placeholder="Jelszó"><br>
						<p class='hibaSzoveg'>Valami nem jó...</p>
						<input id="bejelentkeztetoGomb" name="bejelentkeztetoGomb" type="button" id="submit" value="Belépés"><br>
					</form>
				</section>
			</div>
		</div>
	</div>
</body>


<script>
	<?php


	if (!$IOS) {

		echo 'var hatter = document.querySelector("#hatter");
			var videoHatter = document.querySelector("#videoHatter");
			var hatterKezeloGomb = document.querySelector("#hatterKezeloGomb");

			hatterKezeloGomb.onclick = () => {

				if (sutiLeker("themonstersgym_videoHatter") == "ki") {
					
					hatterKezeloGomb.src = "media/ikonok/szunet.png";
					sutiModosit("themonstersgym_videoHatter", "be");
					videoHatter.play();
					hatter.style.display = "none";
					videoHatter.style.display = "block";
					
				} else {

					hatterKezeloGomb.src = "media/ikonok/indit.png";
					sutiModosit("themonstersgym_videoHatter", "ki");
					videoHatter.pause();
					videoHatter.style.display = "none";
					hatter.style.display = "block";
					
				}

			}';
	}

	?>
</script>

<script src="kliens/js/sutiKezelo.js"></script>
<script src="kliens/js/bejelentkezes.js"></script>

</html>