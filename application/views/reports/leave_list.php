<div class="content-wrapper">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url();?>ams/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><i class="fa fa-cogs"></i> Leaves Left </li>
	</ol>
	<div class="container-fluid">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h1 class="panel-title big">Leaves Report</h1>
			</div>
			<div class="panel-body">
				<form action="<?php echo base_url();?>reports/leave_list" role="form" method="post">
          <div class="row">
              <div class="col-sm-12">
                  <div class="page-header pull-left">
                      <h4>Filter By:</h4>
                  </div>
                  <div class="pull-right">
                      <input type="submit" name="btnFilter" value="Filter" class="btn btn-success btn-lg">
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="emp_name">Employee Name:</label>
                    <select name="txtEmployee" id="emp_name" class="form-control">
                        <option value="">All Employees</option>
                        <?php foreach ($employee as $row){ 
                            echo "<option value='$row->emp_id'>$row->first_name $row->middle_name $row->last_name</option>";
                        } ?>
                    </select>
                </div>
            </div>
          </div><br>
          </form>
         <?php if ($this->input->post('btnFilter')) { ?>
	        <table class="table table-hovered table-striped table-bordered">
            <thead>
               <th class="text-center">Employee Name</th>
                 <th class="text-center">Birthday Leave</th>
                 <th class="text-center">Mandatory Leave</th>
                 <th class="text-center">Maternity Leave</th>
                 <th class="text-center">Paternity Leave</th>
                 <th class="text-center">Sick Leave</th>
                 <th class="text-center">Vacation Leave</th>
                 <th class="text-center">Total Leaves Left</th>
            </thead>
             <?php foreach ($leaves as $row) { ?>
             <tr>
                  <td class=""><?php echo $row->name; ?></td>
                  <td class="text-center <?php if ($row->birthday_leave==0) echo 'bgRed'; ?>"><?php echo $row->birthday_leave; ?></td>
                  <td class="text-center <?php if ($row->mandatory_leave==0) echo 'bgRed'; ?>"><?php echo $row->mandatory_leave; ?></td>
                  <td class="text-center <?php if ($row->maternity_leave==0) echo 'bgRed'; ?>"><?php echo $row->maternity_leave; ?></td>
                  <td class="text-center <?php if ($row->paternity_leave==0) echo 'bgRed'; ?>"><?php echo $row->paternity_leave; ?></td>
                  <td class="text-center <?php if ($row->sick_leave==0) echo 'bgRed'; ?>"><?php echo $row->sick_leave; ?></td>
                  <td class="text-center <?php if ($row->vacation_leave==0) echo 'bgRed'; ?>"><?php echo $row->vacation_leave; ?></td>
                  <th class="text-center success <?php if ($row->total_leave==0) echo 'bgRed'; ?>"><?php echo $row->total_leave; ?></th>
              </tr>
             <?php } ?>
         </table>
				<?php }  ?>
			</div>
		</div>
	</div>
</div>
