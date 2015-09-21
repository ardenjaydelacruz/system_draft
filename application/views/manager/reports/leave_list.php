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
          </div>
          </form>
          <?php if ($this->input->post('btnFilter')) { ?>
          <form action="<?php echo base_url();?>reports/leave_list" role="form" method="post">
            <input type="hidden" name="txtEmployee" value="<?php echo $this->input->post('txtEmployee') ?>">
            <input type="submit" name="btnPrint" value="Print" class="btn btn-info">
          </form>
	        <table class="table table-hovered table-striped table-bordered">
            <thead>
               <th class="text-center">Employee Name</th>
                 <th class="text-center">Emergency Leave</th>
                 <th class="text-center">Maternity Leave</th>
                 <th class="text-center">Paternity Leave</th>
                 <th class="text-center">Sick Leave</th>
                 <th class="text-center">Vacation Leave</th>
                 <th class="text-center">Total Leave</th>
            </thead>
             <?php  foreach ($leaves as $row) { ?>
             <tr>
                <?php 
                  $total = 0;
                  $total+=$row->EL;
                  $total+=$row->PL;
                  $total+=$row->ML;
                  $total+=$row->SL;
                  $total+=$row->VL;?>
                  <td class=""><?php echo $row->name; ?></td>
                  <td class="text-center <?php if ($row->EL==0) echo 'danger'; ?>"><?php echo $row->EL; ?></td>
                  <td class="text-center <?php if ($row->ML==0) echo 'danger'; ?>"><?php echo $row->ML; ?></td>
                  <td class="text-center <?php if ($row->PL==0) echo 'danger'; ?>"><?php echo $row->PL; ?></td>
                  <td class="text-center <?php if ($row->SL==0) echo 'danger'; ?>"><?php echo $row->SL; ?></td>
                  <td class="text-center <?php if ($row->VL==0) echo 'danger'; ?>"><?php echo $row->VL; ?></td>
                  <td class="text-center <?php if ($total==0) echo 'danger'; ?>"><?php echo $total; ?></td>
              </tr>
             <?php } ?>
         </table>
				<?php }  ?>
			</div>
		</div>
	</div>
</div>
