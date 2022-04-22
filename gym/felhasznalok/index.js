//A felhasználó osztály

class felhasznalo {
    constructor(id, vezetekNev, keresztNev, utoNev, nem, szuletesiDatum, szemelyiId, telefonszam, lakcim, regisztracioDatum, hanyszorVoltNalunk, berletId) {
        this.id = id;
        this.vezetekNev = vezetekNev;
        this.keresztNev = keresztNev;
        this.utoNev = utoNev;
        this.nem = nem;
        this.szuletesiDatum = szuletesiDatum;
        this.szemelyiId = szemelyiId;
        this.telefonszam = telefonszam;
        this.lakcim = lakcim;
        this.regisztracioDatum = regisztracioDatum;
        this.hanyszorVoltNalunk = hanyszorVoltNalunk;
        this.berletId = berletId;
    }
}

const felhasznalok = new felhasznalo();

//Egyéb változók

var felhasznalokszama = 0;
var kapottErtek = ""; //olvasó által
var visszajelzes = document.querySelector("#visszajelzes");
var modositandoKartyaOlvaso = document.querySelector("#modositandoKartyaOlvaso");
var ujKartyaMentes = document.querySelector("#ujKartyaMentes");
var ujKartya = document.querySelector("#ujKartya");
var ujKartyaOlvaso = document.querySelector("#ujKartyaOlvaso");
var torlendoKartyaOlvaso = document.querySelector("#torlendoKartyaOlvaso");
var profilToltes = document.querySelector("#profilToltes");
var jegyIdk = ["1", "2"];
var berletIdk = ["3", "4", "5"];
var legutobbiFelhasznalo = -1;
var legutobbiFelhasznaloAdatbazisId = -1;
var legutobbiFelhasznaloBerlete = -1;
var felhasznaloBeleptet = document.querySelector("#felhasznaloBeleptet");
var felhasznaloKulcsozasa = document.querySelector("#felhasznaloKulcsozasa");
var felhasznaloKileptet = document.querySelector("#felhasznaloKileptet");
var kezelosVasarlasUtan = false;
var kulcsId = document.querySelector("#kulcsId");
var ujTranzakcioGomb = document.querySelector("#ujTranzakcioGomb");
var kulcsLeadasId = document.querySelector("#kulcsLeadasId");
var kulcsLeadasGomb = document.querySelector("#kulcsLeadasGomb");
var valaszSzoveg = document.querySelector("#valaszSzoveg");
var seged = 0;
var legutobbiCsomagListaAllapot = "osszes";
var csomaglista = document.querySelector('#csomaglista');
var kereso = document.querySelector('#kereso');
var keresesAlapja = document.querySelector('#keresesAlapja');
var modositando = -1;
var torlendoAblakCim = document.querySelector("#torlendoAblakCim");
var torlendoFelhasznaloId = -1;
var torlendoFelhasznaloAzon = -1;
var torlendoAblakEllenorizGomb = document.querySelector("#torlendoAblakEllenorizGomb");
var magasabbRanguEngedelyValasz = "";
var jelszo = document.querySelector("#torlendoAblakJelszo");
var modositMent = document.querySelector("#modositMentes");
var ujKartyaMentGomb = document.querySelector("#ujKartyaMentes");
var ujMent = document.querySelector("#ujMentes");
var ujMentesMegse = document.querySelector("#ujMentesMegse");
var felhasznaloDiv = document.querySelector("#felhasznaloDiv");
var tranzakcioDiv = document.querySelector("#tranzakcioDiv");
var tranzakcioDivVissza = document.querySelector("#tranzakcioDivVissza");
var ujTranzakcioMentes = document.querySelector("#ujTranzakcioMentes");
var mennyitFizet = document.querySelector("#mennyitFizet");
var leiras = document.querySelector("#leiras");
var valaszSzoveg = document.querySelector("#valaszSzoveg");
var valaszCim = document.querySelector("#valaszCim");
var kartyaOlvasoBezar = document.querySelector("#kartyaOlvasoBezar");
var hova = "";

//Kártyaolvasó és a funkciók

function sikeresBeolvasas(beolvasottKod) {

    $("#olvasasLeallitasa").click()
    kapottErtek = beolvasottKod;
	setTimeout(function () {
		olvasasUtan();
    }, 200)

}
function sikertelenBeolvasas(hiba) {
    
}
let html5QrcodeScanner = new Html5QrcodeScanner(
        "olvaso", {
    fps: 10,
    qrbox: 250
});
html5QrcodeScanner.render(sikeresBeolvasas, sikertelenBeolvasas);

function olvasasUtan() {
    $('#kartyaOlvaso').modal('hide');

    switch (hova) {
		
		case "ujKartyaDiv":
			ujKartya.value = kapottErtek;
			ujKartyaMentes.disabled=false;
			setTimeout(function () {
				$('#ujfelhasznaloKartyaja').modal('show');
			}, 500)
		break;
		
		case "modositandoFelhasznalo":
			modositandoKartya.value = kapottErtek;
			setTimeout(function () {
				$('#modositandoFelhasznalo').modal('show');
				hova="";
			}, 500)
		break;

		case "torlendoAblak":
			torlendoAblakJelszo.value = kapottErtek;
			setTimeout(function () {
				$('#torlendoAblak').modal('show');
				hova="";
			}, 500)
		break;

		case "":
			keresesAlapja.value = "berlet";
			kereso.value = kapottErtek;
			csomaglista.value = "osszes";
			csomaglista.disabled = true;
			kiir();
			beolvasottProfilBeallit(kapottErtek);
		break;
	
    }
	
    //hova = "";

}

