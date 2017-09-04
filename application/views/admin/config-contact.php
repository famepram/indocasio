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
                            <form method="post" role="form" action="<?php echo $root_path;?>config/updater/?redirect=contact" enctype="multipart/form-data">
                                <div class="box-body">
                                    <!-- input states -->
                                    <div class="form-group">
                                        <label class="control-label">Phone Number</label>
                                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="<?php echo get_meta('phone');?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Email Address</label>
                                        <input type="text" name="email" class="form-control" placeholder="Email Address" value="<?php echo get_meta('email');?>" />
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Pin BBM</label>
                                                <input type="text" name="bbm" class="form-control" placeholder="Pin BBM" value="<?php echo get_meta('bbm');?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label style="padding-top:15px;">
                                                    <?php $bbm_show = get_meta('bbm_show');?>
                                                    <input type='hidden' value='0' name='bbm_show'>
                                                    <input type="checkbox" name="bbm_show" value="1" class="minimal-red"  <?php echo $bbm_show ==1 ?'checked':'';?> >
                                                        &nbsp;Show BBM?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Whatsapp</label>
                                                <input type="text" name="whatsapp" class="form-control" placeholder="Whatsapp" value="<?php echo get_meta('whatsapp');?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label style="padding-top:15px;">
                                                    <?php $wa_show = get_meta('wa_show');?>
                                                    <input type='hidden' value='0' name='wa_show'>
                                                    <input type="checkbox" name="wa_show" value="1" class="minimal-red"  <?php echo $wa_show ==1 ?'checked':'';?> >
                                                        &nbsp;Show Whatsapp?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Line</label>
                                                <input type="text" name="line" class="form-control" placeholder="Line" value="<?php echo get_meta('line');?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label style="padding-top:15px;">
                                                    <?php $line_show = get_meta('line_show');?>
                                                    <input type='hidden' value='0' name='line_show'>
                                                    <input type="checkbox" name="line_show" value="1" class="minimal-red"  <?php echo $line_show ==1 ?'checked':'';?> >
                                                        &nbsp;Show Whatsapp?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Jam Operasional</label>
                                        <input type="text" name="jam_buka" class="form-control" placeholder="Jam Operasional" value="<?php echo get_meta('jam_buka');?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Running Text</label>
                                        <input type="text" name="running_text" class="form-control" placeholder="Running Text" value="<?php echo get_meta('running_text');?>" />
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
