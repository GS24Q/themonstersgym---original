class tranzakcio {
  constructor(id, mit, ki, mikor, mennyit, leiras) {
    this.id = id;
    this.mit = mit;
    this.ki = ki;
    this.mikor = mikor;
    this.mennyit = mennyit;
    this.leiras = leiras;
  }
}

var modositando = null;
const tranzakciok = new tranzakcio();
var tranzakciokSzama=0;

var megjelenit=false;


function tranzakcioLekerdez(id){


	const xhr = new XMLHttpRequest();
	xhr.onload = function() {
		const valasz = JSON.parse(this.responseText);
			if(tranzakciok!=null){
				tranzakciokBeallit(valasz);
				//console.log(valasz);
			}else{
				alert("Üres");
			}
	 }
	xhr.open("POST", link+"api/tranzakciok/leker.php?id="+id, true);
	xhr.send();

}

function tranzakciokBeallit(valasz){
	
	tranzakciok.length = 0;
	tranzakciokSzama=0;
	
	//console.log("----------------------------");
	for (let i = 0; i < valasz.length; i++) {
		tranzakciok[i]=valasz[i];
		//console.log("I:"+i+"A válasz:");
		//console.log(tranzakciok[i]);
		tranzakciokSzama++;
	}
	//console.log("----------------------------");

	
	tranzakcioKiir();
	
}

function megtekint(id,mutat){
	
	//modositando=felhasznalok[id].id;
	//alert(modositando);
		
	if(mutat){
		megjelenit=true;
	}
	tranzakcioLekerdez(id);
	
}

function tranzakcioKiir(){


var mehet=true;

			/*console.log("---Csomagok---")
			for (let i = 0; i <	csomagokszama; i++) {
				
				console.log(csomagok[i]);
				//console.log(tranzakciok[i]);

			}
			console.log("---Csomagok---")*/


		if(mehet){

			var lista = document.getElementById("tranzakcioTablazat");
			
			if(megjelenit){
				document.querySelector("#felhasznaloDiv").style.display="none";
				document.querySelector("#tranzakcioDiv").style.display="block";
				megjelenit=false;//bug fix
			}
			var ertek="";
			var ertek = "<table class='table table-bordered'><thead><tr><th>Azonosító</th><th>Mit</th><th>Mikor</th><th>Mennyit</th><th>Leírás</th></tr></thead><tbody>";
			
			for (let i = 0; i < tranzakciokSzama; i++) {
				
				
				//var index = parseInt(tranzakciok[i].mit);
				var index = parseInt(tranzakciok[i].mit)-1;
				//console.log(index);
				//console.log(csomagok[index]);

				
				//ertek+="<tr><td>"+tranzakciok[i].id+"</td><td><td><td>"+tranzakciok[i].mikor+"</td><td>"+tranzakciok[i].mennyit+"</td><td><input type='button' class='btn btn-info' value='✏️' onclick='modosit("+i+")'><input type='button' class='btn btn-danger' value='❌' onclick='torol("+i+")'></td></tr>";
				
				
				
				
				ertek+="<tr><td>"+tranzakciok[i].id+"</td><td>"+csomagok[index].nev+"</td><td>"+tranzakciok[i].mikor+"</td><td>"+tranzakciok[i].mennyit+"</td><td>"+tranzakciok[i].leiras+"</td></tr>";
				
				
				
				
				//ertek+="<tr><td>"+tranzakciok[i].id+"</td><td>"+csomagok[index].nev+"</td><td>"+tranzakciok[i].mikor+"</td><td>"+tranzakciok[i].mennyit+"</td><td></td></tr>";
				
				
			}
			
			lista.innerHTML=ertek;
		
		}
		
}