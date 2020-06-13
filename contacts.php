<?php

$page_title ="contact";
require 'user/inc/config.php';
require 'user/inc/functions.php';
require 'user/inc/logincheck.php';



if(isset($_POST) && !empty($_POST)){
	// debugger($_POST);
	// debugger($_FILES, true);

	$data = array(
		'full_name'	=> sanitize($_POST['full_name']),
		'email'	=> sanitize($_POST['email']),
		'address'	=> sanitize($_POST['address']),
		'mobile'	=> sanitize($_POST['mobile']),
		'comment'	=> sanitize($_POST['comment']),
		'added_by'	=> $_SESSION['user_id'],
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
	//update garda kheri contact_id aauxa tyo case update hunxa ... incase khali xa bhane  tyo add case huncxa by default null send gardine
	$con_id = (isset($_POST['contact_id']) && !empty($_POST['contact_id'])) ? (int)$_POST['contact_id'] : NULL;

	if($con_id){
		/*Update Case*/
		$act = "updat";
		$success = updateContact($data, $con_id);
	} else {
		/*Add case*/
		$act = "add";
		$success = addContact($data);
	}

	if($success){
		$_SESSION['success'] = 'contact '.$act.'ed successfully.';
	} else {
		$_SESSION['error'] = "Sorry! There was problem while ".$act."ing contact.";
	}
	@header('location: contact');
	exit;
} else if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
	$id = (int)$_GET['id'];
	if($id <= 0){
		$_SESSION['error'] = "Sorry! Invalid contact Id.";
		@header('location: contact');
		exit;
	}

	$contact_info = getContactById($id);
	//debugger($contact_info, true);
	if($contact_info){
		$del = deleteContact($id);
		if($del){
			/*File delete*/
			if(!empty($contact_info['image']) && file_exists(UPLOAD_DIR.'/contact/'.$contact_info['image'])){
				unlink(UPLOAD_DIR.'/contact/'.$contact_info['image']);
			}

			$_SESSION['success'] = "contact deleted successfully";
			@header('location: contact');
			exit;
		} else {
			$_SESSION['error'] = "Sorry! There was problem while deleting contact.";
			@header('location: contact');
			exit;	

		}
	} else {
		$_SESSION['error'] = "Sorry! The id you provided has been already deleted or does not exists.";
		@header('location: contact');
		exit;	
	}
}
else {
	$_SESSION['error'] = "Please Fill the form correctly.";
	@header('location: contact');
	exit;
}