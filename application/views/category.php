<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - <?php echo $_category->name;?></title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>

        <div class="container category-content-outter">            
            <div class="row">
                <div id="sidebar-category" class="col-md-3">
                    <div class="wrap-breadcrump">
                        <?php if(empty($_category->parent)):?>
                        <h4>SHOP &gt; <?php echo $_category->name;?></h4>
                        <?php else: ?>
                        <?php $_parent = $_category->get_parent();?>
                        <h4>SHOP &gt; <?php echo $_parent->name;?> &gt; <?php echo $_category->name;?></h4>
                        <?php endif;?>
                    </div>
                    <?php include('inc/sidebar-cat.php');?>
                </div>
                <div id="child-category" class="col-md-9">
                    <div class="row">
                        <div id="category-banner" class="col-md-12">
                            <img src="<?php echo $_category->get_img_src();?>" style="width:100%;">
                        </div>
                    </div>
                    
                    <?php if($_category->has_child()):?>
                    <?php include('inc/subcat-list.php'); ?>
                    <?php endif;?>
                    <?php include('inc/prod-list.php'); ?>

                    <div class="row">
                        <div class="col-md-12"></div>
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

                $('#product_sort').change(function(){
                    var url = $(this).val();
                    window.location.assign(url);
                });

                $('#product_show').change(function(){
                    var url = $(this).val();
                    window.location.assign(url);
                });
            });
        </script>
    </body>
</html>