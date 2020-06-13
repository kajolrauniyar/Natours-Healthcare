<?php

$page_title ="Doctor";
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
                <h4 class="page-title">Doctor</h4>
            </div>
            <div class="col-wrapper-8">
                <a href="add-doctor" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Doctor</a>
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
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>DOB</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $all_doctors=getAllDoctor();
                            if($all_doctors){
                                //debugger($all_doctors);
                                foreach($all_doctors as $key=>$doctor_info){
                                ?>
                                <tr>
                                    <td><?php  echo ($key+1);?></td>
                                    <td><?php  echo $doctor_info['full_name'];?></td>
                                    <td><?php  echo $doctor_info['email'];?></td>
                                    <td><?php  echo $doctor_info['mobile'];?></td>
                                    <td><?php  echo $doctor_info['dob'];?></td>
                                    <td><?php  echo $doctor_info['gender'];?></td>
                                    <td><?php  echo $doctor_info['address'];?></td>
                                    <td><?php  echo $doctor_info['image'];?></td>
                                    <td><?php  echo $doctor_info['status'];?></td>
                                    <td>
                                        <?php
                                        //echo UPLOAD_DIR.'/doctor/'.$doctor_info['image'];
                                            if(!empty($doctor_info['image']) && file_exists(UPLOAD_DIR.'/doctor/'.$doctor_info['image'])){
                                                ?>
                                                <img src="<?php echo UPLOAD_URL.'doctor/'.$doctor_info['image'];?>"  style="max-width:150px; "alt="" class="img img-responsive img-thumbnail">
                                                <?php
                                            }
                                        ?>
                                    </td>
                        <td>
                            <a href="add-doctor?id=<?php echo $doctor_info['id']; ?>" class="btn-link">Edit</a>
                                        / 
                            <a href="doctor?id=<?php echo $doctor_info['id'];?>" class="btn-link" onclick=" return confirm('Are you sure you want to delete this doctor ? Once deleted it cannot be reverted back.' );">
                                            <i class="fa fa-trash-o">Delete</i></a>
                        </td>
                    </tr>
                    <?php
                        }

                        }else{
                            echo "<tr>
                                    <td colspan='6'>No doctor</td>
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



























