<?php

$page_title ="invoice";
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
                <h4 class="page-title">List Of invoice</h4>
            </div>
            <div class="col-wrapper-8">
                <a href="add-invoice" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add invoice</a>
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
                                <th>Tax</th>
                                <th>Client Address</th>
                                <th>Billing Address</th>
                                <th>Due Date</th>
                                <th>Item</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $all_invoices=getAllInvoice();
                            if($all_invoices){
                                //debugger($all_invoices);
                                foreach($all_invoices as $key=>$invoice_info){
                                ?>
                                <tr>
                                    <td><?php  echo ($key+1);?></td>
                                    <td><?php  echo $invoice_info['clients'];?></td>
                                    <td><?php  echo $invoice_info['email'];?></td>
                                    <td><?php  echo $invoice_info['tax'];?></td>
                                    <td><?php  echo $invoice_info['client_address'];?></td>
                                    <td><?php  echo $invoice_info['billing_address'];?></td>
                                    <td><?php  echo $invoice_info['due_date'];?></td>
                                    <td><?php  echo $invoice_info['item'];?></td>
                                    <td><?php  echo $invoice_info['description'];?></td>
                                    <td><?php  echo $invoice_info['amount'];?></td>
                                    <td><?php  echo $invoice_info['status'];?></td>
                        <td>
                            <a href="add-invoice?id=<?php echo $invoice_info['id']; ?>" class="btn-link">Edit</a>
                                        / 
                            <a href="invoice?id=<?php echo $invoice_info['id'];?>" class="btn-link" onclick=" return confirm('Are you sure you want to delete this invoice ? Once deleted it cannot be reverted back.' );">
                                            <i class="fa fa-trash-o">Delete</i></a>
                        </td>
                    </tr>
                    <?php
                        }

                        }else{
                            echo "<tr>
                                    <td colspan='6'>No invoice</td>
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






























