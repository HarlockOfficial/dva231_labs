"use strict";

$("#change-news").submit(function(event){
	event.preventDefault();
	var jsonFileName= $("#change-news").find("input[type=text]").val();
	if(jsonFileName.length>0){
		if(!jsonFileName.endsWith(".json")){
				jsonFileName+=".json";
				$("#change-news").find("input[type=text]").val(jsonFileName);
		}
		if(!(jsonFileName.includes("/") || jsonFileName.includes("..") || jsonFileName.includes(":"))){		
			event.currentTarget.submit();
			return true;
		}else{
			alert("Invalid Filename");
		}
	}
	alert("Invalid Filename");
	return false;
});
