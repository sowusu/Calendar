


$(document).ready(function(){
	alert("login.js works!");

});

$("#logout_id").click(function(){
	$("#username").val("");
	$("#password").val("");
	$("#login-box").toggle();
	$("#logout-box").toggle();
	current_user = "";
	alert("Current user is: " + current_user);

	
});

$("#login_id").click(function(){


	if ($("#username").val() === "" ||  $("#password").val() === ""){
		alert("Please make sure both the username and password fields are filled!");
	}
	else{
		//log the user in.

		$.ajax({url:"validate.php",
			type : "POST",
			data : {"op": "ENTER",
					"username": $("#username").val(),
					"password": $("#password").val()
					},
			success: function (result){
				if (result.success){
					//alert(result.message);
					$("#login-box").toggle();
					$("#logout-box").toggle();
					current_user = $("#username").val();
					alert("Current user is: " + current_user);
				}
				else{
					if ($("#login-error").text() == ""){
						$("#login-error").text(result.message);
					$("#login-error").toggle("slow");
					setTimeout(function(){
						$("#login-error").toggle("slow");
						$("#login-error").text("");
						}, 3000);
					}
					
				}
			}



		})


	}
});

$("#sign_id").click(function(){


	if ($("#username").val() === "" ||  $("#password").val() === ""){
		alert("Please make sure both the username and password fields are filled!");
	}
	else{
		//sign the user up.

		$.ajax({url:"validate.php",
			type : "POST",
			data : {"op": "SIGN UP",
					"username": $("#username").val(),
					"password": $("#password").val()
					},
			success: function (result){
				if (result.success){
					if ($("#login-error").text() == ""){
						$("#login-error").text(result.message);
						$("#login-error").toggle("slow");
						setTimeout(function(){
							$("#login-error").toggle("slow");
							$("#login-error").text("");
							}, 3000);
					}
				}
				else{
					if ($("#login-error").text() == ""){
						$("#login-error").text(result.message);
					$("#login-error").toggle("slow");
					setTimeout(function(){
						$("#login-error").toggle("slow");
						$("#login-error").text("");
						}, 3000);
					}
					
				}
			}



		})


	}
});



