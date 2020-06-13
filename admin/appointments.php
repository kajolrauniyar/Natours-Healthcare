<?php

$page_title ="Appointment";
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
                <h4 class="page-title">List Of Appointment</h4>
            </div>
            <div class="col-wrapper-8">
                <a href="add-appointment" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Appointment</a>
            </div>
        </div>
        <div class="row-wrapper">
            <div class="col-wrapper-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Patient's Name</th>
                                <th>Age</th>
                                <th>doctor's Name</th>
                                <th>Appointment Date</th>
                                <th>Patient Phone</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $all_appointment=getAllAppointment();
                            if($all_appointment){
                                //debugger($all_appointment);
                                foreach($all_appointment as $key=>$appointment_info){
                                ?>
                                <tr>
                                    <td><?php  echo ($key+1);?></td>
                                    <td><?php  echo $appointment_info['patient_name'];?></td>
                                    <td><?php  echo $appointment_info['age'];?></td>
                                    <td><?php  echo $appointment_info['appointment_name'];?></td>
                                    <td><?php  echo $appointment_info['appoint_date'];?></td>
                                    <td><?php  echo $appointment_info['patient_phone'];?></td>
                                    <td><?php  echo $appointment_info['message'];?></td>
                                    <td><?php  echo $appointment_info['Appointment'];?></td>
                                    <td><?php  echo $appointment_info['status'];?></td>
                        <td>
                            <a href="add-appointment?id=<?php echo $appointment_info['id']; ?>" class="btn-link">Edit</a>
                                        / 
                            <a href="appointment?id=<?php echo $appointment_info['id'];?>" class="btn-link" onclick=" return confirm('Are you sure you want to delete this Appointment ? Once deleted it cannot be reverted back.' );">
                                            <i class="fa fa-trash-o">Delete</i></a>
                        </td>
                    </tr>
                    <?php
                        }

                        }else{
                            echo "<tr>
                                    <td colspan='6'>No Appointment</td>
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



























