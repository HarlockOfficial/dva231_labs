"use strict";

$("#login-form").submit(function(event){
	event.preventDefault();
	$("span").hide();
	var username=$("#login-form").find("input[type=text]").val();
	if(username.length<=0){
		$("#username-error").show();
		return;
	}
	if($("#login-form").find("input[type=password]").val().length<8 || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])$/.test($("#login-form").find("input[type=password]").val())){
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
		method: "post",
		statusCode:{
			200: function(){
				window.location="./admin.php";
			},
			401: function(){
				alert("You Entered Incorrect Credentials")
			},
			405: function(){
				alert("Request Method Error");
			}
		}
	});
});
