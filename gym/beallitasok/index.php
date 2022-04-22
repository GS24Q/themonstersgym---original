<?php
	
	error_reporting(0);
	
	session_start();
	$belepve = $_SESSION["monstersgymid"];
	
	if(!isset($belepve)){
		
		header('Location: ../bejelentkezes.php');
		die();
	}
	
	include_once("../szerver/beallitasok.php");
	include_once("../szerver/oldalCim.php");
	
?>

<html>
	
	<head>
		<meta charset="UTF-8">
		<title><?php beallitas_keres("nev") ?> - Beállítások</title>
		<link rel="icon" type="image/png" href="<?php echo oldalCim(); ?>media/ikonok/ikon.png"/>
		<meta name="theme-color" content="<?php beallitas_keres("hatterSzin"); ?>" />
		<meta name="msapplication-navbutton-color" content="<?php beallitas_keres("hatterSzin"); ?>">
		<meta name="apple-mobile-web-app-status-bar-style" content="<?php beallitas_keres("hatterSzin"); ?>">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="viewport" content="viewport-fit=cover, user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="index.css">
		<link rel="stylesheet" href="../../kliens/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" href="../kliens/css/oldalsoSav.css">
		<script src="../../kliens/bootstrap/jquery.slim.min.js"></script>
		<script src="../../kliens/bootstrap/popper.min.js"></script>
		<script src="../../kliens/bootstrap/bootstrap.bundle.min.js"></script>
		
		
	</head>
	
	<body>
		
		
		<div id="navigacio" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">
			<img id="menuNyito" src="../media/ikonok/menu_f.png" height="30px">	
			<div id="cimResz"><?php beallitas_keres("nev") ?></div>
			<a class="nav-link" href="javascript:kijelentkezes();"><img src="../media/ikonok/kijelentkezes_f.png" height="30px"></a>
			
		</div>
		
		
		<div id="oldalso-sav" style="background-color:<?php beallitas_keres("hatterSzin") ?>;">
			
			<?php include_once("../szerver/oldalsoSav.php") ?>
			
			
		</div>
		
		
		<div class="modal fade" id="jelszoValtoztat">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">A profilod jelszavának megváltoztatása</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					
					<!-- Modal body -->
					<div class="modal-body">
						<p>Jelszó megváltoztatása</p>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group text-center">
									<input type="password" placeholder="Új jelszó" class="form-control w-100" id="jelszoValtoztatUjJelszo">
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group text-center">
									<input type="password" placeholder="Új jelszó mégegyszer" class="form-control w-100" id="jelszoValtoztatUjJelszoMegegyszer">
								</div>
							</div>
							
						</div>
						
						
					</div>
					
					<!-- Modal footer -->
					<div class="modal-footer">
						<input type="button" class="btn btn-success text-white" value="Változtat" id="jelszoValtoztatGomb">
					</div>
					
				</div>
			</div>
		</div>
		
		
		<div class="modal fade" id="felhasznaloNevValtoztat">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">A profilod felhasználónevének megváltoztatása</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					
					<!-- Modal body -->
					<div class="modal-body">
						<p>Felhasználónév megváltoztatása</p>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group text-center">
									<input type="text" placeholder="Új felhasználónév" class="form-control w-100" id="felhasznaloNevValtoztatUjNev">
								</div>
							</div>
							
							<div class="col-md-6 m-t-2">
								<div class="form-group text-center">
									<input type="text" placeholder="Új felhasználónév mégegyszer" class="form-control w-100" id="felhasznaloNevValtoztatUjNevMegegyszer">
								</div>
							</div>
							
						</div>
						
						
					</div>
					
					<!-- Modal footer -->
					<div class="modal-footer">
						<input type="button" class="btn btn-success text-white" value="Változtat" id="felhasznaloNevValtoztatGomb">
					</div>
					
				</div>
			</div>
		</div>
		
		
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
			
			
			<div id="oldal">
			<div id="tartalom d-flex">
			<div class="container">
			
			<div class="card" style="width:auto">
			<div class="card-body">
			
			<h1 id="becenev">Üdvözöllek kedves</h1>
			
			</div>
			</div>
			
			<div class="row text-center">
			
			
			<div class="col-lg-6 mt-4">
			
			<div class="card" style="width:auto">
			<!--img class="card-img-top" src="<?php oldalCim(); ?>/media/kepek/hatter.jpg" alt="Card image" style="width:100%"!-->
			<div class="card-body">
			<span class="card-title">Felhasználónév változtatás</span>
			<input type="button" class="btn text-white w-100 mt-3" data-toggle="modal" style="background-color:<?php beallitas_keres("hatterSzin") ?>;" data-target="#felhasznaloNevValtoztat" value="Kattints ide">
			</div>
			</div>
			
			</div>
			
			<div class="col-lg-6 mt-4">
			
			<div class="card" style="width:auto">
			<!--img class="card-img-top" src="<?php oldalCim(); ?>/media/kepek/hatter.jpg" alt="Card image" style="width:100%"!-->
			<div class="card-body">
			<span class="card-title">Jelszó változtatás</span>
			<input type="button" class="btn text-white w-100 mt-3" data-toggle="modal" style="background-color:<?php beallitas_keres("hatterSzin") ?>;" data-target="#jelszoValtoztat" value="Kattints ide">
			</div>
			</div>
			
			</div>
			
			
			</div>
			
			</div>
			</div>
			</div>
			
			
			
			</body>
			
			<script src="../kliens/js/oldalValtas.js"></script>
			<script src="../kliens/js/kijelentkezes.js"></script>
			<script src="../kliens/js/oldalsoSav.js"></script>
			
			
			<script>
			
			var felhasznaloId = <?php echo $_SESSION["monstersgymid"]; ?>;
			
			var link = "<?php echo oldalCim(); ?>";
			
			</script>
			
			
			<script src="index.js"></script>
			
			<style>
			
			
			html,body{
			background-color:black;
			}
			
			
			#oldal{
			background-color:white;
			}
			
			#tartalom{
			background-color:white;	
			}
			
			.form-control {
			width:auto;
			display:inline-block;
			
			
			}
			
			.szam{
			height: calc(1.5em + 0.75rem + 2px) !important;
			width:100% !important;
			left:0px !important;
			padding: 0.375rem 0.75rem;
			font-size: 1rem;
			font-weight: 400;
			line-height: 1.5;
			color: #495057;
			background-color: #fff;
			background-clip: padding-box;
			border: 1px solid #ced4da !important;
			border-radius: 0.25rem !important;
			transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out !important;
			}
			
			body.modal-open > :not(.modal) {
			-webkit-filter: blur(12px);
			-moz-filter: blur(12px);
			-o-filter: blur(12px);
			-ms-filter: blur(12px);
			filter: blur(12px);
			}
			
			</style>
			
			</html>				