function tagKezel(id) {
    var kezelendo = felhasznalok[id].berletId;
    beolvasottProfilBeallit(kezelendo);
}



function beolvasottProfilBeallit(berletId) {

    $('#profilToltes').show();
    $('#profilValasz').hide();
    $('#profilKulcsozasa').hide();
    $('#profilKezelese').hide();
    $('#profilKezeleseAlja').hide();

    setTimeout(function () {
        $('#beolvasottFelhasznalo').modal('show');
    }, 500)

    felhasznaloKulcsozasa.disabled = true;
    felhasznaloKileptet.disabled = true;

    legutobbiFelhasznaloBerlete = berletId;

    var keresettId = -1;
    var adatbazisId = -1;
    var bevanLepve = false;
    var legutobbiBelepes = -1;
    var legutobbiKilepes = -1;
    var vanBerlete = false;
    var ervenyesBerlet = false;
    var tovabbMehet = false;

    const most = new Date();
	//alert(most);

    for (let i = 0; i < felhasznalokszama; i++) {
        if (felhasznalok[i].berletId == berletId) {
            keresettId = i;
            legutobbiFelhasznalo = i;
        }
    }
	
	if(keresettId!=-1){

    adatbazisId = felhasznalok[keresettId].id;
    legutobbiFelhasznaloAdatbazisId = adatbazisId;
    megtekint(adatbazisId, false);
    forgalomLekerdez(adatbazisId, "felhasznalo");

    setTimeout(function () { // telefonra bugfix

        if (belepesekSzama != 0) {

            for (let i = 0; i < belepesekSzama; i++) {

                if (belepesek[i].mit == 1) { // ha belépés
					var datumSzovegbe = belepesek[i].mikor //IOS hiba
					var belepesDatuma = new Date(datumSzovegbe.replace(" ", "T"));
                    //legutobbiBelepes = new Date(belepesek[i].mikor);
                    legutobbiBelepes = new Date(belepesDatuma);
                }

                if (belepesek[i].mit == 0) { // ha kilépés
					var datumSzovegbe = belepesek[i].mikor //IOS hiba
                    var kilepesDatuma = new Date(datumSzovegbe.replace(" ", "T"));
                    legutobbiKilepes = new Date(kilepesDatuma);
                }

            }
			
            if (Date.parse(legutobbiBelepes) < Date.parse(legutobbiKilepes)) {
                bevanLepve = false;
            } else {
                bevanLepve = true;
            }

        } else if (belepesekSzama == 1 && belepesek[0].mit == 1) {
            bevanLepve = true;
        } else { //első belépés
            bevanLepve = false;
        }

        for (let i = 0; i < tranzakciokSzama; i++) {
            if (tranzakciok[i].ki == adatbazisId) {

                if (berletIdk.includes(tranzakciok[i].mit.toString())) { // bérlet ellenörzés

                    vanBerlete = true;
                    //const berletVasarlasa = new Date(tranzakciok[i].mikor);
					
					var datumSzovegbe = tranzakciok[i].mikor //IOS hiba
                    var berletVasarlasa = new Date(datumSzovegbe.replace(" ", "T"));
					

                    const harmincNap = 30 * 24 * 60 * 60 * 1000;

                    const kul = most.getTime() - berletVasarlasa.getTime();

                    if (kul >= harmincNap) {}
                    else {
                        ervenyesBerlet = true;
                        break;
                    }

                }

            }
        }

        var ervenyesJegy = false;

        for (let i = 0; i < tranzakciokSzama; i++) {
            if (tranzakciok[i].ki == adatbazisId) {

                if (jegyIdk.includes(tranzakciok[i].mit.toString())) { // bérlet ellenörzés

					var datumSzovegbe = tranzakciok[i].mikor //IOS hiba
                    var jegyVasarlasa = new Date(datumSzovegbe.replace(" ", "T"));

                    if (most.getFullYear() === jegyVasarlasa.getFullYear() && most.getMonth() === jegyVasarlasa.getMonth() && most.getDate() === jegyVasarlasa.getDate()) {
                        //console.log('Date is older than 30 days');
                        ervenyesJegy = true;
                        break;
                    }

                }

            }
        }

        if (vanBerlete && ervenyesBerlet) {
            berletAllapot.innerHTML = "Érvényes bérlet";
            berletAllapot.classList.remove("text-danger");
            berletAllapot.classList.add("text-success");
            tovabbMehet=true;
        } else {
            berletAllapot.innerHTML = "Lejárt a bérlete";
            berletAllapot.classList.remove("text-success");
            berletAllapot.classList.add("text-danger");
        }

        if (ervenyesJegy) {
            napiJegyAllapot.innerHTML = "Érvényes jegy";
            napiJegyAllapot.classList.remove("text-danger");
            napiJegyAllapot.classList.add("text-success");
            tovabbMehet=true;
        } else {
            napiJegyAllapot.innerHTML = "Nincs";
            napiJegyAllapot.classList.remove("text-success");
            napiJegyAllapot.classList.add("text-danger");
        }

        var beolvasottFelhasznaloNeve = document.querySelector("#beolvasottFelhasznaloNeve");
        beolvasottFelhasznaloNeve.innerHTML = felhasznalok[keresettId].vezetekNev + " " + felhasznalok[keresettId].keresztNev + " " + felhasznalok[keresettId].utoNev;



        if (bevanLepve) {
            felhasznaloKulcsozasa.disabled = true;
            felhasznaloKileptet.disabled = false;
        } else {
            felhasznaloKulcsozasa.disabled = false;
            felhasznaloKileptet.disabled = true;
        }
		
		if (tovabbMehet) {
			if(!bevanLepve){
				felhasznaloKulcsozasa.disabled = false;
			}else{
				felhasznaloKulcsozasa.disabled = true;	
			}
        }else{
            felhasznaloKulcsozasa.disabled = true;
		}

        setTimeout(function () {
            $('#profilToltes').hide();
            $('#profilKezelese').show();
            $('#profilKezeleseAlja').show();
        }, 500)

    }, 500)
	
	}else{
	
		hova="";
		kereso.value = "";
		csomaglista.value = "osszes";
		csomaglista.disabled = false;
		$('#profilToltes').hide();
		profilValaszSzoveg.innerHTML = "Érvénytelen kártya!";
		profilValaszSzoveg.classList.remove("text-success");
		profilValaszSzoveg.classList.add("text-danger");
		$('#profilValasz').show();
	
	}
}

