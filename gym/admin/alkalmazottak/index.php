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
	<title><?php beallitas_keres("nev") ?> - Alkalmazottak</title>
	<link rel="icon" type="image/png" href="<?php echo oldalCim(); ?>media/ikonok/ikon.png"/>
	<meta name="theme-color" content="<?php beallitas_keres("hatterSzin"); ?>" />
	<meta name="msapplication-navbutton-color" content="<?php beallitas_keres("hatterSzin"); ?>">
	<meta name="apple-mobile-web-app-status-bar-style" content="<?php beallitas_keres("hatterSzin"); ?>">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="viewport-fit=cover, user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="index.css">
	<link rel="stylesheet" href="../../kliens/css/oldalsoSav.css">
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
          <h4 class="modal-title" id="valaszCim"></h4>
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
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="valaszCim">Kártya olvasó</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" id="valaszSzoveg">
			<div style="width:auto;" id="olvaso"></div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="kartyaOlvasoBezar">Bezárás</button>
        </div>
        
      </div>
    </div>
  </div>
  
  
<div class="modal fade" id="ujAlkalmazottKartyaja">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="valaszCim">Kártya olvasó</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
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
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-success" disabled id="ujKartyaMentes">Tovább</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Mégse</button>
        </div>
        
      </div>
    </div>
  </div>


<div class="modal fade" id="torlendoAblak">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title font-weight-bold" id="torlendoAblakCim">Megerősítés szükséges</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body text-center" id="valaszSzoveg">
			<h5 class="">A törléshez egy jelszó szükséges.</h5>
			<div class="row">
			<div class="col-md-10">
				<input type="password" id="torlendoAblakJelszo" class="form-control w-100" placeholder="Jelszó">
			</div>
			<div class="col-md-2">
				<input type="button" class="btn btn-info w-100" id="torlendoKartyaOlvaso" value="📸">
			</div>
			</div>
        </div>
        
        <!-- Modal footer -->
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
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Felhasználó módosítása</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
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
				<select class="form-control" name="modositandoNeme" id="modositandoNeme" style="width:100%">
					<?php nemek(); ?>
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

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer text-center">
		  <input type="button" class="btn btn-danger" data-dismiss="modal" value="Mégse">
          <input type="button" class="btn btn-success" value="Változtat" id="modositMentes">
        </div>
        
      </div>
    </div>
  </div>

		 <!-- The Modal -->
<div class="modal fade" id="ujpultosadatokresz">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Új pultos hozzáadása</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
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
				<?php nemek(); ?>
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








        
        <!-- Modal footer -->
        <div class="modal-footer text-center">
		  <input type="button" class="btn btn-danger" data-dismiss="modal" value="Mégse">
          <input type="button" class="btn btn-success" value="Tovább" id="ujFelhasznaloTovabb">
        </div>
        
      </div>
    </div>
  </div>
	
		 <!-- The Modal -->
<div class="modal fade" id="ujpultosbelepesiresz">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">A pultos bejelentkezési adatai</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body text-center">
		
		
		<div class="form-group">
		  <label for="ujFelhasznalonev">Felhasználónév:</label><br>
		  <input type="text" class="form-control w-100" id="ujFelhasznalonev">
		</div>
		

		
		<div class="row">
			<div class="col-sm-6">
			
				<div class="form-group">
				  <label for="ujJelszo">Jelszó:</label><br>
				  <input type="password" class="form-control w-100" id="ujJelszo">
				</div>
				
			</div>
			<div class="col-sm-6">

				
				<div class="form-group">
				  <label for="ujJelszoMegegyszer">Jelszó mégegyszer:</label><br>
				  <input type="password" class="form-control w-100" id="ujJelszoMegegyszer">
				</div>
				
			</div>
		</div>
		
						
		<div class="form-group">
		  <label for="ujEmail">Email:</label><br>
		  <input type="text" class="form-control w-100" id="ujEmail">
		</div>
		
		<div class="form-group">
		  <label for="ujBecenev">Becenév:</label><br>
		  <input type="text" class="form-control w-100" id="ujBecenev">
		</div>
	
		
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer text-center">
		  <input type="button" class="btn btn-danger" data-dismiss="modal" value="Mégse">
          <input type="button" class="btn btn-success" value="Hozzáadás" id="ujFelhasznaloHozzaad">
        </div>
        
      </div>
    </div>
  </div>


