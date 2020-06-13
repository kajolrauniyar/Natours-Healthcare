<?php
function debugger($data, $is_die = false){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	if($is_die){
		exit;
	}
}


function getUserByUserName($email, $is_die=false){
	global $conn;
	$sql = "SELECT * FROM users WHERE email = '".$email."'";
	if($is_die){
		debugger($sql, true);
	}

	$query = mysqli_query($conn, $sql);

	if(mysqli_num_rows($query) <= 0){
		return false;
	} else {
		$data = mysqli_fetch_assoc($query);
		return $data;
	}
}


function generateRandomStr($length = 100){
	$chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$str_len = strlen($chars);
	$random = "";
	for($i=0; $i<$length; $i++){
		$random .= $chars[rand(0, $str_len-1)];
	}

	return $random;
}

function updateLogin($data, $user_id, $is_die=false){
	global $conn;
	$sql = "UPDATE users SET 
			session_token = '".$data['session_token']."', 
			remember_token = '".$data['remember_token']."' WHERE id = ".$user_id;
	if($is_die){
		debugger($sql, true);
	}

	$query = mysqli_query($conn, $sql);
	if($query){
		return true;
	} else {
		return false;
	}
}

function getAdminByUserName($email, $is_die=false){
	global $conn;
	$sql = "SELECT * FROM admin WHERE email = '".$email."'";
	if($is_die){
		debugger($sql, true);
	}

	$query = mysqli_query($conn, $sql);

	if(mysqli_num_rows($query) <= 0){
		return false;
	} else {
		$data = mysqli_fetch_assoc($query);
		return $data;
	}
}


function generateAdminRandomStr($length = 100){
	$chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$str_len = strlen($chars);
	$random = "";
	for($i=0; $i<$length; $i++){
		$random .= $chars[rand(0, $str_len-1)];
	}

	return $random;
}

function updateAdminLogin($data, $user_id, $is_die=false){
	global $conn;
	$sql = "UPDATE admin SET 
			session_token = '".$data['session_token']."', 
			remember_token = '".$data['remember_token']."' WHERE id = ".$user_id;
	if($is_die){
		debugger($sql, true);
	}

	$query = mysqli_query($conn, $sql);
	if($query){
		return true;
	} else {
		return false;
	}
}

function getUserByCookie($remember_token, $is_die = false){
	global $conn;
	$sql = "SELECT * FROM users WHERE remember_token = '".$remember_token."'";
	if($is_die){
		debugger($sql, true);
	}

	$query = mysqli_query($conn, $sql);
	if(mysqli_num_rows($query) <= 0){
		return false;
	} else {
		$user_data = mysqli_fetch_assoc($query);
		return $user_data;
	}
}


function sanitize($str){
	global $conn;
	return mysqli_real_escape_string($conn, $str);
}

/*doctors*/
function addDoctor($data, $is_die =false){
	global $conn;
	$sql = "INSERT INTO doctor SET 
			full_name = '".$data['full_name']."',
			email = '".$data['email']."',
			mobile = '".$data['mobile']."',
			dob = '".$data['dob']."',
			gender = '".$data['gender']."',
			address = '".$data['address']."',
			image = '".$data['image']."',
			status = '".$data['status']."',
			added_by = ".$data['added_by'];
	if($is_die){
		debugger($sql, true);
	}
	$query = mysqli_query($conn, $sql);
	if($query){
		return mysqli_insert_id($conn);
	} else {
		return false;
	}
}
function deleteDoctor($id, $is_die = false){
	global $conn;
	$sql = "DELETE FROM doctor WHERE id = ".$id;//delete the data which id is matched
	if($is_die){
		debugger($sql, true);
	}

	$query = mysqli_query($conn, $sql);
	if($query){
		return true;
	} else {
		return false;
	}
}

