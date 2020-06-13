<?php 

require 'inc/config.php';
$page_title ="Login";
require 'inc/functions.php';
require 'inc/header.php';



    if(isset($_SESSION, $_SESSION['session_token']) && !empty($_SESSION['session_token'])){

        header('location: dashboard');
        exit;
    }


    if(isset($_COOKIE, $_COOKIE['_au']) && !empty($_COOKIE['_au'])){
         //debugger($_COOKIE,true);
          //debugger($_SESSION,true);

        header('location: dashboard');
        exit;
    }

?>
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                    <?php require 'inc/notifications.php';?>
                    <form role="form" method="post" action="login">
                       
                        <div class="form-group">
                            <label>Username or Email</label>
                            <input class="form-control" placeholder="E-mail" name="email" type="email" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" placeholder="Password" name="password" type="password" value=""required>
                        </div>
                        <div class="form-group text-right">
                            <label>
                                <input name="remember" type="checkbox" value="1">Remember Me
                            </label>
                        </div>
                        <div class="form-group text-center">

                            <button type="submit" class="btn btn-primary account-btn">Login</button>
                        </div>
                        <!-- <div class="text-center register-link">
                            Don’t have an account? <a href="register.html">Register Now</a>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php require 'inc/footer.php';?>