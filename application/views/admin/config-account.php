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
                <h1><?php echo $page_name;?></h1>
                <ol class="breadcrumb">
                    <li class="active"><a href=""><i class="fa fa-list"></i>&nbsp; Category List</a></li>
                    <li class="active"><i class="fa fa-plus"></i>&nbsp; <?php echo $page_caption;?></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div class="box">
                            <div class="box-header clearfix">
                                <h3 class="box-title"><?php echo $page_caption;?></h3>
                            </div>
                            <form method="post" role="form" action="<?php echo $root_path;?>config/updater/?redirect=account" enctype="multipart/form-data">
                                <div class="box-body">
                                    <!-- input states -->
                                    <div class="form-group">
                                        <label class="control-label">Bank Name</label>
                                        <input type="text" name="bank_name" class="form-control" placeholder="Bank Name" value="<?php echo get_meta('bank_name');?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Account Number</label>
                                        <input type="text" name="acc_no" class="form-control" placeholder="Twitter Link" value="<?php echo get_meta('acc_no');?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Account Name</label>
                                        <input type="text" name="acc_name" class="form-control" placeholder="Account Name" value="<?php echo get_meta('acc_name');?>" />
                                    </div>
                                    
                                    
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                                </div>
                            </form>
                        </div><!-- /.box -->
                    </div>

                </div>
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->



          <?php include('inc/footer.php');?>
        </div><!-- ./wrapper -->
        <?php include('inc/load_bottom.php');?>
    
    </body>
</html>
