<?php

	include_once("../../szerver/beallitasok.php");
	include_once("../../szerver/oldalCim.php");
	include_once("../../szerver/nemek.php");
	
	session_start();
	$belepve = $_SESSION["monstersgymadminid"];

	if(!isset($belepve)){
		
		header('Location: ../bejelentkezes.php');
		
	}

?>

<html>

<head>
	<meta charset="UTF-8">
	<title><?php beallitas_keres("nev") ?> - Felhasználók</title>
	<link rel="icon" type="image/png" href="<?php echo oldalCim(); ?>media/ikonok/ikon.png"/>
	<meta name="theme-color" content="<?php beallitas_keres("hatterSzin"); ?>" />
	<meta name="msapplication-navbutton-color" content="<?php beallitas_keres("hatterSzin"); ?>">
	<meta name="apple-mobile-web-app-status-bar-style" content="<?php beallitas_keres("hatterSzin"); ?>">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="viewport-fit=cover, user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="index.css">
	<link rel="stylesheet" href="../../../kliens/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="../../kliens/css/oldalsoSav.css">
	<script src="../../../kliens/bootstrap/jquery.slim.min.js"></script>
	<script src="../../../kliens/bootstrap/popper.min.js"></script>
	<script src="../../../kliens/bootstrap/bootstrap.bundle.min.js"></script>
</head>

<body>



<div id="navigacio" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">
  <img id="menuNyito" src="../../media/ikonok/menu_f.png" height="30px">	
		<div id="cimResz"><?php beallitas_keres("nev") ?></div>
        <a class="nav-link" href="javascript:adminKijelentkezes();"><img src="../../media/ikonok/kijelentkezes_f.png" height="30px"></a>

