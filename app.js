function $(id) { 
	return document.getElementById(id);
}

window.onload = function(){
	$("search").onclick = function(){ 
		alert("The search begins!");
	}
}