<div class="modal fade" id="modositandoBelepesiAdatok">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">A pultos bejelentkezési adatai</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body text-center">
		
		
		<div class="form-group">
		  <label for="modositandoFelhasznalonev">Felhasználónév:</label><br>
		  <input type="text" class="form-control w-100" id="modositandoFelhasznalonev">
		</div>
		

		
		<div class="row">
			<div class="col-sm-6">
			
				<div class="form-group">
				  <label for="modositandoJelszo">Jelszó:</label><br>
				  <input type="password" class="form-control w-100" id="modositandoJelszo">
				</div>
				
			</div>
			<div class="col-sm-6">

				
				<div class="form-group">
				  <label for="modositandoJelszoMegegyszer">Jelszó mégegyszer:</label><br>
				  <input type="password" class="form-control w-100" id="modositandoJelszoMegegyszer">
				</div>
				
			</div>
		</div>
		
						
		<div class="form-group">
		  <label for="modositandoEmail">Email:</label><br>
		  <input type="text" class="form-control w-100" id="modositandoEmail">
		</div>
		
		<div class="form-group">
				<label for="lakcim">Kártya azonosító:</label><br>
				<div class="row">
					<div class="col-sm-10">
						<input type="text" class="form-control w-100" id="modositandoKartya">
					</div>
					<div class="col-sm-2">
						<input type="button" class="btn btn-info w-100" id="modositandoKartyaOlvaso" value="📸">
					</div>
				</div>
		</div>
		
		<div class="form-group">
		  <label for="modositandoBecenev">Becenév:</label><br>
		  <input type="text" class="form-control w-100" id="modositandoBecenev">
		</div>
	
		
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer text-center">
		  <input type="button" class="btn btn-danger" data-dismiss="modal" value="Mégse">
          <input type="button" class="btn btn-success" value="Módosít" id="belepesiAdatokModositasa">
        </div>
        
      </div>
    </div>
  </div>


<div id="oldal">
	<div id="tartalom">
	
	
	<div id="felhasznaloDiv">
		<ul class="list-group" id="tartalomBlokk">
			<li class="list-group-item text-white" style="background-color:<?php beallitas_keres("hatterSzin") ?>">Alkalmazottak</li>
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
					
					
					<p>Új tag:<input type="button" class="btn btn-success w-100" value="+" data-toggle="modal" data-target="#ujAlkalmazottKartyaja"></p>

					
				</div>

				<div class="col-sm-6">
						<p>Kártyaolvasó:<input type="button" class="btn btn-info w-100" value="📸" data-toggle="modal" onclick="kartyaOlvaso()"></p>
				</div>

				
				<div class="col-sm-3">
				
				
					<p>Keresés: <input type="text" class="form-control w-100" id="kereso"></p>
 						
						  <label for="sel1">Keresés alapja:</label>
						  <select class="form-control w-100" id="keresesAlapja">
							<option value="kartya">Kártya</option>
							<option value="szemelyi">Személyi</option>
							<option value="telefonszam">Telefonszám</option>
						  </select>
<br>
<br>

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
	
</div>
</div>



</body>

<script>

var link = "<?php echo oldalCim("nev"); ?>";

</script>

<script src="../../kliens/qrOlvaso/html5-qrcode.min_.js"></script>
<script src="../../kliens/js/adminOldalValtas.js"></script>
<script src="../../kliens/js/oldalsoSav.js"></script>
<script src="../../kliens/js/kijelentkezes.js"></script>
<script src="index.js"></script>

<style>

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

</style>

</html>