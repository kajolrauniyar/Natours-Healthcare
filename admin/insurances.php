<?php

$page_title ="insurance";
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
                <h4 class="page-title">List Of insurance</h4>
            </div>
            <div class="col-wrapper-8">
                <a href="add-insurance" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add insurance</a>
            </div>
        </div>
        <div class="row-wrapper">
            <div class="col-wrapper-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Insurance Plan</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $all_insurances=getAllInsurance();
                            if($all_insurances){
                                //debugger($all_insurances);
                                foreach($all_insurances as $key=>$insurance_info){
                                ?>
                                <tr>
                                    <td><?php  echo ($key+1);?></td>
                                    <td><?php  echo $insurance_info['name'];?></td>
                                    <td><?php  echo $insurance_info['email'];?></td>
                                    <td><?php  echo $insurance_info['mobile'];?></td>
                                    <td><?php  echo $insurance_info['address'];?></td>
                                    <td><?php  echo $insurance_info['insurance_plan'];?></td>
                                    <td><?php  echo $insurance_info['status'];?></td>
                        <td>
                            <a href="add-insurance?id=<?php echo $insurance_info['id']; ?>" class="btn-link">Edit</a>
                                        / 
                            <a href="insurance?id=<?php echo $insurance_info['id'];?>" class="btn-link" onclick=" return confirm('Are you sure you want to delete this insurance ? Once deleted it cannot be reverted back.' );">
                                            <i class="fa fa-trash-o">Delete</i></a>
                        </td>
                    </tr>
                    <?php
                        }

                        }else{
                            echo "<tr>
                                    <td colspan='6'>No insurance</td>
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



























