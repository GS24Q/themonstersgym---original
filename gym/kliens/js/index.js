
var jelenlegiIdoDiv = document.querySelector("#jelenlegiIdo");

var idozito = setInterval(jelenlegiIdo, 1000);

function jelenlegiIdo() {
	
    var datum = new Date();
    var ora = datum.getHours();
    var perc = datum.getMinutes();
    var masodperc = datum.getSeconds();

    var ido = "";
    ido = ora + ":";

    if (perc < 10) {
        ido += "0" + perc + ":";

    } else {
        ido += perc + ":";
    }

    if (masodperc < 10) {
        ido += "0" + masodperc;

    } else {
        ido += masodperc;
    }

    jelenlegiIdoDiv.innerHTML = ido;

}
