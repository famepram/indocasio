<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $page_name;?></title>
        <?php include('inc/load_top.php');?>
        <style type="text/css">
            .gallery-content #wrapper {
              width: 100%;
              margin: 0px auto;
              padding-top: 8px; }
              .gallery-content #wrapper #columns {
                -webkit-column-count: 3;
                -webkit-column-gap: 10px;
                -webkit-column-fill: auto;
                -moz-column-count: 3;
                -moz-column-gap: 8px;
                -moz-column-fill: auto;
                column-count: 3;
                column-gap: 15px;
                column-fill: auto; }
                @media (min-width: 1024px) {
                  .gallery-content #wrapper #columns {
                    -webkit-column-count: 5;
                    -moz-column-count: 5;
                    column-count: 5; } }
                .gallery-content #wrapper #columns .pin {
                  display: inline-block;
                  position: relative;
                  margin: 0 2px 13px;
                  -webkit-column-break-inside: avoid;
                  -moz-column-break-inside: avoid;
                  column-break-inside: avoid;
                  background: -webkit-linear-gradient(45deg, #FFF, #F9F9F9);
                  opacity: 1;
                  -webkit-transition: all .2s ease;
                  -moz-transition: all .2s ease;
                  -o-transition: all .2s ease;
                  transition: all .2s ease; }
                  .gallery-content #wrapper #columns .pin img {
                    width: 100%; }
                .del-gallery {
                    position: absolute;
                    top:5px;
                    left: 5px;
                    padding: 5px;
                    color:#000;
                    background-color: transparent;
                    border:solid 1px #000;
                    display:none;
                }

                .pin:hover .del-gallery{
                    display:block;
                }

        </style>
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
                    <li class="active"><a href="<?php echo $root_path;?>product/"><i class="fa fa-list"></i>&nbsp; Product List</a></li>
                    <li class="active"><i class="fa fa-plus"></i>&nbsp; <?php echo $page_caption;?></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <form method="post" role="form" action="<?php echo $root_path;?>product/updater/" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $object!==false?$object->id:'';?>" />
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="box">
                                <div class="box-header clearfix">
                                    <h3 class="box-title">General Data</h3>
                                </div>
                                <div class="box-body" style="padding-left:25px;padding-right:25px;">
                                    <!-- input states -->
                                    <div class="form-group">
                                        <label class="control-label">Product Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Product Name" value="<?php echo $object!==false?$object->code:'';?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Product Code</label>
                                        <input type="text" name="code" class="form-control" placeholder="Product Code" value="<?php echo $object!==false?$object->sku:'';?>" />
                                    </div>
                                    <div class="form-group">
                                        <?php $category = $object!==false?$object->category:'';?>
                                        <label class="control-label">Category</label>
                                        <select class="form-control" name="category">
                                            <option value="0">None</option>
                                            <?php echo get_option_category($category,0);?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Size</label>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input type="text" name="p" class="form-control" placeholder="P" value="<?php echo $object!==false?$object->p:'';?>" />
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="l" class="form-control" placeholder="L" value="<?php echo $object!==false?$object->l:'';?>" />
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="t" class="form-control" placeholder="T" value="<?php echo $object!==false?$object->t:'';?>" />
                                            </div>
                                        </div>
                                        <p class="help-block with-errors">Satuan MM</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Weight</label>
                                        <input type="text" name="weight" class="form-control" placeholder="Product Weight" value="<?php echo $object!==false?$object->weight:'';?>" />
                                        <p class="help-block with-errors">Satuan gram</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Description</label>
                                        <textarea name="descr" class="form-control wysihtml5" rows="10"><?php echo $object!==false?$object->descr:'';?></textarea>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                                </div>

                            </div><!-- /.box -->
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="box">
                                <div class="box-header clearfix">
                                    <h3 class="box-title">Image & Status</h3>
                                </div>
                                <div class="box-body" style="padding-left:25px;padding-right:25px;">
                                    <div class="form-group">
                                        <label class="control-label" style="display:block;">Image</label>
                                        <?php $class= $object!==false?'fileinput-exists':'fileinput-new'; ?>
                                        <div class="fileinput <?php echo $class;?>" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 150px; height: 180px;">
                                                <img src="http://placehold.it/310x375&text=310x375" alt="..." style="width:100%;">                                                                
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"  style="width: 150px; height: 180px;">
                                                <?php if($class=='fileinput-exists') : ?>
                                                <img src="<?php echo $object->get_img_src();?>" alt="..." style="width:100%;"> 
                                                <?php endif;?>
                                            </div>
                                            <div>
                                                <span class="btn btn-primary btn-file"><span class="fileinput-new">Browse Gambar</span><span class="fileinput-exists">Ubah</span><input type="file" name="image"></span>
                                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Hapus</a>
                                            </div>
                                        </div>
                                        <p class="help-block with-errors">Image Res : 310px X 375px</p>

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Warranty</label>
                                        <input type="text" name="warranty" class="form-control" placeholder="Warranty" value="<?php echo $object!==false?$object->warranty:'';?>" />
                                    </div> 
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label style="padding-left:0px;">
                                                <?php $show_price = $object!==false?$object->show_price:'';?>
                                                <input type="checkbox" name="show_price" value="1" class="minimal-red"  <?php echo $show_price ==1 ?'checked':'';?> >
                                                    &nbsp;Show Price ?
                                            </label>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="control-label">Basic Price</label>
                                        <input type="text" name="price" class="form-control" placeholder="Basic Price" value="<?php echo $object!==false?$object->price:'';?>" />
                                    </div>
                                    <div class="form-group">
                                        <?php $disctype = $object!==false?$object->disc_type:'';?>
                                        <label class="control-label">Discount Type</label>
                                        <select class="form-control" name="disctype">
                                            <option value="0">None</option>
                                            <option value="1" <?php echo $disctype ==1?'selected':'';?>>Percent %</option>
                                            <option value="2" <?php echo $disctype ==2?'selected':'';?>>Fixed</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label">Discount Value</label>
                                        <input type="text" name="discval" class="form-control" placeholder="Discount Value" value="<?php echo $object!==false?$object->disc_value:'';?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Stock Status</label>
                                        <div class="row">
                                            <?php $status = $object!==false?$object->status:'';?>
                                            <div class="col-sm-4">
                                                <label>
                                                    <input type="radio" name="status" value="1" class="minimal-red" <?php echo $status ==1 || $status=='' ?'checked':'';?>  />
                                                    &nbsp;Ready
                                                </label>

                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                    <input type="radio" name="status" value="2" class="minimal-red" <?php echo $status ==2 ?'checked':'';?>  />
                                                    &nbsp;Vendor
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label style="padding-left:0px;">
                                                <?php $publish = $object!==false?$object->publish:'';?>
                                                <input type="checkbox" name="publish" value="1" class="minimal-red"  <?php echo $publish ==1 ?'checked':'';?> >
                                                    &nbsp;Publish On Website?
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label style="padding-left:0px;">
                                                <?php $inquiry = $object!==false?$object->inquiry:'';?>
                                                <input type="checkbox" name="inquiry" value="1" class="minimal-red"  <?php echo $inquiry ==1 ?'checked':'';?> >
                                                    &nbsp;Inquiry?
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Sort</label>
                                        <input type="text" name="sort" class="form-control" placeholder="Warranty" value="<?php echo $object!==false?$object->sort:1;?>" />
                                    </div> 
                                </div>
                                
                            </div><!-- /.box -->
                        </div>
                    </form>
                </div>
                <?php if($object !== false):?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header clearfix">
                                <h3 class="box-title">Gallery Product</h3>
                            </div>
                            <div class="box-body" style="padding-left:25px;padding-right:25px;">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form method="post" role="form" action="<?php echo $root_path;?>product/gallery_updater/" enctype="multipart/form-data">
                                            <input type="hidden" name="product_id" value="<?php echo $object->id;?>" />
                                            <div class="form-group">
                                                <label class="control-label" style="display:block;">Add Image Gallery</label>
                                                <?php $class= $object!==false?'fileinput-exists':'fileinput-new'; ?>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 150px; height: 180px;">
                                                        <img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=image&w=150&h=150" alt="..." style="width:100%;">                                                                
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail"  style="width: 150px; height: 180px;">
                                                    </div>
                                                    <div>
                                                        <span class="btn btn-primary btn-file"><span class="fileinput-new">Browse Gambar</span><span class="fileinput-exists">Ubah</span><input type="file" name="image"></span>
                                                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-flat btn-primary">Submit</button>
                                            </div>
                                            
                                        </form>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-12 content gallery-content">
                                        <div id="wrapper">
                                            <div id="columns">
                                                <?php $gals = $object->get_gallery();?>
                                                <?php if(!empty($gals)):?>
                                                    <?php foreach($gals as $gal):?>
                                                    <div class="pin">
                                                        <a class="fancybox" href="<?php echo $gal->get_img_src();?>" href="javascript:void(0);">
                                                            <img src="<?php echo $gal->get_img_src(true);?>" />
                                                        </a>
                                                        <a class="del-gallery" href="#" data-id="<?php echo $gal->id;?>" data-url="<?php echo $root_path.'product/delete_gallery/'.$gal->id;?>">
                                                            <span class="fa fa-close"></span>
                                                        </a>
                                                        
                                                    </div>
                                                    <?php endforeach;?>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>
                <?php endif;?>
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        <div id="modal-conf-delete" class="modal fade">
            <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Delete Confirmation</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure to delete this image?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
                            <a href="#" class="btn btn-flat btn-danger btn-cdel">Delete</a>
                        </div>
                    </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

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

                $('body').on('click','.del-gallery',function(e){
                    e.preventDefault();
                    var url = $(this).attr('data-url');
                    $('.btn-cdel').attr('href',url);
                    $('#modal-conf-delete').modal('show');
                });
                
            });

        </script>
    
    </body>
</html>
