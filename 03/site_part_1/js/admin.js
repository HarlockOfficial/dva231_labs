"use strict";

$("#json-file-btn").click(function(){
	$("#json-file").click();
});

$("#image-file-btn").click(function(){
	$("#image-file").click();
});

$("#image-mission-btn").click(function(){
	$("#image-mission").click();
});
function isEmpty(arr, excluded){
	var ret=true;
	$.each(arr,function(key, value){
		if($.inArray(key,excluded)===-1 && value!==''){
			ret = false;
		}
	});
	return ret;
}

function isNotEmpty(arr, keys){
	var ret=true;
	$.each(keys,function(key,value){
		if(arr[value].length<=0){
			ret = false;
		}
	});
	return ret;
}

$("input[type=submit]").click(function(){
	var page={
		'jsonFileName': $("#change-news").find("input[type=text]").val(),
		'jsonFile': $("#change-news").find("input[type=file]").val(),
		'newsTitle': $("#raw-news").find("input[type=text]").val(),
		'newsImage': $("#raw-news").find("input[type=file]").val(),
		'newsContent': $("#raw-news").find("textarea").eq(0).val(),
		'newsExtendedContent': $("#raw-news").find("textarea").eq(1).val(),
		'eventAction': $("#raw-event").find("input[type=text]").val(),
		'eventDate': $("#raw-event").find("input[type=date]").val(),
		'eventContent': $("#raw-event").find("textarea").val(),
		'missionTitle': $("#raw-mission").find("input[type=text]").eq(0).val(),
		'missionImage': $("#raw-mission").find("input[type=file]").val(),
		'missionAction': $("#raw-mission").find("input[type=text]").eq(1).val(),
		'missionDate': $("#raw-mission").find("input[type=date]").val(),
		'missionContent': $("#raw-mission").find("textarea").eq(0).val(),
		'missionLinks': $("#raw-mission").find("textarea").eq(1).val()
	};
	if(page['jsonFileName'].length>0 && isEmpty(page,['jsonFileName'])){
		if(!page['jsonFileName'].endsWith(".json")){
				page['jsonFileName']+=".json";
		}
		
		if(!(page['jsonFileName'].includes("/") || page['jsonFileName'].includes("..") || 
					page['jsonFileName'].includes(":"))){		
			$.ajax({
				url: "php/changeNews.php",
				data: {
					fileName: page['jsonFileName']
				},
				method: "put",
				statusCode:{
					200: function(){
						window.location="./index.html";
					},
					404: function(){
						alert("File NOT Found try Again")
					},
					405: function(){
						alert("Request Method Error"); //impossible
					}
				}
			});
		}
	}else if(page['jsonFile'].length>0 && isEmpty(page,['jsonFile'])){
		if(!page['jsonFile'].endsWith(".json")){
			alert("select a JSON file");
			return;
		}
		var fr = new FileReader();
		fr.onload=function(){
			$.ajax({
				url: "php/changeNews.php",
				data: {
					fileJson: fr.result
				},
				method: "put",
				statusCode:{
					200: function(){
						window.location="./index.html";
					},
					405: function(){
						alert("Request Method Error"); //impossible
					},
					406: function(){
						alert("File Not Acceptable");
					}
				}
			});
		}
		fr.readAsText($("#change-news").find("input[type=file]").prop("files")[0]);
	}else if(isEmpty(page,['newsTitle','newsImage','newsContent','newsExtendedContent']) &&
			isNotEmpty(page,['newsTitle','newsImage','newsContent'])){
		var fr= new FileReader();
		if(page['newsExtendedContent'].length<=0){
			fr.onload=function(){
				var ext=page['newsImage'].split(".");
				ext=ext[ext.length-1];
				$.ajax({
					url: "php/changeNews.php",
					data: {
						title:page['newsTitle'],
						content:page['newsContent'],
						imgExt: ext,
						img: fr.result
					},
					method: "put",
					statusCode:{
						200: function(){
							window.location="./index.html";
						},
						405: function(){
							alert("Request Method Error"); //impossible
						}
					}
				});
			}
		}else{
			fr.onload=function(){
				var ext=page['newsImage'].split(".");
				ext=ext[ext.length-1];
				$.ajax({
					url: "php/changeNews.php",
					data: {
						title:page['newsTitle'],
						content:page['newsContent'],
						extraContent: page['newsExtendedContent'],
						imgExt: ext,
						img: fr.result
					},
					method: "put",
					statusCode:{
						200: function(){
							window.location="./index.html";
						},
						405: function(){
							alert("Request Method Error"); //impossible
						}
					}
				});
			}
		}
		fr.readAsDataURL($("#raw-news").find("input[type=file]").prop("files")[0]);
	}else if(page['eventContent'].length>0 && isEmpty(page, ['eventAction','eventDate','eventContent'])){
		$.ajax({
			url: "php/changeNews.php",
			data: {
				eventAction: page['eventAction'],
				eventDate: page['eventDate'],
				eventContent: page['eventContent']
			},
			method: "put",
			statusCode:{
				200: function(){
					window.location="./index.html";
				},
				405: function(){
					alert("Request Method Error"); //impossible
				}
			}
		});
	}else if(isEmpty(page,['missionTitle','missionAction','missionContent','missionDate','missionImage','missionLinks']) && 
			isNotEmpty(page,['missionTitle','missionAction','missionContent','missionDate','missionImage','missionLinks'])){
		var links={};
		$.each(page['missionLinks'].split(/\r?\n/),function(key,value){
			let tmp=value.split(",");
			links[tmp[0]]=tmp[1];
		});
		var ext=page['missionImage'].split(".");
		ext=ext[ext.length-1];
		
		var fr = new FileReader();
		fr.onload=function(){
			$.ajax({
				url: "php/changeNews.php",
				data: {
					missionTitle: page['missionTitle'],
					missionAction: page['missionAction'],
					missionContent: page['missionContent'],
					missionDate: page['missionDate'],
					missionLinks: links,
					imgExt: ext,
					img: fr.result
				},
				method: "put",
				statusCode:{
					200: function(){
						window.location="./index.html";
					},
					405: function(){
						alert("Request Method Error"); //impossible
					},
					406: function(){
						alert("File Not Acceptable");
					}
				}
			});
		}
		fr.readAsDataURL($("#raw-mission").find("input[type=file]").prop("files")[0]);
	}else{
		alert("error, forms not correctly filled");
	}
});
