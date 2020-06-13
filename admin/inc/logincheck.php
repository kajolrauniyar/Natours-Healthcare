
<?php 
    if(isset($_COOKIE, $_COOKIE['_au']) && !empty($_COOKIE['_au']) && !isset($_SESSION['session_token']))
    {
        //debugger($_COOKIE, true);

        $remember_token = $_COOKIE['_au'];
        $user_by_cookie = getUserByCookie($remember_token);
        if($user_by_cookie){
            $_SESSION['session_token'] = $remember_token;
            $_SESSION['user_id']    = $user_by_cookie['id'];
            $_SESSION['full_name']  = $user_by_cookie['full_name'];
            $_SESSION['email']      = $user_by_cookie['email'];
        } else {
            header('location: logout');
            exit;
        }
    }


    if(!isset($_SESSION, $_SESSION['session_token']) || empty($_SESSION['session_token'])){
        $_SESSION['error'] = "Please Login first";
        header('location: ./');
        exit;
    }
?>
