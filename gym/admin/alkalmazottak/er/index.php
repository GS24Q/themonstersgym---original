


<?php
//error_reporting(0);


include_once("../../szerver/beallitasok.php");


session_start();
$belepve = $_SESSION["monstersgymadminid"];

if(!isset($belepve)){
	
	header('Location: ./bejelentkezes.php');
	
}





?>








<html>

<head>
<title></title>
  <meta charset="utf-8">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="viewport-fit=cover, user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
<meta name="mobile-web-app-capable" content="yes">
<!--link rel="icon" type="image/png" href="./ikon.png"/!-->

<meta name="theme-color" content="#000000" />
<meta name="msapplication-navbutton-color" content="#000000">
<meta name="apple-mobile-web-app-status-bar-style" content="#000000">


  <link rel="stylesheet" href="../../kliens/css/oldalsoSav.css">


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<div id="navigacio" style="background-color:<?php beallitas_keres("hatterSzin"); ?>;">
  <img id="menuNyito" src="../../media/ikonok/menu_f.png" height="30px">	
		<div id="cimResz"><?php beallitas_keres("nev") ?></div>
        <a class="nav-link" href="../kijelentkezes.php"><img src="../../media/ikonok/kijelentkezes_f.png" height="30px"></a>

</div>


	<div id="oldalso-sav" style="background-color:<?php beallitas_keres("hatterSzin") ?>;">

		<?php include_once("../../szerver/adminOldalsoSav.php") ?>


	</div>

<div class="container text-center">





<div class="modal fade" id="pultosModosit">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Pultos m??dos??t??sa</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
		
		
		
		
			<div class="row text-center">


				<div class="col-md-6">
				
					<div class="form-group">
						<label for="email">Vezet??kn??v</label>
						<input type="text" id="pultosModositVezetekNev" class="form-control" placeholder="Vezet??kn??v">
					</div>
				
				</div>
				<div class="col-md-6">
				
					<div class="form-group">
						<label for="pwd">Keresztn??v</label>
						<input type="text" id="pultosModositKeresztNev" class="form-control" placeholder="Keresztn??v">
					</div>
				
				</div>
				<div class="col-md-12">
				
					<div class="form-group">
						<label for="pwd">Ut??n??v</label>
						<input type="text" id="pultosModositUtoNev" class="form-control" placeholder="Ut??n??v">
					</div>
				
				</div>			
				<div class="col-md-12">
				
					<div class="form-group">
						<label for="pwd">Telefonsz??m</label>
						<input type="number" id="pultosModositTelefonszam" class="form-control" placeholder="Telefonsz??m">
					</div>
				
				</div>
				<div class="col-md-12">
				
					<div class="form-group">
						<label for="pwd">Email</label>
						<input type="email" id="pultosModositEmail" class="form-control" placeholder="Email">
					</div>
				
				</div>
				<div class="col-md-12">

					<div class="form-group">
						<label for="pwd">Orsz??g</label>
						<input type="text" id="pultosModositOrszag" class="form-control" placeholder="Orsz??g">
					</div>
				
				
				
				</div>
				
				<div class="col-md-12">
				
	
					<div class="form-group">
						<label for="varos">V??ros</label>
						<input type="text" id="pultosModositVaros" class="form-control" placeholder="V??ros">
					</div>
				
				</div>
			
			</div>
		
		
		
		
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="button" class="btn btn-primary" onclick="pultosModositasa()" value="M??dos??t">
        </div>
        
      </div>
    </div>
  </div>



<div class="modal fade" id="pultosTorles">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Meger??s??t??s</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body" id="pultosTorlesSzoveg">
		
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <input type="button" class="btn btn-danger" data-dismiss="modal" value="M??gse">
        <input type="button" class="btn btn-danger" value="T??r??l">
      </div>
      
    </div>
  </div>
</div>
  
  
<!-- The Modal uj pultos -->
<div class="modal fade" id="ujpultos">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h1 class="modal-title">??j pultos</h1>
          <button type="button" class="close" data-dismiss="modal">??</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
		<div class="row text-center">


			<div class="col-md-6">
			
				<div class="form-group">
					<label for="email">Vezet??kn??v</label>
					<input type="text" class="form-control" placeholder="Vezet??kn??v">
				</div>
			
			</div>
			<div class="col-md-6">
			
				<div class="form-group">
					<label for="pwd">Keresztn??v</label>
					<input type="text" class="form-control" placeholder="Keresztn??v">
				</div>
			
			</div>
			<div class="col-md-12">
			
				<div class="form-group">
					<label for="pwd">Ut??n??v</label>
					<input type="text" class="form-control" placeholder="Ut??n??v">
				</div>
			
			</div>			
			<div class="col-md-12">
			
				<div class="form-group">
					<label for="pwd">Telefonsz??m</label>
					<input type="number" class="form-control" placeholder="Telefonsz??m">
				</div>
			
			</div>
			<div class="col-md-12">
			
				<div class="form-group">
					<label for="pwd">Email</label>
					<input type="email" class="form-control" placeholder="Email">
				</div>
			
			</div>
			<div class="col-md-12">
			
			<label for="orszag">Orsz??g</label>
			  <select name="orszag" class="custom-select">
				<option value="magyarorszag">Magyarorsz??g</option>
			  </select>
			
			</div>
			
			<div class="col-md-12">
			

				<div class="form-group">
					<label for="varos">V??ros</label>
					<input type="text" class="form-control" placeholder="V??ros">
				</div>
			
			</div>
			
		</div>


		  
		  
		  
		  
		  
          </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="button" class="btn btn-success" id="pultosHozzaad" value="Hozz??ad" onclick="pultosHozzaad()">
        </div>
        
      </div>
    </div>
  </div>



<h2>A jelenlegi munk??sok</h2>

<hr>
<br>

<div class="row">

	<div class="col-md-12">

<div id="accordion">
  <div class="card">
    <div class="card-header bg-dark text-white">
      <a class="collapsed card-link" data-toggle="collapse" href="#collapseOne">
        Pultosok
      </a>
	  		<button type="button" class="btn btn-success hozzaad" data-toggle="modal" data-target="#ujpultos">
			+
		</button>
    </div>
    <div id="collapseOne" class="collapse" data-parent="#accordion">
      <div class="card-body">
        
		
		<div class="table-responsive">
    <table class="table table-bordered" id="pultosTablazat">
      <thead>
        <tr>
          <th>#</th>
          <th>Becen??v</th>
          <th>M??veletek</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Anna</td>
          <td><input type="button" class="btn btn-info" value="??????"><input type="button" class="btn btn-danger" value="???"></td>
        </tr>
      </tbody>
    </table>
  </div>
		
		
      </div>
    </div>
  </div>
</div>


</div>


</div>

<br>
<hr>



</div>


</body>

<style>

.container a{
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

</style>

<script src="index.js"></script>
<script src="pultosLeker.js"></script>
<script src="../../kliens/js/oldalsoSav.js"></script>


</html>