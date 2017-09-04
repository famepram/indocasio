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
                    <li class="active"><a href=""><i class="fa fa-list"></i>&nbsp; Page List</a></li>
                    <li class="active"><i class="fa fa-plus"></i>&nbsp; <?php echo $page_caption;?></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="box">
                            <div class="box-header clearfix">
                                <h3 class="box-title"><?php echo $page_caption;?></h3>
                            </div>
                            <form method="post" role="form" action="<?php echo $root_path;?>page/updater/" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $object!==false?$object->id:'';?>" />
                                <div class="box-body">
                                    
                                    <div class="form-group">
                                        <label class="control-label">Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="Page Title" value="<?php echo $object!==false?$object->title:'';?>" />
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Category</label>
                                                <select name="category" class="form-control">
                                                    <?php $category = $object!==false ? $object->category : 0; ?>
                                                    <option value="0" <?php echo $category == 0 ? 'selected' : ''; ?>>None</option>
                                                    <option value="1" <?php echo $category == 1 ? 'selected' : ''; ?>>About</option>
                                                    <option value="2" <?php echo $category == 2 ? 'selected' : ''; ?>>Help</option>
                                                </select>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label">Description</label>
                                        <textarea name="content" class="form-control wysihtml5" rows="10"><?php echo $object!==false?$object->content:'';?></textarea>
                                    </div>
                                    <div class="row">
                                          <div class="col-xs-6 col-sm-2">
                                                <div class="form-group">
                                                    <label class="control-label">Sort</label>
                                                    <input type="text" name="sort" class="form-control" placeholder="Sort" value="<?php echo $object!==false?$object->sort:'';?>" />
                                                </div>
                                          </div>
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
                     var url = "<?php echo $root_path;?>page/upload_img/";
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

                $('.fileinput-project').on('change.bs.fileinput',function(){
                    uploadFile();
                });
                
            });

        </script>
    
    
    </body>
</html>
