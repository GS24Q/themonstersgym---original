


<?php
//error_reporting(0);
include_once("../../szerver/beallitasok.php");
include_once("../../szerver/oldalCim.php");

session_start();
$belepve = $_SESSION["monstersgymadminid"];

if(!isset($belepve)){
	
	header('Location: ../bejelentkezes.php');
	
}

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
	<link rel="stylesheet" href="../../kliens/css/oldalsoSav.css">
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body onload="lekerdez()">





<!-- The Modal -->
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
          
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Bezárás</button>
        </div>
        
      </div>
    </div>
  </div>



<div id="navigacio" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">
  <img id="menuNyito" src="../../media/ikonok/menu_f.png" height="30px">	
		<div id="cimResz"><?php beallitas_keres("nev") ?></div>
        <a class="nav-link" href="javascript:adminKijelentkezes();"><img src="../../media/ikonok/kijelentkezes_f.png" height="30px"></a>

</div>


	<div id="oldalso-sav" style="background-color:<?php beallitas_keres("hatterSzin") ?>;">

		<?php include_once("../../szerver/adminOldalsoSav.php") ?>


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



<div id="oldal">
	<div id="tartalom d-flex">
		<div class="container">
		
					<div class="row text-center" id="valaszto">
					

					
						<div class="col-sm-6 mt-4">
					
						<a href="javascript:oldalBeallitasok();">
							<img src="../../media/ikonok/oldalBeallitasok.png" style="background-color:<?php beallitas_keres("hatterSzin") ?>;height:180px;width:180px;">
						</a>

						</div>
						
						<div class="col-sm-6 mt-4">
							
							<a href="javascript:fiokBeallitasok();">
								<img src="../../media/ikonok/fiokBeallitasok.png" style="background-color:<?php beallitas_keres("hatterSzin") ?>;height:180px;width:180px;">
							</a>

						</div>
						
						
					</div>

			<section id="teremBeallitasok" class="beallitasok form" style="margin:0 auto;display:none">

			<h2>A jelenlegi beállítások</h2>

			<hr>

				<form id="azonosit" action="" method="POST" enctype="multipart/form-data" autocomplete="off">

					<div class="row">
					
						<div class="col-md-12">
							<div class="form-group">
								<label for="teremneve">A terem neve</label>
								<input type="text" id="teremNev" name="teremNev" class="form-control" placeholder="Név">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="teremszine">A terem színe</label>
								<input type="color" id="teremSzin" name="teremSzin" class="form-control">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="teremszine">Az oldal zárolása?</label><br>
								
								
								
								
								<div class="form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="teremZarolasiAllapot" id="teremFeloldva" value="Ki">Ki
								</label>
								</div>
								<div class="form-check-inline">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="teremZarolasiAllapot" id="teremZarolva" value="Be">Be
								</label>
								</div>
								
								
								
								
								
								
							</div>
						</div>
						
						<div class="col-md-12">
						<hr>
							<input type="button" class="btn btn-block btn-success" id="mentes" value="Mentés">
						</div>
					</div>


				</form>
			</section>


			<div id="fiokBeallitasok" style="margin:0 auto;display:none">
				
					<div class="card" style="width:auto">
						<div class="card-body">

							<h1 id="becenev">Profil megváltoztatása</h1>
				
						</div>
					</div>
				
					<div class="row text-center">
					
					
						<div class="col-sm-6 mt-4">
					
							<div class="card" style="width:auto">
								<!--img class="card-img-top" src="<?php oldalCim(); ?>/media/kepek/hatter.jpg" alt="Card image" style="width:100%"!-->
								<div class="card-body">
								<span class="card-title">Felhasználónév változtatás</span>
								<input type="button" class="btn text-white w-100 mt-3" data-toggle="modal" style="background-color:<?php beallitas_keres("hatterSzin") ?>;" data-target="#felhasznaloNevValtoztat" value="Kattints ide">
								</div>
							</div>

						</div>
						
						<div class="col-sm-6 mt-4">
					
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
</div>


</body>


<script>

	var felhasznaloId = <?php echo $_SESSION["monstersgymadminid"]; ?>;
	var link = "<?php echo oldalCim("nev"); ?>";

</script>


<script src="../../kliens/js/kijelentkezes.js"></script>
<script src="../../kliens/js/oldalsoSav.js"></script>
<script src="../../kliens/js/adminOldalValtas.js"></script>

<style>


html,body{
	background-color:black;
}


#oldal{
	background-color:white;
}

.container-fluid{
		background-color:white;

}

.container-fluid a{
	color:white;
	font-weight:bold;
	text-decoration:none;

}

.hozzaad{
	position:absolute;
	z-index:1000;
	top:0px;
	right:0px;
	height:49px;
	width:49px;
	color:white;
	font-weight:bold;
	border-radius:0;
}

.form-control {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}


body.modal-open > :not(.modal) {
 -webkit-filter: blur(12px);
    -moz-filter: blur(12px);
      -o-filter: blur(12px);
     -ms-filter: blur(12px);
         filter: blur(12px);
}

</style>

<script src="index.js"></script>

</html>