function lekerdez() {
    const xhr = new XMLHttpRequest();
    xhr.onload = function () {
        const valasz = JSON.parse(this.responseText);
        beallit(valasz);
    }
    xhr.open("GET", link + "api/tagok/leker.php", true);
    xhr.send();
}
lekerdez();

function beallit(valasz) {
    felhasznalok.length = 0;
    felhasznalokszama = 0;

    for (let i = 0; i < valasz.length; i++) {
        felhasznalok[i] = valasz[i];
        felhasznalokszama++;
    }
    kiir();
}

function kiir() {
    var tablazat = document.getElementById("tablazat");
    var kereso = document.getElementById("kereso");
    var csomaglista = document.getElementById("csomaglista");
    var ertek = ""
    ertek = "<table class='table table-bordered'><thead><tr><th>Kezel</th><th>Vezetéknév</th><th>Keresztnév</th><th>Nem</th><th>Születésidátum</th><th>Személyi</th><th>Telefonszám</th><th>Lakcím</th><th>Regisztrációs dátum</th><th>Egyéb műveletek</th></tr></thead><tbody>";

    if (kereso.value == "") {

        if (csomaglista.value != "osszes") {
            for (let i = 0; i < felhasznalokszama && i <= csomaglista.value - 1; i++) {
                ertek += "<tr><td><input type='button' class='btn btn-success kezelGomb' value='💼' onclick='tagKezel(" + i + ")'></td><td>" + felhasznalok[i].vezetekNev + "</td><td>" + felhasznalok[i].keresztNev + "</td><td>" + felhasznalok[i].nem + "</td><td>" + felhasznalok[i].szuletesiDatum + "</td><td>" + felhasznalok[i].szemelyiId + "</td><td>" + felhasznalok[i].telefonszam + "</td><td>" + felhasznalok[i].lakcim + "</td><td>" + felhasznalok[i].regisztracioDatum + "</td><td class='d-flex'><input type='button' class='btn btn-primary' value='👁️' onclick='megtekint(" + felhasznalok[i].id + ",true)'><input type='button' class='btn btn-info' value='✏️' onclick='modosit(" + i + ")'><input type='button' onclick='torlendo(" + i + ")' class='btn btn-danger' value='❌'></td></tr>";
                //console.log("xd");
            }
            ertek += "</tbody></table>";
            tablazat.innerHTML = ertek;

        } else {
            for (let i = 0; i < felhasznalokszama; i++) {
                ertek += "<tr><td><input type='button' class='btn btn-success kezelGomb' value='💼' onclick='tagKezel(" + i + ")'></td><td>" + felhasznalok[i].vezetekNev + "</td><td>" + felhasznalok[i].keresztNev + "</td><td>" + felhasznalok[i].nem + "</td><td>" + felhasznalok[i].szuletesiDatum + "</td><td>" + felhasznalok[i].szemelyiId + "</td><td>" + felhasznalok[i].telefonszam + "</td><td>" + felhasznalok[i].lakcim + "</td><td>" + felhasznalok[i].regisztracioDatum + "</td><td class='d-flex'><input type='button' class='btn btn-primary' value='👁️' onclick='megtekint(" + felhasznalok[i].id + ",true)'><input type='button' class='btn btn-info' value='✏️' onclick='modosit(" + i + ")'><input type='button' onclick='torlendo(" + i + ")' class='btn btn-danger' value='❌'></td></tr>";
                //console.log("xd");
            }
            ertek += "</tbody></table>";
            tablazat.innerHTML = ertek;
        }

    } else { //HA VAN VALAMI A KEREŐSBEN


        switch (keresesAlapja.value) {
        case "berlet":

            for (let i = 0; i < felhasznalokszama; i++) {
                if (felhasznalok[i].berletId.includes(kereso.value)) {
                    ertek += "<tr><td><input type='button' class='btn btn-success kezelGomb' value='💼' onclick='tagKezel(" + i + ")'></td><td>" + felhasznalok[i].vezetekNev + "</td><td>" + felhasznalok[i].keresztNev + "</td><td>" + felhasznalok[i].nem + "</td><td>" + felhasznalok[i].szuletesiDatum + "</td><td>" + felhasznalok[i].szemelyiId + "</td><td>" + felhasznalok[i].telefonszam + "</td><td>" + felhasznalok[i].lakcim + "</td><td>" + felhasznalok[i].regisztracioDatum + "</td><td class='d-flex'><input type='button' class='btn btn-primary' value='👁️' onclick='megtekint(" + felhasznalok[i].id + ",true)'><input type='button' class='btn btn-info' value='✏️' onclick='modosit(" + i + ")'><input type='button' onclick='torlendo(" + i + ")' class='btn btn-danger' value='❌'></td></tr>";
                }
            }

            ertek += "</tbody></table>";
            tablazat.innerHTML = ertek;

            break;

        case "szemelyi":

            for (let i = 0; i < felhasznalokszama; i++) {
                if (felhasznalok[i].szemelyiId.includes(kereso.value)) {
                    ertek += "<tr><td><input type='button' class='btn btn-success kezelGomb' value='💼' onclick='tagKezel(" + i + ")'></td><td>" + felhasznalok[i].vezetekNev + "</td><td>" + felhasznalok[i].keresztNev + "</td><td>" + felhasznalok[i].nem + "</td><td>" + felhasznalok[i].szuletesiDatum + "</td><td>" + felhasznalok[i].szemelyiId + "</td><td>" + felhasznalok[i].telefonszam + "</td><td>" + felhasznalok[i].lakcim + "</td><td>" + felhasznalok[i].regisztracioDatum + "</td><td class='d-flex'><input type='button' class='btn btn-primary' value='👁️' onclick='megtekint(" + felhasznalok[i].id + ",true)'><input type='button' class='btn btn-info' value='✏️' onclick='modosit(" + i + ")'><input type='button' onclick='torlendo(" + i + ")' class='btn btn-danger' value='❌'></td></tr>";
                }
            }

            ertek += "</tbody></table>";
            tablazat.innerHTML = ertek;

            break;

        case "telefonszam":

            for (let i = 0; i < felhasznalokszama; i++) {
                if (felhasznalok[i].telefonszam.includes(kereso.value)) {
                    ertek += "<tr><td><input type='button' class='btn btn-success kezelGomb' value='💼' onclick='tagKezel(" + i + ")'></td><td>" + felhasznalok[i].vezetekNev + "</td><td>" + felhasznalok[i].keresztNev + "</td><td>" + felhasznalok[i].nem + "</td><td>" + felhasznalok[i].szuletesiDatum + "</td><td>" + felhasznalok[i].szemelyiId + "</td><td>" + felhasznalok[i].telefonszam + "</td><td>" + felhasznalok[i].lakcim + "</td><td>" + felhasznalok[i].regisztracioDatum + "</td><td class='d-flex'><input type='button' class='btn btn-primary' value='👁️' onclick='megtekint(" + felhasznalok[i].id + ",true)'><input type='button' class='btn btn-info' value='✏️' onclick='modosit(" + i + ")'><input type='button' onclick='torlendo(" + i + ")' class='btn btn-danger' value='❌'></td></tr>";
                }
            }

            ertek += "</tbody></table>";
            tablazat.innerHTML = ertek;

            break;

        case "nev":

            const keresendoNev = kereso.value.split(" ");

            if (keresendoNev.length == 1) {
                for (let i = 0; i < felhasznalokszama; i++) {
                    if (felhasznalok[i].vezetekNev.toLowerCase().includes(keresendoNev[0].toLowerCase())) {
                        ertek += "<tr><td><input type='button' class='btn btn-success kezelGomb' value='💼' onclick='tagKezel(" + i + ")'></td><td>" + felhasznalok[i].vezetekNev + "</td><td>" + felhasznalok[i].keresztNev + "</td><td>" + felhasznalok[i].nem + "</td><td>" + felhasznalok[i].szuletesiDatum + "</td><td>" + felhasznalok[i].szemelyiId + "</td><td>" + felhasznalok[i].telefonszam + "</td><td>" + felhasznalok[i].lakcim + "</td><td>" + felhasznalok[i].regisztracioDatum + "</td><td class='d-flex'><input type='button' class='btn btn-primary' value='👁️' onclick='megtekint(" + felhasznalok[i].id + ",true)'><input type='button' class='btn btn-info' value='✏️' onclick='modosit(" + i + ")'><input type='button' onclick='torlendo(" + i + ")' class='btn btn-danger' value='❌'></td></tr>";
                    }
                    //console.log("xd");
                }

                ertek += "</tbody></table>";
                tablazat.innerHTML = ertek;

            } else if (keresendoNev.length == 2) {
                for (let i = 0; i < felhasznalokszama; i++) {
                    if (felhasznalok[i].vezetekNev.toLowerCase().includes(keresendoNev[0].toLowerCase())) {
                        if (keresendoNev[1] != "") {
                            if (felhasznalok[i].keresztNev.toLowerCase().includes(keresendoNev[1].toLowerCase())) {
                                ertek += "<tr><td><input type='button' class='btn btn-success kezelGomb' value='💼' onclick='tagKezel(" + i + ")'></td><td>" + felhasznalok[i].vezetekNev + "</td><td>" + felhasznalok[i].keresztNev + "</td><td>" + felhasznalok[i].nem + "</td><td>" + felhasznalok[i].szuletesiDatum + "</td><td>" + felhasznalok[i].szemelyiId + "</td><td>" + felhasznalok[i].telefonszam + "</td><td>" + felhasznalok[i].lakcim + "</td><td>" + felhasznalok[i].regisztracioDatum + "</td><td class='d-flex'><input type='button' class='btn btn-primary' value='👁️' onclick='megtekint(" + felhasznalok[i].id + ",true)'><input type='button' class='btn btn-info' value='✏️' onclick='modosit(" + i + ")'><input type='button' onclick='torlendo(" + i + ")' class='btn btn-danger' value='❌'></td></tr>";
                            }
                        } else {
                            ertek += "<tr><td><input type='button' class='btn btn-success kezelGomb' value='💼' onclick='tagKezel(" + i + ")'></td><td>" + felhasznalok[i].vezetekNev + "</td><td>" + felhasznalok[i].keresztNev + "</td><td>" + felhasznalok[i].nem + "</td><td>" + felhasznalok[i].szuletesiDatum + "</td><td>" + felhasznalok[i].szemelyiId + "</td><td>" + felhasznalok[i].telefonszam + "</td><td>" + felhasznalok[i].lakcim + "</td><td>" + felhasznalok[i].regisztracioDatum + "</td><td class='d-flex'><input type='button' class='btn btn-primary' value='👁️' onclick='megtekint(" + felhasznalok[i].id + ",true)'><input type='button' class='btn btn-info' value='✏️' onclick='modosit(" + i + ")'><input type='button' onclick='torlendo(" + i + ")' class='btn btn-danger' value='❌'></td></tr>";
                        }
                    }
                }
                ertek += "</tbody></table>";
                tablazat.innerHTML = ertek;
            } else if (keresendoNev.length == 3) {
                for (let i = 0; i < felhasznalokszama; i++) {
                    if (felhasznalok[i].vezetekNev.toLowerCase().includes(keresendoNev[0].toLowerCase())) {
                        if (keresendoNev[1] != "") {
                            if (felhasznalok[i].keresztNev.toLowerCase().includes(keresendoNev[1].toLowerCase())) {
                                if (keresendoNev[2] != "") {
                                    if (felhasznalok[i].utoNev.toLowerCase().includes(keresendoNev[2].toLowerCase())) {
                                        ertek += "<tr><td><input type='button' class='btn btn-success kezelGomb' value='💼' onclick='tagKezel(" + i + ")'></td><td>" + felhasznalok[i].vezetekNev + "</td><td>" + felhasznalok[i].keresztNev + "</td><td>" + felhasznalok[i].nem + "</td><td>" + felhasznalok[i].szuletesiDatum + "</td><td>" + felhasznalok[i].szemelyiId + "</td><td>" + felhasznalok[i].telefonszam + "</td><td>" + felhasznalok[i].lakcim + "</td><td>" + felhasznalok[i].regisztracioDatum + "</td><td class='d-flex'><input type='button' class='btn btn-primary' value='👁️' onclick='megtekint(" + felhasznalok[i].id + ",true)'><input type='button' class='btn btn-info' value='✏️' onclick='modosit(" + i + ")'><input type='button' onclick='torlendo(" + i + ")' class='btn btn-danger' value='❌'></td></tr>";
                                    }
                                } else {
                                    ertek += "<tr><td><input type='button' class='btn btn-success kezelGomb' value='💼' onclick='tagKezel(" + i + ")'></td><td>" + felhasznalok[i].vezetekNev + "</td><td>" + felhasznalok[i].keresztNev + "</td><td>" + felhasznalok[i].nem + "</td><td>" + felhasznalok[i].szuletesiDatum + "</td><td>" + felhasznalok[i].szemelyiId + "</td><td>" + felhasznalok[i].telefonszam + "</td><td>" + felhasznalok[i].lakcim + "</td><td>" + felhasznalok[i].regisztracioDatum + "</td><td class='d-flex'><input type='button' class='btn btn-primary' value='👁️' onclick='megtekint(" + felhasznalok[i].id + ",true)'><input type='button' class='btn btn-info' value='✏️' onclick='modosit(" + i + ")'><input type='button' onclick='torlendo(" + i + ")' class='btn btn-danger' value='❌'></td></tr>";
                                }
                            }
                        } else {
                            ertek += "<tr><td><input type='button' class='btn btn-success kezelGomb' value='💼' onclick='tagKezel(" + i + ")'></td><td>" + felhasznalok[i].vezetekNev + "</td><td>" + felhasznalok[i].keresztNev + "</td><td>" + felhasznalok[i].nem + "</td><td>" + felhasznalok[i].szuletesiDatum + "</td><td>" + felhasznalok[i].szemelyiId + "</td><td>" + felhasznalok[i].telefonszam + "</td><td>" + felhasznalok[i].lakcim + "</td><td>" + felhasznalok[i].regisztracioDatum + "</td><td class='d-flex'><input type='button' class='btn btn-primary' value='👁️' onclick='megtekint(" + felhasznalok[i].id + ",true)'><input type='button' class='btn btn-info' value='✏️' onclick='modosit(" + i + ")'><input type='button' onclick='torlendo(" + i + ")' class='btn btn-danger' value='❌'></td></tr>";
                        }
                    }
                    //console.log("xd");
                }

                ertek += "</tbody></table>";
                tablazat.innerHTML = ertek;
            }

            break;

        }

    }

}

