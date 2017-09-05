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
                    <li class="active"><a href=""><i class="fa fa-list"></i>&nbsp; Inquiry List</a></li>
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
                            <form method="post" role="form" action="" enctype="multipart/form-data">
                                <?php $object = $this->_inquiry;?>
                                <input type="hidden" name="id" value="<?php echo $object!==false?$object->id:'';?>" />
                                <div class="box-body">
                                    <!-- input states -->
                                    <div class="form-group">
                                        <label class="control-label">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $object!==false?$object->name:'';?>" disabled="disabled" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="text" name="email" class="form-control" placeholder="Email Address" value="<?php echo $object!==false?$object->email:'';?>" disabled="disabled" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Phone</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $object!==false?$object->name:'';?>" disabled="disabled" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Product</label>
                                        <?php $product = $object->get_product(); ?>
                                        <input type="text" name="name" class="form-control" placeholder="Product" value="<?php echo $product!==null?$product->name:'';?>" disabled="disabled" />
                                        <a target="_blank" href="<?php echo $product->get_link();?>"><i>Click here to view product</i></a>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <a href="<?php echo $page_path.'send_info/'.$object->id;?>" class="btn btn-flat btn-primary">Send information stock available</a>
                                    <a href="<?php echo $page_path;?>" class="btn btn-flat btn-default">Back</a>
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
