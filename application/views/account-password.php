<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - Update Password</title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>

        <div class="container account-content-outter">            
            <div class="row">
                <div id="sidebar-category" class="col-md-3">
                    <div class="wrap-breadcrump">
                        <h4>Dashboard &gt; Password </h4>

                    </div>
                    <?php include('inc/sidebar-account.php');?>
                </div>
                <div id="account-content-inner" class="col-md-9">
                    <h4><span class="fa fa-lock"></span> &nbsp;Your Profile</h4>
                    <div class="row">
                        <div class="col-md-6 col-sm-9 wrap-content">
                            
                            <form id="form-register" data-toggle="validator" role="form" class="account-form" method="post" action="<?php echo base_url();?>account/password_post/">

                                <div class="form-group">
                                    <label>Current Password</label>
                                    <input name="pass" type="password" class="form-control" value="" placeholder="Current Password" required>
                                    <span class="help-block with-errors"></span>
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input id="newpass" name="newpass" type="password" class="form-control" value="" placeholder="New Password" required>
                                    <span class="help-block with-errors"></span>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input name="conpass" type="password" class="form-control" value="" placeholder="Confirm Password"  data-match="#newpass">
                                    <span class="help-block with-errors"></span>
                                </div>                                 
                                <button type="submit" class="btn btn-default">Update Password</button>
                            </form>
                        </div>
                    </div>
                    
                    
                </div>
            </div>

        </div>
        <?php include('inc/footer.php');?>
        <?php include('inc/load_bottom.php');?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#list-category li a.has-sub').click(function(e){
                    var _this = $(this);
                    var $parent = $(this).parent('li');
                    var is_active = $parent.hasClass('active');
                    $('#list-category li').removeClass('active');
                    $('#list-category li ul.subcategory').slideUp('slow');
                    console.log(is_active);
                    if(!is_active){
                        _this.find('span').removeClass('fa-angle-double-right').addClass('fa-angle-double-down');
                        if($(this).hasClass('has-sub')){
                            
                            $parent.find('ul').slideDown('slow',function(){
                                $parent.addClass('active');
                            });
                        }
                    } else {
                        _this.find('span').removeClass('fa-angle-double-down').addClass('fa-angle-double-right');
                    }
                    
                    e.preventDefault();

                });
            });
        </script>
    </body>
</html>