function frissit() {
    felhasznalokszama = 0;
    lekerdez();
}

function modosit(azon) {
    modositando = felhasznalok[azon].id;
	
    var modositandoVezetekNev = document.querySelector("#modositandoVezetekNev");
    var modositandoKeresztNev = document.querySelector("#modositandoKeresztNev");
    var modositandoUtoNev = document.querySelector("#modositandoUtoNev");
    var modositandoNeme = document.querySelector("#modositandoNeme");
    var modositandoSzuletesiDatum = document.querySelector("#modositandoSzuletesiDatum");
    var modositandoSzemelyiId = document.querySelector("#modositandoSzemelyiId");
    var modositandoTelefonszam = document.querySelector("#modositandoTelefonszam");
    var modositandoLakcim = document.querySelector("#modositandoLakcim");
    var modositandoKartya = document.querySelector("#modositandoKartya");

    modositandoVezetekNev.value = felhasznalok[azon].vezetekNev;
    modositandoKeresztNev.value = felhasznalok[azon].keresztNev;
    modositandoUtoNev.value = felhasznalok[azon].utoNev;
    modositandoNeme.value = felhasznalok[azon].nem;
    modositandoSzuletesiDatum.value = felhasznalok[azon].szuletesiDatum;
    modositandoSzemelyiId.value = felhasznalok[azon].szemelyiId;
    modositandoTelefonszam.value = felhasznalok[azon].telefonszam;
    modositandoLakcim.value = felhasznalok[azon].lakcim;
    modositandoKartya.value = felhasznalok[azon].berletId;

    $('#modositandoFelhasznalo').modal('show');
}

