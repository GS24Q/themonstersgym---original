class Csomag { //Létrehozzuk a csomag osztályt.
    constructor(id, nev, ar, leiras) {
        this.id = id;
        this.nev = nev;
        this.ar = ar;
        this.leiras = leiras;
    }
}

const csomagok = new Csomag(); //Létrehozzuk a csomagok "tömböt".
var csomagokszama = 0;

/*A html elemek összekötése a javascripttel.*/
var tolto = document.getElementById("tolto");
var arlistaDiv = document.getElementById("opciok");
/*A html elemek összekötése a javascripttel.*/



function lekerdez() { //Ezzel a funckcióval lekérdezzük az apiról a csomagokat.
    const xhr = new XMLHttpRequest();
    xhr.onload = function () {
        const valasz = JSON.parse(this.responseText);
        beallit(valasz); //Továbbítjuk az apiból érkező választ a beállít funkcióba.
    }
    xhr.open("GET", link + "api/csomagok/leker.php", true);
    xhr.send();
}

lekerdez(); //Ezzel a paranccsal elkezdjük az egész procedúrát.

function beallit(valasz) { //Ezzel a funckióval feltöltjük a helyi csomagok tömböt.
    for (let i = 0; i < valasz.length; i++) {
        csomagok[i] = valasz[i];
        console.log(csomagok[i]);
        csomagokszama++;
    }
    kiir();
}

function kiir() { //Kiírjuk a csomagokat a weboldalra.
    for (let i = 0; i < csomagokszama; i++) {
        const opcio = document.createElement("div"); //Létrehozzuk a csomag divjét.
        opcio.className = "col-lg-3 col-md-4 col-sm-6 col-12"; //Beállítjuk a csomag divjének osztályait.
        opcio.innerHTML = '<div class="card text-justify"><div class="card-header">' + csomagok[i].nev + '<span class="float-right">' + csomagok[i].ar + ' FT</span></div><div class="card-body">' + csomagok[i].leiras + '</div></div><br>';
        arlistaDiv.appendChild(opcio); //Megjelenítjük az oldalon a kész divet.
    }
}
