var menuNyito=document.querySelector("#menuNyito");
var menu=document.querySelector("#oldalso-sav");
var menuNyitva=false;
var jelenlegiIdoDiv=document.querySelector("#jelenlegiIdo");

var idozito = setInterval(jelenlegiIdo, 1000);

menuNyito.addEventListener("click", function() {
  if(menuNyitva){
	  menuNyitva=false;
	  menuCsuk();
  }else{
	  menuNyitva=true;
	  menuNyit();
  }
  
});

function menuNyit(){menu.style.display="block";}
function menuCsuk(){menu.style.display="none";}


function jelenlegiIdo(){
	var today = new Date();
	var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
	var dateTime = time;
	jelenlegiIdoDiv.innerHTML=time;
}

