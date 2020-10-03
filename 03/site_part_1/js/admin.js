"use strict";

$("#json-file-btn").click(function(){
	$("#json-file").click();
});

$("#image-file-btn").click(function(){
	$("#image-file").click();
});
function isEmpty(arr, key){
	for(var k in arr){
		if(arr[k]!=='' && $.inArray(k,key)!==-1 ){
			return false;
		}
	}
	return true;
}

$("input[type=submit]").click(function(){
	var page={
		'jsonFileName': $("#change-news").find("input[type=text]").val(),
		'jsonFile': $("#change-news").find("input[type=file]").val(),/*.prop("files");*/
		'newsTitle': $("#raw-news").find("input[type=text]").val(),
		'newsImage': $("#raw-news").find("input[type=file]").val(),/*.prop("files");*/
		'newsContent': $("#raw-news").find("textarea").eq(0).val(),
		'newsExtendedContent': $("#raw-news").find("textarea").eq(1).val(),
		'missionAction': $("#raw-mission").find("input[type=text]").val(),
		'missionDate': $("#raw-mission").find("input[type=date]").val(),
		'missionContent': $("#raw-mission").find("textarea").val()
	};
	if(page['jsonFileName'].length>0 && isEmpty(page,['jsonFileName'])){
		if(!page['jsonFileName'].endsWith(".json")){
				page['jsonFileName']+=".json";
		}
		
		if(!(page['jsonFileName'].includes("/") || page['jsonFileName'].includes("..") || page['jsonFileName'].includes(":"))){		
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
				},
			});
		}
	}else if(page['jsonFile'].length>0 && isEmpty(page,['jsonFile'])){
		//make ajax put request with json file
	}else if(page['newsTitle'].length>0 && isEmpty(page,['newsTitle','newsImage','newsContent','newsExtendedContent'])){
		if(page['newsExtendedContent'].length<=0){
			//make ajax put request for news
		}else{
			//make ajax put request for small_news
		}
	}else if(page['missionAction'].length>0 && isEmpty(page, ['missionAction','missionDate','missionContent'])){
		//make ajax put request for mission
	}else{
		alert("error, forms not correctly filled");
	}
});
