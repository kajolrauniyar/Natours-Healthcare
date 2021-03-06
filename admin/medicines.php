<?php

$page_title ="medicine";
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
                <h4 class="page-title">List Of Medicine</h4>
            </div>
            <div class="col-wrapper-8">
                <a href="add-medicine" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Medicine</a>
            </div>
        </div>
        <div class="row-wrapper">
            <div class="col-wrapper-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Item Name</th>
                                <th>Purchase From</th>
                                <th>Purchase Date</th>
                                <th>Purchase By</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $all_medicines=getAllMedicine();
                            if($all_medicines){
                                //debugger($all_medicines);
                                foreach($all_medicines as $key=>$medicine_info){
                                ?>
                                <tr>
                                    <td><?php  echo ($key+1);?></td>
                                    <td><?php  echo $medicine_info['item_name'];?></td>
                                    <td><?php  echo $medicine_info['purchase_from'];?></td>
                                    <td><?php  echo $medicine_info['purchase_date'];?></td>
                                    <td><?php  echo $medicine_info['purchase_by'];?></td>
                                    <td><?php  echo $medicine_info['amount'];?></td>
                                    <td><?php  echo $medicine_info['status'];?></td>
                        <td>
                            <a href="add-medicine?id=<?php echo $medicine_info['id']; ?>" class="btn-link">Edit</a>
                                        / 
                            <a href="medicine?id=<?php echo $medicine_info['id'];?>" class="btn-link" onclick=" return confirm('Are you sure you want to delete this medicine ? Once deleted it cannot be reverted back.' );">
                                            <i class="fa fa-trash-o">Delete</i></a>
                        </td>
                    </tr>
                    <?php
                        }

                        }else{
                            echo "<tr>
                                    <td colspan='6'>No medicine</td>
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



























