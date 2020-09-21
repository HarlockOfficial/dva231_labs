"use strict";

$("#login-form").submit(function(event){
	event.preventDefault();
	$("span").hide();
	var username=$("#login-form").find("input[type=text]").val();
	if(username.length<=0){
		$("#username-error").show();
		return false;
	}
	if($("#login-form").find("input[type=password]").val().length<=0){
		$("#password-error").show();
		return false;
	}
	var password=md5($("#login-form").find("input[type=password]").val());
	$("#login-form").find("input[type=password]").val(password);
	event.currentTarget.submit();
});
