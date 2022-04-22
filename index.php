<?php
	
	include_once("gym/szerver/oldalCim.php");
	include_once("gym/szerver/beallitasok.php");
	
	$IOS=false;
	
	$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
	
	
	if($iPhone){
		$IOS=true; //ios-en sajnos a háttérben lévő videó nem kezelhető
		$videoHatter=false; //ios-en sajnos a háttérben lévő videó nem kezelhető
	}
	
	if($iPod){
		$IOS=true; //ios-en sajnos a háttérben lévő videó nem kezelhető
		$videoHatter=false; //ios-en sajnos a háttérben lévő videó nem kezelhető
	}
	
	if($iPad){
		$IOS=true; //ios-en sajnos a háttérben lévő videó nem kezelhető
		$videoHatter=false; //ios-en sajnos a háttérben lévő videó nem kezelhető
	}
	$IOS=true;
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
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="kliens/css/fooldal.css">
		<script src="kliens/bootstrap/jquery.slim.min.js"></script>
		<script src="kliens/bootstrap/popper.min.js"></script>
		<script src="kliens/bootstrap/bootstrap.bundle.min.js"></script>
		
	</head>
	
	<body>
		
		<div id="tolto">
			<div class="spinner-grow text-danger"></div>
		</div>
		
		<div class="text-center">
		<?php 
		
			if(!$IOS){
				echo '
				
					<video autoplay muted loop id="videoHatter">
						<source src="media/videok/hatter.mp4" type="video/mp4">
					</video>
					<!--img id="videoHatter" src="media/kepek/hatter.jpg"!-->

				
				';
			}else{
			
				echo '
				
					<!--video autoplay muted loop id="videoHatter">
						<source src="media/videok/hatter.mp4" type="video/mp4">
					</video!-->
					<img id="videoHatter" src="media/kepek/hatter.jpg">
				
				';
			
			}
		
		?>
			<nav class="navbar navbar-dark navigacio">
			  <!-- Brand -->
			  <a class="navbar-brand" href="#"><?php beallitas_keres("nev") ?></a>

			  <!-- Toggler/collapsibe Button -->
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigacioKezelo">
				<span class="navbar-toggler-icon"></span>
			  </button>

			  <!-- Navbar links -->
			  <div class="collapse navbar-collapse" id="navigacioKezelo">
				<ul class="navbar-nav">
				  <li class="nav-item">
					<a class="nav-link">Főoldal</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" href="#arlista">Árlista</a>
				  </li>
				</ul>
			  </div>
			</nav>
			
			<div id="udvozlo" class="d-flex justify-content-center align-items-center">
				<div>
					<div class="row">
						<div class="col-2">
						</div>
						<div class="col-8 text-center">
							<span class="bg-danger rounded"><?php beallitas_keres("nev") ?></span>
							<h4 class="mt-4">A tested szinte bármit kibír. Az elméd az, amit meg kell győznöd.</h4>
							<a href="#arlista"><img id="lefele" src="media/kepek/le.png"></a>
						</div>
						<div class="col-2">
						</div>
					</div>
				</div>
			</div>
			
			<div id="arlista">
				
				<h1>Árlista</h1><br>
				
				<div class="row" id="opciok">
					
				</div>
				
			</div>
			
		</div>
		
	</body>
	
	<script>
		
		<?php 
		
			if(!$IOS){
				
				echo '
				
					var hatter = document.getElementById("videoHatter");
					hatter.oncanplay = function () { //Amint betöltött a videóháttér eltűntetjük a töltőképrenyőt.
						tolto.style.display = "none";
					};
				
				';
			
			}else{
			
				echo 'tolto.style.display = "none"';
			
			}
			
		?>
		
		
		var link = "<?php echo oldalCim(); ?>";
		

		
	</script>
	
	<script src="kliens/js/fooldal.js"></script>
	
</html>