<div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            <span class="label label-success">8</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have 4 messages</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <?php for($i=0;$i<8;$i++):?>
                <li><!-- start message -->
                  <a href="#">
                    <div class="pull-left">
                      <img src="<?php echo base_url();?>assets/admin/img/user.jpg" class="img-circle" alt="User Image"/>
                    </div>
                    <h4>
                      Support Team
                      <small><i class="fa fa-clock-o"></i> 5 mins</small>
                    </h4>
                    <p>Please Recheck the part of document</p>
                  </a>
                </li><!-- end message -->
                <?php endfor;?>
              </ul>
            </li>
            <li class="footer"><a href="#">See All Messages</a></li>
          </ul>
        </li>
        <!-- Notifications: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">10</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have 10 notifications</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <?php for($i=0;$i<8;$i++):?>
                <li>
                  <a href="#">
                    <i class="fa fa-users text-aqua"></i> Document no.reg IA/2015/456-09-1 has been checked 
                  </a>
                </li>
                <?php endfor;?>
              </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
          </ul>
        </li>


        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo base_url();?>assets/admin/img/user.jpg" class="user-image" alt="User Image"/>
            <span class="hidden-xs">Administrator</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?php echo base_url();?>assets/admin/img/user.jpg" class="img-circle" alt="User Image" />
              <p>
                Alexander Pierce - Administrator
                <small>Registered since Nov. 2012</small>
              </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">
              <div class="col-xs-4 text-center">
                <a href="<?php echo base_url();?>user/activity/">Activity</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="<?php echo base_url();?>document/">Documents</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="<?php echo base_url();?>user/update_pass">Password</a>
              </div>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="<?php echo base_url();?>user/update/" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="<?php echo base_url();?>login/" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>