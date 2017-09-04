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
                            <form method="post" role="form" action="<?php echo $root_path;?>banner/updater/" enctype="multipart/form-data">
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
                                        <label class="control-label">Link</label>
                                        <input type="text" name="link" class="form-control" placeholder="Banner Link" value="<?php echo $object!==false?$object->link:'';?>" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Sort</label>
                                        <input type="text" name="sort" class="form-control" placeholder="Sort" value="<?php echo $object!==false?$object->sort:'';?>" />
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label style="padding-left:0px;">
                                                <?php $status = $object!==false?$object->status:'';?>
                                                <input type="checkbox" name="status" value="1" class="minimal-red"  <?php echo $status ==1 ?'checked':'';?> >
                                                    &nbsp;Published To Website ?
                                            </label>
                                        </div>
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
            var url = "<?php echo $root_path;?>article/upload_img";
            function _(el){
                return document.getElementById(el);
            }
            function uploadFile(){
                var file = _("text_image").files[0];
                // alert(file.name+" | "+file.size+" | "+file.type);
                var formdata = new FormData();
                formdata.append("text_image", file);
                var ajax = new XMLHttpRequest();
                ajax.upload.addEventListener("progress", progressHandler, false);
                ajax.addEventListener("load", completeHandler, false);
                ajax.addEventListener("error", errorHandler, false);
                ajax.addEventListener("abort", abortHandler, false);
                ajax.open("POST", url);
                ajax.send(formdata);
                $('div.progress').css('display','block');
                $('div.progress-bar').css('width','0%');
            }
            function progressHandler(event){
                // _("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
                var percent = (event.loaded / event.total) * 100;
                $('div.progress-bar').attr('aria-valuenow',percent);
                var w = percent+"%";
               $('div.progress-bar').css('width',w);
                // _("progressBar").value = Math.round(percent);
                // _("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
            }
            function completeHandler(event){
                // $('div.progress').css('display','none');
                console.log(event.currentTarget.response);
                var data = event.currentTarget.response;
                $('input[name="link-image"]').val(data);

            }
            function errorHandler(event){
                // _("status").innerHTML = "Upload Failed";
            }
            function abortHandler(event){
                // _("status").innerHTML = "Upload Aborted";
            }
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
