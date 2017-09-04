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
                    <li class="active"><a href=""><i class="fa fa-list"></i>&nbsp; Kecamatan List</a></li>
                    <li class="active"><i class="fa fa-plus"></i>&nbsp; Pilih Kota</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <div class="box">
                            <div class="box-header clearfix">
                                <h3 class="box-title"><?php echo $page_caption;?></h3>
                                <div class="btn-group pull-right">
                                    <a href="<?php echo $page_path.'add/';?>" class="btn btn-primary btn-md"><i class="fa fa-plus-square"></i>&nbsp; Add New</a>
                                </div>
                            </div>
                            <form method="post" role="form" action="" enctype="multipart/form-data">
                                <div class="box-body">
                                    <!-- input states -->
                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <select id="province" name="province" class="form-control">
                                            <option value="0">Pilih Provinsi</option>
                                            <?php echo get_option('province');?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kota / Kabupaten</label>
                                        <select id="city" name="city_id" class="form-control">
                                            <option value="0">Pilih Kota / Kabupaten</option>
                                            <?php echo get_option_city($prov_id);?> 
                                        </select>
                                    </div>
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
            function get_option_province(province,selected){
                var data="province="+province;
                var url = base_url+"casio/kecamatan/get_option_city";
                var success = function(data){
                    if(selected != ''){
                        //alert(selected);
                        $('select#city').html(data.options).delay(500).val(selected);
                    } else {
                        $('select#city').html(data.options);
                    }
                };
                var beforeSend = function(){
                    
                }
                var options = {
                    url:url,
                    data:data,
                    success: success,
                    beforeSend:beforeSend,
                    type:"post",
                    dataType:"json"
                };
                $.ajax(options);
            }
            $(document).ready(function(){
                // var province = $('select#province').val();
                // var selected = $('select#city').data('selected');
                //get_option_province(province,selected);
                $('select#province').change(function(){
                    var province = $(this).val();
                    get_option_province(province,'');

                });

                $('select#city').change(function(){
                    var city = $(this).val();
                    var url = base_url+"casio/kecamatan/?city="+city;
                    window.location = url;

                });
            });

        </script>
    </body>
</html>
