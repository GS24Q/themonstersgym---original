class forgalom {
  constructor(id, ki, mikor, mit, kulcs) {
    this.id = id;
    this.ki = ki;
    this.mikor = mikor;
    this.mit = mit;
    this.kulcs = kulcs;
  }
}

var modositando = null;
const belepesek = new forgalom();
var belepesekSzama=0;

var megjelenit=false;


function forgalomLekerdez(azon,tipus){


	const xhr = new XMLHttpRequest();
	xhr.onload = function() {
		const valasz = JSON.parse(this.responseText);
			if(tranzakciok!=null){
				forgalomBeallit(valasz);
				//console.log(valasz);
			}else{
				alert("Üres");
			}
	 }
	 switch(tipus) {
		case "kulcs":
			xhr.open("POST", link+"api/forgalom/leker.php?tipus=kulcs&id="+azon, true);
		break;
		case "felhasznalo":
			xhr.open("POST", link+"api/forgalom/leker.php?tipus=felhasznalo&id="+azon, true);
		break;
	 }

	xhr.send();

}

function forgalomBeallit(valasz){
	
	belepesek.length = 0;
	belepesekSzama=0;
	
	//console.log("----------------------------");
	for (let i = 0; i < valasz.length; i++) {
		belepesek[i]=valasz[i];
		//console.log("I:"+i+"A válasz:");
		//console.log(belepesek[i]);
		belepesekSzama++;
	}
	//console.log("----------------------------");

		
}