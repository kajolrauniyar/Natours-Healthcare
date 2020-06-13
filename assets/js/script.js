function validateForm(){
	var name=document.getElementById('name').value;
	var occupation=document.getElementById('occupation').value;
	var father=document.getElementById('father').value;
	var address=document.getElementById('address').value;
	var mobile=document.getElementById('mobile').value;
	var email=document.getElementById('email').value;

	var country=document.getElementById('country').value;
	//validation check
	var name_check=/^[a-zA-Z. ]{3,30}$/;
	var occupation_check=/^[a-zA-Z. ]{2,30}$/;
	var father_check=/^[a-zA-Z. ]{2,30}$/;
	var address_check=/^[a-zA-Z0-9., ]{3,}$/;
	var mobile_check=/^[789]{1}[0-9]{9}$/;
	var email_check=/^[a-zA-Z0-9_]{3,30}@[1-zA-Z0-9]{2,20}[.]{1}[a-zA-Z.]{2,8}$/;
	if(name_check.test(name)){
		document.getElementById('nameerror').innerHTML=" ";
		document.getElementById('name').focus();
	}else if(name==""){
		document.getElementById("nameerror").innerHTML="*Name is Required";
		document.getElementById('name').focus();
		return false;
	}else{
		document.getElementById("nameerror").innerHTML="Name is invalid";
		document.getElementById("name").focus();
		return false;
	}


		//Mobile Number
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
		//Email
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

	//date of birth
	var dob = document.getElementById("dob").value;
	 var today = new Date();
	if(today>=dob){
		document.getElementById("doberror").innerHTML="dob is invalid";
		document.getElementById("dob").focus();
		return false;
		//return false;
	}else if(dob==""){
		document.getElementById("doberror").innerHTML="*dob is Required";
		document.getElementById('dob').focus();
		return false;
	}else{
		
		document.getElementById('dobrror').innerHTML=" ";
		document.getElementById('dob').focus();
		
	}
	
	//occupation
	if(occupation_check.test(occupation)){
		document.getElementById('occupationerror').innerHTML=" ";
		document.getElementById('occupation').focus();
	}else if(occupation==""){
		document.getElementById("occupationerror").innerHTML="*Occupation is Required";
		document.getElementById('occupation').focus();
		return false;
	}else{
		document.getElementById("occupationerror").innerHTML="Occupation is invalid";
		document.getElementById("occupation").focus();
		return false;
	}

	//father's Name
	if(father_check.test(father)){
		document.getElementById('fathererror').innerHTML=" ";
		document.getElementById('father').focus();
	}else if(father==""){
		document.getElementById("fathererror").innerHTML="*father is Required";
		document.getElementById('father').focus();
		return false;
	}else{
		document.getElementById("fathererror").innerHTML="father  name is invalid";
		document.getElementById("father").focus();
		return false;
	}

	//permanent Address
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

	//country
	if(country=="countryselected"){
		document.getElementById("countryerror").innerHTML="Please Select country";
		document.getElementById("country").focus();
		return false;

	}


		//gender
	var gn=document.regform.gender;	
	for (var i=0; i<gn.length; i++){
		if(gn[i].checked==true ){
			document.getElementById('gendererror').innerHTML=" ";
			document.getElementById('gender').focus();
			return true
		}else{
			document.getElementById("gendererror").innerHTML="Please Select gender";
			document.getElementById("gender").focus();
			return false;
		}
			
	}
	//marital status
	var mar=document.regform.marital;	
	for (var i=0; i<mar.length; i++){
		if(mar[i].checked==true){
			document.getElementById('maritalerror').innerHTML=" ";
			document.getElementById('marital').focus();
			//return true
		}else{
			document.getElementById("maritalerror").innerHTML="Please Select marital";
				document.getElementById("marital").focus();
				return false;
		}
			
	}

}