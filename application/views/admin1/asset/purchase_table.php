<div class="content-wrapper">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url();?>ams/view_assets" class="btn btn-default"><i class="fa fa-user"></i> Assets</a></li>
        <li class="active"><i class="fa fa-calendar"></i> Vendors </li>
    </ol>
    <div class="container-fluid">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h1 class="panel-title big">Purchase Table</h1>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-hover table-bordered table-condensed centered">
                    <thead>
                        <th class="text-center">Order Number</th>
                        <th class="text-center">Item Name</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Vendor</th>
                        <th class="text-center">Date Ordered</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Quantity Delivered</th>
                        <th class="text-center">Notes</th>
                        <th class="text-center">Date Delivered</th>
                        <th class="text-center">Manage</th>
                    </thead>
                    <?php foreach ($record as $row) { ?>
                        <tr>
                            <td>
                                <?php echo $row->order_number; ?>
                            </td>
                            <td>
                                <?php echo $row->item_name; ?>
                            </td>
                            <td>
                                <?php echo $row->quantity; ?>
                            </td>
                            <td>
                                <?php echo $row->price; ?>
                            </td>
                            <td>
                                <?php echo $row->vendor; ?>
                            </td>
                            <td>
                                <?php echo $row->date_ordered; ?>
                            </td>
                            <td>
                                <?php echo $row->status; ?>
                            </td>
                            <td>
                                <?php echo $row->number_of_items_delivered; ?>
                            </td>
                            <td>
                                <?php echo $row->notes; ?>
                            </td>
                            <td>
                                <?php echo $row->date_delivered; ?>
                            </td>
                        </tr>
                        <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
