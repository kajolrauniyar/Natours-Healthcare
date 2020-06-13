<?php

$page_title ="Patient";
require 'inc/config.php';
require 'inc/functions.php';
require 'inc/logincheck.php';



if(isset($_POST) && !empty($_POST)){
	// debugger($_POST);
	// debugger($_FILES, true);

	$data = array(
		'pname'	=> sanitize($_POST['pname']),
		'photo'	=> sanitize($_POST['photo']),
		'email'	=> sanitize($_POST['email']),
		'gender'	=> sanitize($_POST['gender']),
		'dob'	=> sanitize($_POST['dob']),
		'height'	=> sanitize($_POST['height']),
		'weight'	=> sanitize($_POST['weight']),
		'mobile'	=> sanitize($_POST['mobile']),
		'martial'	=> sanitize($_POST['martial']),
		'address'	=> sanitize($_POST['address']),
		'status'	=> sanitize($_POST['status']),
		'added_by'	=> $_SESSION['user_id'],
		'photo'		=> sanitize($_POST['old_photo'])
	);

	//echo UPLOAD_DIR.'/patients/'.$_POST['del_photo'];
	//debugger($_POST, true);
	//delete photo check garne lai
	if(isset($_POST['del_photo']) && !empty($_POST['del_photo']) && file_exists(UPLOAD_DIR.'/patients/'.$_POST['del_photo'])){
		unlink(UPLOAD_DIR.'/patients/'.$_POST['del_photo']);
		$data['photo'] = NULL;
	}

	if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0){
		$ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
		if(in_array(strtolower($ext), ALLOWED_EXTENSIONS)){
			if($_FILES['photo']['size'] <= 5000000){
				$upload_dir = UPLOAD_DIR.'/patients';
				
				if(!is_dir($upload_dir)){
					mkdir($upload_dir, '0777', true);
				}

				/* Patient-2020042772105123.jpg*/

				$file_name = "Patients-".date('Ymdhis').rand(0,999).".".$ext;

				$success = move_uploaded_file($_FILES['photo']['tmp_name'], $upload_dir.'/'.$file_name);
				if($success){

					$data['photo'] = $file_name;

					if(isset($_POST['old_photo']) && !empty($_POST['old_photo']) && file_exists(UPLOAD_DIR.'/patients/'.$_POST['old_photo']))
					{
						unlink(UPLOAD_DIR.'/patients/'.$_POST['old_photo']);
					}
				}
			}
		}
	}
	//update garda kheri patients_id aauxa tyo case update hunxa ... incase khali xa bhane  tyo add case huncxa by default null send gardine
	$pat_id = (isset($_POST['patients_id']) && !empty($_POST['patients_id'])) ? (int)$_POST['patients_id'] : NULL;

	if($pat_id){
		/*Update Case*/
		$act = "updat";
		$success = updatePatients($data, $pat_id);
	} else {
		/*Add case*/
		$act = "add";
		$success = addPatients($data);
	}

	if($success){
		$_SESSION['success'] = 'Patient '.$act.'ed successfully.';
	} else {
		$_SESSION['error'] = "Sorry! There was problem while ".$act."ing Patient.";
	}
	@header('location: Patients');
	exit;
} else if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
	$id = (int)$_GET['id'];
	if($id <= 0){
		$_SESSION['error'] = "Sorry! Invalid Patient Id.";
		@header('location: Patients');
		exit;
	}

	$patients_info = getPatientsById($id);
	//debugger($patients_info, true);
	if($patients_info){
		$del = deletePatients($id);
		if($del){
			/*File delete*/
			if(!empty($patients_info['photo']) && file_exists(UPLOAD_DIR.'/patients/'.$patients_info['photo'])){
				unlink(UPLOAD_DIR.'/patients/'.$patients_info['photo']);
			}

			$_SESSION['success'] = "Patient deleted successfully";
			@header('location: Patients');
			exit;
		} else {
			$_SESSION['error'] = "Sorry! There was problem while deleting Patient.";
			@header('location: Patients');
			exit;	

		}
	} else {
		$_SESSION['error'] = "Sorry! The id you provided has been already deleted or does not exists.";
		@header('location: Patients');
		exit;	
	}
}
else {
	$_SESSION['error'] = "Please Fill the form correctly.";
	@header('location: add-Patient');
	exit;
}