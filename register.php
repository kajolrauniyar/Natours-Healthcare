<?php 
$page_title ="Register";
error_reporting(0);
require 'inc/header.php'; ?>
<?php
 
include("DBConnection.php"); // include the connection object from the DBConnection.php
 
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{ 
     $inFullname = $_POST["fullname"]; // as the method type in the form is "post" we are using $_POST otherwise it would be $_GET[]
     $inEmail = $_POST["email"];
     $inUsername = $_POST["username"];
     $inPassword = $_POST["password"];

    $encryptPassword = password_hash($inPassword, PASSWORD_DEFAULT);
     
     $stmt = $db->prepare("INSERT INTO register(FULLNAME, EMAIL, USERNAME, PASSWORD) VALUES(?, ?, ?, ?)"); //Fetching all the records with input credentials
     $stmt->bind_param("ssss", $inFullname, $inEmail, $inUsername, $encryptPassword); //Where s indicates string type. You can use i-integer, d-double
     $stmt->execute();
     $result = $stmt->affected_rows;
     $stmt -> close();
     $db -> close(); 
    
    if($result > 0)
     {
        echo 'Register successful Plz login';
        header("location: login.php"); // user will be taken to the success page
     }
     else
     {
         echo "Oops. Something went wrong. Please try again"; 
         ?>
         <a href="register.php">Try Login</a>
         <?php 
     }
}
?>
<div class="page-wrapper">
    <section class="section-about">
        <div class="row-login">
            <div class="container form">
                <form name="register" method="post" action="user/index.php" onsubmit="return validate();" >
                    <h3>Register Form</h3>
                        <div class="form-group">
                            <label for="name">Patient's Name:</label>
                            <input type="text" class="form-control" placeholder="Enter your Patient's Name" name="fullname" id="name">
                         </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" placeholder="Enter your Email" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="username" class="form-control" placeholder="Enter your username" name="username" id="username">
                            
                        </div>

                        <div class="form-group">
                            <label for="password">password:</label>
                            <input type="password" class="form-control" placeholder="Enter your password" name="password" id="password">
                        </div>

                        <div class="form-group">
                            <label for="password">Confirm Password:</label>
                            <input type="password" class="form-control" placeholder="Enter your password" name="conpassword" id="password">
                        </div>

                        
                        <div class="form-group">
                        <button type="submit"  value="Register"class="btn btn-dark">Submit</button>
                        </div>
                        <div class="form-group text-center login-link">
                            Already have an account? <a href="user/index">Login</a>
                        </div>
                   </form>  
            </div>
        </div>
    </section>
</div>
<script>
function validate()
{ 
var fullname = document.register.fullname.value;
var email = document.register.email.value;
var username = document.register.username.value; 
var password = document.register.password.value;
var conpassword= document.register.conpassword.value;
if (fullname==null || fullname=="")
{ 
alert("Full Name can't be blank"); 
return false; 
}
else if (email==null || email=="")
{ 
alert("Email can't be blank"); 
return false; 
}
else if (username==null || username=="")
{ 
alert("Username can't be blank"); 
return false; 
}
else if(password.length&amp;lt;6)
{ 
alert("Password must be at least 6 characters long."); 
return false; 
} 
else if (password!=conpassword)
{ 
alert("Confirm Password should match with the Password"); 
return false; 
} 
} 
</script> 
<?php require 'inc/footer.php';?>