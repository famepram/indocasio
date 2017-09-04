<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - Register Success</title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>

        <div class="container content-register">            
            <div class="row">
                <div class="col-xs-12 col-sm-offset-4 col-sm-4 wrap-form">
                    <h3>Register Success!</h3>
                    <p class="intro">You're good to go. System will redirect in 3 seconds.</p>
                    
                </div>

            </div>

        </div>
        <?php include('inc/footer.php');?>
        <?php include('inc/load_bottom.php');?>
        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery.scrollTo.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                setTimeOut(function(){
                    window.location.href=base_url;
                },3000);
            });
        </script>
    </body>
</html>