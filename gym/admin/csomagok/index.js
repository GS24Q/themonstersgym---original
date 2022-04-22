class Csomag {
  constructor(id, nev, ar, leiras) {
    this.id = id;
    this.nev = nev;
    this.ar = ar;
    this.leiras = leiras;
  }
}

const csomagok = new Csomag();
var csomagokszama=0;

function lekerdez(){

	const xhr = new XMLHttpRequest();
	xhr.onload = function() {
		const valasz = JSON.parse(this.responseText);
		beallit(valasz);
	 }
	xhr.open("GET", "../../../api/csomagok/leker.php", true);
	xhr.send();

}

lekerdez();

var seged=0;

function beallit(valasz){
	
	for (let i = 0; i < valasz.length; i++) {
		csomagok[i]=valasz[i];
		console.log(csomagok[i]);
		csomagokszama++;
	}
	kiir();
	
}



var legutobbiCsomagListaAllapot="osszes";




var csomagLista = document.querySelector("#csomaglista");

csomagLista.addEventListener('change', (event) => {
	//alert(csomagLista.value);
	legutobbiCsomagListaAllapot=csomagLista.value;
	kiir();
});



var csomagKereso = document.querySelector("#csomagKereso");

csomagKereso.addEventListener('input', (event) => {
  if(csomagKereso.value!=""){
	  csomaglista.value="osszes";
	  csomaglista.disabled=true;
  }else{
	  csomaglista.value=legutobbiCsomagListaAllapot;
	  csomaglista.disabled=false;
  }
  kiir();
  
});







function kiir(){
	var tablazat = document.getElementById("tablazat");
	var ertek="";
	var ertek = "<table class='table table-bordered'><thead><tr><th>Azonosító</th><th>Név</th><th>Ár</th><th>Leírás</th><th>Művelet</th></tr></thead><tbody>";
	
	
	if(csomagKereso.value==""){
	
	
		if(csomagLista.value=="osszes"){
		
			for (let i = 0; i < csomagokszama; i++) {
				ertek+="<tr><td>"+csomagok[i].id+"</td><td>"+csomagok[i].nev+"</td><td>"+csomagok[i].ar+" FT</td><td>"+csomagok[i].leiras+"</td><td><input type='button' class='btn btn-info' value='✏️' onclick='modosit("+i+")'></td></tr>";
				//console.log("xd");
			}
			ertek+="</tbody></table>";
			tablazat.innerHTML=ertek;
	
		}else{
			
			for (let i = 0; i < csomagokszama && i <= csomaglista.value-1; i++) {
				ertek+="<tr><td>"+csomagok[i].id+"</td><td>"+csomagok[i].nev+"</td><td>"+csomagok[i].ar+" FT</td><td>"+csomagok[i].leiras+"</td><td><input type='button' class='btn btn-info' value='✏️' onclick='modosit("+i+")'></td></tr>";
				//console.log("xd");
			}
			ertek+="</tbody></table>";
			tablazat.innerHTML=ertek;
		}
	
	}else{
		
		for (let i = 0; i < csomagokszama; i++) {
			if(csomagok[i].nev.toLowerCase().includes(csomagKereso.value.toLowerCase())){
				ertek+="<tr><td>"+csomagok[i].id+"</td><td>"+csomagok[i].nev+"</td><td>"+csomagok[i].ar+" FT</td><td>"+csomagok[i].leiras+"</td><td><input type='button' class='btn btn-info' value='✏️' onclick='modosit("+i+")'></td></tr>";
				//console.log("xd");
			}
		}
		ertek+="</tbody></table>";
		tablazat.innerHTML=ertek;
	}
}

var modositando=-1;

function modosit(azon){
	
	modositando=csomagok[azon].id;
	var modositandoNev = document.querySelector("#modositandoNev");
	var	modositandoAr = document.querySelector("#modositandoAr");
	var	modositandoLeiras= document.querySelector("#modositandoLeiras");
	modositandoNev.value=csomagok[azon].nev;
	modositandoAr.value=csomagok[azon].ar;
	modositandoLeiras.value=csomagok[azon].leiras;
	$('#csomagmodositasa').modal('show');
	
}

function frissit(){
	csomagokszama=0;
	lekerdez();
}



var modositMent=document.querySelector("#modositMentes");

modositMent.onclick = ()=>{

var modositandoNev = document.querySelector("#modositandoNev");
var	modositandoAr = document.querySelector("#modositandoAr");
var	modositandoLeiras= document.querySelector("#modositandoLeiras");

const adatok = {
	csomagId: modositando,
	csomagNev: modositandoNev.value,
	csomagAr: modositandoAr.value,
	csomagLeiras: modositandoLeiras.value
};

const kuldendo = JSON.stringify(adatok);
		let xhr = new XMLHttpRequest();
		xhr.open("POST", "../../../api/csomagok/modosit.php", true);
		xhr.setRequestHeader('Content-Type', 'application/json');
		xhr.onload = ()=>{
			if(xhr.readyState === XMLHttpRequest.DONE){
				if(xhr.status === 201){
					$('#csomagmodositasa').modal('hide');
					valaszCim.innerHTML="Minden sikerült";
					valaszSzoveg.innerHTML="Sikeres csomag módosítás";
					setTimeout(function(){
						$('#valasz').modal('show');
					}, 500)
					frissit();
				}else{
					let data = xhr.response;
					$('#csomagmodositasa').modal('hide');
					valaszCim.innerHTML="Valami nem sikerült";
					valaszSzoveg.innerHTML="Sikertelen csomag módosítás<br>"+data;
					setTimeout(function(){
						$('#valasz').modal('show');
					}, 500)				}
			}
		}
		//let formData = new FormData(bejelentkezes_form);
		xhr.send(kuldendo);

}


var ujMent=document.querySelector("#ujMentes");

ujMent.onclick = ()=>{

var ujNev = document.querySelector("#ujNev");
var	ujAr = document.querySelector("#ujAr");
var	ujLeiras= document.querySelector("#ujLeiras");

const adatok = {
	csomagNev: ujNev.value,
	csomagAr: ujAr.value,
	csomagLeiras: ujLeiras.value
};

const kuldendo = JSON.stringify(adatok);
		let xhr = new XMLHttpRequest();
		xhr.open("POST", "../../../api/csomagok/hozzaad.php", true);
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
					$('#ujcsomag').modal('hide');
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
					const valasz = JSON.parse(data);
					//alert("Valami hibás");
					$('#ujcsomag').modal('hide');
					valaszCim.innerHTML="Valami nem sikerült";
					valaszSzoveg.innerHTML=valasz.valasz;
					$('#valasz').modal('show');
					//console.log(data);
				}
		  }
		}
		//let formData = new FormData(bejelentkezes_form);
		xhr.send(kuldendo);

}


var ujNyito=document.querySelector("#uj");
var ujtag=document.querySelector("#ujtag");
var ujMegse=document.querySelector("#ujMegse");
var modositMegse=document.querySelector("#modositMegse");
