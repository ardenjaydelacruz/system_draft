  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>ems/dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">MSI</span>
      <span class="logo-lg"><b>MSInc.</b></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"  data-placement="right" title="Show/Hide Sidebar">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <?php $this->load->view('layout/notif'); ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- <img src="<?php echo base_url();?>assets/images/default.jpg" class="user-image" alt="User Image"/> -->
              <span class="hidden-xs"><?php echo $this->session->userdata('user_level').' '.$this->session->userdata('first_name'); ?> </span> 
              <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url().'assets/images/profile/'.$this->session->userdata('profile_image'); ?>" class="img-circle" alt="User Image" />
                <p>
                  <?php echo $this->session->userdata('user_level'); ?>
                  <small><?php echo $this->session->userdata('first_name'); ?></small>
                </p>
                
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url();?>auth/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
