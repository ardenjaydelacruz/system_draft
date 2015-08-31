<div class="content-wrapper">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class='active'>Audit Trail</li>
    </ol>
    <div class="container-fluid">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-8">
                        <h1 class="panel-title big">Audit Trail</h1>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table id="dynamicTable" class="table table-striped table-hover table-bordered">
                <thead>
                    <th class="table-head">ID</th>
                    <th class="table-head">Name</th>
                    <th class="table-head">User Level</th>
                    <th class="table-head">IP Address</th>
                    <th class="table-head">Action</th>
                    <th class="table-head">Emp ID</th>
                    <th class="table-head">Date and Time</th>
                </thead>
                <?php
                    foreach ($audit as $record) { 
                ?>
                <tr>
                    <td align="center">
                        <?php echo $record->audit_trail_id; ?>
                    </td>
                    <td>
                        <?php echo $record->username; ?>
                    </td>
                    <td>
                        <?php echo $record->user_level; ?>
                    </td>
                    <td align="center">
                        <?php if($record->ip_address=='::1'){echo '127.0.0.1';} else {echo $record->ip_address;} ?>
                    </td>
                    <td>
                        <?php echo $record->action; ?>
                    </td>
                    <td>
                        <?php echo $record->employee_id; ?>
                    </td>
                    <td align="center">
                        <?php echo date('F d, Y - g:i A',strtotime($record->date_time)); ?>
                    </td>
                </tr>
                <?php  }  ?>
            </table>
            
            </div>
        </div>
    </div>
</div>
