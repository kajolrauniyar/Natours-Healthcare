<?php

$page_title ="schedule";
require 'inc/config.php';
require 'inc/header.php';
require 'inc/functions.php';
require 'inc/logincheck.php';
require 'inc/sidebar.php'; 
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row-wrapper">
            <div class="col-wrapper-3">
                <h4 class="page-title">List Of Schedule</h4>
            </div>
            <div class="col-wrapper-8">
                <a href="add-schedule" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add schedule</a>
            </div>
        </div>
        <div class="row-wrapper">
            <div class="col-wrapper-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Doctor's Name</th>
                                <th>Available Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $all_schedules=getAllSchedule();
                            if($all_schedules){
                                //debugger($all_schedules);
                                foreach($all_schedules as $key=>$schedule_info){
                                ?>
                                <tr>
                                    <td><?php  echo ($key+1);?></td>
                                    <td><?php  echo $schedule_info['dr_name'];?></td>
                                    <td><?php  echo $schedule_info['available_days'];?></td>
                                    <td><?php  echo $schedule_info['start_time'];?></td>
                                    <td><?php  echo $schedule_info['end_time'];?></td>
                                    <td><?php  echo $schedule_info['message'];?></td>
                                    <td><?php  echo $schedule_info['status'];?></td>
                           
                        <td>
                            <a href="add-schedule?id=<?php echo $schedule_info['id']; ?>" class="btn-link">Edit</a>
                                        / 
                            <a href="schedule?id=<?php echo $schedule_info['id'];?>" class="btn-link" onclick=" return confirm('Are you sure you want to delete this schedule ? Once deleted it cannot be reverted back.' );">
                                            <i class="fa fa-trash-o">Delete</i></a>
                        </td>
                    </tr>
                    <?php
                        }

                        }else{
                            echo "<tr>
                                    <td colspan='6'>No schedule</td>
                                </tr>";
                        }
                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'inc/footer.php';?>



























