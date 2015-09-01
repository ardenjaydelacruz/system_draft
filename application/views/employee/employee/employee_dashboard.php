<div class="content-wrapper">
  <ol class="breadcrumb">
  <li><a href="<?php echo base_url(); ?>ems/emp_dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  </ol>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <div class="callout callout-success">
          <h4 class=""><i class="fa fa-bullhorn"></i> Announcement! (Recent 3)</h4>
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
        <div class="callout callout-danger">
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
    </div>
   
    <div class="row">
      <div class="col-md-6">
        <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Leaves Left</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-hovered table-striped table-bordered">
                <thead>
                  <th class="text-center">Leave Type ID</th>
                  <th class="text-center">Leave Type Name</th>
                  <th class="text-center">Days Left</th>
                </thead>
                <tr>
                <?php foreach ($leaves as $row) { ?>
                  <td class="text-center"><?php echo $row->leave_type_id; ?></td>
                  <td class="text-center"><?php echo $row->leave_type_name; ?></td>
                  <td class="text-center"><?php echo $row->days; ?></tr>
                <?php } ?>
                </tr>
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
    </div>
  </div>
</div>
