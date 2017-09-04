<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - Update Profile</title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>

        <div class="container account-content-outter">            
            <div class="row">
                <div id="sidebar-category" class="col-md-3">
                    <div class="wrap-breadcrump">
                        <h4>Dashboard &gt; Profile </h4>

                    </div>
                    <?php include('inc/sidebar-account.php');?>
                </div>
                <div id="account-content-inner" class="col-md-9">
                    <h4><span class="fa fa-newspaper-o"></span> &nbsp;Your Profile</h4>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 wrap-content">
                            
                            <form id="form-register" data-toggle="validator" role="form" class="account-form" method="post" action="<?php echo base_url();?>account/profile_post/">
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
                                            <input name="fname" type="text" class="form-control" value="<?php echo $this->_customer->fname;?>" placeholder="First Name" required>
                                            <span class="help-block with-errors"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 half">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input name="lname" type="text" class="form-control"  value="<?php echo $this->_customer->lname;?>" placeholder="Last Name">
                                            <span class="help-block with-errors"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input name="email" type="email" class="form-control" value="<?php echo $this->_customer->email;?>" placeholder="Email Address" required>
                                    <span class="help-block with-errors"></span>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input name="phone" type="phone" class="form-control"  value="<?php echo $this->_customer->phone;?>" placeholder="Phone Number" required>
                                    <span class="help-block with-errors"></span>
                                </div>                                 
                                <button type="submit" class="btn btn-default">Update Profile</button>
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