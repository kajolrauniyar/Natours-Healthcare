<?php 
$page_title ="Add Invoice";
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
            $_SESSION['error'] = "Invalid Invoice Id";
            @header('location: invoice');
            exit;
        }

        $ins_info = getInvoiceById($id);//Invoice data dinxa... valid  data  dinxa through id bata
        if(!$ins_info){//Invoice data xaina bhnaera check garne
            $_SESSION['error'] = "Invoice already deleted or does not exists.";
            @header('location: invoice');
            exit;
        }
    }

?>
<div class="page-wrapper">
   <!-- section about start-->
    <section class="section-about">
        <div class="row-login">
            <div class="container form">
                <form name="invoice"  action="invoice"  method="post" enctype="multipart/form-data">
                    <!-- transcation form -->
                    <h3><?php echo ucfirst($act); ?>  Invoice Form</h3>
             
                    <!-- Patient's Details -->
                    <div class="form-group">
                        <label for="details">Patient's Name:</label>
                        <input type="text" class="form-control"  name="clients" id="pname" value="<?php echo @$inv_info['clients']; ?>">
                    </div>
                    <div class="form-group">
                       <!-- relation --> 
                        <label for="details">Email:</label>
                        <input type="text" class="form-control" name="email" id="email" value="<?php echo @$inv_info['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="details">Tax:</label>
                        <input type="number" class="form-control"  name="tax" id="tax" value="<?php echo @$inv_info['tax']; ?>">
                    </div>
                    <div class="form-group">
                        <!-- client Address -->
                        <label for="number">Client Address:</label>
                       <textarea class="form-control" name="client_address" value="<?php echo @$inv_info['client_address']; ?>"></textarea>
                    </div>
                    <div class="form-group">
                       <label for="number">Billing Address:</label>
                       <textarea class="form-control"  name="billing_address" value="<?php echo @$inv_info['billing_address']; ?>"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Due Date:</label>
                        <input type="date" class="form-control"  name="due_date" id="due_date" value="<?php echo @$inv_info['due_date']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="item">Item:</label>
                        <input type="text" class="form-control"  name="item" id="item" value="<?php echo @$inv_info['item']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="number">Description:</label>
                        <textarea  class="form-control" name="description" value="<?php echo @$inv_info['description']; ?>"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="number" class="form-control"  name="amount" id="amount" value="<?php echo @$inv_info['amount']; ?>">
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
<?php require 'inc/footer.php';?>