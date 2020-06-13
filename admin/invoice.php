
<?php

$page_title ="Invoice";
require 'inc/config.php';
require 'inc/functions.php';
require 'inc/logincheck.php';



if(isset($_POST) && !empty($_POST)){
    // debugger($_POST);
    // debugger($_FILES, true);

    $data = array(
        'clients' => sanitize($_POST['clients']),
        'email' => sanitize($_POST['email']),
        'tax'    => sanitize($_POST['tax']),
        'client_address'   => sanitize($_POST['client_address']),
        'billing_address' => sanitize($_POST['billing_address']),
        'due_date'=>sanitize($_POST['due_date']),
        'items' => sanitize($_POST['items']),
        'description' => sanitize($_POST['description']),
        'amount' => sanitize($_POST['amount']),
        'status'    => sanitize($_POST['status']),
        'added_by'  => $_SESSION['user_id'],
    );

    //echo UPLOAD_DIR.'/Invoice/'.$_POST['del_image'];
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
    $inv_id = (isset($_POST['invoice_id']) && !empty($_POST['invoice_id'])) ? (int)$_POST['invoice_id'] : NULL;

    if($inv_id){
        /*Update Case*/
        $act = "updat";
        $success = updateInvoice($data, $inv_id);
    } else {
        /*Add case*/
        $act = "add";
        $success = addInvoice($data);
    }

    if($success){
        $_SESSION['success'] = 'Invoice '.$act.'ed successfully.';
    } else {
        $_SESSION['error'] = "Sorry! There was problem while ".$act."ing Invoice.";
    }
    @header('location: invoices');
    exit;
} else if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
    $id = (int)$_GET['id'];
    if($id <= 0){
        $_SESSION['error'] = "Sorry! Invalid Invoice Id.";
        @header('location: invoices');
        exit;
    }

    $Invoice_info = getInvoiceById($id);
    //debugger($Invoice_info, true);
    if($Invoice_info){
        $del = deleteInvoice($id);
        if($del){
            /*File delete*/
            if(!empty($Invoice_info['image']) && file_exists(UPLOAD_DIR.'/Invoice/'.$Invoice_info['image'])){
                unlink(UPLOAD_DIR.'/Invoice/'.$Invoice_info['image']);
            }

            $_SESSION['success'] = "Invoice deleted successfully";
            @header('location: invoices');
            exit;
        } else {
            $_SESSION['error'] = "Sorry! There was problem while deleting Invoice.";
            @header('location: invoices');
            exit;   

        }
    } else {
        $_SESSION['error'] = "Sorry! The id you provided has been already deleted or does not exists.";
        @header('location: invoices');
        exit;   
    }
}
else {
    $_SESSION['error'] = "Please Fill the form correctly.";
    @header('location: add-invoice');
    exit;
}