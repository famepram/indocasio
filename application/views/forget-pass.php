<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?>- Forget Password</title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>

        <div class="container content-register">            
            <div class="row">
                <div class="col-xs-12 col-sm-offset-3 col-sm-6 wrap-form">
                    <h3>Forget Password</h3>
                    <p class="intro">Enter your email address.</p>
                    <form id="form-register" data-toggle="validator" role="form" class="account-form" method="post" action="<?php echo base_url();?>register/fp_post/">
                        <?php if(isset($error) && !empty($error)):?>
                        <div class="alert alert-warning alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>Error!</strong> <?php echo $error;?>
                        </div>
                        <?php endif;?>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input name="email" type="email" class="form-control" placeholder="Email Address" required>
                            <span class="help-block with-errors"></span>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
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