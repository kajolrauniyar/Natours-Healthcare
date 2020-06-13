<?php

$page_title ="Medicine";
require 'inc/config.php';
require 'inc/functions.php';
require 'inc/logincheck.php';



if(isset($_POST) && !empty($_POST)){
    // debugger($_POST);
    // debugger($_FILES, true);

    $data = array(
        'item_name' => sanitize($_POST['item_name']),
        'purchase_from' => sanitize($_POST['purchase_from']),
        'purchase_date'    => sanitize($_POST['purchase_date']),
        'purchase_by'   => sanitize($_POST['purchase_by']),
        'amount' => sanitize($_POST['amount']),
        'status'    => sanitize($_POST['status']),
        'added_by'  => $_SESSION['user_id'],
    );

    //echo UPLOAD_DIR.'/Medicine/'.$_POST['del_image'];
    //debugger($_POST, true);
    //delete image check garne lai
    if(isset($_POST['del_image']) && !empty($_POST['del_image']) && file_exists(UPLOAD_DIR.'/medicine/'.$_POST['del_image'])){
        unlink(UPLOAD_DIR.'/medicine/'.$_POST['del_image']);
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

                    if(isset($_POST['old_image']) && !empty($_POST['old_image']) && file_exists(UPLOAD_DIR.'/medicine/'.$_POST['old_image']))
                    {
                        unlink(UPLOAD_DIR.'/medicine/'.$_POST['old_image']);
                    }
                }
            }
        }
    }
    //update garda kheri doctor_id aauxa tyo case update hunxa ... incase khali xa bhane  tyo add case huncxa by default null send gardine
    $med_id = (isset($_POST['medicine_id']) && !empty($_POST['medicine_id'])) ? (int)$_POST['medicine_id'] : NULL;

    if($med_id){
        /*Update Case*/
        $act = "updat";
        $success = updateMedicine($data, $med_id);
    } else {
        /*Add case*/
        $act = "add";
        $success = addMedicine($data);
    }

    if($success){
        $_SESSION['success'] = 'Medicine '.$act.'ed successfully.';
    } else {
        $_SESSION['error'] = "Sorry! There was problem while ".$act."ing Medicine.";
    }
    @header('location: medicines');
    exit;
} else if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
    $id = (int)$_GET['id'];
    if($id <= 0){
        $_SESSION['error'] = "Sorry! Invalid Medicine Id.";
        @header('location: medicines');
        exit;
    }

    $medicine_info = getMedicineById($id);
    //debugger($medicine_info, true);
    if($medicine_info){
        $del = deleteMedicine($id);
        if($del){
            /*File delete*/
            if(!empty($medicine_info['image']) && file_exists(UPLOAD_DIR.'/Medicine/'.$medicine_info['image'])){
                unlink(UPLOAD_DIR.'/Medicine/'.$medicine_info['image']);
            }

            $_SESSION['success'] = "Medicine deleted successfully";
            @header('location: medicines');
            exit;
        } else {
            $_SESSION['error'] = "Sorry! There was problem while deleting Medicine.";
            @header('location: medicines');
            exit;   

        }
    } else {
        $_SESSION['error'] = "Sorry! The id you provided has been already deleted or does not exists.";
        @header('location: medicines');
        exit;   
    }
}
else {
    $_SESSION['error'] = "Please Fill the form correctly.";
    @header('location: add-medicine');
    exit;
}