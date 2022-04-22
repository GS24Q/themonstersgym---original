var menuNyito = document.querySelector("#menuNyito");
var menu = document.querySelector("#oldalso-sav");
var elem = document.querySelector(".elem");
var menuNyitva = false;

menuNyito.addEventListener("click", function () {
	
    if (menuNyitva) {
        menuNyitva = false;
        menuCsuk();
    } else {
        menuNyitva = true;
        menuNyit();
    }

});

function menuNyit() {

    var elemek = document.getElementsByClassName("elem");
    var elemKepek = document.getElementsByClassName("elemKep");

    if (screen.width <= 450) {

        menu.style.width = "100%";
        for (var i = 0; i < elemek.length; i++) {
            elemek[i].style.display = "flex";
            elemKepek[i].style.display = "none";
            elemek[i].style.justifyContent = "center";
        }

    } else {

        menu.style.width = "200px";
        for (var i = 0; i < elemek.length; i++) {
            elemek[i].style.justifyContent = "left";
            elemKepek[i].style.display = "block";

        }

    }
    setTimeout(function () {

        for (var i = 0; i < elemek.length; i++) {
            elemek[i].style.display = "flex";
        }

    }, 500)
}
function menuCsuk() {

    menu.style.width = "0px";
    setTimeout(function () {
        var elemek = document.getElementsByClassName("elem");
        for (var i = 0; i < elemek.length; i++) {
            elemek[i].style.display = "none";
        }
    }, 100)

}