function updateDoctor($data, $doc_id, $is_die = false){
	global $conn;
	$sql = "UPDATE doctor SET 
				full_name = '".$data['full_name']."',
				email = '".$data['email']."',
				mobile = '".$data['mobile']."',
				dob = '".$data['dob']."',
				gender = '".$data['gender']."',
				address = '".$data['address']."',
				image = '".$data['image']."',
				status = '".$data['status']."',
				added_by = ".$data['added_by']."
			WHERE id = ".$doc_id;

	if($is_die){
		debugger($sql, true);
	}
	$query = mysqli_query($conn, $sql);
	if($query){
		return $doc_id;//true likheda pani hunxa ... incase kahile hamilai Doctor check garnu parxa tesle doc_id pass gardiyeko
	} else {
		return false;
	}

}
function getAllDoctor($is_die=false){
	global $conn;
	$sql="SELECT * FROM doctor ORDER BY id DESC";
	if($is_die){
		echo $sql;
		exit;
	}
	$query=mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)<=0){
		return false;//data xaina bhane
	}else{
		$data=array();
		while($row=mysqli_fetch_assoc($query)){
			$data[]=$row;//arrayma ek ek garera data basiyo
		}
		return $data;

	}
}

function getDoctorById($id, $is_die=false){
	global $conn;
	$sql = "SELECT * FROM doctor WHERE id = ".$id;
	if($is_die){
		debugger($sql, true);
	}

	$query = mysqli_query($conn, $sql);
	if($query){
		if(mysqli_num_rows($query) <= 0){
			return false;
		} else {
			$data = mysqli_fetch_assoc($query);//loop garnu pardaina
			return $data;
		}
	} else {
		return false;
	}
}
/*Insurance*/
function addInsurance($data, $is_die =false){
	global $conn;
	$sql = "INSERT INTO insurance SET 
			name = '".$data['name']."',
			email = '".$data['email']."',
			mobile = '".$data['mobile']."',
			address = '".$data['address']."',
			insurance_plan = '".$data['insurance_plan']."',
			terms = '".$data['terms']."',
			status = '".$data['status']."',
			added_by = ".$data['added_by'];
	if($is_die){
		debugger($sql, true);
	}
	$query = mysqli_query($conn, $sql);
	if($query){
		return mysqli_insert_id($conn);
	} else {
		return false;
	}
}
function deleteInsurance($id, $is_die = false){
	global $conn;
	$sql = "DELETE FROM insurance WHERE id = ".$id;//delete the data which id is matched
	if($is_die){
		debugger($sql, true);
	}

	$query = mysqli_query($conn, $sql);
	if($query){
		return true;
	} else {
		return false;
	}
}

function updateInsurance($data, $ins_id, $is_die = false){
	global $conn;
	$sql = "UPDATE insurance SET 
			name = '".$data['name']."',
			email = '".$data['email']."',
			mobile = '".$data['mobile']."',
			address = '".$data['address']."',
			insurance_plan = '".$data['insurance_plan']."',
			terms = '".$data['terms']."',
			status = '".$data['status']."',
			added_by = ".$data['added_by']."
			WHERE id = ".$ins_id;

	if($is_die){
		debugger($sql, true);
	}
	$query = mysqli_query($conn, $sql);
	if($query){
		return $ins_id;//true likheda pani hunxa ... incase kahile hamilai Doctor check garnu parxa tesle doc_id pass gardiyeko
	} else {
		return false;
	}

}
function getAllInsurance($is_die=false){
	global $conn;
	$sql="SELECT * FROM insurance ORDER BY id DESC";
	if($is_die){
		echo $sql;
		exit;
	}
	$query=mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)<=0){
		return false;//data xaina bhane
	}else{
		$data=array();
		while($row=mysqli_fetch_assoc($query)){
			$data[]=$row;//arrayma ek ek garera data basiyo
		}
		return $data;

	}
}

function getInsuranceById($id, $is_die=false){
	global $conn;
	$sql = "SELECT * FROM insurance WHERE id = ".$id;
	if($is_die){
		debugger($sql, true);
	}

	$query = mysqli_query($conn, $sql);
	if($query){
		if(mysqli_num_rows($query) <= 0){
			return false;
		} else {
			$data = mysqli_fetch_assoc($query);//loop garnu pardaina
			return $data;
		}
	} else {
		return false;
	}
}
/*Invoices*/
function addInvoice($data, $is_die =false){
	global $conn;
	$sql = "INSERT INTO invoice SET 
			clients = '".$data['clients']."',
			email = '".$data['email']."',
			tax = '".$data['tax']."',
			client_address = '".$data['client_address']."',
			billing_address = '".$data['billing_address']."',
			due_date = '".$data['due_date']."',
			item = '".$data['item']."',
			description = '".$data['description']."',
			amount = '".$data['amount']."',
			status = '".$data['status']."',
			added_by = ".$data['added_by'];
	if($is_die){
		debugger($sql, true);
	}
	$query = mysqli_query($conn, $sql);
	if($query){
		return mysqli_insert_id($conn);
	} else {
		return false;
	}
}
function deleteInvoice($id, $is_die = false){
	global $conn;
	$sql = "DELETE FROM invoice WHERE id = ".$id;//delete the data which id is matched
	if($is_die){
		debugger($sql, true);
	}

	$query = mysqli_query($conn, $sql);
	if($query){
		return true;
	} else {
		return false;
	}
}

