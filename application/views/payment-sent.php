<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo GG_PREFIX_TITLE;?> - Payment Confirmation Sent</title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>
        <div class="container content-checkout">       
            <div class="row">

                <div class="col-sm-12" style="padding:50px;">
                    <h4>Payment confirmation sent</h4>
                    <h3>Thanks for doing the payment</h3>
                    <p>we'll let you know if the payment accepted</p>
                    <a href="<?php echo base_url();?>" class="btn btn-default">Back to home</a>
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