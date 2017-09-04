<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - Search Result</title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>

        <div class="container category-content-outter">            
            <div class="row">
                <div id="sidebar-category" class="col-md-3">
                    <div class="wrap-breadcrump">
                        <h4>SEARCH</h4>
                    </div>
                    <?php include('inc/sidebar-cat.php');?>
                </div>
                <div id="child-category" class="col-md-9" style="min-height:450px;">
                    <h4 style="margin-top: 0px;border-bottom: solid 1px #000;padding-bottom: 15px;  margin-bottom: 30px;  font-size: 14px;">Result search of "<?php echo $this->q;?>"</h4>
                    <?php if(!empty($this->list)):?>
                        <?php foreach($this->list as $row ):?>
                        <div class="row result-search-row">
                            <div class="col-sm-2 col-xs-4">
                                <img src="<?php echo $row->get_img_src(true);?>" style="width:100%;">
                            </div>
                            <div class="col-sm-10 col-xs-8 desc">
                                <a href="<?php echo $row->get_link();?>"><?php echo $row->name;?></a>
                                <p>
                                    <?php echo $row->get_category_name();?> <br />
                                    <?php echo 'Size : '.$row->p.' x '.$row->l.' x '.$row->t.' mm';?> <br />
                                    <?php echo 'Weight : '.$row->weight.' grams';?> <br />
                                    <span><strike>IDR <?php echo number_format($row->price);?></strike></span>
                                    <span>IDR <?php echo number_format($row->get_final_price());?></span>
                                </p>
                            </div>
                        </div>
                        <?php endforeach;?>
                    <?php endif;?>
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