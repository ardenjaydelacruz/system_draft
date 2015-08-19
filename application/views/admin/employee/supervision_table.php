<div class="content-wrapper">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <?php if($this->input->post('txtSearch')) {
            echo "<li><a href='employees' class='btn btn-default'>Employees</a></li>";
            echo "<li class='active'>Search Employees</li>";
        } else {
            echo "<li class='active'>Employees Supervision</li>";
        }
        ?>
    </ol>
    <div class="container-fluid">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-sm-8">
                        <h1 class="box-title big">Employees Supervision
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
                        <buttom class="btn btn-success"><i class="fa fa-plus"></i> Add Employee Supervision </buttom>
                    </a>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <th class="table-head">Emp. ID</th>
                        <th class="table-head">Employee Name</th>
                        <th class="table-head">Supervisor Name</th>
                        <th class="table-head">Assigned Date</th>
                    </thead>
                    <?php
                    foreach ($record as $row) {	?>
                        <tr>
                            <td align="center">
                                <?php echo $row->employee_id; ?>
                            </td>
                            <td class="text-center"> 
                                <?php echo $row->employee_name; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $row->supervisor_name; ?>
                            </td>
                            <td class="text-center">
                                <?php echo date_format($row->assigned_date,'M d, Y'); ?>
                            </td>
                        </tr>
                        <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
