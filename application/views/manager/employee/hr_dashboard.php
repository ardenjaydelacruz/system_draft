<div class="content-wrapper">
  <ol class="breadcrumb">
  <li><a href="<?php echo base_url(); ?>ems/hr_dashboard" class="btn btn-default"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
          <h3 class="box-title">HR Manager Dashboard</h3>
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
