<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - Undermaintaince</title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home" style="min-height:350px;">
        <?php // include('inc/header.php');?>
        <div class="container" style="padding-top:50px;padding-bottom:50px;text-align:center;">       
            <!-- <h1 style="text-align:center">Website is currently under maintenance</h1>
            <h3 style="text-align:center;margin-bottom:30px;">You can still find us on marketplace</h3>
            <div class="row">
                <div class="col-sm-offset-4 col-sm-4">
                    <a href="<?php echo get_meta('kaskus_link');?>"><img style="width:100%;margin-top:20px;" src="<?php echo base_url();?>assets/img/kaskus.png" /></a>
                </div>
            </div> -->
<!--             <h4><?php echo $this->_page->title;?></h4> -->
            <?php echo $this->_page->content;?>
        </div>

        <?php //include('inc/load_bottom.php');?>

    </body>
</html>