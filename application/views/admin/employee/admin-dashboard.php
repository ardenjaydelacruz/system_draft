<div class="content-wrapper">
  <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>admin/dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i>
              Dashboard</a></li>
  </ol>
  <div class="container-fluid">
    <!-- announcements -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Notifications</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div><!-- /.box-tools -->
      </div><!-- /.box-header -->
      <div class="box-body">
        <div class="col-sm-6">
          <div class="callout callout-success announcement">
            <h4 class="pull-left"><i class="fa fa-bullhorn"></i> Announcement! (Recent 3)</h4>
            <a href="#" data-target="#postAnnouncement" data-toggle="modal" class="btn btn-primary pull-right">
                    <i class="fa fa-plus"></i> Post Announcement
                  </a>
                  <div class="clearfix"></div>
            <ul>
              <?php 
                foreach ($announcement as $row) {
                  echo "<br><li><b>$row->description</b>  <br>-  $row->posted_by (". date('M d, Y - g:i A',strtotime($row->date_posted)).")</li>";
                }
               ?>
            </ul>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="callout callout-danger announcement">
            <h4><i class="fa fa-birthday-cake"></i>  Birthdays for <?php echo strtoupper(date('F')); ?></h4>
            <table class="table borderless">
              <?php 
                foreach ($birthday as $row) {
                  echo "
                  <tr>
                    <th>$row->first_name $row->last_name</th> 
                    <td>". date_format($row->birthday,'F d, Y')."</td>
                  </tr>
                  ";
                }
               ?>
            </table>
          </div>
        </div>
      </div><!-- /.box-body -->
    </div><!-- /.box -->

    <!-- dashboard -->
    <div class="box box-info">
      <div class="box-header with-border">
          <h3 class="box-title">Admin Dashboard</h3>
          <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div><!-- /.box-tools -->
      </div>
      <div class="box-body">
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
                        <h3><?php echo $existing; ?></h3>
                        <p>Existing Employees</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="<?php echo base_url('ems/employees'); ?>" class="small-box-footer">View Employees <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $onleave; ?></h3>
                        <p>On-leave Employees</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="<?php echo base_url('ems/employees'); ?>" class="small-box-footer">View Employees <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $resigned; ?></h3>
                        <p>Resigned Employees</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="<?php echo base_url('ems/employees'); ?>" class="small-box-footer">View Employees <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
      </div>
    </div>

    <!-- Add Infos -->
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add Company Information</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class="box-body">
            <center>
            <div class="col-sm-6">
              <a href="#" data-target="#addDepartment" data-toggle="modal" class="btn btn-app btn-flat">
                <span class="badge bg-green"><?php echo count($departments); ?></span>
                <i class="fa fa-institution"></i> Department
              </a>
              <a href="#" data-target="#addSupervisor" data-toggle="modal" class="btn btn-app btn-flat">
                <span class="badge bg-green"><?php echo count($supervisors); ?></span>
                <i class="fa fa-group"></i> Supervisors
              </a>
              <a href="#" data-target="#addAssetCategory" data-toggle="modal" class="btn btn-app btn-flat">
                <span class="badge bg-green"><?php echo count($category); ?></span>
                <i class="fa fa-cubes"></i> Asset <br> Category
              </a>  
            </div>
            <div class="col-sm-6">
              <a href="#" data-target="#addEmploymentType" data-toggle="modal" class="btn btn-app btn-flat">
                <span class="badge bg-green"><?php echo count($employment_type); ?></span>
                <i class="fa fa-suitcase"></i> Employment<Br> Type
              </a>
              <a href="#" data-target="#addJobTitle" data-toggle="modal" class="btn btn-app btn-flat">
                <span class="badge bg-green"><?php echo count($job_titles); ?></span>
                <i class="fa fa-briefcase"></i> Job Title
              </a>
              <a href="#" data-target="#addVendor" data-toggle="modal" class="btn btn-app btn-flat">
                <span class="badge bg-green"><?php echo count($vendors); ?></span>
                <i class="fa fa-truck"></i> Vendor
              </a> 
            </div>
            </center>
          </div><!-- /.box-body -->

          <!-- dept + emp type -->
          <div class="row">
            <div class="col-md-6">
              <div class="box box-primary box-solid collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Department</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-hovered table-striped table-bordered">
                      <thead>
                        <th class="text-center">Department ID</th>
                        <th class="text-center">Department Name</th>
                        <th class="text-center">Manage</th>
                      </thead>
                      <?php foreach ($departments as $row) { ?>
                      <tr>
                        <td class="text-center"><?php echo $row->department_id; ?></td>
                        <td class="text-center"><?php echo $row->department_name; ?></td>
                        <td class="text-center">
                          <a href="<?php echo base_url(); ?>ems/delete_company_info?id=<?php echo $row->department_id; ?>&table=department" data-toggle="tooltip" data-placement="top" title="Remove Department">
                            <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                          </a>
                        </td>
                      </tr>
                      <?php } ?>
                     </table>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-6">
              <div class="box box-primary box-solid collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Employment Type</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-hovered table-striped table-bordered">
                       <thead>
                          <th class="text-center">ID</th>
                          <th class="text-center">Employment Type</th>
                          <th class="text-center">Manage</th>
                       </thead>
                       <?php foreach ($employment_type as $row) { ?>
                       <tr>
                          <th class="text-center"><?php echo $row->employment_type_id; ?></th>
                          <td class="text-center"><?php echo $row->employment_type; ?></td>
                          <td class="text-center">
                            <a href="<?php echo base_url(); ?>ems/delete_company_info?id=<?php echo $row->employment_type_id; ?>&table=emp_type" data-toggle="tooltip" data-placement="top" title="Remove Employment Type">
                              <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                            </a>
                          </td>
                       </tr>
                       <?php } ?>
                   </table>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div>

          <!-- Supervisor + Job Titles -->
          <div class="row">
            <div class="col-md-6">
              <div class="box box-primary box-solid collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Supervisors</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-hovered table-striped table-bordered">
                      <thead>
                        <th class="text-center">Supervisor ID</th>
                        <th class="text-center">Employee ID</th>
                        <th class="text-center">Supervisor Name</th>
                        <th class="text-center">Manage</th>
                      </thead>
                      <?php foreach ($supervisors as $row) { ?>
                      <tr>
                        <td class="text-center"><?php echo $row->supervisor_id; ?></td>
                        <td class="text-center"><?php echo $row->employee_id; ?></td>
                        <td class="text-center"><?php echo "$row->first_name $row->middle_name $row->last_name"; ?></td>
                        <td class="text-center">
                          <a href="<?php echo base_url(); ?>ems/delete_company_info?id=<?php echo $row->supervisor_id; ?>&table=supervisor" data-toggle="tooltip" data-placement="top" title="Remove Supervisor">
                            <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                          </a>
                        </td>
                      </tr>
                      <?php } ?>
                     </table>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-6">
              <div class="box box-primary box-solid collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Job Titles</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-hovered table-striped table-bordered">
                       <thead>
                          <th class="text-center">ID</th>
                          <th class="text-center">Job Title</th>
                          <th class="text-center">Manage</th>
                       </thead>
                       <?php foreach ($job_titles as $row) { ?>
                       <tr>
                          <th class="text-center"><?php echo $row->job_title_id; ?></th>
                          <td class="text-center"><?php echo $row->job_title_name; ?></td>
                          <td class="text-center">
                            <a href="<?php echo base_url(); ?>ems/delete_company_info?id=<?php echo $row->job_title_id; ?>&table=job_title" data-toggle="tooltip" data-placement="top" title="Remove Job Title">
                              <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                            </a>
                          </td>
                       </tr>
                       <?php } ?>
                   </table>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div>
          <!-- Asset Category + Vendors -->
          <div class="row">
            <div class="col-md-6">
              <div class="box box-primary box-solid collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Asset Category</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-hovered table-striped table-bordered">
                      <thead>
                        <th class="text-center">Category ID</th>
                        <th class="text-center">Category Name</th>
                        <th class="text-center">Manage</th>
                      </thead>
                      <?php foreach ($category as $row) { ?>
                      <tr>
                        <td class="text-center"><?php echo $row->category_id; ?></td>
                        <td class="text-center"><?php echo $row->category_name; ?></td>
                        <td class="text-center">
                          <a href="<?php echo base_url(); ?>ems/delete_company_info?id=<?php echo $row->category_id; ?>&table=asset_category" data-toggle="tooltip" data-placement="top" title="Remove Asset Category">
                            <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                          </a>
                        </td>
                      </tr>
                      <?php } ?>
                     </table>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-6">
              <div class="box box-primary box-solid collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Vendors</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-hovered table-striped table-bordered">
                       <thead>
                          <th class="text-center">Vendor ID</th>
                          <th class="text-center">Vendor Name</th>
                          <th class="text-center">Manage</th>
                       </thead>
                       <?php foreach ($vendors as $row) { ?>
                       <tr>
                          <th class="text-center"><?php echo $row->vendor_id; ?></th>
                          <td class="text-center"><?php echo $row->vendor_name; ?></td>
                          <td class="text-center">
                            <a href="<?php echo base_url(); ?>ems/delete_company_info?id=<?php echo $row->vendor_id; ?>&table=vendor" data-toggle="tooltip" data-placement="top" title="Remove Job Title">
                              <button class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                            </a>
                          </td>
                       </tr>
                       <?php } ?>
                   </table>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div>
        </div><!-- /.box -->
      </div><!-- /.col -->
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