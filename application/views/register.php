<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - Register</title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>

        <div class="container content-register">            
            <div class="row">
                <div class="col-xs-12 col-sm-offset-3 col-sm-6 wrap-form">
                    <h3>Create New Account</h3>
                    <p class="intro">If you already have account. click <a href="">here</a> to login.</p>
                    <form id="form-register" data-toggle="validator" role="form" class="account-form" method="post" action="<?php echo base_url();?>register/post/?<?php echo $redirect!=''?'redirect='.$redirect:''?>">
                        <?php if(isset($error) && !empty($error)):?>
                        <div class="alert alert-warning alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>Error!</strong> <?php echo $error;?>
                        </div>
                        <?php endif;?>

                        <div class="row">
                            <div class="col-sm-6 half">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input name="fname" type="text" class="form-control" name="" id="exampleInputEmail1" placeholder="First Name" required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 half">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input name="lname" type="text" class="form-control" id="exampleInputEmail1" placeholder="Last Name">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input name="email" type="email" class="form-control" placeholder="Email Address" required>
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input name="phone" type="phone" class="form-control" id="exampleInputEmail1" placeholder="Phone Number" required>
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input id="pass" type="password" class="form-control" name="pass" placeholder="Password" data-minlength="6" required>
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="conpass" placeholder="Confirm Password" data-match="#pass">
                            <span class="help-block with-errors"></span>
                        </div>
                      
                        <button type="submit" class="btn btn-default">Register</button>
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