</div>


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
          ...
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Bezárás</button>
        </div>
        
      </div>
    </div>
  </div>

	<div id="oldalso-sav" style="background-color:<?php beallitas_keres("hatterSzin") ?>;">

		<?php include_once("../../szerver/adminOldalsoSav.php") ?>


	</div>




					<div class="modal fade" id="kartyaOlvaso">
					<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
					
					
					<div class="modal-header">
					<h4 class="modal-title" id="valaszCim">Kártya olvasó</h4>
					</div>
					
					
					<div class="modal-body" id="valaszSzoveg">
					<div style="width:auto;" id="olvaso"></div>
					</div>
					
					
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" id="kartyaOlvasoBezar">Bezárás</button>
					</div>
					
					</div>
					</div>
					</div>
					
					
					<div class="modal fade" id="torlendoAblak">
					<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
					
					
					<div class="modal-header">
					<h4 class="modal-title font-weight-bold" id="torlendoAblakCim">Megerősítés szükséges</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					
					
					<div class="modal-body text-center" id="valaszSzoveg">
					<h5 class="">A törléshez szükséges a főnök!</h5>
					<div class="row">
					<div class="col-md-10">
					<input type="password" id="torlendoAblakJelszo" class="form-control w-100" placeholder="Jelszó">
					</div>
					<div class="col-md-2">
					<input type="button" class="btn btn-info w-100" value="📸" id="torlendoKartyaOlvaso">
					</div>
					</div>
					</div>
					
					
					<div class="modal-footer">
					<button type="button" class="btn btn-success" id="torlendoAblakEllenorizGomb">Ellenörzés</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Bezárás</button>
					</div>
					
					</div>
					</div>
					</div>
					
					<!-- The Modal -->
					<div class="modal fade" id="modositandoFelhasznalo">
					<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
					<div class="modal-content">
					
					
					<div class="modal-header">
					<h4 class="modal-title">Felhasználó módosítása</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					
					
					<div class="modal-body text-center">
					
					<div class="form-group">
					<label for="vezetekNev">Vezetéknév:</label><br>
					<input type="text" class="form-control w-100" id="modositandoVezetekNev">
					</div>
					
					<div class="form-group">
					<label for="keresztNev">Keresztnév:</label><br>
					<input type="text" class="form-control w-100" id="modositandoKeresztNev">
					</div>
					
					<div class="form-group">
					<label for="utoNev">Utónév:</label><br>
					<input type="text" class="form-control w-100" id="modositandoUtoNev">
					</div>
					
					<div class="form-group">
					<label for="nem">Nem:</label><br>
					<select class="form-control w-100" id="modositandoNeme">
					<?php nemek() ?>
					</select>
					</div>
					
					<div class="form-group">
					<label for="szuletesiDatum">Születési Dátum:</label><br>
					<input type="text" class="form-control w-100" id="modositandoSzuletesiDatum">
					</div>
					
					<div class="form-group">
					<label for="szemelyiId">SzemélyiId:</label><br>
					<input type="text" class="form-control w-100" id="modositandoSzemelyiId">
					</div>
					
					<div class="form-group">
					<label for="telefonszam">Telefonszám:</label><br>
					<input type="text" class="form-control w-100" id="modositandoTelefonszam">
					</div>
					
					<div class="form-group">
					<label for="lakcim">Lakcím:</label><br>
					<input type="text" class="form-control w-100" id="modositandoLakcim">
					</div>
					
					<div class="form-group">
					<label for="modositandoKartya">Kártya azonosító:</label><br>
					
					<div class="row">
					<div class="col-sm-10">
					<input type="text" class="form-control w-100" id="modositandoKartya">
					</div>
					<div class="col-sm-2">
					<input type="button" class="btn btn-info w-100" id="modositandoKartyaOlvaso" value="📸">
					</div>
					</div>
					</div>
					
					
					
					
					
					
					
					
					
					
					</div>
					
					
					<div class="modal-footer text-center">
					<input type="button" class="btn btn-danger" data-dismiss="modal" value="Mégse">
					<input type="button" class="btn btn-success" value="Változtat" id="modositMentes">
					</div>
					
					</div>
					</div>
					</div>
					
					
					<div class="modal fade" id="ujfelhasznaloKartyaja">
					<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
					
					
					<div class="modal-header">
					<h4 class="modal-title" id="valaszCim">Kártya olvasó</h4>
					</div>
					
					
					<div class="modal-body" id="valaszSzoveg">
					<div style="width:auto;" id="ujTagOlvaso"></div>
					
					<div class="form-group">
					<label for="lakcim">Kártya azonosító:</label><br>
					<div class="row">
					<div class="col-sm-10">
					<input type="text" class="form-control w-100" id="ujKartya">
					</div>
					<div class="col-sm-2">
					<input type="button" class="btn btn-info w-100" id="ujKartyaOlvaso" value="📸">
					</div>
					</div>
					</div>
					</div>
					
					
					<div class="modal-footer">
					<button type="button" class="btn btn-success" disabled id="ujKartyaMentes">Tovább</button>
					<button type="button" class="btn btn-danger" id="ujKartyaMegse">Mégse</button>
					</div>
					
					</div>
					</div>
					</div>
					<!-- The Modal -->
					<div class="modal fade" id="ujfelhasznalo">
					<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
					<div class="modal-content">
					
					
					<div class="modal-header">
					<h4 class="modal-title">Új tag hozzáadása</h4>
					</div>
					
					
					<div class="modal-body text-center">
					
					<div class="form-group">
					<label for="vezetekNev">Vezetéknév:</label><br>
					<input type="text" class="form-control w-100" id="ujVezetekNev">
					</div>
					
					<div class="form-group">
					<label for="keresztNev">Keresztnév:</label><br>
					<input type="text" class="form-control w-100" id="ujKeresztNev">
					</div>
					
					<div class="form-group">
					<label for="utoNev">Utónév:</label><br>
					<input type="text" class="form-control w-100" id="ujUtoNev">
					</div>
					
					<div class="form-group">
					<label for="nem">Nem:</label><br>
					<select class="form-control" name="ujNeme" id="ujNeme" style="width:100%">
					<?php nemek() ?>
					</select>
					</div>
					
					<div class="form-group">
					<label for="szuletesiDatum">Születési Dátum:</label><br>
					<input type="date" class="form-control w-100" name="ujszuletesiDatum" id="ujszuletesiDatum" placeholder="Születési Dátum"><br>
					</div>
					
					<div class="form-group">
					<label for="szemelyiId">Személyi:</label><br>
					<input type="number" class="form-control w-100" id="ujSzemelyiId">
					</div>
					
					<div class="form-group">
					<label for="telefonszam">Telefonszám:</label><br>
					<input type="number" class="form-control w-100" id="ujTelefonszam">
					</div>
					
					<div class="form-group">
					<label for="lakcim">Lakcím:</label><br>
					<input type="text" class="form-control w-100" id="ujLakcim">
					</div>
					
					
					</div>
					
					
					<div class="modal-footer text-center">
					<input type="button" class="btn btn-danger" value="Mégse" id="ujMentesMegse">
					<input type="button" class="btn btn-success" value="Hozzáadás" id="ujMentes">
					</div>
					
					</div>
					</div>
					</div>
					
					
					<!-- The Modal -->
					<div class="modal fade" id="ujtranzakcio">
					<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
					<div class="modal-content">
					
					
					<div class="modal-header">
					<h4 class="modal-title">Új tranzakció</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					
					
					<div class="modal-body text-center">
					
					
					<span class="tranzakcioSzemelyNeve" id="modositandoVezetekNev"></span>
					<span class="tranzakcioSzemelyNeve" id="modositandoKeresztNev"></span>
					
					
					
					<div class="form-group">
					<label for="nem">Csomag:</label><br>
					<select class="form-control" name="csomag" id="csomag" onchange="arKiirasa()" style="width:100%">
					
					</select>
					</div>
					
					
					<div class="form-group">
					<label for="mennyitFizet">Mennyit fizet?</label><br>
					<input type="number" class="form-control w-100" id="mennyitFizet" name="mennyitFizet" placeholder="1234 FT" min="0">
					</div>
					
					<div class="form-group">
					<label for="leiras">Egyéb:</label>
					<textarea class="form-control w-100" rows="5" id="leiras"></textarea>
					</div>
					
					
					
					</div>
					
					
					<div class="modal-footer text-center">
					<input type="button" class="btn btn-danger" data-dismiss="modal" value="Mégse">
					<input type="button" class="btn btn-success" value="Hozzáadás" id="ujTranzakcioMentes">
					</div>
					
					</div>
					</div>
					</div>
					
					
					<div class="modal fade" id="beolvasottFelhasznalo">
					<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
					
					
					<div class="modal-header">
					<h4 class="modal-title" id="valaszCim">Profil</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					
					
					<div class="modal-body text-center" id="beolvasottFelhasznaloTartalma">
					
					
					<div id="profilToltes" class="spinner-grow text-danger" role="status">
					<span class="sr-only">Betöltés...</span>
					</div>
					
					<div id="profilKezelese">
					
					<h1 id="beolvasottFelhasznaloNeve">X Y</h1>
					<hr>
					<h1>Bérlet állapota</h1>
					<p id="berletAllapot">---</p>
					<hr>
					<h1>Napijegy állapota</h1>
					<p id="napiJegyAllapot">---</p>
					<hr>
					<button type="button" class="btn btn-success" disabled id="felhasznaloKulcsozasa">Beléptet</button>
					<button type="button" class="btn btn-danger" disabled id="felhasznaloKileptet">Kiléptet</button>
					
					</div>	
					
					<div id="profilKulcsozasa">
					<h1>Kulcs megadása</h1>
					<input type="text" class="form-control w-100 mb-2" id="kulcsId">
					<button type="button" class="btn btn-success" disabled id="felhasznaloBeleptet">Beléptet</button>
					</div>
					
					<div id="profilValasz">
					<h1 id="profilValaszSzoveg"></h1>
					</div>
					
					</div>
					
					
					<div class="modal-footer" id="profilKezeleseAlja">
					
					<button type="button" class="btn btn-success" id="ujTranzakcioGomb">Vásárlás</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Mégse</button>
					</div>
					
					</div>
					</div>
					</div>
					
					<div class="modal fade" id="kulcsLeadas">
					<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
					
					
					<div class="modal-header">
					<h4 class="modal-title" id="valaszCim">Kulcs leadás</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					
					<div class="modal-body text-center">
					
					<h3>Kulcs megadása</h3>
					<input type="text" class="form-control w-100 mb-2" id="kulcsLeadasId">
					<button type="button" class="btn btn-warning" disabled id="kulcsLeadasGomb">Profil megnyitása</button>
					
					</div>
					
					</div>
					</div>
					</div>
	
