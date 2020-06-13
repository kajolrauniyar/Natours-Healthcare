function ContactForm(){
	var name =document.getElementById("name").value;
	var email=document.getElementById('email').value;	
	var address=document.getElementById('address').value;
	var mobile=document.getElementById('mobile').value;
	var comment=document.getElementById('comment').value;

	/*pattern check*/
	var name_check=/^[a-zA-Z_.]{2,20}$/;
	var address_check=/^[a-zA-Z0-9., ]{3,}$/;
	var mobile_check=/^[6789]{1}[0-9]{9}$/;
	var email_check=/^[a-zA-Z0-9_]{3,30}@[1-zA-Z0-9]{2,20}[.]{1}[a-zA-Z.]{2,8}$/;
	var comment_check=/^[a-zA-Z0-9., ]{3,}$/;
	/*name  validation check*/
	if(name_check.test(name)){
		document.getElementById("nameerror").innerHTML="";
		document.getElementById("name").focus();
	}else if(name==""){
		document.getElementById("nameerror").innerHTML="name Id Is Required";
		document.getElementById("name").focus();
		return false;
	}
	else{
		document.getElementById("nameerror").innerHTML="name Id is invalid";
		document.getElementById("name").focus();
		return false;
	}
	//Email validation check
	if(email_check.test(email)){
		document.getElementById('emailerror').innerHTML=" ";
		document.getElementById('email').focus();
	}else if(email==""){
		document.getElementById("emailerror").innerHTML="*email is Required";
		document.getElementById('email').focus();
		return false;
	}else{
		document.getElementById("emailerror").innerHTML="email is invalid";
		document.getElementById("email").focus();
		return false;
	}
	//permanent Address validation check
	if(address_check.test(address)){
		document.getElementById('addresserror').innerHTML=" ";
		document.getElementById('address').focus();
	}else if(address==""){
		document.getElementById("addresserror").innerHTML="*Address is Required";
		document.getElementById('address').focus();
		return false;
	}else{
		document.getElementById("addresserror").innerHTML="Address is invalid";
		document.getElementById("address").focus();
		return false;
	}
	//Mobile Number validation check
	if(mobile_check.test(mobile)){
		document.getElementById('mobileerror').innerHTML=" ";
		document.getElementById('mobile').focus();
	}else if(mobile==""){
		document.getElementById("mobileerror").innerHTML="*mobile is Required";
		document.getElementById('mobile').focus();
		return false;
	}else{
		document.getElementById("mobileerror").innerHTML="mobile is invalid";
		document.getElementById("mobile").focus();
		return false;
	}
	
	//comment
	if(comment_check.test(comment)){
		document.getElementById('commenterror').innerHTML=" ";
		document.getElementById('comment').focus();
	}else if(comment==""){
		document.getElementById("commenterror").innerHTML="*comment is Required";
		document.getElementById('comment').focus();
		return false;
	}else{
		document.getElementById("commenterror").innerHTML="comment is invalid";
		document.getElementById("comment").focus();
		return false;
	}
	
}