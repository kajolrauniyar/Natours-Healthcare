<?php 
require 'inc/config.php';

require 'inc/functions.php';


if(isset($_POST) && !empty($_POST)){
    /*Form is submitted*/
    // debugger($_POST);
    $user_name = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);    // return email or false
    if(!$user_name){
        $_SESSION['error'] = "Username is not valid. Please enter email user type.";
        @header('location: ./');
        exit;   
    }

    // debugger($_POST);
    $enc_password = sha1($user_name.$_POST['password']);

    $user_info = getUserByUserName($user_name);

    if($user_info){

        if($enc_password == $user_info['password']){
            /*Password valid*/
            if($user_info['status'] == "Active"){
                if($user_info['role'] == "Admin"){
                    /*Successful login*/
                    $token = generateRandomStr(100);
                    
                    $data = array(
                        'session_token' => $token,
                        'remember_token'    => NULL
                    );

                    if(isset($_POST['remember']) && $_POST['remember'] == 1){
                        setcookie('_au', $token, (time()+864000), "/");
                        $data['remember_token'] = $token;
                    }

                    $_SESSION['session_token'] = $token;
                    $_SESSION['user_id']    = $user_info['id'];
                    $_SESSION['full_name']  = $user_info['full_name'];
                    $_SESSION['email']      = $user_info['email'];

                    //debugger($_SESSION, true);

                    updateLogin($data, $user_info['id']);

                    //debugger($data, true);
                    $_SESSION['success'] = "Welcome ".$user_info['full_name']."! To user panel of Natours Healthcare.";
                    @header('location: dashboard');
                    exit;
                } else {
                    $_SESSION['error'] = "You do not have previlage to access user panel.";
                    @header('location: ./');
                    exit;   
                }
            } else {
                $_SESSION['error'] = "User account is not activated.";
                @header('location: ./');
                exit;   

            }
        } else {
            //debugger($_SESSION, true);
            //debugger($data, true);
            $_SESSION['error'] = "Password does not match.";
            @header('location: ./');
            exit;               
        }
    } else {
        $_SESSION['error'] = "Username does not exists.";
        @header('location: ./');
        exit;   
    }
} else {
    /*Direct Access to this file*/
    $_SESSION['error'] = "Please Login first";
    @header('location: ./');
    exit;
}