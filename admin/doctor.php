<?php

$page_title ="doctor";
require 'inc/config.php';
require 'inc/functions.php';
require 'inc/logincheck.php';



if(isset($_POST) && !empty($_POST)){
	// debugger($_POST);
	// debugger($_FILES, true);

	$data = array(
		'full_name'	=> sanitize($_POST['full_name']),
		'email'	=> sanitize($_POST['email']),
		'mobile'	=> sanitize($_POST['mobile']),
		'dob'	=> sanitize($_POST['dob']),
		'gender'	=> sanitize($_POST['gender']),
		'address'	=> sanitize($_POST['address']),
		'image'	=> sanitize($_POST['image']),
		'status'	=> sanitize($_POST['status']),
		'added_by'	=> $_SESSION['user_id'],
		'image'		=> sanitize($_POST['old_image'])
	);

	//echo UPLOAD_DIR.'/doctor/'.$_POST['del_image'];
	//debugger($_POST, true);
	//delete image check garne lai
	if(isset($_POST['del_image']) && !empty($_POST['del_image']) && file_exists(UPLOAD_DIR.'/doctor/'.$_POST['del_image'])){
		unlink(UPLOAD_DIR.'/doctor/'.$_POST['del_image']);
		$data['image'] = NULL;
	}

	if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
		$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
		if(in_array(strtolower($ext), ALLOWED_EXTENSIONS)){
			if($_FILES['image']['size'] <= 5000000){
				$upload_dir = UPLOAD_DIR.'/doctor';
				
				if(!is_dir($upload_dir)){
					mkdir($upload_dir, '0777', true);
				}

				/* Doctor-2020042772105123.jpg*/

				$file_name = "Doctor-".date('Ymdhis').rand(0,999).".".$ext;

				$success = move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir.'/'.$file_name);
				if($success){

					$data['image'] = $file_name;

					if(isset($_POST['old_image']) && !empty($_POST['old_image']) && file_exists(UPLOAD_DIR.'/doctor/'.$_POST['old_image']))
					{
						unlink(UPLOAD_DIR.'/doctor/'.$_POST['old_image']);
					}
				}
			}
		}
	}
	//update garda kheri doctor_id aauxa tyo case update hunxa ... incase khali xa bhane  tyo add case huncxa by default null send gardine
	$doc_id = (isset($_POST['doctor_id']) && !empty($_POST['doctor_id'])) ? (int)$_POST['doctor_id'] : NULL;

	if($doc_id){
		/*Update Case*/
		$act = "updat";
		$success = updateDoctor($data, $doc_id);
	} else {
		/*Add case*/
		$act = "add";
		$success = addDoctor($data);
	}

	if($success){
		$_SESSION['success'] = 'Doctor '.$act.'ed successfully.';
	} else {
		$_SESSION['error'] = "Sorry! There was problem while ".$act."ing Doctor.";
	}
	@header('location: doctors');
	exit;
} else if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
	$id = (int)$_GET['id'];
	if($id <= 0){
		$_SESSION['error'] = "Sorry! Invalid Doctor Id.";
		@header('location: doctors');
		exit;
	}

	$doctor_info = getDoctorById($id);
	//debugger($doctor_info, true);
	if($doctor_info){
		$del = deleteDoctor($id);
		if($del){
			/*File delete*/
			if(!empty($doctor_info['image']) && file_exists(UPLOAD_DIR.'/doctor/'.$doctor_info['image'])){
				unlink(UPLOAD_DIR.'/doctor/'.$doctor_info['image']);
			}

			$_SESSION['success'] = "Doctor deleted successfully";
			@header('location: doctors');
			exit;
		} else {
			$_SESSION['error'] = "Sorry! There was problem while deleting Doctor.";
			@header('location: doctors');
			exit;	

		}
	} else {
		$_SESSION['error'] = "Sorry! The id you provided has been already deleted or does not exists.";
		@header('location: doctors');
		exit;	
	}
}
else {
	$_SESSION['error'] = "Please Fill the form correctly.";
	@header('location: add-doctor');
	exit;
}