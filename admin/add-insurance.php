<?php 
$page_title ="Add Insurance";
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
            $_SESSION['error'] = "Invalid Insurance Id";
            @header('location: insurances');
            exit;
        }

        $ins_info = getInsuranceById($id);//Insurance data dinxa... valid  data  dinxa through id bata
        if(!$ins_info){//Insurance data xaina bhnaera check garne
            $_SESSION['error'] = "Insurance already deleted or does not exists.";
            @header('location: insurances');
            exit;
        }
    }

?>
<div class="page-wrapper">
   <!-- section about start-->
     <section class="section-about">
        <div class="row-login">
            <div class="container form">
                <form name="insurance"  action="insurance"  method="post" enctype="multipart/form-data">
                    <h3><?php echo ucfirst($act); ?> Insurance Form</h3>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" placeholder="Enter your  name" name="name" value="<?php echo @$ins_info['name']; ?>">
                     </div>
                     <!-- phone -->
                     <div class="form-group">
                        <label for="mobile number"> Mobile Number:</label>
                        <input type="Number" class="form-control"  placeholder="Enter Mobile Number" name="mobile" value="<?php echo @$ins_info['mobile']; ?>">
                     </div>
                     <!-- email -->
                     <div class="form-group">
                        <label for="email"> Email:</label>
                        <input type="email" class="form-control" placeholder="Enter Email" name="email" value="<?php echo @$ins_info['email']; ?>">
                     </div>
                     <!-- add. -->
                     <div class="form-group">
                        <label for="address">Permanent Address:</label>
                        <textarea class="form-control" placeholder="Enter your Permanent Address" name="address" value="<?php echo @$ins_info['address']; ?>"></textarea> 
                     </div>
                     <!-- plan -->
                     <div class="form-group">
                        <label for="plan">Insurance Plan</label>
                        <select class="form-control" name="insurance_plan" id="insurance_plan">
                            <option  value="5-7lac" selected>Select your plan</option>
                            <option  value="5-7lakh" <?php echo (isset($ins_info, $ins_info['status']) && $ins_info['status'] == "5-7lakh") ? "selected" : ""; ?>>5-7lakh</option>
                            <option  value="7-10lakh" <?php echo (isset($ins_info, $ins_info['status']) && $ins_info['status'] == "7-10lakh") ? "selected" : ""; ?>>7-10lakh</option>
                            <option  value="10-15lakh" <?php echo (isset($ins_info, $ins_info['status']) && $ins_info['status'] == "10-15lakh") ? "selected" : ""; ?>>10-15lakh</option>
                            <option  value="15lakh-more" <?php echo (isset($ins_info, $ins_info['status']) && $ins_info['status'] == "15lakh-more") ? "selected" : ""; ?>>15lakh-more</option>
                        </select> 
                     </div>
                      <div class="form-group">
                        <label for="status">Status:</label>
                        <input type="radio" name="status" value="Active" <?php echo (isset($doc_info, $doc_info['status']) && $doc_info['status'] == "Active") ? "selected" : ""; ?>>Active
                        <input type="radio" name="status" value="Inactive" <?php echo (isset($doc_info, $doc_info['status']) && $doc_info['status'] == "Inactive") ? "selected" : ""; ?>>Inactive
                    </div> 
                       <!-- email -->
                     <div class="form-group">
                        <input type="checkbox"  name="checkbox" value="1">I authorised  health insurance limited.
                     </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>
                </form>  
            </div>
        </div>
    </section>
</div>
<?php require 'inc/footer.php'; ?>