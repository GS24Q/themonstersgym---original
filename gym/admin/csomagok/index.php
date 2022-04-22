<?php


include_once("../../szerver/oldalCim.php");

include_once("../../szerver/beallitasok.php");


session_start();
$belepve = $_SESSION["monstersgymadminid"];

if(!isset($belepve)){
	
	header('Location: ./bejelentkezes.php');
	
}





?>

<html>

<head>
	<meta charset="UTF-8">
	<title><?php beallitas_keres("nev") ?> - Csomagok</title>
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


<div id="oldalso-sav" style="background-color:<?php beallitas_keres("hatterSzin") ?>;">

	<?php include_once("../../szerver/adminOldalsoSav.php") ?>


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
          
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Bezárás</button>
        </div>
        
      </div>
    </div>
  </div>




		 <!-- The Modal -->
  <div class="modal fade" id="csomagmodositasa">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Csomag módosítása</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body text-center">
		
		<div class="form-group">
		  <label for="modositandoNev">Név:</label><br>
		  <input type="text" class="form-control w-100" id="modositandoNev">
		</div>
		
		<div class="form-group">
		  <label for="modositandoAr">Ár:</label><br>
		  <input type="number" class="szam" id="modositandoAr">
		</div>
		
		<div class="form-group">
		  <label for="modositandoLeiras">Leírás:</label><br>
		  <input type="text" class="form-control w-100" id="modositandoLeiras">
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
  <div class="modal fade" id="csomagtorlese">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="valaszCim">Csomag törlése</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" id="torlesSzoveg">
          
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
		  <input type="button" class="btn btn-success" data-dismiss="modal" value="Mégse">
          <button type="button" class="btn btn-danger" id="torlesGomb">Törlés</button>
        </div>
        
      </div>
    </div>
  </div>


		 <!-- The Modal -->
  <div class="modal fade" id="ujcsomag">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Új csomag hozzáadása</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body text-center">
		
		<div class="form-group">
		  <label for="nev">Név:</label><br>
		  <input type="text" class="form-control w-100" id="ujNev">
		</div>
		
		<div class="form-group">
		  <label for="ar">Ár:</label><br>
		  <input type="number" class="szam" id="ujAr">
		</div>
		
		<div class="form-group">
		  <label for="leiras">Leírás:</label><br>
		  <input type="text" class="form-control w-100" id="ujLeiras">
		</div>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer text-center">
		  <input type="button" class="btn btn-danger" data-dismiss="modal" value="Mégse">
          <input type="button" class="btn btn-success" value="Hozzáadás" id="ujMentes">
        </div>
        
      </div>
    </div>
  </div>
	
	
<div id="oldal">
	<div id="tartalom">
	<ul class="list-group" id="tartalomBlokk">
		<li class="list-group-item text-white" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">Csomag lista</li>
		<li class="list-group-item">

		<!--
		Csomag lista
		!-->
		<div class="row pl-3">
			
		</div><br>
		
		<div class="row">
		
			
			<div class="col-sm-3">
				<p>Mutass <select id="csomaglista" class="form-control w-100 text-center">
				
				  <option value="osszes">Összes</option>
				  <option value="5">5</option>
				  <option value="10">10</option>
				  <option value="20">20</option>
				  <option value="50">50</option>

				
				</select></p>
			</div>

			<div class="col-sm-2"></div>

			
			<div class="col-sm-2"><br>
			</div>
			
			
			<div class="col-sm-2">
			</div>
			

			
			<div class="col-sm-3">
				<p>Keresés: <input type="text" id="csomagKereso" class="form-control w-100 text-center" placeholder="Csomag neve"></p>
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



</body>

<script src="../../kliens/js/kijelentkezes.js"></script>
<script src="../../kliens/js/adminOldalValtas.js"></script>
<script src="../../kliens/js/oldalsoSav.js"></script>

<script src="index.js"></script>

<style>

html,body{
	background-color:black;
}

#oldal{
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



<script>

var link = "<?php echo oldalCim("nev"); ?>";

</script>



</html>