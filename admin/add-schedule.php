<?php 
$page_title ="Add schedule";
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
            $_SESSION['error'] = "Invalid schedule Id";
            @header('location: schedules');
            exit;
        }

        $sch_info = getScheduleById($id);//schedule data dinxa... valid  data  dinxa through id bata
        if(!$sch_info){//schedule data xaina bhnaera check garne
            $_SESSION['error'] = "schedule already deleted or does not exists.";
            @header('location: schedules');
            exit;
        }
    }

?>
<div class="page-wrapper">
    <section class="section-about">
        <div class="row-login">
            <div class="container form">
                <form name="schedule"  action="schedule"  method="post" enctype="multipart/form-data">
                    <h3><?php echo ucfirst($act); ?>  Schedule</h3>
                    <div class="form-group">
                        <label for="name">Doctor's Name:</label>
                        <input type="text" class="form-control"  name="dr_name" value="<?php echo @$sch_info['dr_name']; ?>">
                     </div>
                    <div class="form-group">
                        <label for="available_days">Available Days:</label>
                        <input type="date" class="form-control"  name="available_days" value="<?php echo @$sch_info['available_days']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="start_time">Start Time:</label>
                        <input type="time" class="form-control"  name="start_time" value="<?php echo @$sch_info['start_time']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="end_time">End Time:</label>
                        <input type="time" class="form-control"  name="end_time" value="<?php echo @$sch_info['end_time']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <input type="message" class="form-control"  name="message" value="<?php echo @$sch_info['message']; ?>">
                     </div>
                    <div class="form-group">
                        <label for="schedule_status">Schedule Status:</label>
                        <input type="radio" name="status" value="Active" <?php echo (isset($sch_info, $sch_info['status']) && $sch_info['status'] == "Active") ? "selected" : ""; ?>>Active
                        <input type="radio" name="status" value="Inactive" <?php echo (isset($sch_info, $sch_info['status']) && $sch_info['status'] == "Inactive") ? "selected" : ""; ?>>Inactive
                    </div>
                    <input type="hidden" name="schedule_id" value="<?php echo @$sch_info['id']; ?>">
                    <div class="form-group">
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>
                </form>  
            </div>
        </div>
    </section>
</div>
<?php require 'inc/footer.php'?>



















































