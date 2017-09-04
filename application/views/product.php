<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - <?php echo $_product->code;?></title>
        <meta property="og:title" content="Indocasio :: <?php echo $_product->code;?>" />
        <meta property="og:url" content="<?php echo $_product->get_link();?>" />
        <meta property="og:image" content="<?php echo $_product->get_img_src();?>" />
        <?php include('inc/load_top.php');?>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <style>
        .fancybox-title{
            position: relative !important;
            right: 0px;
        }

        .fancybox-wrap{

        }

        .fancybox-skin{
            border: none;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;
            

        }

        .fancybox-title-float-wrap .child{
            margin-right: 0px;
            display: block;
            border: none;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;
            background-color: #fff;
            border-bottom: solid 5px #77c1ff;
            white-space: normal;
        }
        </style>
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
                <div id="content-product" class="col-md-9">
                    <h4 class="breadcrump">PRODUCT DETAIL &gt; <?php echo $_product->code;?></h4>
                    <div id="product-main-info" class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="wrap-prod-img thumbnail">
                                <a class="fancybox" href="<?php echo $_product->get_img_src();?>" href="javascript:void(0);">
                                    <img id="prod_img" src="<?php echo $_product->get_img_src();?>" data-zoom-image="<?php echo $_product->get_img_src();?>" style="width:100%;max-width:230px;">
                                </a>
                            </div>
                        </div>
                        <div id="wrap-main-caption" class="col-sm-8 col-xs-12">
                            <h3><?php echo $_product->code;?></h3>
                            <?php if(empty($_category->parent)):?>
                            <h5><?php echo $_category->name;?></h5>
                            <?php else: ?>
                            <?php $_parent = $_category->get_parent();?>
                            <h5><?php echo $_parent->name;?> , <?php echo $_category->name;?></h5>
                            <?php endif;?>
                            <div class="row">
                                <div class="col-xs-3">PRICE</div>
                                <div class="col-xs-9"> : &nbsp; 
                                    <?php if($_product->show_price == 1):?>
                                        <?php if($_product->disc_value > 0):?>
                                    <strike>IDR <?php echo number_format($_product->price);?></strike> &nbsp; IDR <?php echo number_format($_product->get_final_price());?>
                                        <?php else :?>
                                         IDR <?php echo number_format($_product->get_final_price());?>
                                        <?php endif;?>
                                    <?php else :?>
                                    <span class="fa fa-phone"></span> &nbsp; Call
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">SIZE</div>
                                <div class="col-xs-9"> : &nbsp; <?php echo ($_product->p/10);?> x <?php echo ($_product->l/10);?> x <?php echo ($_product->t/10);?> cm</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">WEIGHT</div>
                                <div class="col-xs-9"> : &nbsp; <?php echo $_product->weight;?> Gram</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">WARRANTY</div>
                                <div class="col-xs-9"> : &nbsp; <?php echo $_product->warranty;?> <?php echo $_product->warranty > 1?'Years':'Year';?></div>
                            </div>
                            <?php if($_product->publish == 1):?>
                            <?php if($_product->inquiry == 0):?>
                            <div class="row">
                                <div class="col-xs-3 label-add-to-cart">QTY</div>
                                <div id="wrap-add-to-cart" class="col-xs-9">
                                    <form id="form-add-to-cart" class="form-inline" action="<?php echo base_url();?>product/add_to_cart/">
                                      <div class="form-group">
                                        <label for="exampleInputName2">: &nbsp;</label> 
                                        <input type="hidden" value="<?php echo $_product->id;?>" name="pid" />
                                        <input type="text" class="form-control" id="pqty" value="1" name="pqty" type="number">
                                        <button id="btn-add-to-cart" type="submit" class="btn btn-default">Add To Cart</button>
                                      </div>
                                    </form>
                                </div>
                            </div>
                            <?php else : ?>
                            <div class="row">
                                <div class="col-xs-9">
                                    <button class="btn btn-inquiry btn-default">Inquiry</button>
                                </div>
                            </div>
                            <?php endif;?>
                            <?php else : ?>
                            <div class="row">
                                <div class="col-xs-9">
                                    <span class="btn btn-default">Not Available</span>
                                </div>
                            </div>
                            <?php endif;?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="product-share">
                                        <li>
                                            <!-- <input type="text" value="12"> -->
                                            <a data-url="<?php echo $_product->get_link();?>" href="javascript:void(0);" onClick="shareFB($(this))"><img src="<?php echo base_url();?>assets/img/facebook-black.png"></a>
                                        </li>
                                        <li>
                                            <!-- <input type="text" value="12"> -->
                                            <a data-caption="<?php echo $_product->code;?>" data-url="<?php echo $_product->get_link();?>"  onClick="shareTW($(this))" href="javascript:void(0);" href="#"><img src="<?php echo base_url();?>assets/img/twitter-black.png"></a>
                                        </li>
                                        <li>
                                            <!-- <input type="text" value="12"> -->
                                            <a data-url="<?php echo $_product->get_link();?>" data-media="<?php echo $_product->get_img_src();?>" data-caption="Indocasio - <?php echo $_product->code;?>" href="javascript:void(0);" onClick="sharePIN($(this))" href="#"><img src="<?php echo base_url();?>assets/img/pinterest-black.png"></a>
                                        </li>
                                        <li>
                                            <!-- <input type="text" value="12"> -->
                                            <a data-url="<?php echo $_product->get_link();?>" href="javascript:void(0);" onClick="shareGP($(this))" href="#"><img src="<?php echo base_url();?>assets/img/gplus-black.png"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row row-other-info">
                        <div class="col-sm-12">
                            <h4>Description</h4>
                            <div class="row">
                                <div class="col-sm-12 content">
                                    <?php echo $_product->descr;?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-other-info">
                        <div class="col-sm-12">
                            <h4>Product Related</h4>
                            <div class="row">
                                <div class="col-sm-12 content">
                                    <div id="wrap-related" class="row">
                                        <?php $rels = $_product->get_related(6);?>
                                        <?php foreach($rels as $rel):?>
                                        <div class="item col-xs-6 col-sm-2 col-md-2 col-lg-2">
                                            <a href ="<?php echo $rel->get_link();?>">
                                                <div class="content-item">
                                                    <div class="thumbnail">
                                                        <div class="wrap-image">
                                                            <img src="<?php echo $rel->get_img_src(true);?>" alt="...">
                                                        </div>
                                                        <div class="caption">
                                                            <h4><?php echo $rel->code;?></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $gals = $_product->get_gallery();?>
                    <?php if(!empty($gals)):?>
                    <div class="row row-other-info">
                        <div class="col-sm-12">
                            <h4>Gallery</h4>
                            <div class="row">
                                <div class="col-sm-12 content gallery-content">
                                    <div id="wrapper">
                                        <div id="columns">
                                            <?php foreach($gals as $gal):?>
                                            <div class="pin">
                                                <a class="fancybox" href="<?php echo $gal->get_img_src();?>" href="javascript:void(0);">
                                                    <img src="<?php echo $gal->get_img_src(true);?>" />
                                                </a>
                                                
                                            </div>
                                            <?php endforeach;?>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
            </div>

        </div>
        <?php include('inc/footer.php');?>
        <?php include('inc/load_bottom.php');?>
        <div id="modal-added-cart" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Product has been added to cart</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-5 col-xs-5" style="padding:25px;">
                                <img src="http://localhost/indocasio/uploads/product/1433078205.png" style="width:100%;max-width:180px;" />
                            </div>
                            <div class="col-sm-7 col-xs-7" style="padding:25px;">
                                <h4 class="code">Product Code</h4>
                                <p class="desc">
             
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-shopping" data-dismiss="modal">Continue Shopping</button>
                        <a href="<?php echo base_url();?>checkout/account/" class="btn btn-primary btn-goto-checkout">Go to Checkout</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery.scrollTo.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery.elevatezoom-3.0.8.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
        <script type="text/javascript">
            function shareTW(obj) {
                var w=700;
                var h=400;
                var x=Number((window.screen.width-w)/2);
                var y=Number((window.screen.height-h)/2);
                a_encodedUrl = encodeURIComponent($(obj).attr('data-url'));
                a_encodedTitle = encodeURIComponent($(obj).attr('data-caption'));
                window.open('http://twitter.com/share?url=' + a_encodedUrl + '&text=' + a_encodedTitle, "Twitter",'width='+w+',height='+h+',left='+x+',top='+y+',scrollbars=no');

            }

            function shareFB(obj){
                var width = 700;
                var height = 400;
                var left = parseInt((screen.availWidth/2) - (width/2));
                var top = parseInt((screen.availHeight/2) - (height/2));
                var url = $(obj).attr('data-url');
                window.open('http://www.facebook.com/sharer/sharer.php?u='+url, "Facebook", 'height='+height+',width='+width+',left=' + left + ',top=' + top + ',screenX=' + left + ',screenY=' + top);
            }

            function shareTB(obj){
                var width = 700;
                var height = 400;
                var left = parseInt((screen.availWidth/2) - (width/2));
                var top = parseInt((screen.availHeight/2) - (height/2));
                a_encodedUrl = encodeURIComponent($(obj).attr('data-url'));
                a_encodedTitle = encodeURIComponent($(obj).attr('data-caption'));
                a_encodedExcerpt = encodeURIComponent($(obj).attr('data-excerpt'));
                var url_share = 'http://www.tumblr.com/share/link?url='+a_encodedUrl+'&name='+a_encodedTitle+'&description='+a_encodedExcerpt;
                window.open(url_share, "Tumblr", 'height='+height+',width='+width+',left=' + left + ',top=' + top + ',screenX=' + left + ',screenY=' + top);
            }

            function sharePIN(obj){
                var width = 700;
                var height = 400;
                var left = parseInt((screen.availWidth/2) - (width/2));
                var top = parseInt((screen.availHeight/2) - (height/2));
                a_encodedUrl = encodeURIComponent($(obj).attr('data-url'));
                a_encodedTitle = encodeURIComponent($(obj).attr('data-caption'));
                a_encodedMedia = encodeURIComponent($(obj).attr('data-media'));
                var url_share = 'http://pinterest.com/pin/create/link/?url='+a_encodedUrl+'&media='+a_encodedMedia+'&description='+a_encodedTitle;
                window.open(url_share, "Tumblr", 'height='+height+',width='+width+',left=' + left + ',top=' + top + ',screenX=' + left + ',screenY=' + top);
            }

            function shareGP(obj){
                var w=700;
                var h=500;
                var x=Number((window.screen.width-w)/2);
                var y=Number((window.screen.height-h)/2);
                a_encodedUrl = encodeURIComponent($(obj).attr('data-url'));
                window.open('https://plus.google.com/share?url=' + a_encodedUrl, "Twitter",'width='+w+',height='+h+',left='+x+',top='+y+',scrollbars=no');
            }




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

                // $("#prod_img").elevateZoom({ zoomType    : "inner", cursor: "crosshair" }); 

                $('#btn-add-to-cart').click(function(e){
                    var data = $('#form-add-to-cart').serialize();
                    var url  = $('#form-add-to-cart').attr('action');
                    var success = function(data){
                        $('#wrap-navbar .cart a').html('Cart ('+data.total_qty+')');
                        $('#modal-added-cart .code').html(data.prod.code);
                        var desc = data.prod.cat_str+'<br />'+(data.prod.p/10).toFixed(2)+' X '+(data.prod.l / 10).toFixed(2) +' X '+ (data.prod.t / 10).toFixed(2) +' cm <br />'+ (data.prod.weight / 100).toFixed(2)+' kgs';
                        $('#modal-added-cart .desc').html(desc);
                        $('#modal-added-cart img').attr('src',data.prod.img_src);
                        $('#modal-added-cart').modal('show');
                        $(window).scrollTo('#wrap-navbar',400);
                    }
                    var beforeSend = function(){

                    }

                    var options = {
                        data:data,
                        url:url,
                        beforeSend:beforeSend,
                        success:success,
                        dataType:"json",
                        type:"post"
                    }

                    $.ajax(options);
                    e.preventDefault();
                });

                $(".fancybox").fancybox({
                    padding : 0
                    
                });
            });
        </script>
    </body>
</html>