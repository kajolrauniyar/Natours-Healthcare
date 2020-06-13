<?php 
$page_title ="Register";
require 'inc/config.php'; ?>
<?php require 'inc/functions.php'; ?>
<?php require 'inc/header.php'; ?>
<?php require 'inc/logincheck.php'; ?>
<div class="page-wrapper">
    <section class="section-about">
        <div class="row-login">
            <div class="container form">
                <form name="doctor"  action="doctor"  method="post" enctype="multipart/form-data">
                    <h3>Register Form</h3>
                        <div class="form-group">
                            <label for="name">Patient's Name:</label>
                            <input type="text" class="form-control" placeholder="Enter your Patient's Name" name="name" id="name">
                         </div>
                         <div class="form-group">
                            <label for="number">Mobile Number:</label>
                            <input type="number" class="form-control" placeholder="Enter your Mobile Number" name="mobile" id="mobile">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" placeholder="Enter your Email" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="dob">Date Of Birth:</label>
                            <input type="date" class="form-control" placeholder="Enter your Date Of Birth" name="dob" id="dob">
                        </div>
                      
                        <div class="form-group">
                            <label for="name">Patient's Occupation:</label>
                            <input type="text" class="form-control" placeholder="Enter your Patient's Occupation" name="occupation" id="occupation">
                        </div>
                        <div class="form-group">
                            <label for="name">Patient's Father Name:</label>
                            <input type="text" class="form-control" placeholder="Enter your Patient's Father Name" name="father" id="father" >
                        </div>
                        <div class="form-group">
                            <label for="Address">Permanent Address:</label>
                          <textarea class="form-control" placeholder="Enter your Permanent Address" id="address"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="country">Country:</label>
                            <select class="form-control" id="country">
                                <option selected value="countryselected">Select Your Country</option>
                                <option value="nepal">Nepal</option>
                                <option value="India">India</option>
                                <option value="Fiji">Fiji</option>
                                <option value="USA">USA</option>
                                <option value="Australia">Australia</option>
                                <option value="england">England</option>
                                <option value="afghanistan">Afghanistan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Gender:</label>
                            <input type="radio" name="gender" value="Male" <?php echo (isset($pat_info, $pat_info['gender']) && $pat_info['gender'] == "Male") ? "selected" : ""; ?>>Male
                            <input type="radio" name="gender" value="Female" <?php echo (isset($pat_info, $pat_info['gender']) && $pat_info['gender'] == "Female") ? "selected" : ""; ?>>Female 
                        </div>
                        <div class="form-group">
                            <label for="name">Marital Status:</label>
                            <input type="radio"   name="marital" value="single">Single
                            <input type="radio"   name="marital" value="married">Married
                        </div>
                        <div class="form-group checkbox">
                            <label>
                                <input type="checkbox"> I have read and agree the Terms & Conditions
                            </label>
                        </div>
                        
                        <div class="form-group">
                        <button type="submit" class="btn btn-dark">Submit</button>
                        </div>
                        <div class="form-group text-center login-link">
                            Already have an account? <a href="index">Login</a>
                        </div>
                   </form>  
            </div>
        </div>
    </section>
</div>
<?php require 'inc/footer.php';?>