<div id="oldal">
	<div id="tartalom">
	
	
	<div id="felhasznaloDiv">
		<ul class="list-group" id="tartalomBlokk">
			<li class="list-group-item text-white" style="background-color:<?php beallitas_keres("hatterSzin") ?>">Felhasználók</li>
			<li class="list-group-item">

			<!--
			Csomag lista
			!-->

				
			<div class="row">
				<div class="col-sm-3">
				
				

				
					<p>Mutass <select id="csomaglista" class="form-control w-100 text-center">
					
					  <option value="osszes">Összes</option>
					  <option value="5">5</option>
					  <option value="10">10</option>
					  <option value="20">20</option>
					  <option value="50">50</option>

					
					</select></p>
					
					
					<p>Új<button type="button" class="btn btn-success w-100" id="ujFelhasznaloFelvetel">
						<img src="../../kliens/bootstrapIkonok/person-plus-fill" class="ikonok" height="24px">
					</button></p>
					
				</div>

				<div class="col-sm-6">

					<p>Kártyaolvasó:
						<input type="button" class="btn btn-info w-100" value="📸" data-toggle="modal" onclick="kartyaOlvaso()"></p>
					
					<p>Kulcs leadás:<input type="button" class="btn btn-warning w-100" value="🔑" data-toggle="modal" data-target="#kulcsLeadas"></p>


				</div>

				
				<div class="col-sm-3">
				
				
					<span>Keresés: <input type="text" class="form-control w-100 mb-3" id="kereso"></span>
 						
						  <span>Keresés alapja	<select class="form-control w-100 text-center" id="keresesAlapja"></span>
						  
							<option value="berlet">Bérlet</option>
							<option value="nev">Név</option>
							<option value="szemelyi">Személyi</option>
							<option value="telefonszam">Telefonszám</option>
							
							
						  </select>


				</div>
				
				
				
			</div>
		<div class="table-responsive table-hover" id="tablazatdiv">
			<p id="tablazat"></p>
		<!--table class="table table-bordered" id="csomaglista">
			<thead>
			<tr>
				<th>Azonosító</th>
				<th>Név</th>
				<th>Ár</th>
				<th>Leírás</th>
				<th>Művelet</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td>1</td>
				<td>Egy</td>
				<td>1000 FT</td>
				<td>Első leírás</td>
				<td><input type="button" class="btn btn-primary" value="✏️"><input type="button" class="btn btn-danger" value="❌"></td>
			</tr>
			<tr>
				<td>2</td>
				<td>Kettő</td>
				<td>2000 FT</td>
				<td>Második leírás</td>
				<td><input type="button" class="btn btn-primary" value="✏️"><input type="button" class="btn btn-danger" value="❌"></td>
			</tr>
			<tr>
				<td>3</td>
				<td>Három</td>
				<td>3000 FT</td>
				<td>Harmadik leírás</td>
				<td><input type="button" class="btn btn-primary" value="✏️"><input type="button" class="btn btn-danger" value="❌"></td>
			</tr>
			</tbody>
		</table!-->
	  </div>
			
	</li>
	</ul>
