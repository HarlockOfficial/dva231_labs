"use strict";

$("#login-form").submit(function(event){
	event.preventDefault();
	$("span").hide();
	var username=$("#login-form").find("input[type=text]").val();
	if(username.length<=0){
		$("#username-error").show();
		return;
	}
	if($("#login-form").find("input[type=password]").val().length<=0){
		$("#password-error").show();
		return;
	}
	var password=md5($("#login-form").find("input[type=password]").val());
	$.ajax({
		url: "php/login.php",
		data: {
			username: username,
			password: password
		},
		method: "get",
		statusCode:{
			200: function(){
				window.location="./admin.php";
			},
			405: function(){
				alert("Request Method Error");
			}
		},
	});
});
