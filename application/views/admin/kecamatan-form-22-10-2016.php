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
                    <li class="active"><a href=""><i class="fa fa-list"></i>&nbsp; City List</a></li>
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
                            <form method="post" role="form" action="<?php echo $root_path;?>kecamatan/updater/" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $object!==false?$object->id:'';?>" />
                                <div class="box-body">
                                    <!-- input states -->
                                    <?php $city_id = $object!==false?$object->city_id:'';?>
                                    <div class="form-group">
                                        <label class="control-label">Kota</label>
                                        <select name="city_id" id="city_id" class="form-control">
                                            <?php echo get_option('city',$city_id);?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nama Kecamatan</label>
                                        <input type="text" name="name" class="form-control" placeholder="Nama Kecamatan" value="<?php echo $object!==false?$object->name:'';?>" />
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Tarif OKE</label>
                                                <input type="text" name="oke" class="form-control" placeholder="Tarif OKE" value="<?php echo $object!==false?$object->oke:'';?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">OKE ET</label>
                                                <input type="text" name="oke_et" class="form-control" placeholder="OKE ET" value="<?php echo $object!==false?$object->oke_et:'';?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Tarif REG</label>
                                                <input type="text" name="reg" class="form-control" placeholder="Tarif REG" value="<?php echo $object!==false?$object->reg:'';?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">REG ET</label>
                                                <input type="text" name="reg_et" class="form-control" placeholder="REG ET" value="<?php echo $object!==false?$object->reg_et:'';?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Tarif YES</label>
                                                <input type="text" name="yes" class="form-control" placeholder="Tarif YES" value="<?php echo $object!==false?$object->yes:'';?>" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">YES ET</label>
                                                <input type="text" name="yes_et" class="form-control" placeholder="YES ET" value="<?php echo $object!==false?$object->yes_et:'';?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Available for GOJEK </label> <Br />
                                                <?php $avgojek = $object!==false ? $object->avgojek:'';?>
                                                <input type="checkbox" name="avgojek" <?php echo $avgojek=="1"?'checked="checked"':''; ?> class="form-control" value="1" /> Yes
                                            </div>
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
    
    </body>
</html>
