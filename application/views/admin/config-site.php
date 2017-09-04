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
                    <li class="active"><a href=""><i class="fa fa-list"></i>&nbsp; Site Configuration</a></li>
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
                            <form method="post" role="form" action="<?php echo $root_path;?>config/updater/?redirect=site" enctype="multipart/form-data">
                                <div class="box-body">
                                    <!-- input states -->
                                    <div class="form-group">
                                        <?php $is_offline = get_meta('is_offline');?>
                                        <label class="control-label">Set Website As </label>
                                        <select class="form-control" name="is_offline">
                                            <option value="0" <?php echo $is_offline ==0?'selected':'';?>>Online</option>
                                            <option value="1" <?php echo $is_offline ==1?'selected':'';?>>Offline</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Page Title Prefix </label>
                                        <input type="text" name="page_prefix" class="form-control" placeholder="Page Title Prefix" value="<?php echo get_meta('page_prefix');?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Link Video </label>
                                        <textarea name="video_link" class="form-control" rows="6"><?php echo get_meta('video_link');?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" style="display:block;">Logo</label>
                                        <?php $logo = get_meta('logo');?>
                                        <?php $class= $logo!=''?'fileinput-exists':'fileinput-new'; ?>
                                        <div class="fileinput <?php echo $class;?>" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                                <img src="http://placehold.it/280x30&text=280x30" alt="..." style="width:100%;">                                                                
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"  style="width: 280px; height: 30px;">
                                                <?php if($class=='fileinput-exists') : ?>
                                                <?php $src_img = base_url().'uploads/site/'.$logo;?>
                                                <img src="<?php echo $src_img;?>" alt="..." style="width:100%;"> 
                                                <?php endif;?>
                                            </div>
                                            <div>
                                                <span class="btn btn-primary btn-file"><span class="fileinput-new">Browse Gambar</span><span class="fileinput-exists">Ubah</span><input type="file" name="logo"></span>
                                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Hapus</a>
                                            </div>
                                        </div>
                                        <p class="help-block with-errors">Image Res : 280px x 30px</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" style="display:block;">Logo White (Email)</label>
                                        <?php $logo_white = get_meta('logo_white');?>
                                        <?php $class= $logo_white!=''?'fileinput-exists':'fileinput-new'; ?>
                                        <div class="fileinput <?php echo $class;?>" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                                <img src="http://placehold.it/280x30&text=280x30" alt="..." style="width:100%;">                                                                
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"  style="width: 280px; height: 30px;">
                                                <?php if($class=='fileinput-exists') : ?>
                                                <?php $src_img = base_url().'uploads/site/'.$logo_white;?>
                                                <img src="<?php echo $src_img;?>" alt="..." style="width:100%;"> 
                                                <?php endif;?>
                                            </div>
                                            <div>
                                                <span class="btn btn-primary btn-file"><span class="fileinput-new">Browse Gambar</span><span class="fileinput-exists">Ubah</span><input type="file" name="logo_white"></span>
                                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Hapus</a>
                                            </div>
                                        </div>
                                        <p class="help-block with-errors">Image Res : 280px x 30px</p>

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" style="display:block;">Favicon</label>
                                        <?php $favicon = get_meta('favicon');?>
                                        <?php $class= $favicon!=''?'fileinput-exists':'fileinput-new'; ?>
                                        <div class="fileinput <?php echo $class;?>" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                                <img src="http://placehold.it/128x128&text=64X64" alt="..." style="width:100%;">                                                                
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"  style="width: 150px; height: 150px;">
                                                <?php if($class=='fileinput-exists') : ?>
                                                <?php $src_img = base_url().'uploads/site/'.$favicon;?>
                                                <img src="<?php echo $src_img;?>" alt="..." style="width:100%;"> 
                                                <?php endif;?>
                                            </div>
                                            <div>
                                                <span class="btn btn-primary btn-file"><span class="fileinput-new">Browse Gambar</span><span class="fileinput-exists">Ubah</span><input type="file" name="favicon"></span>
                                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Hapus</a>
                                            </div>
                                        </div>
                                        <p class="help-block with-errors">Image Res : 128px x 128px</p>

                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" style="display:block;">Home New Product</label>
                                        <?php $home_np_img = get_meta('home_np_img');?>
                                        <?php $class= $home_np_img!=''?'fileinput-exists':'fileinput-new'; ?>
                                        <div class="fileinput <?php echo $class;?>" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 212px; height: 105px;">
                                                <img src="http://placehold.it/425x210&text=425X210" alt="..." style="width:100%;">                                                                
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"   style="width: 212px; height: 105px;">
                                                <?php if($class=='fileinput-exists') : ?>
                                                <?php $src_img = base_url().'uploads/site/'.$home_np_img;?>
                                                <img src="<?php echo $src_img;?>" alt="..." style="width:100%;"> 
                                                <?php endif;?>
                                            </div>
                                            <div>
                                                <span class="btn btn-primary btn-file"><span class="fileinput-new">Browse Gambar</span><span class="fileinput-exists">Ubah</span><input type="file" name="home_np_img"></span>
                                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Hapus</a>
                                            </div>
                                        </div>
                                        <p class="help-block with-errors">Image Res : 128px x 128px</p>

                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" style="display:block;">Home Product Finder</label>
                                        <?php $home_pf_img = get_meta('home_pf_img');?>
                                        <?php $class= $home_pf_img!=''?'fileinput-exists':'fileinput-new'; ?>
                                        <div class="fileinput <?php echo $class;?>" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 212px; height: 105px;">
                                                <img src="http://placehold.it/425x210&text=425X210" alt="..." style="width:100%;">                                                                
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"  style="width: 212px; height: 105px;">
                                                <?php if($class=='fileinput-exists') : ?>
                                                <?php $src_img = base_url().'uploads/site/'.$home_pf_img;?>
                                                <img src="<?php echo $src_img;?>" alt="..." style="width:100%;"> 
                                                <?php endif;?>
                                            </div>
                                            <div>
                                                <span class="btn btn-primary btn-file"><span class="fileinput-new">Browse Gambar</span><span class="fileinput-exists">Ubah</span><input type="file" name="home_pf_img"></span>
                                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Hapus</a>
                                            </div>
                                        </div>
                                        <p class="help-block with-errors">Image Res : 128px x 128px</p>

                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Email Order Notice</label>
                                        <input type="text" name="email_order" class="form-control" placeholder="Email Sender" value="<?php echo get_meta('email_order');?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Email Receiver</label>
                                        <input type="text" name="email_receiver" class="form-control" placeholder="Email Receiver" value="<?php echo get_meta('email_receiver');?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Email Admin 1</label>
                                        <input type="text" name="email_admin" class="form-control" placeholder="Email Admin 1" value="<?php echo get_meta('email_admin');?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Email Admin 2</label>
                                        <input type="text" name="email_admin2" class="form-control" placeholder="Email Admin 2" value="<?php echo get_meta('email_admin2');?>" />
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
        <script type="text/javascript">
            $(document).ready(function(){
                $('.icheck').iCheck();
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass: 'iradio_minimal-blue'
                });
                
            });

        </script>
    
    </body>
</html>
