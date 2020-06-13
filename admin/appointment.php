
<?php

$page_title ="appointment";
require 'inc/config.php';
require 'inc/functions.php';
require 'inc/logincheck.php';



if(isset($_POST) && !empty($_POST)){
    // debugger($_POST);
    // debugger($_FILES, true);

    $data = array(
        'patient_name'	=> sanitize($_POST['patient_name']),
		'age'	=> sanitize($_POST['age']),
		'doctor_name'	=> sanitize($_POST['doctor_name']),
		'appoint_date'	=> sanitize($_POST['appoint_date']),
		'patient_phone'	=> sanitize($_POST['patient_phone']),
		'message'	=> sanitize($_POST['message']),
		'status'	=> sanitize($_POST['status']),
		'added_by'	=> $_SESSION['user_id']
    );

    //echo UPLOAD_DIR.'/appointment/'.$_POST['del_image'];
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
    $app_id = (isset($_POST['appointment_id']) && !empty($_POST['appointment_id'])) ? (int)$_POST['appointment_id'] : NULL;

    if($app_id){
        /*Update Case*/
        $act = "updat";
        $success = updateAppointment($data, $app_id);
    } else {
        /*Add case*/
        $act = "add";
        $success = addAppointment($data);
    }

    if($success){
        $_SESSION['success'] = 'appointment '.$act.'ed successfully.';
    } else {
        $_SESSION['error'] = "Sorry! There was problem while ".$act."ing appointment.";
    }
    @header('location: appointments');
    exit;
} else if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
    $id = (int)$_GET['id'];
    if($id <= 0){
        $_SESSION['error'] = "Sorry! Invalid appointment Id.";
        @header('location: appointments');
        exit;
    }

    $appointment_info = getAppointmentById($id);
    //debugger($appointment_info, true);
    if($appointment_info){
        $del = deleteAppointment($id);
        if($del){
            /*File delete*/
            if(!empty($appointment_info['image']) && file_exists(UPLOAD_DIR.'/appointment/'.$appointment_info['image'])){
                unlink(UPLOAD_DIR.'/appointment/'.$appointment_info['image']);
            }

            $_SESSION['success'] = "appointment deleted successfully";
            @header('location: appointments');
            exit;
        } else {
            $_SESSION['error'] = "Sorry! There was problem while deleting appointment.";
            @header('location: appointments');
            exit;   

        }
    } else {
        $_SESSION['error'] = "Sorry! The id you provided has been already deleted or does not exists.";
        @header('location: appointments');
        exit;   
    }
}
else {
    $_SESSION['error'] = "Please Fill the form correctly.";
    @header('location: add-appointment');
    exit;
}