function updateInvoice($data, $inv_id, $is_die = false){
	global $conn;
	$sql = "UPDATE invoice SET 
			clients = '".$data['clients']."',
			email = '".$data['email']."',
			tax = '".$data['tax']."',
			client_address = '".$data['client_address']."',
			billing_address = '".$data['billing_address']."',
			due_date = '".$data['due_date']."',
			item = '".$data['item']."',
			description = '".$data['description']."',
			amount = '".$data['amount']."',
			status = '".$data['status']."',
			added_by = ".$data['added_by']."
			WHERE id = ".$inv_id;

	if($is_die){
		debugger($sql, true);
	}
	$query = mysqli_query($conn, $sql);
	if($query){
		return $inv_id;//true likheda pani hunxa ... incase kahile hamilai Doctor check garnu parxa tesle doc_id pass gardiyeko
	} else {
		return false;
	}

}
function getAllInvoice($is_die=false){
	global $conn;
	$sql="SELECT * FROM invoice ORDER BY id DESC";
	if($is_die){
		echo $sql;
		exit;
	}
	$query=mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)<=0){
		return false;//data xaina bhane
	}else{
		$data=array();
		while($row=mysqli_fetch_assoc($query)){
			$data[]=$row;//arrayma ek ek garera data basiyo
		}
		return $data;

	}
}

function getInvoiceById($id, $is_die=false){
	global $conn;
	$sql = "SELECT * FROM invoice WHERE id = ".$id;
	if($is_die){
		debugger($sql, true);
	}

	$query = mysqli_query($conn, $sql);
	if($query){
		if(mysqli_num_rows($query) <= 0){
			return false;
		} else {
			$data = mysqli_fetch_assoc($query);//loop garnu pardaina
			return $data;
		}
	} else {
		return false;
	}
}
/*Medicine*/
function addMedicine($data, $is_die =false){
	global $conn;
	$sql = "INSERT INTO medicine SET 
			item_name = '".$data['item_name']."',
			purchase_from = '".$data['purchase_from']."',
			purchase_date = '".$data['purchase_date']."',
			purchase_by = '".$data['purchase_by']."',
			amount = '".$data['amount']."',
			status = '".$data['status']."',
			added_by = ".$data['added_by'];
	if($is_die){
		debugger($sql, true);
	}
	$query = mysqli_query($conn, $sql);
	if($query){
		return mysqli_insert_id($conn);
	} else {
		return false;
	}
}
function deleteMedicine($id, $is_die = false){
	global $conn;
	$sql = "DELETE FROM medicine WHERE id = ".$id;//delete the data which id is matched
	if($is_die){
		debugger($sql, true);
	}

	$query = mysqli_query($conn, $sql);
	if($query){
		return true;
	} else {
		return false;
	}
}

function updateMedicine($data, $med_id, $is_die = false){
	global $conn;
	$sql = "UPDATE medicine SET 
			item_name = '".$data['item_name']."',
			purchase_from = '".$data['purchase_from']."',
			purchase_date = '".$data['purchase_date']."',
			purchase_by = '".$data['purchase_by']."',
			amount = '".$data['amount']."',
			status = '".$data['status']."',
			added_by = ".$data['added_by']."
			WHERE id = ".$med_id;

	if($is_die){
		debugger($sql, true);
	}
	$query = mysqli_query($conn, $sql);
	if($query){
		return $med_id;//true likheda pani hunxa ... incase kahile hamilai Doctor check garnu parxa tesle doc_id pass gardiyeko
	} else {
		return false;
	}

}
function getAllMedicine($is_die=false){
	global $conn;
	$sql="SELECT * FROM medicine ORDER BY id DESC";
	if($is_die){
		echo $sql;
		exit;
	}
	$query=mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)<=0){
		return false;//data xaina bhane
	}else{
		$data=array();
		while($row=mysqli_fetch_assoc($query)){
			$data[]=$row;//arrayma ek ek garera data basiyo
		}
		return $data;

	}
}

