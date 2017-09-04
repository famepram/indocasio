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
                    <li class="active"><a href=""><i class="fa fa-list"></i>&nbsp; Admin List</a></li>
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
                            <form method="post"  data-toggle="validator" role="form" action="<?php echo $root_path;?>admin/updater/" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $object!==false?$object->id:'';?>" />
                                <div class="box-body">
                                    <!-- input states -->
                                    <div class="form-group">
                                        <label class="control-label">Admin Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Admin Name" value="<?php echo $object!==false?$object->name:'';?>" required />
                                        <p class="help-block with-errors"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Username</label>
                                        <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $object!==false?$object->username:'';?>" required />
                                        <p class="help-block with-errors"></p>
                                    </div>
                                    <?php if(!$object) : ?>
                                    <div class="form-group">
                                        <label class="control-label">Password</label>
                                        <input id="password" type="password" name="pass" class="form-control" placeholder="Password" value="" required />
                                        <p class="help-block with-errors"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Confirm Password</label>
                                        <input type="password" name="conpass" class="form-control" placeholder="Confirm Password" value="" data-match="#password" />
                                        <p class="help-block with-errors"></p>
                                    </div>
                                    <?php endif;?>
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
