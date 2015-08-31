<div class="content-wrapper">
  <ol class="breadcrumb">
  <li><a href="<?php echo base_url(); ?>ems/emp_dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  </ol>
  <div class="container-fluid">
    <div class="box box-info box-solid">
      <div class="box-header with-border">
          <h3 class="box-title">Employee Dashboard</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
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
        </div><!-- /.row -->
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Assigned Projects</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-hovered table-striped table-bordered">
                 <thead>
                    <th class="text-center">Project ID</th>
                    <th class="text-center">Project Name</th>
                    <th class="text-center">Assigned Date</th>
                 </thead>
                 <?php foreach ($project as $proj) { ?>
                 <tr>
                    <th class="text-center"><?php echo $proj->project_id; ?></th>
                    <td><?php echo $proj->project_name; ?></td>
                    <td><?php echo date_format($proj->assigned_date,'M d, Y'); ?></td>
                 </tr>
                 <?php } ?>
             </table>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->

      <div class="col-md-6">
        <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Assigned Assets</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-hovered table-striped table-bordered">
                 <thead>
                    <th class="text-center">Asset ID</th>
                    <th class="text-center">Asset Name</th>
                    <th class="text-center">Asset Status</th>
                    <th class="text-center">Assigned Date</th>
                 </thead>
                 <?php foreach ($asset as $eq) { ?>
                 <tr>
                    <th class="text-center"><?php echo $eq->asset_id; ?></th>
                    <td><?php echo $eq->asset_name; ?></td>
                    <td><?php echo $eq->asset_status;?></td>
                    <td><?php echo date_format($eq->assigned_date,'M d, Y'); ?></td>
                 </tr>
                 <?php } ?>
             </table>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Requested Supplies/Equipments</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-hovered table-striped table-bordered">
                 <thead>
                    <th class="text-center">Equipment/Supplies Name</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Date Requested</th>
                 </thead>
                 <?php foreach ($requested_asset as $eq) { ?>
                 <tr>
                    <th class="text-center"><?php echo $eq->asset_name; ?></th>
                    <td class="text-center"><?php echo $eq->quantity; ?></td>
                    <td class="text-center">
                    <?php 
                      if ($eq->request_status=='Approved'){
                        echo "<label class='label label-success'>";
                        echo $eq->request_status;
                        echo "</label>";
                      } else if ($eq->request_status=='Denied') {
                        echo "<label class='label label-danger'>";
                        echo $eq->request_status;
                        echo "</label>";
                      } else {
                        echo "<label class='label label-warning'>";
                        echo $eq->request_status;
                        echo "</label>";
                      }
                    ?>
                    </td>
                    <td class="text-center"><?php echo date_format($eq->date_requested,'M d, Y'); ?></td>
                 </tr>
                 <?php } ?>
             </table>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div>
  </div>
</div>
<form action="<?php echo base_url();?>ams/request_asset" method="post">
  <div class="modal fade" id="requestAsset" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Request Supplies / Equipments</h4>
        </div>
        <div class="modal-body">
          <label for="">Equipment / Supply Name:</label>
          <input type="text" class="form-control" name="txtAssetName" required><br>
          <label for="">Quantity:</label>
          <input type="text" class="form-control" name="txtQuantity" required><br>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Add" name="btnAddRequest">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</form>
