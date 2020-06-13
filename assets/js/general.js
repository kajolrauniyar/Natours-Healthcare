function generalForm(){
	var name =document.getElementById("name").value;
	var mobile=document.getElementById('mobile').value;
	var email=document.getElementById('email').value;	
	var dob=document.getElementById('dob').value;
	var bloodgroup=document.getElementById('bloodgroup').value;
	var bp=document.getElementById('bp').value;
	var height=document.getElementById('height').value;
	var weight=document.getElementById('weight').value;





	/*pattern check*/
	var name_check=/^[a-zA-Z_.]{2,20}$/;
	var mobile_check=/^[789]{1}[0-9]{9}$/;
	var email_check=/^[a-zA-Z0-9_]{3,30}@[1-zA-Z0-9]{2,20}[.]{1}[a-zA-Z.]{2,8}$/;
	var height_check=/^(\d*\.)?\d+$/;
	var weight_check=/^(\d*\.)?\d+$/;
	/*name  validation check*/
	if(name_check.test(name)){
		document.getElementById("nameerror").innerHTML="";
		document.getElementById("name").focus();
	}else if(name==""){
		document.getElementById("nameerror").innerHTML="*Name Id Is Required";
		document.getElementById("name").focus();
		return false;
	}
	else{
		document.getElementById("nameerror").innerHTML="*Name Id is invalid";
		document.getElementById("name").focus();
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
		

	//date of birth
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
		
		document.getElementById('doberror').innerHTML=" ";
		document.getElementById('dob').focus();
		
	}	

	//blood group
	if(bloodgroup=="select"){
		document.getElementById("bloodgrouperror").innerHTML="Please Select blood group";
		document.getElementById("bloodgroup").focus();
		return false;

	}

		//blood pressure validation check
	if(bp_check.test(bp)){
		document.getElementById('bperror').innerHTML=" ";
		document.getElementById('bp').focus();
	}else if(bp==""){
		document.getElementById("bperror").innerHTML="*Blood Pressure is Required";
		document.getElementById('bp').focus();
		return false;
	}else{
		document.getElementById("bperror").innerHTML="Blood Pressure is invalid";
		document.getElementById("bp").focus();
		return false;
	}
	//height validation check
	if(height_check.test(height)){
		document.getElementById('heighterror').innerHTML=" ";
		document.getElementById('height').focus();
	}else if(height==""){
		document.getElementById("heighterror").innerHTML="*Height is Required";
		document.getElementById('height').focus();
		return false;
	}else{
		document.getElementById("heighterror").innerHTML="Height is invalid";
		document.getElementById("height").focus();
		return false;
	}
	//weight validation check
	if(weight_check.test(weight)){
		document.getElementById('weighterror').innerHTML=" ";
		document.getElementById('weight').focus();
	}else if(weight==""){
		document.getElementById("weighterror").innerHTML="*Weight is Required";
		document.getElementById('weight').focus();
		return false;
	}else{
		document.getElementById("weighterror").innerHTML="Weight is invalid";
		document.getElementById("weight").focus();
		return false;
	}
	//allergy
	var allergy=document.generalform.allergy;	
	for (var i=0; i<allergy.length; i++){
		if(allergy[i].checked==true){
			document.getElementById('allergyerror').innerHTML=" ";
			document.getElementById('allergy').focus();
			//return true
		}else{
			document.getElementById("allergyerror").innerHTML="Please Select allergy";
			document.getElementById("allergy").focus();
			return false;
		}
			
	}

	//gender
	var gn=document.generalform.gender;	
	for (var i=0; i<gn.length; i++){
		if(gn[i].checked==true ){
			document.getElementById('gendererror').innerHTML=" ";
			document.getElementById('gender').focus();
			//return true
		}else{
			document.getElementById("gendererror").innerHTML="Please Select gender";
			document.getElementById("gender").focus();
			return false;
		}
			
	}
	//marital status	
	var mar=document.generalform.marital;
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