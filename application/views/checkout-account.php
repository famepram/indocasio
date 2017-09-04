<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - Checkout Account</title>
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
                                    <li class="active"><h5>Signin</h5></li>
                                    <li><h5>Delivery <span class="fa fa-angle-double-right"></span></h5></li>
                                    <li><h5>Confirmation <span class="fa fa-angle-double-right"></span></h5></li>
                                    <li><h5>Finish <span class="fa fa-angle-double-right"></span></h5></li>
                                </ul>
                            </div>
                            <div class="checkout-breadcrump visible-xs" style="text-align:center;">
                                <h4>Checkout  <span class="fa fa-angle-double-right"></span> Sign In</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-offset-1 col-md-4 checkout-login" style="margin-top:35px;">
                            <h4>Sign in to Your Account</h4>
                            <form id="form-login" data-toggle="validator" role="form" class="account-form" method="post" action="<?php echo base_url();?>login/post/?redirect=<?php echo urlencode(base_url().'checkout/delivery/');?>">
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
                                <button type="submit" class="btn btn-default">Sign In</button>
                            </form>
                            <hr>
                            <div class="or">
                                <h4 class="or">OR</h4>
                            </div>
                            
                            <p>If you don't have an account, click this button below to create new account</p>
                            <a class="btn btn-default" href="<?php echo base_url();?>register/?redirect=<?php echo urlencode(base_url().'checkout/delivery/');?>">Register</a>

                        </div>
                        <div class="col-sm-12 col-md-offset-2 col-md-4 checkout-quick-co" style="margin-top:35px;">
                            <h4>Checkout Without Register</h4>
                            <form id="form-quick-co" data-toggle="validator" role="form" class="account-form" method="post" action="<?php echo base_url();?>checkout/account_post/">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" name="fname" placeholder="First Name" required>
                                            <span class="help-block with-errors"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="lname" placeholder="Last Name">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                                    <span class="help-block with-errors"></span>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="phone" class="form-control" name="phone" placeholder="Phone Number" required>
                                    <span class="help-block with-errors"></span>
                                </div>
                                <button type="submit" class="btn btn-default">Next Step <span class="fa fa-angle-double-right"></span></button>
                            </form>
                        </div>
                    </div>
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