</div>
	
	<div id="tranzakcioDiv" style="display:none">
			
			
			<ul class="list-group" id="tartalomBlokk" id="felhasznalokLista">
			<li class="list-group-item text-white w-100 d-flex align-items-center justify-content-between" style="background-color:<?php beallitas_keres("hatterSzin") ?>">
				<input type="button" class="btn btn-success" value="Vissza" id="tranzakcioDivVissza" stlye="max-width:50px !important;">
				<span>Tranzakciók</span>
				<span></span>
			</li>
			<li class="list-group-item">

			<!--
			Csomag lista
			!-->

		<div class="table-responsive" id="tablazatdiv">
			<p id="tranzakcioTablazat"></p>
		<!--table class="table table-bordered" id="csomaglista">
			<thead>
			<tr>
				<th>Azonosító</th>
				<th>Név</th>
				<th>Ár</th>
				<th>Leírás</th>
				<th>Művelet</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td>1</td>
				<td>Egy</td>
				<td>1000 FT</td>
				<td>Első leírás</td>
				<td><input type="button" class="btn btn-primary" value="✏️"><input type="button" class="btn btn-danger" value="❌"></td>
			</tr>
			<tr>
				<td>2</td>
				<td>Kettő</td>
				<td>2000 FT</td>
				<td>Második leírás</td>
				<td><input type="button" class="btn btn-primary" value="✏️"><input type="button" class="btn btn-danger" value="❌"></td>
			</tr>
			<tr>
				<td>3</td>
				<td>Három</td>
				<td>3000 FT</td>
				<td>Harmadik leírás</td>
				<td><input type="button" class="btn btn-primary" value="✏️"><input type="button" class="btn btn-danger" value="❌"></td>
			</tr>
			</tbody>
		</table!-->
	  </div>
			
	</li>
	</ul>

</div>
	
</div>
</div>

<!--img src="visszajelzes.jpg" id="visszajelzes"!-->

</body>


<script>

var link = "<?php echo oldalCim("nev"); ?>";

</script>

<script src="../../kliens/qrOlvaso/html5-qrcode.min_.js"></script>
<script src="../../kliens/js/adminOldalValtas.js"></script>
<script src="../../kliens/js/kijelentkezes.js"></script>
<script src="../../kliens/js/oldalsoSav.js"></script>
<script src="csomagok.js"></script>
<script src="tranzakcioLeker.js"></script>
<script src="forgalomLeker.js"></script>

<script src="index.js"></script>




<style>

/*#visszajelzes{
	position:absolute;
	z-index:2400;
	top:0px;
	left:0px;
	width:100vh;
	height:100vh;
	object-fit:contain;
	display:none;
}*/

.form-control {
	width:auto;
	display:inline-block;

	
}

#oldal{
	background-color:white;
}

#tartalom{
	background-color:white;	
}

html,body{
	background-color:black;
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

td, th {
  white-space: nowrap;
  overflow: hidden;
}

.ikonok{
	filter:invert();
}

</style>

</html>