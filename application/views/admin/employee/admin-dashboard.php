<div class="content-wrapper">
  <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i>
              Dashboard</a></li>
  </ol>
  <div class="container-fluid">
    <div class="callout callout-success">
      <h4><i class="fa fa-bullhorn"></i> Announcement! (Recent 3)</h4>
      <ul>
        <?php 
          foreach ($announcement as $row) {
            echo "<br><li><b>$row->description</b>  -  $row->posted_by (". date('M d, Y - g:i A',strtotime($row->date_posted)).")</li>";
          }
         ?>
      </ul>
    </div>
    <div class="box box-info box-solid">
      <div class="box-header with-border">
          <h3 class="box-title">Admin Dashboard</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Add Company Information</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div><!-- /.box-tools -->
              </div><!-- /.box-header -->
              <div class="box-body">
                <a href="#" data-target="#postAnnouncement" data-toggle="modal" class="btn btn-app btn-flat">
                  <i class="fa fa-bullhorn"></i> Post<br> Announcement
                </a>
                <a href="#" data-target="#addDepartment" data-toggle="modal" class="btn btn-app btn-flat">
                  <span class="badge bg-green"><?php echo $departments; ?></span>
                  <i class="fa fa-institution"></i> Department
                </a>
                <a href="#" data-target="#addSupervisor" data-toggle="modal" class="btn btn-app btn-flat">
                  <span class="badge bg-green"><?php echo $supervisors; ?></span>
                  <i class="fa fa-group"></i> Supervisors
                </a>
                <a href="#" data-target="#addJobTitle" data-toggle="modal" class="btn btn-app btn-flat">
                  <span class="badge bg-green"><?php echo $job_titles; ?></span>
                  <i class="fa fa-briefcase"></i> Job Title
                </a>
                <a href="#" data-target="#addEmploymentType" data-toggle="modal" class="btn btn-app btn-flat">
                  <span class="badge bg-green"><?php echo $employment_type; ?></span>
                  <i class="fa fa-suitcase"></i> Employment<Br> Type
                </a>
                <a href="#" data-target="#addVendor" data-toggle="modal" class="btn btn-app btn-flat">
                  <span class="badge bg-green"><?php echo $vendors; ?></span>
                  <i class="fa fa-truck"></i> Vendor
                </a>    
                <a href="#" data-target="#addLeave" data-toggle="modal" class="btn btn-app btn-flat">
                  <span class="badge bg-green"><?php echo $leaves; ?></span>
                  <i class="fa fa-calendar"></i> Leave Type
                </a>   
                <a href="#" data-target="#addAssetCategory" data-toggle="modal" class="btn btn-app btn-flat">
                  <span class="badge bg-green"><?php echo $category; ?></span>
                  <i class="fa fa-cubes"></i> Asset <br> Category
                </a>         
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
        </div>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $total_employee; ?></h3>
                        <p>Total Employees</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>ems/employees" class="small-box-footer">View Employees
                        <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $total_projects; ?></h3>

                        <p>Active Projects</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <a href="<?php echo base_url('ams/view_projects'); ?>" class="small-box-footer">View Projects <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $total_asset; ?></h3>

                        <p>Total Assets</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cubes"></i>
                    </div>
                    <a href="<?php echo base_url('ams/view_assets'); ?>" class="small-box-footer">View Assets <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>10</h3>

                        <p>Upcoming Leaves</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <a href="<?php echo base_url('ems/leaves_table'); ?>" class="small-box-footer">View Leaves <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
      </div>
    </div>
  </div>
</div>
<form action="<?php echo base_url();?>ems/post_announcement" method="post">
  <div class="modal fade" id="postAnnouncement" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Post New Announcement</h4>
        </div>
        <div class="modal-body">
          <label for="">Announcement:</label>
          <textarea name="txtAnnouncement" id="" cols="30" rows="10" required class="form-control"></textarea>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Add" name="btnAddCategory">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>
<form action="<?php echo base_url();?>ems/add_department" method="post">
  <div class="modal fade" id="addDepartment" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add New Depaartment</h4>
        </div>
        <div class="modal-body">
          <label for="">Department ID:</label>
          <input type="text" class="form-control" name="txtDepartmentID" required><br>
          <label for="">Deparment Name:</label>
          <input type="text" class="form-control" name="txtDepartmentName" required><br>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Add" name="btnAddDepartment">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>
<form action="<?php echo base_url();?>ems/add_supervisor" method="post">
  <div class="modal fade" id="addSupervisor" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add New Supervisor</h4>
        </div>
        <div class="modal-body">
          <label for="">Supervisor ID:</label>
          <input type="text" class="form-control" name="txtSupervisorID" required><br>
          <label for="">Employee Name:</label>
          <select name="txtSupervisorName" class="form-control">
              <option value=''>---</option>
              <?php foreach ($employee as $row){ 
                  echo "<option value='$row->emp_id'>$row->first_name $row->middle_name $row->last_name</option>";
              } ?>
          </select><br> 
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Add" name="btnAddDepartment">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>
<form action="<?php echo base_url();?>ems/add_jobtitle" method="post">
  <div class="modal fade" id="addJobTitle" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Job Title</h4>
        </div>
        <div class="modal-body">
          <label for="">Job Title ID:</label>
          <input type="text" class="form-control" name="txtJobTitleID" required><br>
          <label for="">Job Title Name:</label>
          <input type="text" class="form-control" name="txtJobTitleName" required><br>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Add" name="btnAddDepartment">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>
<form action="<?php echo base_url();?>ems/add_employment_type" method="post">
  <div class="modal fade" id="addEmploymentType" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Employment Type</h4>
        </div>
        <div class="modal-body">
          <label for="">Employment Type ID:</label>
          <input type="text" class="form-control" name="txtJobTitleID" required><br>
          <label for="">Employment Type Name:</label>
          <input type="text" class="form-control" name="txtJobTitleName" required><br>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Add" name="btnAddDepartment">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>
<form action="<?php echo base_url();?>ems/add_vendor" method="post">
  <div class="modal fade" id="addVendor" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Vendor</h4>
        </div>
        <div class="modal-body">
          <label for="">Vendor ID:</label>
          <input type="text" class="form-control" name="txtVendorID" required><br>
          <label for="">Vendor Name:</label>
          <input type="text" class="form-control" name="txtVendorName" required><br>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Add" name="btnAddDepartment">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>
<form action="<?php echo base_url();?>ems/add_leave" method="post">
  <div class="modal fade" id="addLeave" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Leave Type</h4>
        </div>
        <div class="modal-body">
          <label for="">Leave ID:</label>
          <input type="text" class="form-control" name="txtLeaveID" required><br>
          <label for="">Leave Name:</label>
          <input type="text" class="form-control" name="txtLeaveName" required><br>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Add" name="btnAddLeave">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>
<form action="<?php echo base_url();?>ems/add_asset_category" method="post">
  <div class="modal fade" id="addAssetCategory" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add Asset Category</h4>
        </div>
        <div class="modal-body">
          <label for="">Category ID:</label>
          <input type="text" class="form-control" name="txtCategoryID" required><br>
          <label for="">Category Name:</label>
          <input type="text" class="form-control" name="txtCategoryName" required><br>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Add" name="btnAddCategory">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>