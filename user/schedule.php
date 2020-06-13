
<?php

$page_title ="schedule";
require 'inc/config.php';
require 'inc/functions.php';
require 'inc/logincheck.php';



if(isset($_POST) && !empty($_POST)){
    // debugger($_POST);
    // debugger($_FILES, true);

    $data = array(
        'dr_name' => sanitize($_POST['dr_name']),
        'available_days' => sanitize($_POST['available_days']),
        'start_time'    => sanitize($_POST['start_time']),
        'end_time'   => sanitize($_POST['end_time']),
        'message' => sanitize($_POST['message']),
        'status'    => sanitize($_POST['status']),
        'added_by'  => $_SESSION['user_id'],
    );

    //echo UPLOAD_DIR.'/schedule/'.$_POST['del_image'];
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
    $inv_id = (isset($_POST['schedule_id']) && !empty($_POST['schedule_id'])) ? (int)$_POST['schedule_id'] : NULL;

    if($inv_id){
        /*Update Case*/
        $act = "updat";
        $success = updateSchedule($data, $inv_id);
    } else {
        /*Add case*/
        $act = "add";
        $success = addSchedule($data);
    }

    if($success){
        $_SESSION['success'] = 'schedule '.$act.'ed successfully.';
    } else {
        $_SESSION['error'] = "Sorry! There was problem while ".$act."ing schedule.";
    }
    @header('location: schedules');
    exit;
} else if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
    $id = (int)$_GET['id'];
    if($id <= 0){
        $_SESSION['error'] = "Sorry! Invalid schedule Id.";
        @header('location: schedules');
        exit;
    }

    $schedule_info = getScheduleById($id);
    //debugger($schedule_info, true);
    if($schedule_info){
        $del = deleteSchedule($id);
        if($del){
            /*File delete*/
            if(!empty($schedule_info['image']) && file_exists(UPLOAD_DIR.'/schedule/'.$schedule_info['image'])){
                unlink(UPLOAD_DIR.'/schedule/'.$schedule_info['image']);
            }

            $_SESSION['success'] = "schedule deleted successfully";
            @header('location: schedules');
            exit;
        } else {
            $_SESSION['error'] = "Sorry! There was problem while deleting schedule.";
            @header('location: schedules');
            exit;   

        }
    } else {
        $_SESSION['error'] = "Sorry! The id you provided has been already deleted or does not exists.";
        @header('location: schedules');
        exit;   
    }
}
else {
    $_SESSION['error'] = "Please Fill the form correctly.";
    @header('location: add-schedule');
    exit;
}