function torlendo(azon) {
    torlendoFelhasznaloAzon = azon;
    torlendoFelhasznaloId = felhasznalok[azon].id;
    torlendoAblakCim.innerHTML = felhasznalok[azon].vezetekNev + " " + felhasznalok[azon].keresztNev + " törlése";
    $('#torlendoAblak').modal('show');
}

function magasabbRanguEngedely() {
    var valaszSzoveg = document.querySelector("#valaszSzoveg");
    var jelszo = document.querySelector("#torlendoAblakJelszo");

    const adatok = {
        kartya: jelszo.value
    };

    const kuldendo = JSON.stringify(adatok);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", link + "api/ellenorzes/magasabbRanguEngedely.php", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 202) {
                var megerosit = confirm("Tuti?");
                if (megerosit) {
                    $('#torlendoAblak').modal('hide');
                    torol(torlendoFelhasznaloId);
                } else {
                    $('#torlendoAblak').modal('hide');
                    $('#valasz').modal('hide');
                }
            } else {
                $('#torlendoAblak').modal('hide');
                torlendoAblakJelszo.style.border = "1px solid red";
                valaszCim.innerHTML = "Valami nem sikerült";
                valaszSzoveg.innerHTML = "Azonosítás sikertelen";
                setTimeout(function () {
                    $('#valasz').modal('show');
                }, 500)
            }
        }
    }
    xhr.send(kuldendo);
}

