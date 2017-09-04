<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - Shoping Cart</title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>
        <div class="container content-cart">       
            <div class="row">
                <div class="col-sm-12">
                    <div class="row head-table">
                        <div class="col-sm-1 col-xs-1">#</div>
                        <div class="col-sm-4 col-xs-4">Product Detail</div>
                        <div class="col-sm-2 col-xs-2">Qty</div>
                        <div class="col-sm-4 col-xs-4">Price</div>
                    </div>
                    <?php if(!empty($this->mod_cart->items)):?>
                        <?php $x = 0;?>
                        <?php foreach($this->mod_cart->items as $item):?>
                            <?php $x++;?>
                            <div id="row-<?php echo $item->id;?>" class="row row-item">
                                <div class="col-sm-1 col-xs-1 item-col"><?php echo $x;?>.</div>
                                <div class="col-sm-4 col-xs-4 item-col">
                                    <div class="row">
                                        <div class="col-sm-4 col-xs-12">
                                            <img src="<?php echo $item->get_img_src(true);?>" />
                                            <a class="visible-xs" href="<?php echo $item->get_link();?>"><?php echo $item->name;?></a>
                                        </div>
                                        <div class="col-sm-8 hidden-xs">
                                            <a href="<?php echo $item->get_link();?>"><?php echo $item->name;?></a>
                                            <p>
                                                <?php echo $item->get_category_name();?> <br />
                                                <?php $p = $item->p / 10;?>
                                                <?php $l = $item->l / 10;?>
                                                <?php $t = $item->t / 10;?>
                                                <?php $weight = $item->weight / 100;?>
                                                <?php echo 'Size : '.$p.' x '.$l.' x '.$t.' cm';?> <br />
                                                <?php echo 'Weight : '.$weight.' kgs';?> <br />
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-xs-2 item-col">
                                    <?php echo $item->qty.' Pcs';?>
                                </div>
                                <div class="col-sm-4 col-xs-4 item-col">
                                    <div class="row">
                                        <div class="col-sm-5 hidden-xs">
                                            <?php echo '@'.$item->price_format;?>
                                        </div>
                                        <div class="col-sm-7 col-xs-12">
                                            <?php echo $item->price_line_format;?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1 col-xs-1 item-col">
                                    <a class="remove-item" data-id="<?php echo $item->id;?>" href="javascript:void(0);"> X </a>
                                </div>
                            </div>

                        <?php endforeach;?>
                    
                    <div class="row foot-table">
                        <div class="col-sm-9 col-xs-7"style="padding-right:0px;">
                            <strong>Total</strong>
                        </div>
                        <div class="total_price col-sm-3 col-xs-5" style="padding-left:0px;">
                            <strong><?php echo $this->mod_cart->total_price_format;?></strong>
                        </div>
                    </div>

                    <div class="row sc-checkout">
                        <div class="col-sm-6 col-xs-6">
                            <a class="btn btn-default" href="#" style="float:left;"><span class="fa fa-angle-left"></span> &nbsp; Back To Shop</a>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <a class="btn btn-default" href="<?php echo base_url();?>checkout/account/" style="float:right;">Go to Checkout &nbsp; <span class="fa fa-angle-right"></span> </a>
                        </div>
                    </div>
                    <?php else :?>
                    <div class="row foot-table">
                        <div class="col-sm-12 col-xs-12"style="padding-right:0px;">
                            <strong>No Item In Your Cart</strong>
                        </div>

                    </div>
                    <?php endif;?>
                </div>
            </div>     
        </div>
        <?php include('inc/footer.php');?>
        <?php include('inc/load_bottom.php');?>
        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery.scrollTo.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.remove-item').click(function(e){
                    var id = $(this).attr('data-id');
                    var data = "id="+id;
                    var success = function(data){
                        var $tr = $('#row-'+id).remove();
                        $('li.cart a').html("Cart ("+data.total+")");
                        $('.total_price').html('<strong>'+data.total_price+'</strong>')
                    }
                    var beforeSend = function beforeSend(){

                    }
                    var options = {
                        url:base_url+"cart/remove/",
                        dataType:"json",
                        data:data,
                        type:"post",
                        success:success,
                        beforeSend:beforeSend
                    }
                    $.ajax(options);
                    e,preventDefault();
                });
            });
        </script>
    </body>
</html>