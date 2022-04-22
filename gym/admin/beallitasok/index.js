var valaszto = document.querySelector("#valaszto");
var teremBeallitasok = document.querySelector("#teremBeallitasok");
var profilBeallitasok = document.querySelector("#fiokBeallitasok");
function oldalBeallitasok() {
    //alert("Oldal");
    valaszto.style.animation = "eltunes 0.5s forwards";
    setTimeout(function () {
        $("#valaszto").hide();
    }, 500);
    teremBeallitasok.style.animation = "megjelenes 0.5s forwards";
    setTimeout(function () {
        $("#teremBeallitasok").show();
    }, 500);
}

function fiokBeallitasok() {
    //alert("Fiók");
    valaszto.style.animation = "eltunes 0.5s forwards";
    setTimeout(function () {
        $("#valaszto").hide();
    }, 500);
    profilBeallitasok.style.animation = "megjelenes 0.5s forwards";
    setTimeout(function () {
        $("#fiokBeallitasok").show();
    }, 500);
}

var hatterSzin = "";
var teremNev = "";

function lekerdez() {
    const xhr = new XMLHttpRequest();
    xhr.onload = function () {
        const valasz = JSON.parse(this.responseText);
        beallit(valasz);
    };
    xhr.open("GET", "../../../api/beallitasok/leker.php", true);
    xhr.send();
}

function beallit(valasz) {
    var teremNev = document.querySelector("#teremNev");
    var teremSzin = document.querySelector("#teremSzin");
    var teremFeloldva = document.querySelector("#teremFeloldva");
    var teremZarolva = document.querySelector("#teremZarolva");

    teremNev.value = valasz.nev;
    teremSzin.value = valasz.hatterSzin;

    if (valasz.zarolva == 1) {
        teremZarolva.checked = true;
    } else {
        teremFeloldva.checked = true;
    }
}

const bejelentkezes_form = document.querySelector(".beallitasok form"),
    mentes = document.querySelector("#mentes"),
    teremNevDiv = document.querySelector("#teremNev"),
    teremSzin = document.querySelector("#teremSzin"),
    teremFeloldva = document.querySelector("#teremFeloldva"),
    teremZarolva = document.querySelector("#teremZarolva");

function zarolasiAllapot() {
    if (teremFeloldva.checked) {
        return 0;
    } else {
        return 1;
    }
}

var valaszCim = document.querySelector("#valaszCim");
var valaszSzoveg = document.querySelector("#valaszSzoveg");

mentes.onclick = () => {
    const adatok = {
        teremNev: teremNevDiv.value,
        teremSzin: teremSzin.value,
        teremZarolasa: zarolasiAllapot(),
    };

    const kuldendo = JSON.stringify(adatok);
    //console.log(teszt);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", link + "api/beallitasok/modosit.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 201) {
                //let data = xhr.response;

                //const valasz = JSON.parse(data);
                //console.log(valasz);
                //var eredmeny =valasz.valasz;
                let data = xhr.response;
                //alert("Valami hibás");
                //console.log(data);
                valaszCim.innerHTML = "Minden sikerült";
                valaszSzoveg.innerHTML = "Sikeres beállítás modosítás";
                $("#valasz").modal("show");
                //alert("Minden sikerült");
            } else {
                let data = xhr.response;
                //alert("Valami hibás");
                valaszCim.innerHTML = "Valami nem sikerült";
                valaszSzoveg.innerHTML = "Sikertelen beállítás<br>" + data;
                $("#valasz").modal("show");
                console.log(data);
            }
        }
    };
    //let formData = new FormData(bejelentkezes_form);
    //console.log(formData);
    xhr.send(kuldendo);
};

var jelszoValtoztatGomb = document.querySelector("#jelszoValtoztatGomb");
var valaszSzoveg = document.querySelector("#valaszSzoveg");
var valaszCim = document.querySelector("#valaszCim");

jelszoValtoztatGomb.onclick = () => {
    var jelszoValtoztatUjJelszo = document.querySelector(
        "#jelszoValtoztatUjJelszo"
    ).value;
    var jelszoValtoztatUjJelszoMegegyszer = document.querySelector(
        "#jelszoValtoztatUjJelszoMegegyszer"
    ).value;

    const adatok = {
        id: felhasznaloId,
        jelszo: jelszoValtoztatUjJelszo,
        jelszoMegegyszer: jelszoValtoztatUjJelszoMegegyszer,
    };

    const kuldendo = JSON.stringify(adatok);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", link + "api/admin/jelszoValtoztatas/modosit.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 201) {
                $("#jelszoValtoztat").modal("hide");
                valaszSzoveg.innerHTML = "Sikeres jelszó változtatás";
                setTimeout(function () {
                    $("#valasz").modal("show");
                }, 500);
            } else {
                $("#jelszoValtoztat").modal("hide");
                valaszSzoveg.innerHTML = "Sikertelen jelszó változtatás";
                setTimeout(function () {
                    $("#valasz").modal("show");
                }, 500);
            }
        }
    };
    //let formData = new FormData(bejelentkezes_form);
    xhr.send(kuldendo);
};

var felhasznaloNevValtoztatGomb = document.querySelector(
    "#felhasznaloNevValtoztatGomb"
);

felhasznaloNevValtoztatGomb.onclick = () => {
    var felhasznaloNevValtoztatUjNev = document.querySelector(
        "#felhasznaloNevValtoztatUjNev"
    ).value;
    var felhasznaloNevValtoztatUjNevMegegyszer = document.querySelector(
        "#felhasznaloNevValtoztatUjNevMegegyszer"
    ).value;

    const adatok = {
        id: felhasznaloId,
        felhasznaloNev: felhasznaloNevValtoztatUjNev,
        felhasznaloNevMegegyszer: felhasznaloNevValtoztatUjNevMegegyszer,
    };

    const kuldendo = JSON.stringify(adatok);

    let xhr = new XMLHttpRequest();
    xhr.open(
        "POST",
        link + "api/admin/felhasznaloNevValtoztatas/modosit.php",
        true
    );
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 201) {
                $("#felhasznaloNevValtoztat").modal("hide");
                valaszSzoveg.innerHTML = "Sikeres felhasználónév változtatás";
                setTimeout(function () {
                    $("#valasz").modal("show");
                }, 500);
            } else {
                $("#felhasznaloNevValtoztat").modal("hide");
                valaszSzoveg.innerHTML =
                    "Sikertelen felhasználónév változtatás";
                setTimeout(function () {
                    $("#valasz").modal("show");
                }, 500);
            }
        }
    };
    //let formData = new FormData(bejelentkezes_form);
    xhr.send(kuldendo);
};
