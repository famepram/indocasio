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
                            <form method="post" role="form" action="<?php echo $root_path;?>category/updater/" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $object!==false?$object->id:'';?>" />
                                <div class="box-body">
                                    <!-- input states -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Image</label>
                                        <div class="col-sm-10">
                                            <?php $class= $object!==false?'fileinput-exists':'fileinput-new'; ?>
                                            <div class="fileinput <?php echo $class;?>" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 425px; height: 210px;">
                                                    <img src="http://placehold.it/450x210&text=850x420" alt="..." style="width:100%;">                                                                
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"  style="width: 425px; height: 210px;">
                                                    <?php if($class=='fileinput-exists') : ?>
                                                    <img src="<?php echo $object->get_img_src();?>" alt="..." style="width:100%;"> 
                                                    <?php endif;?>
                                                </div>
                                                <div>
                                                    <span class="btn btn-primary btn-file"><span class="fileinput-new">Browse Gambar</span><span class="fileinput-exists">Ubah</span><input type="file" name="image"></span>
                                                    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Hapus</a>
                                                </div>
                                            </div>
                                            <p class="help-block with-errors"><?php echo form_error('image');?></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Category Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Category Name" value="<?php echo $object!==false?$object->name:'';?>" />
                                    </div>
                                    <div class="form-group">
                                        <?php $parent = $object!==false?$object->parent:'';?>
                                        <?php $not   = $object!==false?$object->id:'';?>
                                        <label class="control-label">Parent</label>
                                        <select class="form-control" name="parent">
                                            <option value="0">None</option>
                                            <?php echo get_option_category($parent,$not);?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Sort</label>
                                        <input type="text" name="sort" class="form-control" placeholder="Sort" value="<?php echo $object!==false?$object->sort:'';?>" />
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