function getMedicineById($id, $is_die=false){
	global $conn;
	$sql = "SELECT * FROM medicine WHERE id = ".$id;
	if($is_die){
		debugger($sql, true);
	}
	$query = mysqli_query($conn, $sql);
	if($query){
		if(mysqli_num_rows($query) <= 0){
			return false;
		} else {
			$data = mysqli_fetch_assoc($query);//loop garnu pardaina
			return $data;
		}
	} else {
		return false;
	}
}
/*patients*/
function addPatients($data, $is_die =false){
	global $conn;
	$sql = "INSERT INTO patients SET 
			pname = '".$data['pname']."',
			photo = '".$data['photo']."',
			email = '".$data['email']."',
			gender = '".$data['gender']."',
			dob = '".$data['dob']."',
			height = '".$data['height']."',
			weight = '".$data['weight']."',
			mobile = '".$data['mobile']."',
			martial = '".$data['martial']."',
			address = '".$data['address']."',
			status = '".$data['status']."',
			added_by = ".$data['added_by'];
	if($is_die){
		debugger($sql, true);
	}
	$query = mysqli_query($conn, $sql);
	if($query){
		return mysqli_insert_id($conn);
	} else {
		return false;
	}
}
function deletePatients($id, $is_die = false){
	global $conn;
	$sql = "DELETE FROM patients WHERE id = ".$id;//delete the data which id is matched
	if($is_die){
		debugger($sql, true);
	}

	$query = mysqli_query($conn, $sql);
	if($query){
		return true;
	} else {
		return false;
	}
}

function updatePatients($data, $pat_id, $is_die = false){
	global $conn;
	$sql = "UPDATE patients SET 
				pname = '".$data['pname']."',
				photo = '".$data['photo']."',
				email = '".$data['email']."',
				gender = '".$data['gender']."',
				dob = '".$data['dob']."',
				height = '".$data['height']."',
				weight = '".$data['weight']."',
				mobile = '".$data['mobile']."',
				martial = '".$data['martial']."',
				address = '".$data['address']."',
				status = '".$data['status']."',
				added_by = ".$data['added_by']."
			WHERE id = ".$pat_id;

	if($is_die){
		debugger($sql, true);
	}
	$query = mysqli_query($conn, $sql);
	if($query){
		return $pat_id;//true likheda pani hunxa ... incase kahile hamilai patients check garnu parxa tesle pat_id pass gardiyeko
	} else {
		return false;
	}

}
function getAllPatients($is_die=false){
	global $conn;
	$sql="SELECT * FROM patients ORDER BY id DESC";
	if($is_die){
		echo $sql;
		exit;
	}
	$query=mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)<=0){
		return false;//data xaina bhane
	}else{
		$data=array();
		while($row=mysqli_fetch_assoc($query)){
			$data[]=$row;//arrayma ek ek garera data basiyo
		}
		return $data;

	}
}

function getPatientsById($id, $is_die=false){
	global $conn;
	$sql = "SELECT * FROM patients WHERE id = ".$id;
	if($is_die){
		debugger($sql, true);
	}

	$query = mysqli_query($conn, $sql);
	if($query){
		if(mysqli_num_rows($query) <= 0){
			return false;
		} else {
			$data = mysqli_fetch_assoc($query);//loop garnu pardaina
			return $data;
		}
	} else {
		return false;
	}
}

/*Schedule*/
function addSchedule($data, $is_die =false){
	global $conn;
	$sql = "INSERT INTO schedule SET 
			patient_name = '".$data['patient_name']."',
			age = '".$data['age']."',
			doctor_name = '".$data['doctor_name']."',
			appoint_date = '".$data['appoint_date']."',
			status = '".$data['status']."',
			patient_phone = '".$data['patient_phone']."',
			message = '".$data['message']."',
			status = '".$data['status']."',
			added_by = ".$data['added_by'];
	if($is_die){
		debugger($sql, true);
	}
	$query = mysqli_query($conn, $sql);
	if($query){
		return mysqli_insert_id($conn);
	} else {
		return false;
	}
}
function deleteSchedule($id, $is_die = false){
	global $conn;
	$sql = "DELETE FROM schedule WHERE id = ".$id;//delete the data which id is matched
	if($is_die){
		debugger($sql, true);
	}

	$query = mysqli_query($conn, $sql);
	if($query){
		return true;
	} else {
		return false;
	}
}

