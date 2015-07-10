<aside class="main-sidebar height">
        <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="text-center image">
        <img src="<?php echo base_url().'assets/images/profile/'.$profile_image; ?>" class="img-circle" alt="User Image" />
      </div>
      <div class="pull-right info">
        <p class="text-center"><?php echo $user_level; ?></p>
        <p class="text-center"><?php echo $firstname; ?></p>
      </div>
    </div>
    <!-- search form -->
   <!--  <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search..."/>
        <span class="input-group-btn">
          <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form> -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    Brands
    <ul class="sidebar-menu">
      <li class="header text-center">Manager's Menu</li>
      <li>
        <a href="<?php echo base_url();?>admin/dashboard">
          <i class="fa fa-dashboard"></i> <span>Manager Dashboard</span> 
        </a>
        
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-group"></i>
          <span>Employee Management</span>
         <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url();?>manager/employees"><i class="fa fa-user"></i> Employees</a></li>
          <li><a href="<?php echo base_url();?>manager/leaves_table"><i class="fa fa-calendar-o"></i> Leaves</a></li>
          <li><a href="<?php echo base_url();?>manager/view_performance"><i class="fa fa-thumbs-o-up"></i> Performance </a></li>
          <li><a href="<?php echo base_url();?>manager/promotion"><i class="fa fa-star"></i> Promotions </a></li>
        </ul>
      </li>
      
      <li class="treeview">
        <a href="#">
          <i class="fa fa-money"></i>
          <span>Payroll Management</span>
         <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
          <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
          <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
          <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-cubes"></i>
          <span>Asset Management</span>
         <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url();?>admin/view_assets"><i class="fa fa-cube"></i> Assets</a></li>
          <li><a href="<?php echo base_url();?>admin/purchase_stocks"><i class="fa fa-shopping-cart"></i> Purchase Stocks</a></li>
          <li><a href="<?php echo base_url();?>admin/view_vendors"><i class="fa fa-truck"></i> Vendors</a></li>
          <li><a href="<?php echo base_url();?>admin/view_bom"><i class="fa fa-credit-card"></i> Bill of Materials</a></li>
        </ul>
      </li>
      
      <li class="treeview">
        <a href="#">
          <i class="fa fa-files-o"></i>
          <span>Reports</span>
         <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
          <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
          <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
          <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
        </ul>
      </li>
    </ul>
  </section>
</aside>