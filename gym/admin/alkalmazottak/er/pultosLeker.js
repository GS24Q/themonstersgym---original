class pultos {
  constructor(id, felhasznalonev, jelszo, vezetekNev, keresztNev, utoNev, nem, telefonszam, email, orszag, varos, becenev, hibasBejelentkezesek, legutobbiProbalkozas) {
    this.id = id;
    this.felhasznalonev = felhasznalonev;
    this.jelszo = jelszo;
    this.vezetekNev = vezetekNev;
    this.keresztNev = keresztNev;
    this.utoNev = utoNev;
    this.nem = nem;
    this.telefonszam = telefonszam;
    this.email = email;
    this.orszag = orszag;
    this.varos = varos;
    this.becenev = becenev;
    this.hibasBejelentkezesek = hibasBejelentkezesek;
    this.legutobbiProbalkozas = legutobbiProbalkozas;
  }
}

var modositando = null;
var torlendo = null;

const pultosok = new pultos();
var pultosokSzama=0;

function pultosLekerdez(id){

	const xhr = new XMLHttpRequest();
	xhr.onload = function() {
		const valasz = JSON.parse(this.responseText);
			if(pultosok!=null){
				pultusokBeallit(valasz);
				//console.log(valasz);
			}else{
				alert("Üres");
			}
	 }
	xhr.open("GET", "../../../api/munkások/leker.php", true);
	xhr.send();

}

pultosLekerdez();

function pultusokBeallit(valasz){
	
	pultosok.length = 0;
	pultosokSzama=0;
	
	//console.log("----------------------------");
	for (let i = 0; i < valasz.length; i++) {
		pultosok[i]=valasz[i];
		//console.log("I:"+i+"A válasz:");
		//console.log(tranzakciok[i]);
		pultosokSzama++;
	}
	//console.log("----------------------------");

	
	pultosokKiir();
	
}

function megtekint(id){
	
	//modositando=felhasznalok[id].id;
	//alert(modositando);
	tranzakcioLekerdez(id);
	
}

function pultosokKiir(){



var mehet=true;

			console.log("---Csomagok---")
			for (let i = 0; i <	pultosokSzama; i++) {
				
				console.log(i+" rekord")
				console.log(pultosok[i]);
				//console.log(tranzakciok[i]);

			}
			console.log("---Csomagok---")


		if(mehet){

			var lista = document.getElementById("pultosTablazat");

			//document.querySelector("#felhasznaloDiv").style.display="none";
			//document.querySelector("#tranzakcioDiv").style.display="block";

			var ertek="";
			//var ertek = "<table class='table table-bordered'><thead><tr><th>Azonosító</th><th>Mit</th><th>Mikor</th><th>Mennyit</th><th>Művelet</th></tr></thead><tbody>";
			var ertek = "<thead><tr><th>#</th><th>Becenév</th><th>Műveletek</th></tr></thead><tbody>";
			
			for (let i = 0; i < pultosokSzama; i++) {
			
				
				
				//var index = parseInt(tranzakciok[i].mit);
				//var index = parseInt(tranzakciok[i].mit)-1;
				//console.log(index);
				//console.log(csomagok[index]);

				
				//ertek+="<tr><td>"+tranzakciok[i].id+"</td><td><td><td>"+tranzakciok[i].mikor+"</td><td>"+tranzakciok[i].mennyit+"</td><td><input type='button' class='btn btn-info' value='✏️' onclick='modosit("+i+")'><input type='button' class='btn btn-danger' value='❌' onclick='torol("+i+")'></td></tr>";
				
				
				
				ertek+="<tr><td>"+pultosok[i].id+"</td><td>"+pultosok[i].becenev+"</td><td><input type='button' class='btn btn-info' value='✏️' onclick='pultosModosit("+i+")'><input type='button' class='btn btn-danger' value='❌' onclick='pultosTorolMegerosit("+i+")'></td></tr>";
				//ertek+="<tr><td>"+pultosok[i].id+"</td><td>"+pultosok[i].becenev+"</td><td>"+tranzakciok[i].mikor+"</td><td>"+tranzakciok[i].mennyit+"</td><td><input type='button' class='btn btn-info' value='✏️' onclick='modosit("+i+")'><input type='button' class='btn btn-danger' value='❌' onclick='torol("+i+")'></td></tr>";
				
				
				
				
				//ertek+="<tr><td>"+tranzakciok[i].id+"</td><td>"+csomagok[index].nev+"</td><td>"+tranzakciok[i].mikor+"</td><td>"+tranzakciok[i].mennyit+"</td><td></td></tr>";
				
				
			}
			
			lista.innerHTML=ertek;
		
		}
		
}

//var pultosHozzaadGomb = document.querySelector("#pultosHozzaad");
//var pultosModositDiv = document.querySelector("#pultosModosit");

function pultosHozzaad(){
	alert("Hozzáad");
}