function updateSchedule($data, $sch_id, $is_die = false){
	global $conn;
	$sql = "UPDATE schedule SET 
				dr_name = '".$data['dr_name']."',
				available_days = '".$data['available_days']."',
				start_time = '".$data['start_time']."',
				end_time = '".$data['end_time']."',
				message = '".$data['message']."',
				status = '".$data['status']."',
				added_by = ".$data['added_by']."
			WHERE id = ".$app_id;

	if($is_die){
		debugger($sql, true);
	}
	$query = mysqli_query($conn, $sql);
	if($query){
		return $sch_id;//true likheda pani hunxa ... incase kahile hamilai Schedule check garnu parxa tesle sch_id pass gardiyeko
	} else {
		return false;
	}

}
function getAllSchedule($is_die=false){
	global $conn;
	$sql="SELECT * FROM schedule ORDER BY id DESC";
	if($is_die){
		echo $sql;
		exit;
	}
	$query=mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)<=0){
		return false;//data xaina bhane
	}else{
		$data=array();
		while($row=mysqli_fetch_assoc($query)){
			$data[]=$row;//arrayma ek ek garera data basiyo
		}
		return $data;

	}
}

function getScheduleById($id, $is_die=false){
	global $conn;
	$sql = "SELECT * FROM schedule WHERE id = ".$id;
	if($is_die){
		debugger($sql, true);
	}

	$query = mysqli_query($conn, $sql);
	if($query){
		if(mysqli_num_rows($query) <= 0){
			return false;
		} else {
			$data = mysqli_fetch_assoc($query);//loop garnu pardaina
			return $data;
		}
	} else {
		return false;
	}
}

/*Schedule*/
function addAppointment($data, $is_die =false){
	global $conn;
	$sql = "INSERT INTO appointments SET 
			patient_name = '".$data['patient_name']."',
			age = '".$data['age']."',
			doctor_name = '".$data['doctor_name']."',
			appoint_date = '".$data['appoint_date']."',
			status = '".$data['status']."',
			patient_phone = '".$data['patient_phone']."',
			message = '".$data['message']."',
			status = '".$data['status']."',
			added_by = ".$data['added_by'];
	if($is_die){
		debugger($sql, true);
	}
	$query = mysqli_query($conn, $sql);
	if($query){
		return mysqli_insert_id($conn);
	} else {
		return false;
	}
}
function deleteAppointment($id, $is_die = false){
	global $conn;
	$sql = "DELETE FROM appointments WHERE id = ".$id;//delete the data which id is matched
	if($is_die){
		debugger($sql, true);
	}

	$query = mysqli_query($conn, $sql);
	if($query){
		return true;
	} else {
		return false;
	}
}

function updateAppointment($data, $app_id, $is_die = false){
	global $conn;
	$sql = "UPDATE appointments SET 
				dr_name = '".$data['dr_name']."',
				available_days = '".$data['available_days']."',
				start_time = '".$data['start_time']."',
				end_time = '".$data['end_time']."',
				message = '".$data['message']."',
				status = '".$data['status']."',
				added_by = ".$data['added_by']."
			WHERE id = ".$sch_id;

	if($is_die){
		debugger($sql, true);
	}
	$query = mysqli_query($conn, $sql);
	if($query){
		return $app_id;//true likheda pani hunxa ... incase kahile hamilai appointment check garnu parxa tesle sch_id pass gardiyeko
	} else {
		return false;
	}

}
function getAllAppointment($is_die=false){
	global $conn;
	$sql="SELECT * FROM appointments ORDER BY id DESC";
	if($is_die){
		echo $sql;
		exit;
	}
	$query=mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)<=0){
		return false;//data xaina bhane
	}else{
		$data=array();
		while($row=mysqli_fetch_assoc($query)){
			$data[]=$row;//arrayma ek ek garera data basiyo
		}
		return $data;

	}
}

function getAppointmentById($id, $is_die=false){
	global $conn;
	$sql = "SELECT * FROM appointments WHERE id = ".$id;
	if($is_die){
		debugger($sql, true);
	}

	$query = mysqli_query($conn, $sql);
	if($query){
		if(mysqli_num_rows($query) <= 0){
			return false;
		} else {
			$data = mysqli_fetch_assoc($query);//loop garnu pardaina
			return $data;
		}
	} else {
		return false;
	}
}
?>
