<?php 
$page_title ="Add medicine";
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
            $_SESSION['error'] = "Invalid medicine Id";
            @header('location: medicines');
            exit;
        }

        $ins_info = getmedicineById($id);//medicine data dinxa... valid  data  dinxa through id bata
        if(!$ins_info){//medicine data xaina bhnaera check garne
            $_SESSION['error'] = "medicine already deleted or does not exists.";
            @header('location: medicines');
            exit;
        }
    }

?>
<div class="page-wrapper">
   <!-- section about start-->
    <section class="section-about">
        <div class="row-login">
            <div class="container form">
                <form name="medicine"  action="medicine"  method="post" enctype="multipart/form-data">
                    <h3><?php echo ucfirst($act); ?> Medicine</h3>
                    <div class="form-group">
                        <label for="name">Items Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Items Name" id="name" name="item_name" value="<?php echo @$med_info['item_name']; ?>">
                     </div>
                     <!-- email -->
                     <div class="form-group">
                        <label for="email">Purchase From:</label>
                        <input type="date" class="form-control" id="from" name="purchase_from" value="<?php echo @$med_info['purchase_from']; ?>">
                     </div>
                     <!-- phone -->
                     <div class="form-group">
                        <label for="purchase">Purchase Date:</label>
                        <input type="date" class="form-control" id="date" name="purchase_date" value="<?php echo @$med_info['purchase_date']; ?>">
                     </div>
                    <!-- bill country -->
                    <div class="form-group">
                        <label for="purchase">Purchase By:</label>
                        <input type="date" class="form-control" id="by" name="purchase_by" value="<?php echo @$med_info['purchase_by']; ?>">
                     </div>
              
                    <!-- state -->
                    <div class="form-group">
                        <label for="purchase">Amount:</label>
                        <input type="number" class="form-control" id="amount" name="amount" value="<?php echo @$med_info['amount']; ?>">
                     </div>
                     <div class="form-group">
                        <label for="status">Status:</label>
                        <input type="radio" name="status" value="Active" <?php echo (isset($doc_info, $doc_info['status']) && $doc_info['status'] == "Active") ? "selected" : ""; ?>>Active
                        <input type="radio" name="status" value="Inactive" <?php echo (isset($doc_info, $doc_info['status']) && $doc_info['status'] == "Inactive") ? "selected" : ""; ?>>Inactive
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>
                </form>  
            </div>
        </div>
    </section>
</div>
 <?php  require 'inc/footer.php';?>


































