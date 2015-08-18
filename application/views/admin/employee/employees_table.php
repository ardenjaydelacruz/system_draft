<div class="content-wrapper">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <?php if($this->input->post('txtSearch')) {
            echo "<li><a href='employees' class='btn btn-default'>Employees</a></li>";
            echo "<li class='active'>Search Employees</li>";
        } else {
            echo "<li class='active'>Employees</li>";
        }
        ?>
    </ol>
    <div class="container-fluid">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-sm-8">
                        <h1 class="box-title big">Employees
                        </h1>
                    </div>
                    <form action="<?php echo base_url();?>ems/search_employee" method="post">
                        <div class="col-sm-4">
                            <div class="input-group input-group">
                                <input type="text" class="form-control" placeholder="Search Employee (Id / Name / City)" name="txtSearch">
                                <span class="input-group-btn">
                                <button class="btn btn-info btn-flat" name="btnSearch"><i class="fa fa-search fa-lg"></i></button>
                            </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box-body">
                <div class="pull-left add-employee">
                    <a href="<?php echo base_url();?>ems/add_employee">
                        <buttom class="btn btn-success"><i class="fa fa-plus"></i> Add Employee </buttom>
                    </a>
                    <buttom class="btn btn-info btn-sm">
                        <?php echo "Total Employees: ". $total_employee; ?>
                    </buttom>
                </div>
                <div class="pull-right">

                    <?php
                        if(isset($links)) echo $links;
                        ?>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <!-- <th><input type="checkbox" class="checkbox"></th> -->
                        <th class="table-head">Emp. ID</th>
                        <th class="table-head">First Name</th>
                        <th class="table-head">Middle Name</th>
                        <th class="table-head">Last Name</th>
                        <th class="table-head">Job Title</th>
                        <th class="table-head">Department</th>
                        <th class="table-head">Status</th>
                        <th class="table-head">Manage</th>
                    </thead>
                    <?php
                    foreach ($record as $row) {	?>
                        <tr>
                            <!-- <td><input type="checkbox" class="checkbox" name="checkbox[]"></td> -->
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
                            <td align="center">
                                <a href="<?php echo base_url();?>ems/view_details?emp_id=<?php echo $row->emp_id; ?>">
                                    <button class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="View Employee">
                                        <i class="fa fa-user"></i>
                                    </button>
                                </a>
                                <a href="<?php echo base_url();?>ems/request_leave?emp_id=<?php echo $row->emp_id; ?>">
                                    <button class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Add Leave Request">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </a>
                                <a href="<?php echo base_url();?>ems/evaluate_employee?emp_id=<?php echo $row->emp_id; ?>">
                                    <button class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Evaluate Employee">
                                        <i class="fa fa-star"></i>
                                    </button>
                                </a>
                                <button class="btn btn-danger btn-xs" onclick=deleteEmployee(<?php echo $row->emp_id; ?>,'<?php echo base_url();?>ems/'); data-toggle="tooltip" data-placement="top" title="Delete Employee">
                                        <i class="fa fa-trash-o"></i>
                                </button>
                                <!-- <input type="button" class="btn btn-danger btn-xs" value="Delete" onclick=deleteAlert(<?php echo $row->emp_id; ?>)> -->
                                <!-- <a href="<?php echo base_url();?>ems/delete_employee?emp_id=<?php echo $row->emp_id; ?>">
                            <input type="button" class="btn btn-danger btn-xs" value="Delete onclick=deleteAlert(<?php echo $row->emp_id; ?>)">
                        </a> -->
                            </td>
                        </tr>
                        <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
