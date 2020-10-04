"use strict";

$(window).scroll(function(){
	if($(window).scrollTop()>0){
		$("#navbar").css("position","sticky").css("top","0");
	}else{
		$("#navbar").removeAttr("style");
	}
});

var div, news=[],addedNews;
$.getJSON("php/news.php",function(data){
	news=data['news'];
	createTopNews(0,true);
	$("#img2").css("background-image","url("+data['small_news']['imgurl']+")");
	$("#other-news-title").text(data['small_news']['title']);
	$("#other-news").text(data['small_news']['content']);
	addedNews=data['small_news']['extended_content'];
});

$.getJSON("php/events.php",function(data){
	$("#events-content").append(data);
});

$.getJSON("php/missions.php",function(data){
	$("#img3").css("background-image","url("+data['imgurl']+")");
	$("#mission-title").text(data['title']);
	$("#mission-content").html(data['content']);
	$("#mission-links").html(data['links']);
});

$("#go-to-admin-btn").click(function(){
	window.location="login.php";
});
function createTopNews(i,start){
	div=$("<div />",{
			"class":"default-column column-four card-content img-container right-zero",
			css: {
				backgroundImage:"url('"+news[i]['imgurl']+"')"
			}
	});
	let baseTitle=$("<h4 />",{
		"class":"opacity-60 text-white bottom-zero top-zero first",
		text:news[i]['title']
	});
	let baseP=$("<p />",{
		"class":"opacity-60 bottom-zero top-zero",
		text:news[i]['content']
	});
	$(div).append(baseTitle).append(baseP);
	if(!start){
		$(div).width(0);
	}
	$("#top-news").append(div);
	setTimeout(changeTopNews,30000,(i+1)%news.length);
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

$("#img2").hover(function(){
		$("#other-news-title").height("0%").css("color","transparent");
		$("#other-news").width("100%").height("100%").fadeTo(0,1).css("overflow-y", "scroll")
			.append("<p id='added-news'>"+addedNews+"</p>");
	},function(){
		$("#other-news-title").prop("style",null);
		$("#other-news").prop("style",null);
		$("#added-news").remove();
});

$("#img4").click(function(){
	$("#img4").html("<iframe width='100%' height='100%' src='https://www.youtube.com/embed/2OEL4P1Rz04' frameborder='0' allow='autoplay; encrypted-media;' allowfullscreen='allowfullscreen'></iframe>");
});
