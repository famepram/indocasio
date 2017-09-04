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
                            <form method="post" role="form" action="<?php echo $root_path;?>config/updater/?redirect=socmed" enctype="multipart/form-data">
                                <div class="box-body">
                                    <!-- input states -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Facebook Link</label>
                                                <input type="text" name="fb_link" class="form-control" placeholder="Facebook Link" value="<?php echo get_meta('fb_link');?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label style="padding-top:15px;">
                                                    <?php $show_fb = get_meta('fb_show');?>
                                                    <input type='hidden' value='0' name='fb_show'>
                                                    <input type="checkbox" name="fb_show" value="1" class="minimal-red"  <?php echo $show_fb ==1 ?'checked':'';?> >
                                                        &nbsp;Show Facebook?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Twitter Link</label>
                                                <input type="text" name="tw_link" class="form-control" placeholder="Twitter Link" value="<?php echo get_meta('tw_link');?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label style="padding-top:15px;">
                                                    <?php $show_tw = get_meta('tw_show');?>
                                                    <input type='hidden' value='0' name='tw_show'>
                                                    <input type="checkbox" name="tw_show" value="1" class="minimal-red"  <?php echo $show_tw ==1 ?'checked':'';?> >
                                                        &nbsp;Show Twitter?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Instagram Link</label>
                                                <input type="text" name="ig_link" class="form-control" placeholder="Instagram Link" value="<?php echo get_meta('ig_link');?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label style="padding-top:15px;">
                                                    <?php $show_ig = get_meta('ig_show');?>
                                                    <input type="hidden" value='0' name='ig_show'>
                                                    <input type="checkbox" name="ig_show" value="1" class="minimal-red"  <?php echo $show_ig ==1 ?'checked':'';?> >
                                                        &nbsp;Show Instagram ?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Gplus Link</label>
                                                <input type="text" name="ig_link" class="form-control" placeholder="Instagram Link" value="<?php echo get_meta('ig_link');?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label style="padding-top:15px;">
                                                    <?php $show_gp = get_meta('gp_show');?>
                                                    <input type="hidden" value='0' name='gp_show'>
                                                    <input type="checkbox" name="gp_show" value="1" class="minimal-red"  <?php echo $show_gp ==1 ?'checked':'';?> >
                                                        &nbsp;Show GPlus?
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" style="display:block;">Logo Kaskus</label>
                                        <?php $logo_kaskus = get_meta('logo_kaskus');?>
                                        <?php $class= $logo_kaskus!=''?'fileinput-exists':'fileinput-new'; ?>
                                        <div class="fileinput <?php echo $class;?>" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 175px; height: 45px;">
                                                <img src="http://placehold.it/177x45&text=177x45" alt="..." style="width:100%;">                                                                
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"  style="width: 175px; height: 45px;">
                                                <?php if($class=='fileinput-exists') : ?>
                                                <?php $src_img = base_url().'uploads/site/'.$logo_kaskus;?>
                                                <img src="<?php echo $src_img;?>" alt="..." style="width:100%;"> 
                                                <?php endif;?>
                                            </div>
                                            <div>
                                                <span class="btn btn-primary btn-file"><span class="fileinput-new">Browse Gambar</span><span class="fileinput-exists">Ubah</span><input type="file" name="logo_kaskus"></span>
                                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Hapus</a>
                                            </div>
                                        </div>
                                        <p class="help-block with-errors">Image Res : 177px x 45px</p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label">Kaskus Link</label>
                                        <input type="text" name="kaskus_link" class="form-control" placeholder="Kaskus Link" value="<?php echo get_meta('kaskus_link');?>" />
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" style="display:block;">Logo Bukalapak</label>
                                        <?php $logo_bukalapak = get_meta('logo_bukalapak');?>
                                        <?php $class= $logo_bukalapak!=''?'fileinput-exists':'fileinput-new'; ?>
                                        <div class="fileinput <?php echo $class;?>" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 175px; height: 45px;">
                                                <img src="http://placehold.it/177x45&text=177x45" alt="..." style="width:100%;">                                                                
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"  style="width: 175px; height: 45px;">
                                                <?php if($class=='fileinput-exists') : ?>
                                                <?php $src_img = base_url().'uploads/site/'.$logo_bukalapak;?>
                                                <img src="<?php echo $src_img;?>" alt="..." style="width:100%;"> 
                                                <?php endif;?>
                                            </div>
                                            <div>
                                                <span class="btn btn-primary btn-file"><span class="fileinput-new">Browse Gambar</span><span class="fileinput-exists">Ubah</span><input type="file" name="logo_bukalapak"></span>
                                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Hapus</a>
                                            </div>
                                        </div>
                                        <p class="help-block with-errors">Image Res : 177px x 45px</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Bukalapak Link</label>
                                        <input type="text" name="bl_link" class="form-control" placeholder="Bukalapak Link" value="<?php echo get_meta('bl_link');?>" />
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" style="display:block;">Logo Tokopedia</label>
                                        <?php $logo_tokopedia = get_meta('logo_tokopedia');?>
                                        <?php $class= $logo_tokopedia!=''?'fileinput-exists':'fileinput-new'; ?>
                                        <div class="fileinput <?php echo $class;?>" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                                <img src="http://placehold.it/177x45&text=177x45" alt="..." style="width:100%;">                                                                
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"  style="width: 175px; height: 45px;">
                                                <?php if($class=='fileinput-exists') : ?>
                                                <?php $src_img = base_url().'uploads/site/'.$logo_tokopedia;?>
                                                <img src="<?php echo $src_img;?>" alt="..." style="width:100%;"> 
                                                <?php endif;?>
                                            </div>
                                            <div>
                                                <span class="btn btn-primary btn-file"><span class="fileinput-new">Browse Gambar</span><span class="fileinput-exists">Ubah</span><input type="file" name="logo_toped"></span>
                                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Hapus</a>
                                            </div>
                                        </div>
                                        <p class="help-block with-errors">Image Res : 177px x 45px</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tokopedia Link</label>
                                        <input type="text" name="toped_link" class="form-control" placeholder="Tokopedia Link" value="<?php echo get_meta('toped_link');?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Video Link</label>
                                        <input type="text" name="video_link" class="form-control" placeholder="Video Link" value="<?php echo get_meta('video_link');?>" />
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                                </div>
                            </form>
                        </div><!-- /.box -->
                    </div>

                </div>
            </section><!-- /<div class=""></div>content -->
        </div><!-- /.content-wrapper -->



          <?php include('inc/footer.php');?>
        </div><!-- ./wrapper -->
        <?php include('inc/load_bottom.php');?>
    
    </body>
</html>
