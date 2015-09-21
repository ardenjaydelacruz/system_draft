<div class="content-wrapper">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class='active'>Employees</li>
    </ol>
    <div class="container-fluid">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-sm-8">
                        <h1 class="box-title big">Employees
                        </h1>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <table id="dynamicTable" class="table table-striped table-hover table-bordered">
                    <thead class="success">
                        <!-- <th><input type="checkbox" class="checkbox"></th> -->
                        <th class="table-head">Emp. ID</th>
                        <th class="table-head">First Name</th>
                        <th class="table-head">Middle Name</th>
                        <th class="table-head">Last Name</th>
                        <th class="table-head">Job Title</th>
                        <th class="table-head">Dept</th>
                        <th class="table-head">Status</th>
                    </thead>
                    <?php
                    foreach ($record as $row) {	?>
                        <tr>
                            <td align="center">
                                <?php echo $row->emp_id; ?>
                            </td>
                            <td>
                                <?php echo $row->first_name; ?>
                            </td>
                            <td>
                                <?php echo $row->middle_name; ?>
                            </td>
                            <td>
                                <?php echo $row->last_name; ?>
                            </td>
                            <td>
                                <?php echo $row->job_title_name; ?>
                            </td>
                            <td>
                                <?php echo $row->department_name; ?>
                            </td>
                            <td class="text-center">
                                <?php if ($row->status == 'Existing'){
                                    echo "<label class='label label-success'>$row->status</label>"; 
                                } elseif ($row->status == 'OnLeave') {
                                    echo "<label class='label label-warning'>$row->status</label>";
                                } else {
                                    echo "<label class='label label-danger'>$row->status</label>";
                                }
                                ?>
                            </td>
                        </tr>
                        <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
