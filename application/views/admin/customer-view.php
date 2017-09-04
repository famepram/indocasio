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
                    <li class="active"><a href=""><i class="fa fa-list"></i>&nbsp; Customer View</a></li>
                    <li class="active"><i class="fa fa-plus"></i>&nbsp; <?php echo $page_caption;?></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="box">
                            <div class="box-header clearfix">
                                <h3 class="box-title">View Detail Customer</h3>
                            </div>
                            <div class="box-body">
                                <h3><?php echo $this->_customer->fname.' '.$this->_customer->lname;?></h3>
                                <span><?php echo $this->_customer->email;?></span><br/>
                                <span><?php echo $this->_customer->phone;?></span><br/>
                                <span>Date Register : <?php echo date('d F Y',$this->_customer->cdate);?></span>

                            </div>
                            <div class="box-body">
                                <h3>Address Book</h3>
                                <?php $abs = $this->_customer->get_address_book();?>
                                <?php if(!empty($abs)):?>
                                    <?php foreach($abs as $ab):?>
                                    <p><?php echo $ab->address;?>, <br /><?php echo get_city_name($ab->city_id);?> 
                                        <?php echo get_province_name_by_city($ab->city_id);?> <?php echo $ab->postal_code;?>.
                                        <?php echo $ab->is_default==1?'(Default)':'';?>
                                    </p>
                                    <?php endforeach;?>
                                <?php endif;?>

                            </div>
                        </div><!-- /.box -->
                    </div>
                    <div class="col-md-6 col-sm-12">

                    </div>
                </div>
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->



          <?php include('inc/footer.php');?>
        </div><!-- ./wrapper -->
        <?php include('inc/load_bottom.php');?>
    
    </body>
</html>
