<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $page_name;?></title>
        <?php include('inc/load_top.php');?>
    </head>
  <body class="skin-blue layout-boxed sidebar-collapse">
      <div class="wrapper">
          <!-- header. contains the top menu-->
          <?php include('inc/header.php');?>
          <!-- Left side column. contains the logo and sidebar -->
          <?php include('inc/sidebar.php');?>

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
              <!-- Content Header (Page header) -->
              <section class="content-header">
                <h1>
                  Dashboard
                  <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                  <li class="active"><i class="fa fa-dashboard"></i>&nbsp; Dashboard</li>
                </ol>
              </section>

              <!-- Main content -->
              <section class="content">
                   <!-- =========================================================== -->

                  <!-- Small boxes (Stat box) -->
                  <div class="row">
                      <div class="col-lg-3 col-xs-6">
                          <!-- small box -->
                          
                              <div onclick="window.location='<?php echo base_url();?>viewer/keyword';" class="small-box bg-aqua dashboard-menu">
                                  <div class="inner">
                                      <h3>Keyword</h3>
                                      <p>Find Document By Keywords</p>
                                  </div>
                                  <div class="icon">
                                      <i class="fa fa-at"></i>
                                  </div>
                                  <a href="<?php echo base_url();?>document/" class="small-box-footer">
                                    View List Document <i class="fa fa-arrow-circle-right"></i>
                                  </a>
                              </div>
                          </a>
                      </div><!-- ./col -->
                      <div onclick="window.location='<?php echo base_url();?>viewer/advance';" class="col-lg-3 col-xs-6 dashboard-menu">
                          <!-- small box -->
                          <div class="small-box bg-green">
                              <div class="inner">
                                  <h3>Advance</h3>
                                  <p>Find Document With Advance Search</p>
                              </div>
                              <div class="icon">
                                  <i class="fa fa-filter"></i>
                              </div>
                              <a href="<?php echo base_url();?>document/" class="small-box-footer">
                                  View List Document <i class="fa fa-arrow-circle-right"></i>
                              </a>
                          </div>
                      </div><!-- ./col -->
                      <div onclick="window.location='<?php echo base_url();?>viewer/category/';" class="col-lg-3 col-xs-6 dashboard-menu">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                              <h3>Category</h3>
                              <p>Find Document By Categories</p>
                            </div>
                            <div class="icon">
                              <i class="fa fa-server"></i>
                            </div>
                            <a href="<?php echo base_url();?>document/" class="small-box-footer">
                              View List Document <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                      </div><!-- ./col -->
                      <div onclick="window.location='<?php echo base_url();?>viewer/user';" class="col-lg-3 col-xs-6 dashboard-menu">
                        <!-- small box -->
                        <div class="small-box bg-red">
                          <div class="inner">
                            <h3>By Admin</h3>
                            <p>Find Document By Admin</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-users"></i>
                          </div>
                          <a href="<?php echo base_url();?>document/" class="small-box-footer">
                            View List Document <i class="fa fa-arrow-circle-right"></i>
                          </a>
                        </div>
                      </div><!-- ./col -->
                  </div><!-- /.row -->

                <!-- =========================================================== -->
              </section><!-- /.content -->
          </div><!-- /.content-wrapper -->
          <footer class="main-footer">
            <div class="pull-right hidden-xs">
              <b>Version</b> 2.0
            </div>
            <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
          </footer>
      </div><!-- ./wrapper -->
      <?php include('inc/load_bottom.php');?>
    
  </body>
</html>
