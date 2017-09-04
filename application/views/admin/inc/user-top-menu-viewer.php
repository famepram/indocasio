<div class="navbar-custom-menu">
      <ul class="nav navbar-nav">



        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo base_url();?>assets/admin/img/user.jpg" class="user-image" alt="User Image"/>
            <span class="hidden-xs"><?php echo $adm->name;?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
<!--             <li class="user-header">

            </li> -->
            
            <!-- Menu Footer-->

            <li class="user-footer">
              <div class="pull-left">
                <a href="<?php echo $root_path;?>admin/update_pass/" class="btn btn-info btn-flat">Update Password</a>
              </div>
              <div class="pull-right">
                <a href="<?php echo $root_path;?>login/off/" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>