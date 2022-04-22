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

function csomagLekerdez(){

	const xhr = new XMLHttpRequest();
	xhr.onload = function() {
		const valasz = JSON.parse(this.responseText);
		csomagBeallit(valasz);
	 }
	xhr.open("GET", link+"api/csomagok/leker.php", true);
	xhr.send();

}

csomagLekerdez();

var csomagSeged=0;

function csomagBeallit(valasz){
	
	csomagok.length=0;
	csomagokszama=0;
	
	for (let i = 0; i < valasz.length; i++) {
		csomagok[i]=valasz[i];
		//console.log(csomagok[i]);
		csomagokszama++;
	}
	csomagKiir();
	//csomagKiir();
	
}


function csomagKiir(){
	var lista = document.getElementById("csomag");
	var ertek="";
	//var ertek = "<table class='table table-bordered'><thead><tr><th>Azonosító</th><th>Név</th><th>Ár</th><th>Leírás</th><th>Művelet</th></tr></thead><tbody>";
	for (let i = 0; i < csomagokszama; i++) {
		ertek+="<option value=\""+csomagok[i].id+"\">"+csomagok[i].nev+"</option>"
		//ertek+="<tr><td>"+csomagok[i].id+"</td><td>"+csomagok[i].nev+"</td><td>"+csomagok[i].ar+" FT</td><td>"+csomagok[i].leiras+"</td><td><input type='button' class='btn btn-info' value='✏️' onclick='modosit("+i+")'><input type='button' class='btn btn-danger' value='❌' onclick='torol("+i+")'></td></tr>";
		//console.log("xd");
	}
	//ertek+="</tbody></table>";
	//tablazat.innerHTML=ertek;
	lista.innerHTML=ertek;
}