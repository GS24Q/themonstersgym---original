var alap = document.querySelector("#alap");
var valaszCim = document.querySelector("#valaszCim");
var valaszSzoveg = document.querySelector("#valaszSzoveg");
var logo = document.querySelector("#logo");
var hang = document.querySelector("#hang");

const bejelentkezes_form = document.querySelector(".azonositas form"),
bejelentkeztetoGomb = document.querySelector("#bejelentkeztetoGomb"),
felhasznalonev = document.querySelector("#felhasznalonev"),
hibaSzoveg = document.querySelector(".hibaSzoveg"),
jelszo = document.querySelector("#jelszo");

bejelentkeztetoGomb.onclick = () => {

    const adatok = {
        felhasznalonev: felhasznalonev.value,
        jelszo: jelszo.value,
    };

    const kuldendo = JSON.stringify(adatok);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../../api/bejelentkezes/belepes.php", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 201) {

                let data = xhr.response;
                alap.style.animation = 'eltunes 1s forwards';
                hatter.style.animation = 'elhalvanyodas 1s forwards';
                videoHatter.style.animation = 'elhalvanyodas 1s forwards';
                setTimeout(function () {
					window.location.href = "./";
				}, 1000)

            } else {

                let data = xhr.response;
                const valasz = JSON.parse(data);
				logo.classList.add("hiba");	
				hang.play();
				setTimeout(function () {

					valaszCim.innerHTML = "Sikertelen bejelentkezés";
					valaszSzoveg.innerHTML = valasz.valasz;
					$('#valasz').modal('show');
					logo.classList.remove("hiba");	
				
				}, 500)


            }
        }
    }
	
    xhr.send(kuldendo);
	
}
