var kapottErtek = "";


var hova = "";


function olvasasUtan(){
	$('#kartyaOlvaso').modal('hide');
	
	switch (hova) {
	  case "ujAlkalmazottKartyaja":
	    ujKartya.value = kapottErtek;
			setTimeout(function(){
				ujKartyaMentes.disabled=false;
				$('#ujAlkalmazottKartyaja').modal('show');
			}, 500)
		break;	  
		case "modositandoBelepesiAdatok":
	    modositandoKartya.value = kapottErtek;
			setTimeout(function(){
				$('#modositandoBelepesiAdatok').modal('show');
			}, 500)
		break;
		
		case "torlendoAblak":
	    torlendoAblakJelszo.value = kapottErtek;
			setTimeout(function(){
				$('#torlendoAblak').modal('show');
			}, 500)
		break;
		
		
		case "":
		  keresesAlapja.value = "kartya";
		  kereso.value=kapottErtek;
		  csomaglista.value="osszes";
			csomaglista.disabled=true;
		  kiir();
		  beolvasottProfilBeallit(kapottErtek);

			//alert();
		break;
	}
	hova="";
	
}





function sikeresBeolvasas(beolvasottKod) {

	$("#olvasasLeallitasa").click()
	//hova="";
	//$('#kartyaOlvaso').modal('hide');
	kapottErtek=beolvasottKod;
	setTimeout(function () {
		olvasasUtan();
    }, 200)
	
}
function sikertelenBeolvasas(hiba) {
  //handle scan error
}
let html5QrcodeScanner = new Html5QrcodeScanner(
    "olvaso", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(sikeresBeolvasas, sikertelenBeolvasas);




function kartyaOlvaso(){
		$('#kartyaOlvaso').modal({ //bug fix
			backdrop: 'static',
			keyboard: false
		})
}

function kartyaOlvasoBezarasa(){
	$('#kartyaOlvaso').modal('hide');
}


var kartyaOlvasoBezar = document.querySelector("#kartyaOlvasoBezar");


kartyaOlvasoBezar.onclick = () => {
	hova="";
    kartyaOlvasoBezarasa();
}


var ujKartyaOlvaso = document.querySelector("#ujKartyaOlvaso");


ujKartyaOlvaso.onclick = ()=>{
	//$("#olvasasLeallitasa").click()
	hova = "ujAlkalmazottKartyaja";
	$('#ujAlkalmazottKartyaja').modal('hide');
	setTimeout(function(){
		$('#kartyaOlvaso').modal('show');
	}, 500)
}



var ujKartya = document.querySelector("#ujKartya");
ujKartya.addEventListener('input', (event) => {
	
	if(ujKartya.value!=""){
		ujKartyaMentes.disabled=false;
	}else{
		ujKartyaMentes.disabled=true;
	}
	
})

var ujKartyaMentGomb=document.querySelector("#ujKartyaMentes");

ujKartyaMentGomb.onclick = ()=>{
					
	$('#ujAlkalmazottKartyaja').modal('hide');
	setTimeout(function(){
		$('#ujpultosadatokresz').modal('show');
	}, 500)

}


var torlendoKartyaOlvaso = document.querySelector("#torlendoKartyaOlvaso");



torlendoKartyaOlvaso.onclick = ()=>{

	hova = "torlendoAblak";
	$('#torlendoAblak').modal('hide');
	setTimeout(function(){
		$('#kartyaOlvaso').modal('show');
	}, 500)
	
}







var modositandoKartyaOlvaso = document.querySelector("#modositandoKartyaOlvaso");


modositandoKartyaOlvaso.onclick = ()=>{
	//$("#olvasasLeallitasa").click()
	hova = "modositandoBelepesiAdatok";
	$('#modositandoBelepesiAdatok').modal('hide');
	setTimeout(function(){
		$('#kartyaOlvaso').modal('show');
	}, 500)
}






class pultos {
  constructor(id, felhasznalonev, vezetekNev, keresztNev, utoNev, becenev, nem, szuletesiDatum, szemelyiId, telefonszam, lakcim, regisztracioDatum, hanyszorVoltNalunk, email, kartya) {
    this.id = id;
    this.felhasznalonev = felhasznalonev;
    this.vezetekNev = vezetekNev;
    this.keresztNev = keresztNev;
    this.utoNev = utoNev;
    this.becenev = becenev;
    this.nem = nem;
    this.szuletesiDatum = szuletesiDatum;
    this.szemelyiId = szemelyiId;
    this.telefonszam = telefonszam;
    this.lakcim = lakcim;
    this.regisztracioDatum = regisztracioDatum;
    this.hanyszorVoltNalunk = hanyszorVoltNalunk;
    this.email = email;
    this.kartya = kartya;
  }
}


var valaszSzoveg=document.querySelector("#valaszSzoveg");

const pultosok = new pultos();
var pultosokszama=0;

function lekerdez(){

	const xhr = new XMLHttpRequest();
	xhr.onload = function() {
		const valasz = JSON.parse(this.responseText);
		beallit(valasz);
	 }
	xhr.open("GET", link+"api/alkalmazottak/leker.php", true);
	xhr.send();

}

lekerdez();

var seged=0;

function beallit(valasz){
	
	pultosok.length=0;
	pultosokszama=0;
	
	for (let i = 0; i < valasz.length; i++) {
		pultosok[i]=valasz[i];
		console.log(pultosok[i]);
		pultosokszama++;
	}
	kiir();
	
}


var legutobbiCsomagListaAllapot="osszes";

var ujFelhasznaloTovabb = document.querySelector('#ujFelhasznaloTovabb');

ujFelhasznaloTovabb.addEventListener('click', (event) => {
	//alert("");
	$('#ujpultosadatokresz').modal('hide');

	setTimeout(function(){
		$('#ujpultosbelepesiresz').modal('show');
	}, 500)
	

	
});

var csomaglista = document.querySelector('#csomaglista');
	
csomaglista.addEventListener('change', (event) => {
	legutobbiCsomagListaAllapot=csomaglista.value;
  kiir();
});

var kereso = document.querySelector('#kereso');

kereso.addEventListener('input', (event) => {
  if(kereso.value!=""){
	  csomaglista.value="osszes";
	  csomaglista.disabled=true;
  }else{
	  csomaglista.value=legutobbiCsomagListaAllapot;
	  csomaglista.disabled=false;
  }
  kiir();
  
});

var keresesAlapja = document.querySelector('#keresesAlapja');

keresesAlapja.addEventListener('change', (event) => {
	//alert(keresesAlapja.value);
	kiir();
});

function kiir(){
	var tablazat = document.getElementById("tablazat");
	var kereso = document.getElementById("kereso");
	var csomaglista = document.getElementById("csomaglista");
	//alert(csomaglista.value);
	var ertek="";
	
	
	//var ertek = "<table class='table table-bordered'><thead><tr><th>Azonosító</th><th>Vezetéknév</th><th>Keresztnév</th><th>Utónév</th><th>Nem</th><th>Születésidátum</th><th>Személyi</th><th>Telefonszám</th><th>Lakcím</th><th>Regisztrációs dátum</th><th>Művelet</th></tr></thead><tbody>";
	//var ertek = "<table class='table table-bordered'><thead><tr><th>Kártya</th><th>Vezetéknév</th><th>Keresztnév</th><th>Utónév</th><th>Nem</th><th>Születésidátum</th><th>Személyi</th><th>Telefonszám</th><th>Lakcím</th><th>Regisztrációs dátum</th><th>Művelet</th></tr></thead><tbody>";
	var ertek = "<table class='table table-bordered'><thead><tr><th>Kezel</th><th>Vezetéknév</th><th>Keresztnév</th><th>Utónév</th><th>Nem</th><th>Születésidátum</th><th>Személyi</th><th>Telefonszám</th><th>Lakcím</th><th>Regisztrációs dátum</th><th>Egyéb műveletek</th></tr></thead><tbody>";
	
	
	if(kereso.value==""){
	
		if(csomaglista.value!="osszes"){
			for (let i = 0; i < pultosokszama && i <= csomaglista.value-1; i++) {
				ertek+="<tr><td><input type='button' class='btn btn-primary' value='🔐' onclick='belepesModosit("+i+")'></td><td>"+pultosok[i].vezetekNev+"</td><td>"+pultosok[i].keresztNev+"</td><td>"+pultosok[i].utoNev+"</td><td>"+pultosok[i].nem+"</td><td>"+pultosok[i].szuletesiDatum+"</td><td>"+pultosok[i].szemelyiId+"</td><td>"+pultosok[i].telefonszam+"</td><td>"+pultosok[i].lakcim+"</td><td>"+pultosok[i].regisztracioDatum+"</td><td class='d-flex'><input type='button' class='btn btn-info' value='✏️' onclick='modosit("+i+")'><input type='button' onclick='torlendo("+i+")' class='btn btn-danger' value='❌'></td></tr>";
				//console.log("xd");
			}
			ertek+="</tbody></table>";
			tablazat.innerHTML=ertek;

		}else{
			for (let i = 0; i < pultosokszama; i++) {
				ertek+="<tr><td><input type='button' class='btn btn-primary' value='🔐' onclick='belepesModosit("+i+")'></td><td>"+pultosok[i].vezetekNev+"</td><td>"+pultosok[i].keresztNev+"</td><td>"+pultosok[i].utoNev+"</td><td>"+pultosok[i].nem+"</td><td>"+pultosok[i].szuletesiDatum+"</td><td>"+pultosok[i].szemelyiId+"</td><td>"+pultosok[i].telefonszam+"</td><td>"+pultosok[i].lakcim+"</td><td>"+pultosok[i].regisztracioDatum+"</td><td class='d-flex'><input type='button' class='btn btn-info' value='✏️' onclick='modosit("+i+")'><input type='button' onclick='torlendo("+i+")' class='btn btn-danger' value='❌'></td></tr>";
				//console.log("xd");
			}
			ertek+="</tbody></table>";
			tablazat.innerHTML=ertek;
		}
	
	}else{ //HA VAN VALAMI A KEREŐSBEN
		
		
		switch(keresesAlapja.value) {
			case "kartya":
				for (let i = 0; i < pultosokszama; i++) {
					if(pultosok[i].kartya.includes(kereso.value)){
						ertek+="<tr><td><input type='button' class='btn btn-primary' value='🔐' onclick='belepesModosit("+i+")'></td><td>"+pultosok[i].vezetekNev+"</td><td>"+pultosok[i].keresztNev+"</td><td>"+pultosok[i].utoNev+"</td><td>"+pultosok[i].nem+"</td><td>"+pultosok[i].szuletesiDatum+"</td><td>"+pultosok[i].szemelyiId+"</td><td>"+pultosok[i].telefonszam+"</td><td>"+pultosok[i].lakcim+"</td><td>"+pultosok[i].regisztracioDatum+"</td><td class='d-flex'><input type='button' class='btn btn-info' value='✏️' onclick='modosit("+i+")'><input type='button' onclick='torlendo("+i+")' class='btn btn-danger' value='❌'></td></tr>";
					}
					//console.log("xd");
				}
				ertek+="</tbody></table>";
				tablazat.innerHTML=ertek;
			break;
		  case "szemelyi":




		for (let i = 0; i < pultosokszama; i++) {
			if(pultosok[i].szemelyiId.includes(kereso.value)){
				ertek+="<tr><td><input type='button' class='btn btn-primary' value='🔐' onclick='belepesModosit("+i+")'></td><td>"+pultosok[i].vezetekNev+"</td><td>"+pultosok[i].keresztNev+"</td><td>"+pultosok[i].utoNev+"</td><td>"+pultosok[i].nem+"</td><td>"+pultosok[i].szuletesiDatum+"</td><td>"+pultosok[i].szemelyiId+"</td><td>"+pultosok[i].telefonszam+"</td><td>"+pultosok[i].lakcim+"</td><td>"+pultosok[i].regisztracioDatum+"</td><td class='d-flex'><input type='button' class='btn btn-info' value='✏️' onclick='modosit("+i+")'><input type='button' onclick='torlendo("+i+")' class='btn btn-danger' value='❌'></td></tr>";
			}
			//console.log("xd");
		}
		ertek+="</tbody></table>";
		tablazat.innerHTML=ertek;



			break;
		  case "telefonszam":



		for (let i = 0; i < pultosokszama; i++) {
			if(pultosok[i].telefonszam.includes(kereso.value)){
				ertek+="<tr><td><input type='button' class='btn btn-primary' value='🔐' onclick='belepesModosit("+i+")'></td><td>"+pultosok[i].vezetekNev+"</td><td>"+pultosok[i].keresztNev+"</td><td>"+pultosok[i].utoNev+"</td><td>"+pultosok[i].nem+"</td><td>"+pultosok[i].szuletesiDatum+"</td><td>"+pultosok[i].szemelyiId+"</td><td>"+pultosok[i].telefonszam+"</td><td>"+pultosok[i].lakcim+"</td><td>"+pultosok[i].regisztracioDatum+"</td><td class='d-flex'><input type='button' class='btn btn-info' value='✏️' onclick='modosit("+i+")'><input type='button' onclick='torlendo("+i+")' class='btn btn-danger' value='❌'></td></tr>";
			}
			//console.log("xd");
		}
		ertek+="</tbody></table>";
		tablazat.innerHTML=ertek;



			break;
		  default:
			// code block
		}
		
		

		
	}
	
	
}



function frissit(){
	pultosokszama=0;
	lekerdez();
}



var modositando=-1;





function belepesModosit(azon){
	
	
	modositando=pultosok[azon].id;
	
	var modositandoFelhasznalonev = document.querySelector("#modositandoFelhasznalonev");
	var modositandoEmail = document.querySelector("#modositandoEmail");
	var modositandoBecenev = document.querySelector("#modositandoBecenev");
	
	modositandoFelhasznalonev.value=pultosok[azon].felhasznalonev;
	modositandoEmail.value=pultosok[azon].email;
	modositandoBecenev.value=pultosok[azon].becenev;
	modositandoKartya.value=pultosok[azon].kartya;
	
	$('#modositandoBelepesiAdatok').modal('show');
	
	
}




var belepesiAdatokModositasa=document.querySelector("#belepesiAdatokModositasa");

belepesiAdatokModositasa.onclick = ()=>{

var modositandoFelhasznalonev = document.querySelector("#modositandoFelhasznalonev");
var	modositandoJelszo = document.querySelector("#modositandoJelszo");
var	modositandoJelszoMegegyszer= document.querySelector("#modositandoJelszoMegegyszer");
var	modositandoEmail= document.querySelector("#modositandoEmail");
var	modositandoBecenev= document.querySelector("#modositandoBecenev");

const adatok = {
	id: modositando,
	modositandoFelhasznalonev: modositandoFelhasznalonev.value,
	modositandoJelszo: modositandoJelszo.value,
	modositandoJelszoMegegyszer: modositandoJelszoMegegyszer.value,
	modositandoEmail: modositandoEmail.value,
	modositandoBecenev: modositandoBecenev.value,
	modositandoKartya: modositandoKartya.value
};

const kuldendo = JSON.stringify(adatok);

		let xhr = new XMLHttpRequest();
		xhr.open("POST", link+"api/alkalmazottak/belepesiAdatokModositasa.php", true);
		xhr.setRequestHeader('Content-Type', 'application/json');
		xhr.onload = ()=>{
			if(xhr.readyState === XMLHttpRequest.DONE){
				if(xhr.status === 201){
					$('#modositandoBelepesiAdatok').modal('hide');
					valaszCim.innerHTML="Minden sikerült";
					valaszSzoveg.innerHTML="Sikeres felhasználó módosítás";
					setTimeout(function(){
						$('#valasz').modal('show');
						frissit();
					}, 500)
				}else{
					let data = xhr.response;
					$('#modositandoBelepesiAdatok').modal('hide');
					valaszCim.innerHTML="Valami nem sikerült";
					valaszSzoveg.innerHTML="Sikertelen felhasználó módosítás<br>"+data;
					console.log(data);
					setTimeout(function(){
						$('#valasz').modal('show');
					}, 500)
				}
			}
		}
		//let formData = new FormData(bejelentkezes_form);
		xhr.send(kuldendo);

}


function modosit(azon){
	
	//alert(azon);
	modositando=pultosok[azon].id;
	var modositandoVezetekNev = document.querySelector("#modositandoVezetekNev");
	var	modositandoKeresztNev = document.querySelector("#modositandoKeresztNev");
	var	modositandoUtoNev= document.querySelector("#modositandoUtoNev");
	var	modositandoBeceNev= document.querySelector("#modositandoBeceNev");
	var	modositandoNeme= document.querySelector("#modositandoNeme");
	var	modositandoSzuletesiDatum= document.querySelector("#modositandoSzuletesiDatum");
	var	modositandoSzemelyiId= document.querySelector("#modositandoSzemelyiId");
	var	modositandoTelefonszam= document.querySelector("#modositandoTelefonszam");
	var	modositandoLakcim= document.querySelector("#modositandoLakcim");
	
	modositandoVezetekNev.value=pultosok[azon].vezetekNev;
	modositandoKeresztNev.value=pultosok[azon].keresztNev;
	modositandoUtoNev.value=pultosok[azon].utoNev;
	modositandoBeceNev.value=pultosok[azon].becenev;
	modositandoNeme.value=pultosok[azon].nem;
	modositandoSzuletesiDatum.value=pultosok[azon].szuletesiDatum;
	modositandoSzemelyiId.value=pultosok[azon].szemelyiId;
	modositandoTelefonszam.value=pultosok[azon].telefonszam;
	modositandoLakcim.value=pultosok[azon].lakcim;
	
	$('#modositandoFelhasznalo').modal('show');
	
}




var torlendoAblakCim = document.querySelector("#torlendoAblakCim");


var torlendoFelhasznaloId=-1;
var torlendoFelhasznaloAzon=-1;

function torlendo(azon){
	//alert(azon);
	//alert(pultosok[azon].id);
	torlendoFelhasznaloAzon=azon;
	torlendoFelhasznaloId=pultosok[azon].id;
	torlendoAblakCim.innerHTML=pultosok[azon].vezetekNev+" "+pultosok[azon].keresztNev+" törlése";
	
	$('#torlendoAblak').modal('show');

	
}




var torlendoAblakEllenorizGomb=document.querySelector("#torlendoAblakEllenorizGomb");

torlendoAblakEllenorizGomb.onclick = ()=>{
	if(torlendoFelhasznaloId!=-1 && torlendoFelhasznaloAzon!=-1){
		//torol()
		magasabbRanguEngedely()
		//alert(pultosok[torlendoFelhasznaloAzon].vezetekNev);
	}
}


function magasabbRanguEngedely(){
	var valaszSzoveg=document.querySelector("#valaszSzoveg");
	var jelszo = document.querySelector("#torlendoAblakJelszo");

	const adatok = {
		kartya: jelszo.value
	};
	
		const kuldendo = JSON.stringify(adatok);
		let xhr = new XMLHttpRequest();
		xhr.open("POST", link+"api/ellenorzes/magasabbRanguEngedely.php", true);
		xhr.setRequestHeader('Content-Type', 'application/json');
		xhr.onload = ()=>{
			if(xhr.readyState === XMLHttpRequest.DONE){
				if(xhr.status === 202){
					//$('#csomagmodositasa').modal('hide');
					var megerosit = confirm("Tuti?");
					if(megerosit){
						
						$('#torlendoAblak').modal('hide');
						torol(torlendoFelhasznaloId);
						//alert(pultosok[torlendoFelhasznaloAzon].vezetekNev+" "+pultosok[torlendoFelhasznaloAzon].keresztNev);
					}else{
						$('#torlendoAblak').modal('hide');
						$('#valasz').modal('hide');
					}
					/*$('#torlendoAblak').modal('hide');
					valaszCim.innerHTML="Minden sikerült";
					valaszSzoveg.innerHTML="Sikeres törlés";
					$('#valasz').modal('show');*/
					//frissit();
					//alert("Siker");
				}else{
					//let data = xhr.response;
					//$('#csomagmodositasa').modal('hide');
					//valaszCim.innerHTML="Valami nem sikerült";
					//valaszSzoveg.innerHTML="Sikertelen törlés<br>"+data;
					//$('#valasz').modal('show');
					//alert("Nem jó valami "+data);
					$('#torlendoAblak').modal('hide');
					torlendoAblakJelszo.style.border="1px solid red";
					valaszCim.innerHTML="Valami nem sikerült";
					valaszSzoveg.innerHTML="Azonosítás sikertelen";
					setTimeout(function(){
						$('#valasz').modal('show');
					}, 500)
					

				}
			}
		}
		xhr.send(kuldendo);
}





function torol(azon){
	
const adatok = {
	id: azon
};
	
const kuldendo = JSON.stringify(adatok);
		let xhr = new XMLHttpRequest();
		xhr.open("POST", link+"api/alkalmazottak/torol.php", true);
		xhr.setRequestHeader('Content-Type', 'application/json');
		xhr.onload = ()=>{
			if(xhr.readyState === XMLHttpRequest.DONE){
				if(xhr.status === 201){
					valaszCim.innerHTML="Minden sikerült";
					valaszSzoveg.innerHTML="Sikeres törlés";
					setTimeout(function(){
						$('#valasz').modal('show');
						frissit();
					}, 500)
				}else{
					let data = xhr.response;
					valaszCim.innerHTML="Valami nem sikerült";
					valaszSzoveg.innerHTML="Sikertelen törlés<br>"+data;
					setTimeout(function(){
						$('#valasz').modal('show');
						frissit();
					}, 500)
				}
			}
		}
		xhr.send(kuldendo);
}





var modositMent=document.querySelector("#modositMentes");

modositMent.onclick = ()=>{

var modositandoVezetekNev = document.querySelector("#modositandoVezetekNev");
var	modositandoKeresztNev = document.querySelector("#modositandoKeresztNev");
var	modositandoUtoNev= document.querySelector("#modositandoUtoNev");
var	modositandoNeme= document.querySelector("#modositandoNeme");
var	modositandoSzuletesiDatum= document.querySelector("#modositandoSzuletesiDatum");
var	modositandoSzemelyiId= document.querySelector("#modositandoSzemelyiId");
var	modositandoTelefonszam= document.querySelector("#modositandoTelefonszam");
var	modositandoLakcim= document.querySelector("#modositandoLakcim");

const adatok = {
	id: modositando,
	modositandoVezetekNev: modositandoVezetekNev.value,
	modositandoKeresztNev: modositandoKeresztNev.value,
	modositandoUtoNev: modositandoUtoNev.value,
	modositandoNeme: modositandoNeme.value,
	modositandoSzuletesiDatum: modositandoSzuletesiDatum.value,
	modositandoSzemelyiId: modositandoSzemelyiId.value,
	modositandoTelefonszam: modositandoTelefonszam.value,
	modositandoLakcim: modositandoLakcim.value
};

console.log(adatok);

const kuldendo = JSON.stringify(adatok);

		let xhr = new XMLHttpRequest();
		xhr.open("POST", link+"api/alkalmazottak/modosit.php", true);
		xhr.setRequestHeader('Content-Type', 'application/json');
		xhr.onload = ()=>{
			if(xhr.readyState === XMLHttpRequest.DONE){
				if(xhr.status === 201){
					$('#modositandoFelhasznalo').modal('hide');
					valaszCim.innerHTML="Minden sikerült";
					valaszSzoveg.innerHTML="Sikeres felhasználó módosítás";
					setTimeout(function(){
						$('#valasz').modal('show');
						frissit();
					}, 500)
				}else{
					let data = xhr.response;
					$('#modositandoFelhasznalo').modal('hide');
					valaszCim.innerHTML="Valami nem sikerült";
					valaszSzoveg.innerHTML="Sikertelen felhasználó módosítás<br>"+data;
					console.log(data);
					setTimeout(function(){
						$('#valasz').modal('show');
					}, 500)
				}
			}
		}
		//let formData = new FormData(bejelentkezes_form);
		xhr.send(kuldendo);

}

var ujMent=document.querySelector("#ujFelhasznaloHozzaad");

ujMent.onclick = ()=>{



$('#ujpultosbelepesiresz').modal('hide');

var ujVezetekNev = document.querySelector("#ujVezetekNev");
var	ujKeresztNev = document.querySelector("#ujKeresztNev");
var	ujUtoNev= document.querySelector("#ujUtoNev");
var	ujNeme= document.querySelector("#ujNeme");
var	ujszuletesiDatum= document.querySelector("#ujszuletesiDatum");
var	ujSzemelyiId= document.querySelector("#ujSzemelyiId");
var	ujTelefonszam= document.querySelector("#ujTelefonszam");
var	ujLakcim= document.querySelector("#ujLakcim");

var	ujFelhasznalonev= document.querySelector("#ujFelhasznalonev");
var	ujJelszo= document.querySelector("#ujJelszo");
var	ujJelszoMegegyszer= document.querySelector("#ujJelszoMegegyszer");
var	ujEmail= document.querySelector("#ujEmail");
var	ujBecenev= document.querySelector("#ujBecenev");
var	ujKartya= document.querySelector("#ujKartya");

const adatok = {
	ujVezetekNev: ujVezetekNev.value,
	ujKeresztNev: ujKeresztNev.value,
	ujUtoNev: ujUtoNev.value,
	ujNeme: ujNeme.value,
	ujszuletesiDatum: ujszuletesiDatum.value,
	ujSzemelyiId: ujSzemelyiId.value,
	ujTelefonszam: ujTelefonszam.value,
	ujLakcim: ujLakcim.value,
	ujFelhasznalonev: ujFelhasznalonev.value,
	ujJelszo: ujJelszo.value,
	ujJelszoMegegyszer: ujJelszoMegegyszer.value,
	ujEmail: ujEmail.value,
	ujBecenev: ujBecenev.value,
	kartya: ujKartya.value
};

const kuldendo = JSON.stringify(adatok);
		let xhr = new XMLHttpRequest();
		xhr.open("POST", link+"api/alkalmazottak/hozzaad.php", true);
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
					$('#ujfelhasznalo').modal('hide');
					//csomagok = [];
					//csomagok = new Csomag();
					//nullaz();
					valaszCim.innerHTML="Minden sikerült";
					valaszSzoveg.innerHTML="Sikeres hozzáadás";
					setTimeout(function(){
						$('#valasz').modal('show');
					}, 500)
					frissit();
					//alert("Minden sikerült");

					
				}else{
					let data = xhr.response;
					const valasz = JSON.parse(data)
					//alert("Valami hibás");
					$('#ujfelhasznalo').modal('hide');
					valaszCim.innerHTML="Valami nem sikerült";
					valaszCim.innerHTML="Valami nem sikerült";
					valaszSzoveg.innerHTML=valasz.valasz;
					setTimeout(function(){
						$('#valasz').modal('show');
					}, 500)
					//console.log(data);
				}
		  }
		}
		//let formData = new FormData(bejelentkezes_form);
		xhr.send(kuldendo);

}




