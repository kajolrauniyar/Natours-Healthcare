<?php

$page_title ="patients";
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
                <h4 class="page-title">List Of Patients</h4>
            </div>
            <div class="col-wrapper-8">
                <a href="add-patients" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add patients</a>
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
                                <th>Email</th>
                                <th>Gender</th>
                                <th>DOB</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th>Photo</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $all_patients=getAllPatients();
                            if($all_patients){
                                //debugger($all_patients);
                                foreach($all_patients as $key=>$patients_info){
                                ?>
                                <tr>
                                    <td><?php  echo ($key+1);?></td>
                                    <td><?php  echo $patients_info['pname'];?></td>
                                    <td><?php  echo $patients_info['email'];?></td>
                                    <td><?php  echo $patients_info['gender'];?></td>
                                    <td><?php  echo $patients_info['dob'];?></td>
                                    <td><?php  echo $patients_info['mobile'];?></td>                                   
                                    <td><?php  echo $patients_info['status'];?></td>
                                    <td>
                                        <?php
                                        //echo UPLOAD_DIR.'/patients/'.$patients_info['photo'];
                                            if(!empty($patients_info['photo']) && file_exists(UPLOAD_DIR.'/patients/'.$patients_info['photo'])){
                                                ?>
                                                <img src="<?php echo UPLOAD_URL.'patients/'.$patients_info['photo'];?>"  style="max-width:150px; "alt="" class="img img-responsive img-thumbnail">
                                                <?php
                                            }
                                        ?>
                                    </td>
                        <td>
                            <a href="add-patients?id=<?php echo $patients_info['id']; ?>" class="btn-link">Edit</a>
                                        / 
                            <a href="patient?id=<?php echo $patients_info['id'];?>" class="btn-link" onclick=" return confirm('Are you sure you want to delete this patients ? Once deleted it cannot be reverted back.' );">
                                            <i class="fa fa-trash-o">Delete</i></a>
                        </td>
                    </tr>
                    <?php
                        }

                        }else{
                            echo "<tr>
                                    <td colspan='6'>No patients</td>
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



























