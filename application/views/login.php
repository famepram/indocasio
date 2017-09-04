<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - Login To You Account</title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>

        <div class="container content-register">            
            <div class="row">
                <div class="col-xs-12 col-sm-offset-4 col-sm-4 wrap-form">
                    <h3>Sign In To Your Account</h3>
                    <p class="intro">If you don't have account yet. click <a href="<?php echo base_url().'register/'?>">here</a> to register.</p>
                    <form id="form-login" data-toggle="validator" role="form" class="account-form" method="post" action="<?php echo base_url();?>login/post/">
                        <?php if(isset($error) && !empty($error)):?>
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Error!</strong> <?php echo $error;?>
                        </div>
                        <?php endif;?>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="pass" placeholder="Password" required>
                            <span class="help-block"></span>
                        </div>
                        <p>click <a href="<?php echo base_url();?>forget_pass">here</a> if you forget your password</p>
                        <button type="submit" class="btn btn-default">Sign In</button>

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