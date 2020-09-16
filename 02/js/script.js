"use strict";

const title=["Nulla ultricies","Integer ullamcorper","Quisque vel consectetur"];
const content=["Nulla lacinia quam enim, a porttitor felis sagittis id",
			"Quisque consequat id quam non molestie. Sed nunc orci hendrerit vitae dui",
			"Suspendisse efficitur mi quis nibh congue, at fermentum ex eleifend"];
var div;

$(window).scroll(function(){
	if($(window).scrollTop()>0){
		$("#navbar").css("position","sticky").css("top","0");
	}else{
		$("#navbar").removeAttr("style");
	}
});

function createTopNews(i,start){
	let img="img/park"+(i+1)+".jpg";
	div=$("<div />",{
			"class":"default-column column-four card-content img-container right-zero",
			css: {
				backgroundImage:"url('"+img+"')"
			}
	});
	let baseTitle=$("<h4 />",{
		"class":"opacity-60 text-white bottom-zero top-zero first",
		text:title[i]
	});
	let baseP=$("<p />",{
		"class":"opacity-60 bottom-zero top-zero",
		text:content[i]
	});
	$(div).append(baseTitle).append(baseP);
	if(!start){
		$(div).width(0);
	}
	$("#top-news").append(div);
	setTimeout(changeTopNews,30000,(i+1)%3);
}
function changeTopNews(i){
	$(div).animate({
		width:0,
		opacity:0
	},2000,function(){
		$(this).remove();
	});
	createTopNews(i,false);
	$(div).animate({
		width:"100%",
		opacity:"100%"
	},2000);
}
createTopNews(0,true);

$("#other-news").hover(function(){
		$("#other-news-title").height("0%").css("color","transparent");
		$("#other-news").width("100%").height("100%").fadeTo(0,1).css("overflow-y", "scroll")
			.append("<p id='added-news'>Fusce eros mauris, luctus a nunc in enim. Nullam sit amet ante placerat, consequat mi vel, finibus ex. Maecenas non diam ut mauris auctor tempus. In vestibulum, nulla et rutrum dapibus, eros mauris malesuada. Cras fermentum lorem eros, sit amet suscipit metus dictum sit amet.</p>");
	},function(){
		$("#other-news-title").prop("style",null);
		$("#other-news").prop("style",null);
		$("#added-news").remove();
});

$("#img4").click(function(){
	$("#img4").html("<iframe width='100%' height='100%' src='https://www.youtube.com/embed/2OEL4P1Rz04' frameborder='0' allow='autoplay; encrypted-media;' allowfullscreen='allowfullscreen'></iframe>");
});