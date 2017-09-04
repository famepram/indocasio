<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $page_name;?></title>
        <?php include('inc/load_top.php');?>
    </head>
  <body class="skin-blue">
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
            Sparepart
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i>&nbsp; <?php echo $page_name;?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
              <div class="col-md-12 col-sm-12">
                  <div class="box">
                      <div class="box-header clearfix">
                          <h3 class="box-title">Master Sparepart</h3>
                          <a href="<?php echo $page_path.'add/';?>" class="btn btn-primary btn-md" style="float:right;"> Add New</a>
                      </div>
                      <div class="box-body">
                          <table class="datatable table table-bordered table-striped">
                              <thead>
                                  <tr>
                                      <th>No </th>
                                      <th>No Reg</th>
                                      <th>Name</th>
                                      <th>Model</th>
                                      <th>Date</th>
                                      <th>Checked</th>
                                      <th>Approved</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php for($x=1; $x<21;$x++): ?>
                                  <tr>
                                      <td><?php echo $x?>.</td>
                                      <td>IA/2015/456-09-<?php echo $x?></td>
                                      <td>Calibration Final Report<?php echo $x?></td>
                                      <td>XCF - SD</td>
                                      <td>13-04-2015</td>
                                      <td><?php echo $x%2==0?'<label class="label label-default">Not Checked</label>':'<label class="label label-success">Checked</label>';?></td>
                                      <td><?php echo $x%2==0?'<label class="label label-success">Approved</label>':'<label class="label label-default">Not Approved</label>';?></td>
                                      <td style="min-width:80px;">
                                          <div class="btn-group">
                                              <a href="#" class="btn btn-success btn-flat" data-toggle="tooltip" data-placement="top" title="Edit Document IA/2015/456-09-<?php echo $x?>"><i class="fa fa-pencil"></i></a>
                                              <a data-toggle="modal" data-target="#modal-delete" href="#" class="btn btn-danger btn-flat" data-toggle="tooltip" data-placement="top" title="Delete Document IA/2015/456-09-<?php echo $x?>"><i class="fa fa-trash"></i></a>
                                          </div>
                                      </td>
                                  </tr>
                                  <?php endfor;?>
                              </tbody>
                          </table>
                      </div>
                  </div><!-- /.box -->
              </div>

          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


      <div id="modal-delete" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
              <p>Are you sure to delete this data?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-flat btn-danger">Delete</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
      <?php include('inc/footer.php');?>
    </div><!-- ./wrapper -->
    <?php include('inc/load_bottom.php');?>
    
  </body>
</html>
