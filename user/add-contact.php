<?php 
$page_title ="Contact";
require 'inc/config.php'; ?>
<?php require 'inc/functions.php'; ?>
<?php require 'inc/header.php'; ?>
<?php require 'inc/logincheck.php'; ?>
<?php require 'inc/sidebar.php';?>

<div class="page-wrapper">
   <!-- section about start-->
    <section class="section-about">
        <div class="row-login">
            <div class="container form">
                  <form name="contacts"  action="thank-you"  method="post" enctype="multipart/form-data">
                    <h3>Contact</h3>
                    <!-- name -->
                        <div class="form-group">
                            <label for="name">Full Name:</label>
                            <input type="text" class="form-control" id="name" value="<?php echo @$contact_info['full_name']; ?>" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" value="<?php echo @$contact_info['email']; ?>" name="email">
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="address" class="form-control" id="address" value="<?php echo @$contact_info['address']; ?>" name="address">
                         </div>
                        <div class="form-group">
                            <label for="number">Mobile number:</label>
                            <input type="number" class="form-control" id="mobile" name="number" value="<?php echo @$contact_info['mobile']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="number">Comment:</label>
                            <textarea type="text" class="form-control" id="comment" value="<?php echo @$contact_info['comment']; ?>"></textarea>
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





















