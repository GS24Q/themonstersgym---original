var hatter = document.querySelector("#hatter");
var videoHatter = document.querySelector("#videoHatter");
hatterKezeloGomb = document.querySelector("#hatterKezeloGomb"),


hatterKezeloGomb.onclick = ()=>{
	
	if(sutiLeker("themonstersgym_videoHatter")=="ki"){
		//alert("Ki");

		hatterKezeloGomb.src="../media/ikonok/szunet.png"
		sutiModosit("themonstersgym_videoHatter","be")
		videoHatter.play();
		hatter.style.display="none";
		videoHatter.style.display="block";
	}else{

		hatterKezeloGomb.src="../media/ikonok/indit.png"
		sutiModosit("themonstersgym_videoHatter","ki")
		videoHatter.pause();
		videoHatter.style.display="none";
		hatter.style.display="block";
		//alert("Be");
	}
	
}


const bejelentkezes_form = document.querySelector(".azonositas form"),
bejelentkeztetoGomb = document.querySelector("#bejelentkeztetoGomb"),
felhasznalonev = document.querySelector("#felhasznalonev"),
hibaSzoveg = document.querySelector(".hibaSzoveg"),
jelszo = document.querySelector("#jelszo");


bejelentkeztetoGomb.onclick = ()=>{
	//mentes.disabled=true;
	
		//alert("");
	
const adatok = {
	felhasznalonev: felhasznalonev.value,
	jelszo: jelszo.value,
};

const kuldendo = JSON.stringify(adatok);




		let xhr = new XMLHttpRequest();
		xhr.open("POST", "../../api/admin/bejelentkezes/belepes.php", true);
		xhr.setRequestHeader('Content-Type', 'application/json');
		xhr.onload = ()=>{
			if(xhr.readyState === XMLHttpRequest.DONE){
				if(xhr.status === 201){
					let data = xhr.response;
					
					//const valasz = JSON.parse(data);
					//console.log(valasz);
					//var eredmeny =valasz.valasz;
					//let data = xhr.response;
					//alert("Valami hibás");
					//console.log(data);
					//let data = xhr.response;
					alap.style.animation = 'eltunes 1s forwards'
					hatter.style.animation= 'elhalvanyodas 1s forwards'
					//videoHatter.style.animation= 'elhalvanyodas 1s forwards'
						setTimeout(function(){
							window.location.href = "./";
						}, 1000)

					//alert("Minden sikerült");

					
				}else{
					let data = xhr.response;
					const valasz = JSON.parse(data);
					//alert("Valami hibás");
					valaszCim.innerHTML="Sikertelen bejelentkezés";
					valaszSzoveg.innerHTML=valasz.valasz;
					$('#valasz').modal('show');

				}
		  }
		}
		//let formData = new FormData(bejelentkezes_form);
		//console.log(formData);
		xhr.send(kuldendo);
		
		
	
}