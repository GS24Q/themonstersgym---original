class Csomag {
    constructor(id, nev, ar, leiras) {
        this.id = id;
        this.nev = nev;
        this.ar = ar;
        this.leiras = leiras;
    }
}

const csomagok = new Csomag();
var csomagokszama = 0;

function csomagLekerdez() {

    const xhr = new XMLHttpRequest();
    xhr.onload = function () {
        const valasz = JSON.parse(this.responseText);
        csomagBeallit(valasz);
    }
    xhr.open("GET", link + "api/csomagok/leker.php", true);
    xhr.send();

}

csomagLekerdez();

var csomagSeged = 0;

function csomagBeallit(valasz) {

    csomagok.length = 0;
    csomagokszama = 0;

    for (let i = 0; i < valasz.length; i++) {
        csomagok[i] = valasz[i];
        csomagokszama++;
    }
    csomagKiir();

}

function csomagKiir() {

    var lista = document.getElementById("csomag");
    var ertek = "";

    for (let i = 0; i < csomagokszama; i++) {

        ertek += "<option value=\"" + csomagok[i].id + "\">" + csomagok[i].nev + "</option>"

    }

    lista.innerHTML = ertek;
}