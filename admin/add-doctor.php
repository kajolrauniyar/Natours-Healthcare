<?php 
$page_title ="Add Doctor";
require 'inc/config.php'; ?>
<?php require 'inc/functions.php'; ?>
<?php require 'inc/header.php'; ?>
<?php require 'inc/logincheck.php'; ?>
<?php require 'inc/sidebar.php';?>
<?php 
    $act = "Add";

    if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
        $act = "Update";
        $id = (int)$_GET['id'];//id xahile integer data ho tesle  int garera pasaunu parxa...kahile kahi url ma id pathauda  string pani pathaune sakxa tesle int conversion use garne 
        if($id <= 0){
            $_SESSION['error'] = "Invalid doctor Id";
            @header('location: doctors');
            exit;
        }

        $doc_info = getdoctorById($id);//doctor data dinxa... valid  data  dinxa through id bata
        if(!$doc_info){//doctor data xaina bhnaera check garne
            $_SESSION['error'] = "doctor already deleted or does not exists.";
            @header('location: doctors');
            exit;
        }
    }

?>
<div class="page-wrapper">
   <!-- section about start-->
    <section class="section-about">
        <div class="row-login">
            <div class="container form">
                <form name="doctor"  action="doctor"  method="post" enctype="multipart/form-data">
                    <h3><?php echo ucfirst($act); ?> Doctor</h3>
                    <!-- name -->
                    <div class="form-group">
                        <label for="name">Doctor's Name:</label>
                        <input type="text" class="form-control" placeholder="Enter your Doctor's Name" name="full_name" id="full_name" value="<?php echo @$doc_info['full_name']; ?>">
                     </div>
                     <!-- photo -->
                    <div class="form-group">
                        <label for="name">Doctor's Photo:</label>
                        <input type="file"  name="image" accept="image/*" id="photo">
                        <?php 
                            if(isset($doc_info, $doc_info['image']) && !empty($doc_info['image']) && file_exists(UPLOAD_DIR.'/doctor/'.$doc_info['image'])){
                            ?>
                            <img src="<?php echo UPLOAD_URL.'doctor/'.$doc_info['image']; ?>" alt="" class="img img-thumbnail img-responsive">
                            <input type="checkbox" name="del_image" value="<?php echo $doc_info['image']; ?>"> Delete
                            <?php
                            }
                        ?>
                     </div>
                     <!-- email -->
                    <div class="form-group">
                        <label for="Email">Email:</label>
                        <input type="email" class="form-control" placeholder="Enter your Email" name="email" id="email" value="<?php echo @$doc_info['email']; ?>">
                     </div>
                     <!--gender  -->
                       <div class="form-group">
                        <label for="Gender">Gender:</label> 
                        <input type="radio" name="gender" value="Male" <?php echo (isset($doc_info, $doc_info['gender']) && $doc_info['gender'] == "Male") ? "selected" : ""; ?>>Male
                        <input type="radio" name="gender" value="Female" <?php echo (isset($doc_info, $doc_info['gender']) && $doc_info['gender'] == "Female") ? "selected" : ""; ?>>Female
                     </div>
                     <!-- dob -->
                     <div class="form-group">
                        <label for="Dob">Date of birth:</label>
                        <input type="date" name="dob" class="form-control"name="dob" id="dob" value="<?php echo @$doc_info['dob']; ?>"> 
                     </div>
                     
                     <!-- phone number -->
                     <div class="form-group">
                        <label for="Mobile Number">Mobile Number:</label>
                        <input type="Number" class="form-control"  placeholder="Enter your Mobile Number " name="mobile" id="mobile" value="<?php echo @$doc_info['mobile']; ?>"> 
                     </div>
                    
                     <!-- add. -->
                     <div class="form-group">
                        <label for="Address">Permanent Address:</label>
                        <textarea class="form-control" name="address" placeholder="Enter your Permanent Address" id="address" value="<?php echo @$doc_info['address']; ?>"></textarea> 
                     </div>
                     <!-- status -->
                      <div class="form-group">
                        <label for="status">Status:</label>
                        <input type="radio" name="status" value="Active" <?php echo (isset($doc_info, $doc_info['status']) && $doc_info['status'] == "Active") ? "selected" : ""; ?>>Active
                        <input type="radio" name="status" value="Inactive" <?php echo (isset($doc_info, $doc_info['status']) && $doc_info['status'] == "Inactive") ? "selected" : ""; ?>>Inactive
                    </div> 
                    <input type="hidden" name="doctor_id" value="<?php echo @$doc_info['id']; ?>">
                    <input type="hidden" name="old_image" value="<?php echo @$doc_info['image']; ?>">
                                 
                    <div class="form-group">
                    <button type="submit" class="btn btn-dark">Submit</button>
                    </div>
                </form> 
            </div>
        </div>
    </section>
</div>
<?php require 'inc/footer.php';?>