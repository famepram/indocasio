<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - <?php echo $this->_page->title;?></title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>
        <div class="container content-checkout content-page">       
            <div class="row">

                <div class="col-sm-12" style="padding:10px 50px;">
                    <h4><?php echo $this->_page->title;?></h4>
                    <?php echo $this->_page->content;?>
                </div>
                    
            </div>     
        </div>
        <?php include('inc/footer.php');?>
        <?php include('inc/load_bottom.php');?>
        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery.scrollTo.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                
            });
        </script>
    </body>
</html>