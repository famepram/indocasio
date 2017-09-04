<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - Checkout Finish</title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>
        <div class="container content-checkout">       
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="checkout-breadcrump hidden-xs">
                                <hr>
                                <ul>
                                    <li><h5>Sign In <span class="fa fa-angle-double-right"></span></h5></li>
                                    <li><h5>Delivery <span class="fa fa-angle-double-right"></span></h5></li>
                                    <li><h5>Confirmation <span class="fa fa-angle-double-right"></span></h5></li>
                                    <li class="active"><h5>Finish</h5></li>
                                    
                                </ul>
                            </div>
                            <div class="checkout-breadcrump visible-xs" style="text-align:center;">
                                <h4>Checkout  <span class="fa fa-angle-double-right"></span> Finish </h4>
                            </div>
                        </div>
                    </div>
                    <form id="form-order-confirmation" data-toggle="validator" role="form" class="account-form" method="post" action="<?php echo base_url();?>login/post/">
                        <div class="row">
                            <div class="col-sm-12 wrap-finish-order">
                                <h4>The Order no. <?php echo $this->_order->get_no_order();?> has been successfully placed</h4>
                                <h3>Thanks for ordering</h3>
                                <p>We'll send you an email for order detail information</p>
                                <a href="<?php echo base_url();?>" class="btn btn-default">Back to home</a>
                            </div>
                        </div>
                    </form>
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