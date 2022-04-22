


<?php
	
	
error_reporting(0);

session_start();
$belepve = $_SESSION["monstersgymadminid"];

if(isset($belepve)){
	
	header('Location: ./');
	
}
	
	
include_once("../szerver/beallitasok.php");
include_once("../szerver/oldalCim.php");

$videoHatter=false;
$IOS=false;

if(!isset($_COOKIE["themonstersgym_videoHatter"])) {
	$sutiNev = "themonstersgym_videoHatter";
	$sutiErtek = "ki";
	setcookie($sutiNev, $sutiErtek, time() + (86400 * 30), "/"); // 86400 = 1 day
} else {
	if($_COOKIE["themonstersgym_videoHatter"]=="be"){
		$videoHatter=true;
	}
}

	$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
	
	
	if($iPhone){
		$IOS=true;
		$videoHatter=false; //ios-en sajnos a háttérben lévő videó nem kezelhető
	}
	
	if($iPod){
		$IOS=true;
		$videoHatter=false; //ios-en sajnos a háttérben lévő videó nem kezelhető
	}
	
	if($iPad){
		$IOS=true;
		$videoHatter=false; //ios-en sajnos a háttérben lévő videó nem kezelhető
	}





?>
<!DOCTYPE html>
<html lang="hu">
	<head>
		<meta charset="UTF-8">
		<title><?php beallitas_keres("nev") ?> - Bejelentkezés</title>
		<link rel="icon" type="image/png" href="<?php echo oldalCim(); ?>media/ikonok/ikon.png"/>
		<meta name="theme-color" content="<?php beallitas_keres("hatterSzin"); ?>" />
		<meta name="msapplication-navbutton-color" content="<?php beallitas_keres("hatterSzin"); ?>">
		<meta name="apple-mobile-web-app-status-bar-style" content="<?php beallitas_keres("hatterSzin"); ?>">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="viewport" content="viewport-fit=cover, user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" type="text/css" href="bejelentkezes.css">
		<link rel="stylesheet" href="../../kliens/bootstrap/bootstrap.min.css">
						<script src="../../kliens/bootstrap/jquery.slim.min.js"></script>
						<script src="../../kliens/bootstrap/popper.min.js"></script>
						<script src="../../kliens/bootstrap/bootstrap.bundle.min.js"></script>	
	</head>
	<body>
	
		<?php
	
		if($videoHatter){
			echo '
				<video autoplay muted loop id="videoHatter">
					<source src="../../media/videok/hatter.mp4" type="video/mp4">
				</video>
				
				<div id="hatter" style="display:none;"></div>
			';
		}else{
			echo '
				<div id="hatter"></div>
				
				<video muted loop id="videoHatter">
					<source src="../../media/videok/hatter.mp4" type="video/mp4">
				</video>
			';
		}
	
	?>
		
	<div class="modal fade" id="valasz">
		<div class="modal-dialog modal-dialog-centered">
		  <div class="modal-content">
		  
			<!-- Modal Header -->
			<div class="modal-header">
			  <h4 class="modal-title" id="valaszCim">Minden sikerült</h4>
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			
			<!-- Modal body -->
			<div class="modal-body" id="valaszSzoveg">
			  ...
			</div>
			
			<!-- Modal footer -->
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
					if(!$IOS){
						if($videoHatter){ 
							echo '<img class="beallitasReszlegIkonok" src="../media/ikonok/szunet.png" id="hatterKezeloGomb">';
						}else{
							echo '<img class="beallitasReszlegIkonok" src="../media/ikonok/indit.png" id="hatterKezeloGomb">';
						}
					}
					?>
					</div>
					<header>
						<!--h1>Monster Gym</h1!-->
						<img src="../media/ikonok/fonokLogo.png">
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
	<script src="../kliens/js/sutiKezelo.js"></script>
	<script src="bejelentkezes.js"></script>
	<style>
	body.modal-open > :not(.modal) {
	-webkit-filter: blur(12px);
		-moz-filter: blur(12px);
		-o-filter: blur(12px);
		-ms-filter: blur(12px);
			filter: blur(12px);
	}
	
	.modal-content{
		background-color:rgba(20,20,20,0.5) !important;
		color:white !important;
		backdrop-filter:blur(10px) !important;
	}
	
	.modal-header{
		border-bottom:2px solid rgba(0,0,0,0.3) !important;
	}
	
	.modal-footer{
		border-top:2px solid rgba(0,0,0,0.3) !important;
	}
	
	.close{
		color:white;
	}
	.close:hover{
		color:white;
	}
	
	</style>
</html>