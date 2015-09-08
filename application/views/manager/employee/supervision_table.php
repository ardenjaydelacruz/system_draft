
<div class="content-wrapper">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>ems/hr_dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class='active'>Employees Supervision</li>
    </ol>
    <div class="container-fluid">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-sm-8">
                        <h1 class="box-title big">Employees Supervision
                        </h1>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="pull-left add-employee">
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addSupervision"><i class="fa fa-plus"></i> Add Supervision</a><br><br>
                </div>
                <div class="clearfix"></div>
                <table id="dynamicTable" class="table table-striped table-hover table-bordered">
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
            <form action="<?php echo base_url();?>ems/supervisions" method="post">
              <div class="modal fade" id="addSupervision" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Add Supervision</h4>
                    </div>
                    <div class="modal-body">
                      <label for="">Employee Name:</label>
                      <select name="txtEmployee" class="form-control">
                          <option value=''>---</option>
                          <?php foreach ($employee as $row){ 
                              echo "<option value='$row->emp_id'>$row->first_name $row->middle_name $row->last_name</option>";
                          } ?>
                      </select><br> 
                      <label class="text-center"> To </label> <br><br>
                      <label for="">Supervisor Name:</label>
                      <select name="txtSupervisor" class="form-control">
                          <option value=''>---</option>
                          <?php foreach ($supervisor as $row){ 
                              echo "<option value='$row->supervisor_id'>$row->first_name $row->middle_name $row->last_name</option>";
                          } ?>
                      </select>
                    </div>
                    <div class="modal-footer">
                      <input type="submit" class="btn btn-success" value="Add" name="btnSubmit">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
            </form>
        </div>
    </div>
</div>
