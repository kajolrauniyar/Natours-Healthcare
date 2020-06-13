function loginForm(){
	var login =document.getElementById("login").value;
	var password=document.getElementById("password").value;
	var login_check=/^[a-zA-Z_.]{2,20}@[a-zA-Z]{2,20}[.]{1}[a-zA-Z.]{2,6}$/;
	var password_check=/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
	if(login_check.test(login)){
		document.getElementById("loginerror").innerHTML="";
		document.getElementById("login").focus();
	}else if(login=""){
		document.getElementById("loginerror").innerHTML="login Id Is Required";
		document.getElementById("login").focus();
		return false;
	}
	else{
		document.getElementById("loginerror").innerHTML="Login Id is invalid";
		document.getElementById("login").focus();
		return false;
	}
	//password
	if(password_check.test(password)){
		document.getElementById("passworderror").innerHTML="";
		document.getElementById("password").focus();
	}else if(password=""){
		document.getElementById("passworderror").innerHTML="Password  Is Required";
		document.getElementById("password").focus();
		return false;
	}
	else{
		document.getElementById("passworderror").innerHTML="Password contains atleast one number alpha and special symbol minimun 8 characters required";
		document.getElementById("password").focus();
		return false;
	}
}