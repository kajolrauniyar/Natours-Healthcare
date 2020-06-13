<?php 
$page_title ="Add Patients";
require 'inc/config.php'; ?>
<?php require 'inc/functions.php'; ?>
<?php require 'inc/header.php'; ?>
<?php require 'inc/logincheck.php'; ?>
<?php require 'inc/sidebar.php';?>

<?php require 'inc/sidebar.php'; ?>
<div class="page-wrapper">
   <!-- section about start-->
    <section class="section-about">
        <div class="row-login">
            <div class="container form">
                <form name="patient"  action="thank-you"  method="post" enctype="multipart/form-data">
                    <h3> Patient's Form</h3>
                    <!-- name -->
                    <div class="form-group">
                        <label for="name">Patient's Name:</label>
                        <input type="text" value="<?php echo @$pat_info['pname']; ?>" class="form-control" placeholder="Enter your Patient's Name" name="pname" id="name">
                     </div>
                     <!-- photo -->
                    <div class="form-group">
                        <label for="name">Patient's Photo:</label>
                        <input type="file"  name="photo" accept="image/*" id="photo">
                        <?php 
                            if(isset($pat_info, $pat_info['photo']) && !empty($pat_info['photo']) && file_exists(UPLOAD_DIR.'/patients/'.$pat_info['photo'])){
                            ?>
                            <img src="<?php echo UPLOAD_URL.'patients/'.$pat_info['photo']; ?>" alt="" class="img img-thumbnail img-responsive">
                            <input type="checkbox" name="del_photo" value="<?php echo $pat_info['photo']; ?>"> Delete
                            <?php
                            }
                        ?>
                     </div>
                     <!-- email -->
                    <div class="form-group">
                        <label for="Email">Email:</label>
                        <input type="email" class="form-control" placeholder="Enter your Email" value="<?php echo @$pat_info['email']; ?>" name="email" id="email">
                     </div>
                     <!--gender  -->
                       <div class="form-group">
                        <label for="Gender">Gender:</label>
                        <input type="radio" name="gender" value="Male" <?php echo (isset($pat_info, $pat_info['gender']) && $pat_info['gender'] == "Male") ? "selected" : ""; ?>>Male
                        <input type="radio" name="gender" value="Female" <?php echo (isset($pat_info, $pat_info['gender']) && $pat_info['gender'] == "Female") ? "selected" : ""; ?>>Female 
                     </div>
                     <!-- dob -->
                     <div class="form-group">
                        <label for="Dob">Date of birth:</label>
                        <input type="date" class="form-control"name="dob" id="dob" value="<?php echo @$pat_info['dob']; ?>"> 
                     </div>
                     <!-- height -->
                     <div class="form-group">
                        <label for="Height">Height:</label>
                        <input type="number" class="form-control"  placeholder="Enter your Height" name="height" id="height" value="<?php echo @$pat_info['height']; ?>"> 
                     </div>
                     <!-- weight -->
                     <div class="form-group">
                        <label for="Weight">Weight:</label>
                        <input type="number" class="form-control"  placeholder="Enter your Weight" name="weight" id="weight" value="<?php echo @$pat_info['weight']; ?>"> 
                     </div>
                     <!-- phone number -->
                     <div class="form-group">
                        <label for="Mobile Number">Mobile Number:</label>
                        <input type="Number" class="form-control"  placeholder="Enter your Mobile Number " name="mobile" id="mobile" value="<?php echo @$pat_info['mobile']; ?>"> 
                     </div>
                     <!-- marital -->
                     <div class="form-group">
                        <label for="Marital status">Marital status:</label>
                        <input type="radio" name="martial" value="Single" <?php echo (isset($pat_info, $pat_info['martial']) && $pat_info['martial'] == "single") ? "selected" : ""; ?>>Single
                        <input type="radio" name="martial" value="Married" <?php echo (isset($pat_info, $pat_info['martial']) && $pat_info['martial'] == "married") ? "selected" : ""; ?>>Married 
                     </div>
                     <!-- add. -->
                     <div class="form-group">
                        <label for="Address">Permanent Address:</label>
                        <textarea class="form-control" name="address" value="<?php echo @$pat_info['mobile']; ?>" placeholder="Enter your Permanent Address" id="address"></textarea> 
                     </div>
                     <!-- status -->
                      <div class="form-group">
                        <label for="status">Status:</label>
                        <input type="radio" name="status" value="Active" <?php echo (isset($pat_info, $pat_info['status']) && $pat_info['status'] == "single") ? "selected" : ""; ?>>Active
                        <input type="radio" name="status" value="Inactive" <?php echo (isset($pat_info, $pat_info['status']) && $pat_info['status'] == "married") ? "selected" : ""; ?>>Inactive 
                     </div>
                    <input type="hidden" name="pat_id" value="<?php echo @$pat_info['id']; ?>">
                    <input type="hidden" name="old_photo" value="<?php echo @$pat_info['photo']; ?>">                           
                    <div class="form-group">
                    <button type="submit" class="btn btn-dark">Submit</button>
                    </div>
                </form> 
            </div>
        </div>
    </section>
</div>
<?php require 'inc/footer.php';?>