function torol(azon) {
    const adatok = {
        id: azon
    };

    const kuldendo = JSON.stringify(adatok);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", link + "api/tagok/torol.php", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 201) {
                $('#csomagmodositasa').modal('hide');
                valaszCim.innerHTML = "Minden sikerült";
                valaszSzoveg.innerHTML = "Sikeres törlés";
                setTimeout(function () {
                    $('#valasz').modal('show');
                }, 500)
                frissit();
                jelszo.value = "";
            } else {
                let data = xhr.response;
                $('#csomagmodositasa').modal('hide');
                valaszCim.innerHTML = "Valami nem sikerült";
                valaszSzoveg.innerHTML = "Sikertelen törlés<br>" + data;
                setTimeout(function () {
                    $('#valasz').modal('show');
                }, 500)
                jelszo.value = "";
            }
        }
    }
    xhr.send(kuldendo);
}

function ujTranzakcio(azon) {
    kie = felhasznalok[azon].id;
	
    var modositandoVezetekNev = document.querySelector("#modositandoVezetekNev");
    var modositandoKeresztNev = document.querySelector("#modositandoKeresztNev");

    modositandoVezetekNev.innerHTML = felhasznalok[azon].vezetekNev;
    modositandoKeresztNev.innerHTML = felhasznalok[azon].keresztNev;

    $('#ujtranzakcio').modal('show');
}

function kartyaOlvaso(){
	$('#kartyaOlvaso').modal({ //bug fix
		backdrop: 'static',
		keyboard: false
	})
	

}

function kartyaOlvasoBezarasa(){
	$('#kartyaOlvaso').modal('hide');
}

function ujfelhasznaloKartyaBezarasa(){
	$('#kartyaOlvaso').modal('hide');
}

//Események

var csomagBugFix=0;

	
function arKiirasa(){
	
mennyitFizet.placeholder=csomagok[csomag.selectedIndex].ar+" FT";

}


ujFelhasznaloFelvetel.onclick = () => {

	$('#ujfelhasznaloKartyaja').modal({ //bug fix
		backdrop: 'static',
		keyboard: false
	})

}


ujKartyaMegse.onclick = () => {
	hova="";
	$('#ujfelhasznaloKartyaja').modal('hide');
}


kartyaOlvasoBezar.onclick = () => {
	hova="";
    kartyaOlvasoBezarasa();
}

modositandoKartyaOlvaso.onclick = () => {
    hova = "modositandoFelhasznalo";
    $('#modositandoFelhasznalo').modal('hide');
	
	setTimeout(function () {
		kartyaOlvaso();
    }, 500)

}

ujKartyaOlvaso.onclick = () => {
    hova = "ujKartyaDiv";
    $('#ujfelhasznaloKartyaja').modal('hide');
	setTimeout(function () {
		kartyaOlvaso();
    }, 500)
}

torlendoKartyaOlvaso.onclick = () => {
    hova = "torlendoAblak";
    $('#torlendoAblak').modal('hide');
	setTimeout(function () {
		kartyaOlvaso();
    }, 500)
}