function pultosModositasa(id){
	
	var pultosModositVezetekNev = document.querySelector("#pultosModositVezetekNev");
	var pultosModositKeresztNev = document.querySelector("#pultosModositKeresztNev");
	var pultosModositUtoNev = document.querySelector("#pultosModositUtoNev");
	var pultosModositTelefonszam = document.querySelector("#pultosModositTelefonszam");
	var pultosModositEmail = document.querySelector("#pultosModositEmail");
	var pultosModositOrszag = document.querySelector("#pultosModositOrszag");
	var pultosModositVaros = document.querySelector("#pultosModositVaros");
	
	
	const adatok = {
		mit: modositando,
		vezetekNev: pultosModositVezetekNev.value,
		keresztNev: pultosModositKeresztNev.value,
		utoNev: pultosModositUtoNev.value,
		telefonszam: pultosModositTelefonszam.value,
		email: pultosModositEmail.value,
		orszag: pultosModositOrszag.value,
		varos: pultosModositVaros.value
		//becenev: leiras.value,
	};
	
	const kuldendo = JSON.stringify(adatok);
	
	
	
	let xhr = new XMLHttpRequest();
	xhr.open("POST", "../../api/munkások/modosit.php", true);
	xhr.setRequestHeader('Content-Type', 'application/json');
	xhr.onload = ()=>{
		if(xhr.readyState === XMLHttpRequest.DONE){
			if(xhr.status === 201){
				//let data = xhr.response;
				
				//const valasz = JSON.parse(data);
				//console.log(valasz);
				//var eredmeny =valasz.valasz;
				//let data = xhr.response;
				//alert("Valami hibás");
				//console.log(data);
				//$('#ujtranzakcio').modal('hide');
				//csomagok = [];
				//csomagok = new Csomag();
				//nullaz();
				//valaszCim.innerHTML="Minden sikerült";
				//valaszSzoveg.innerHTML="Sikeres hozzáadás";
				//$('#valasz').modal('show');
				//frissit();
				alert("Minden sikerült");

				
			}else{
				//let data = xhr.response;
				//const valasz = JSON.parse(data)
				alert("Valami hibás");
				//$('#ujtranzakcio').modal('hide');
				//valaszCim.innerHTML="Valami nem sikerült";
				//valaszSzoveg.innerHTML=valasz.valasz;
				//$('#valasz').modal('show');
				//console.log(data);
			}
	  }
	}
	//let formData = new FormData(bejelentkezes_form);
	xhr.send(kuldendo);
	
	
	
	
	
	
	
	
	
	

}

function pultosModosit(bejovoId){
	
	
	
	var id=bejovoId;
	modositando=pultosok[id].id;
	
	console.log(id);
	console.log(pultosok[id]);
	
	var pultosModositVezetekNev = document.querySelector("#pultosModositVezetekNev");
	var pultosModositKeresztNev = document.querySelector("#pultosModositKeresztNev");
	var pultosModositUtoNev = document.querySelector("#pultosModositUtoNev");
	var pultosModositTelefonszam = document.querySelector("#pultosModositTelefonszam");
	var pultosModositEmail = document.querySelector("#pultosModositEmail");
	var pultosModositOrszag = document.querySelector("#pultosModositOrszag");
	var pultosModositVaros = document.querySelector("#pultosModositVaros");
	
	//try {
	  //adddlert("Welcome guest!");
	  pultosModositVezetekNev.value="";
	  pultosModositKeresztNev.value="";
	  pultosModositUtoNev.value="";
	  pultosModositTelefonszam.value="";
	  pultosModositEmail.value="";
	  pultosModositOrszag.value="";
	  pultosModositVaros.value="";
	  
	  pultosModositVezetekNev.value=pultosok[id].vezetekNev;
	  pultosModositKeresztNev.value=pultosok[id].keresztNev;
	  pultosModositUtoNev.value=pultosok[id].utoNev;
	  pultosModositTelefonszam.value=pultosok[id].telefonszam;
	  pultosModositEmail.value=pultosok[id].email;
	  pultosModositOrszag.value=pultosok[id].orszag;
	  //pultosModositVaros.innerHTML=pultosok[id].varos
	  pultosModositVaros.value="xd";
	  $('#pultosModosit').modal('show');

	  
	  
	/*}
	catch(err) {
	  alert(err.message);
	}*/
	
	//alert("Módosít");
	//pultosModositű
	//console.log(pultosok[id])
	
	//$('#pultosModosit').modal('show');
}

function pultosTorolMegerosit(bejovoId){
	//alert("Töröl");
	
	var id=bejovoId;
	
	torlendo=pultosok[id].id; //adatbázis id
	
	var pultosTorlesDiv = document.querySelector("#pultosTorles");
	var pultosTorlesDivSzoveg = document.querySelector("#pultosTorlesSzoveg");
	pultosTorlesDivSzoveg.innerHTML="Biztosan törölni szeretnéd? ("+pultosok[id].becenev+")";
	$('#pultosTorles').modal('show');
	
}

