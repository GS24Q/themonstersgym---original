
const adatok = {
		id: felhasznaloId
	};
	
	const kuldendo = JSON.stringify(adatok);

		let xhr = new XMLHttpRequest();
		xhr.open("POST", link+"api/alkalmazottak/becenevKeres.php", true);
		xhr.setRequestHeader('Content-Type', 'application/json');
		xhr.onload = ()=>{
			if(xhr.readyState === XMLHttpRequest.DONE){
				if(xhr.status === 201){
					
					let data = xhr.response;
					const valasz = JSON.parse(data);

					//alert(valasz);
					document.getElementById("becenev").innerHTML="Üdvözöllek kedves "+valasz;
					
				}else{
					
					window.location.href = link+"gym/kijelentkezes.php";

				}
		  }
		}
		//let formData = new FormData(bejelentkezes_form);
		xhr.send(kuldendo);









var jelszoValtoztatGomb = document.querySelector("#jelszoValtoztatGomb");
var	valaszSzoveg = document.querySelector("#valaszSzoveg");
var	valaszCim = document.querySelector("#valaszCim");



jelszoValtoztatGomb.onclick = ()=>{
	
	var jelszoValtoztatUjJelszo = document.querySelector("#jelszoValtoztatUjJelszo");
	var jelszoValtoztatUjJelszoMegegyszer = document.querySelector("#jelszoValtoztatUjJelszoMegegyszer");
	
	if(jelszoValtoztatUjJelszo.value!=jelszoValtoztatUjJelszoMegegyszer.value || (jelszoValtoztatUjJelszo.value=="") || (jelszoValtoztatUjJelszoMegegyszer.value=="")){
	
		jelszoValtoztatUjJelszo.style.border="1px solid red";
		jelszoValtoztatUjJelszoMegegyszer.style.border="1px solid red";
	
}else{
	
	
	const adatok = {
		id: felhasznaloId,
		jelszo: jelszoValtoztatUjJelszo.value,
		jelszoMegegyszer: jelszoValtoztatUjJelszoMegegyszer.value
	};
	
	const kuldendo = JSON.stringify(adatok);

		let xhr = new XMLHttpRequest();
		xhr.open("POST", link+"api/alkalmazottak/jelszoValtoztatas/modosit.php", true);
		xhr.setRequestHeader('Content-Type', 'application/json');
		xhr.onload = ()=>{
			if(xhr.readyState === XMLHttpRequest.DONE){
				if(xhr.status === 201){
					
					
					jelszoValtoztatUjJelszo.style.border="1px solid #ced4da";
					jelszoValtoztatUjJelszoMegegyszer.style.border="1px solid #ced4da";
					
					$('#jelszoValtoztat').modal('hide');
					valaszCim.innerHTML="Minden sikerült"
					valaszSzoveg.innerHTML="Sikeres jelszó változtatás"
					setTimeout(function(){
						$('#valasz').modal('show');
					}, 500)
					
				}else{
				
					$('#jelszoValtoztat').modal('hide');
					valaszCim.innerHTML="Sikertelen művelet"
					valaszSzoveg.innerHTML="Sikertelen jelszó változtatás"
					setTimeout(function(){
						$('#valasz').modal('show');
					}, 500)

				}
		  }
		}
		//let formData = new FormData(bejelentkezes_form);
		xhr.send(kuldendo);
	
	}
	
}


var felhasznaloNevValtoztatGomb = document.querySelector("#felhasznaloNevValtoztatGomb");


felhasznaloNevValtoztatGomb.onclick = ()=>{
	
	var felhasznaloNevValtoztatUjNev = document.querySelector("#felhasznaloNevValtoztatUjNev");
	var felhasznaloNevValtoztatUjNevMegegyszer = document.querySelector("#felhasznaloNevValtoztatUjNevMegegyszer");
	
	
if(felhasznaloNevValtoztatUjNev.value!=felhasznaloNevValtoztatUjNevMegegyszer.value || (felhasznaloNevValtoztatUjNev.value=="") || (felhasznaloNevValtoztatUjNevMegegyszer.value=="")){
	
	felhasznaloNevValtoztatUjNev.style.border="1px solid red";
	felhasznaloNevValtoztatUjNevMegegyszer.style.border="1px solid red";
	
}else{
	
	
	const adatok = {
		id: felhasznaloId,
		felhasznaloNev: felhasznaloNevValtoztatUjNev.value,
		felhasznaloNevMegegyszer: felhasznaloNevValtoztatUjNevMegegyszer.value
	};
	
	const kuldendo = JSON.stringify(adatok);

		let xhr = new XMLHttpRequest();
		xhr.open("POST", link+"api/alkalmazottak/felhasznaloNevValtoztatas/modosit.php", true);
		xhr.setRequestHeader('Content-Type', 'application/json');
		xhr.onload = ()=>{
			if(xhr.readyState === XMLHttpRequest.DONE){
				if(xhr.status === 201){
					
					
					felhasznaloNevValtoztatUjNev.style.border="1px solid #ced4da";
					felhasznaloNevValtoztatUjNevMegegyszer.style.border="1px solid #ced4da";
					
					$('#felhasznaloNevValtoztat').modal('hide');
					valaszCim.innerHTML="Minden sikerült"
					valaszSzoveg.innerHTML="Sikeres felhasználónév változtatás"
					setTimeout(function(){
						$('#valasz').modal('show');
					}, 500)
					
				}else{
					
					let data = xhr.response;
					$('#felhasznaloNevValtoztat').modal('hide');
					valaszCim.innerHTML="Sikertelen művelet"
					valaszSzoveg.innerHTML="Sikertelen felhasználónév változtatás"
					setTimeout(function(){
						$('#valasz').modal('show');
					}, 500)

				}
		  }
		}
		//let formData = new FormData(bejelentkezes_form);
		xhr.send(kuldendo);
	
}



}


