<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?></title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>

        <div class="container category-content-outter">            
            <div class="row">
                <div id="sidebar-category" class="col-md-3">
                    <div class="wrap-breadcrump">
                        <h4>SHOP &gt; G-SHOCK</h4>
                    </div>
                    

                    <?php include('inc/sidebar-cat.php');?>
                </div>
                <div id="child-category" class="col-md-9">
                    <div class="row">
                        <div id="category-banner" class="col-md-12">
                            <img src="uploads/cat-banner-2.jpg" style="width:100%;">
                        </div>
                    </div>
                    <div id="product-sort-filter" class="row"> 
                        <div class="col-md-6">
                            <form class="form-inline">
                                <div id="wrap-sorting" class="form-group">
                                    <label for="exampleInputName2">SORT BY :</label>
                                    <select class="form-control">
                                        <option>Name A - Z</option>
                                        <option>Name Z - A</option>
                                        <option>Price Lowest - Highest</option>
                                        <option>Price Highest - Lowest</option>
                                    </select>
                                    <span class="clearfix">&nbsp;</span>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                        	<form id="form-filter" class="form-inline">
                                <div id="wrap-filter" class="form-group">
                                    <label for="exampleInputName2">SHOW :</label>
                                    <select class="form-control">
                                        <option>12</option>
                                        <option>24</option>
                                        <option>48</option>
                                        <option>60</option>
                                    </select>
                                    <label for="exampleInputName2">PER PAGE</label>
                                    <span class="clearfix">&nbsp;</span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="wrap-product" class="row">
                        <?php for($i=0;$i<12;$i++):?>
                        <div class="item col-xs-6 col-sm-4 col-md-3">
                            <a href ="#">
                                <div class="content-item">
                                    <div class="thumbnail">
                                    	<div class="wrap-image">
                                    		<img src="uploads/prod-1.png" alt="...">
                                    	</div>
								      	<div class="caption">
									      	<div class="row">
									      		<div class="col-xs-12 col-md-7 prod-name">
									      			<h4>SGW-500H-28V</h4>
									      		</div>
									      		<div class="col-xs-12 col-md-5 prod-price">
									      			<span><strike>IDR 1.700.000</strike></span>
									      			<span>IDR 1.300.000</span>
									      		</div>
									      	</div>
								      	</div>
								    </div>
                                </div>
                            </a>
                        <!--     <div class="cat-overlay"></div> -->
                        </div>
                        <?php endfor;?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        	<ul class="pagination">
                        		<li class="prev">
                        			<a href=""><span class="fa fa-angle-double-left"></span>&nbsp; PREVIOUS</a>
                        		</li>
                        		<li class="page">
                        			<a class="active" href="">1</a>
                        		</li>
                        		<li class="page">
                        			<a href="">2</a>
                        		</li>
                        		<li class="page">
                        			<a href="">3</a>
                        		</li>
                        		<li class="next">
                        			<a href=""> NEXT &nbsp; <span class="fa fa-angle-double-right"></span></a>
                        		</li>
                        	</ul>
                        	<!-- <span class="clearfix">&nbsp;</span> -->
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