felhasznaloKulcsozasa.onclick = () => {
    $('#profilToltes').show();
    $('#profilKezelese').hide();
    $('#profilKezeleseAlja').hide();

    setTimeout(function () {
        $('#profilToltes').hide();
        $('#profilKulcsozasa').show();
    }, 500)
}

ujTranzakcioGomb.onclick = () => {
    $('#beolvasottFelhasznalo').modal('hide');
    setTimeout(function () {
        kezelosVasarlasUtan = true;
		csomag.selectedIndex = "0";
		mennyitFizet.placeholder=csomagok[0].ar+" FT";
        ujTranzakcio(legutobbiFelhasznalo);
    }, 500)
}

felhasznaloBeleptet.onclick = () => {

    $('#profilKulcsozasa').hide();
    $('#profilToltes').show();

    const adatok = {
        ki: legutobbiFelhasznaloAdatbazisId,
        mit: 1,
        kulcs: kulcsId.value
    };

    const kuldendo = JSON.stringify(adatok);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", link + "api/forgalom/hozzaad.php", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 201) {
                felhasznaloBeleptet.disabled = true;
                setTimeout(function () {
                    $('#profilToltes').hide();
                    profilValaszSzoveg.innerHTML = "Sikeres beléptetés!";
                    profilValaszSzoveg.classList.remove("text-danger");
                    profilValaszSzoveg.classList.add("text-success");
                    $('#profilValasz').show();
                }, 500)
            } else {
                setTimeout(function () {
                    $('#profilToltes').hide();
                    profilValaszSzoveg.innerHTML = "Sikertelen beléptetés!";
                    profilValaszSzoveg.classList.remove("text-success");
                    profilValaszSzoveg.classList.add("text-danger");
                    $('#profilValasz').show();
                }, 500)
            }
        }
    }
    xhr.send(kuldendo);
}

felhasznaloKileptet.onclick = () => {

    $('#profilToltes').show();
    $('#profilValasz').hide();
    $('#profilKulcsozasa').hide();
    $('#profilKezelese').hide();
    $('#profilKezeleseAlja').hide();

    const adatok = {
        ki: legutobbiFelhasznaloAdatbazisId,
        mit: 0
    };

    const kuldendo = JSON.stringify(adatok);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", link + "api/forgalom/hozzaad.php", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 201) {
                felhasznaloKileptet.disabled = true;
                setTimeout(function () {
                    $('#profilToltes').hide();
                    profilValaszSzoveg.innerHTML = "Sikeres kiléptetés!";
                    profilValaszSzoveg.classList.remove("text-danger");
                    profilValaszSzoveg.classList.add("text-success");
                    $('#profilValasz').show();
                }, 500)

            } else {
                felhasznaloKileptet.disabled = true;
                setTimeout(function () {
                    $('#profilToltes').hide();
                    profilValaszSzoveg.innerHTML = "Sikeres kiléptetés!";
                    profilValaszSzoveg.classList.remove("text-danger");
                    profilValaszSzoveg.classList.add("text-success");
                    $('#profilValasz').show();
                }, 500)
            }
        }
    }
    xhr.send(kuldendo);
}

kulcsLeadasGomb.onclick = () => {
    forgalomLekerdez(kulcsLeadasId.value, "kulcs");
	
    setTimeout(function () {
        $('#profilValasz').hide();
        if (belepesekSzama != 0) {
            var kezelendo = belepesek[belepesekSzama - 1].ki;
			
            for (let i = 0; i < felhasznalokszama; i++) {
                if (felhasznalok[i].id == kezelendo) {
                    $('#kulcsLeadas').modal('hide');
                    beolvasottProfilBeallit(felhasznalok[i].berletId);
                    break;
                }
            }
        } else {
            $('#kulcsLeadas').modal('hide');
            alert("Valami nem jó");
        }
    }, 500)
}

torlendoAblakEllenorizGomb.onclick = () => {
    if (torlendoFelhasznaloId != -1 && torlendoFelhasznaloAzon != -1) {
        magasabbRanguEngedely()
    }
}

modositMent.onclick = () => {

    var modositandoVezetekNev = document.querySelector("#modositandoVezetekNev");
    var modositandoKeresztNev = document.querySelector("#modositandoKeresztNev");
    var modositandoUtoNev = document.querySelector("#modositandoUtoNev");
    var modositandoNeme = document.querySelector("#modositandoNeme");
    var modositandoSzuletesiDatum = document.querySelector("#modositandoSzuletesiDatum");
    var modositandoSzemelyiId = document.querySelector("#modositandoSzemelyiId");
    var modositandoTelefonszam = document.querySelector("#modositandoTelefonszam");
    var modositandoLakcim = document.querySelector("#modositandoLakcim");
    var modositandoKartya = document.querySelector("#modositandoKartya");

    const adatok = {
        id: modositando,
        modositandoVezetekNev: modositandoVezetekNev.value,
        modositandoKeresztNev: modositandoKeresztNev.value,
        modositandoUtoNev: modositandoUtoNev.value,
        modositandoNeme: modositandoNeme.value,
        modositandoSzuletesiDatum: modositandoSzuletesiDatum.value,
        modositandoSzemelyiId: modositandoSzemelyiId.value,
        modositandoTelefonszam: modositandoTelefonszam.value,
        modositandoLakcim: modositandoLakcim.value,
        modositandoKartya: modositandoKartya.value
    };

    const kuldendo = JSON.stringify(adatok);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", link + "api/tagok/modosit.php", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 201) {
                $('#modositandoFelhasznalo').modal('hide');
                valaszCim.innerHTML = "Minden sikerült";
                valaszSzoveg.innerHTML = "Sikeres felhasználó módosítás";
                setTimeout(function () {
                    $('#valasz').modal('show');
                    frissit();
                }, 500)
            } else {
                let data = xhr.response;
                $('#modositandoFelhasznalo').modal('hide');
                valaszCim.innerHTML = "Valami nem sikerült";
                valaszSzoveg.innerHTML = "Sikertelen felhasználó módosítás<br>" + data;
                setTimeout(function () {
                    $('#valasz').modal('show');
                }, 500)
            }
        }
    }
    xhr.send(kuldendo);
}

