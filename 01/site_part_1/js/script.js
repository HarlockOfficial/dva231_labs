"use strict";
var navbar=document.getElementById("navbar");
window.addEventListener("scroll",function(event){
	if(window.scrollY>2){
		navbar.style.position="sticky";
		navbar.style.top="0";
	}else{
		navbar.removeAttribute("style");
	}
});