function ujSuti(nev, ertek, lejaratiNapok) {
    const datum = new Date();
    datum.setTime(datum.getTime() + (lejaratiNapok * 24 * 60 * 60 * 1000));
    let lejar = "expires=" + datum.toUTCString();
    document.cookie = nev + "=" + ertek + ";" + lejar + ";path=/";
}

function sutiLeker(nev) {
    let sutiNev = nev + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(sutiNev) == 0) {
            return c.substring(sutiNev.length, c.length);
        }
    }
    return "";
}

function sutiModosit(mit, mire) {
    ujSuti(mit, mire, 365);
}

function sutiEllenoriz(melyiket, mire) {
    let ellenorizendoSuti = sutiLeker(melyiket);
    if (ellenorizendoSuti != "") { //ha nem üres a süti
        if (ellenorizendoSuti == mire) {
            return true
        } else {
            return true;
        }
    } else {
        return null;
    }
}