ujKartyaMentGomb.onclick = () => {
    hova="";
	$('#ujfelhasznaloKartyaja').modal('hide');
    setTimeout(function () {
		$('#ujfelhasznalo').modal({ //bug fix
			backdrop: 'static',
			keyboard: false
		})
    }, 500)
}

ujMentesMegse.onclick = () => {
	hova="";
	$('#ujfelhasznalo').modal('hide');
}
ujMent.onclick = () => {
	hova="";
    var ujKartya = document.querySelector("#ujKartya");
    var ujVezetekNev = document.querySelector("#ujVezetekNev");
    var ujKeresztNev = document.querySelector("#ujKeresztNev");
    var ujUtoNev = document.querySelector("#ujUtoNev");
    var ujNeme = document.querySelector("#ujNeme");
    var ujszuletesiDatum = document.querySelector("#ujszuletesiDatum");
    var ujSzemelyiId = document.querySelector("#ujSzemelyiId");
    var ujTelefonszam = document.querySelector("#ujTelefonszam");
    var ujLakcim = document.querySelector("#ujLakcim");

    const adatok = {
        ujKartya: ujKartya.value,
        ujVezetekNev: ujVezetekNev.value,
        ujKeresztNev: ujKeresztNev.value,
        ujUtoNev: ujUtoNev.value,
        ujNeme: ujNeme.value,
        ujszuletesiDatum: ujszuletesiDatum.value,
        ujSzemelyiId: ujSzemelyiId.value,
        ujTelefonszam: ujTelefonszam.value,
        ujLakcim: ujLakcim.value
    };

    const kuldendo = JSON.stringify(adatok);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", link + "api/tagok/hozzaad.php", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 201) {
                $('#ujfelhasznalo').modal('hide');
                valaszCim.innerHTML = "Minden sikerült";
                valaszSzoveg.innerHTML = "Sikeres hozzáadás";
                setTimeout(function () {
                    $('#valasz').modal('show');
                }, 500)
                frissit();
            } else {
                let data = xhr.response;
                const valasz = JSON.parse(data);
                $('#ujfelhasznalo').modal('hide');
                valaszCim.innerHTML = "Valami nem sikerült";
                valaszSzoveg.innerHTML = valasz.valasz;
                setTimeout(function () {
                    $('#valasz').modal('show');
                }, 500)
            }
        }
    }
    xhr.send(kuldendo);
}

tranzakcioDivVissza.onclick = () => {
    tranzakcioDiv.style.display = "none";
    felhasznaloDiv.style.display = "block";
}

ujTranzakcioMentes.onclick = () => {
    const adatok = {
        mit: csomag.value,
        ki: kie,
        mennyit: mennyitFizet.value,
        leiras: leiras.value
    };
    const kuldendo = JSON.stringify(adatok);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", link + "api/tranzakciok/hozzaad.php", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 201) {
                $('#ujtranzakcio').modal('hide');
                frissit();
                if (kezelosVasarlasUtan) {
                    setTimeout(function () {
                        beolvasottProfilBeallit(legutobbiFelhasznaloBerlete);
                    }, 500)
                    kezelosVasarlasUtan = false; //nullázás
                } else {
                    valaszCim.innerHTML = "Minden sikerült";
                    valaszSzoveg.innerHTML = "Sikeres hozzáadás";
                    setTimeout(function () {
                        $('#valasz').modal('show');
                    }, 500)
                }
            } else {
                let data = xhr.response;
                const valasz = JSON.parse(data);
                $('#ujtranzakcio').modal('hide');
                valaszCim.innerHTML = "Valami nem sikerült";
                valaszSzoveg.innerHTML = valasz.valasz;
                setTimeout(function () {
                    $('#valasz').modal('show');
                }, 500)
            }
        }
    }
    xhr.send(kuldendo);
}

ujKartya.addEventListener('input', (event) => {
    if (ujKartya.value != "") {
        ujKartyaMentes.disabled = false;
    } else {
        ujKartyaMentes.disabled = true;
    }
});

kulcsId.addEventListener('input', (event) => {
    if (kulcsId.value != "") {
        felhasznaloBeleptet.disabled = false;
    } else {
        felhasznaloBeleptet.disabled = true;
    }
});

kulcsLeadasId.addEventListener('input', (event) => {
    if (kulcsLeadasId.value != "") {
        kulcsLeadasGomb.disabled = false;
    } else {
        kulcsLeadasGomb.disabled = true;
    }
});

kereso.addEventListener('input', (event) => {
    if (kereso.value != "") {
        csomaglista.value = "osszes";
        csomaglista.disabled = true;
    } else {
        csomaglista.value = legutobbiCsomagListaAllapot;
        csomaglista.disabled = false;
    }
    kiir();
});

csomaglista.addEventListener('change', (event) => {
    legutobbiCsomagListaAllapot = csomaglista.value;
    kiir();
});

keresesAlapja.addEventListener('change', (event) => {
    kiir();
});