"use strict";

$("#change-news").submit(function(event){
	event.preventDefault();
	var jsonFileName= $("#change-news").find("input[type=text]").val();
	if(jsonFileName.length>0){
		if(!jsonFileName.endsWith(".json")){
				jsonFileName+=".json";
		}
		
		if(!(jsonFileName.includes("/") || jsonFileName.includes("..") || jsonFileName.includes(":"))){		
			$.ajax({
				url: "php/changeNews.php",
				data: {
					fileName: jsonFileName
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
	}
});
