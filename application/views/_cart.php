<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Indocasio</title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>
        <div class="container content-cart">       
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-1">#</div>
                        <div class="col-sm-5">Product Detail</div>
                        <div class="col-sm-2">Qty</div>
                        <div class="col-sm-4">Price</div>
                    </div>
                    <?php if(!empty($this->mod_cart->items)):?>
                        <?php foreach($this->mod_cart->items as $item):?>

                        
                        <?php endforeach;?>
                    <?php endif;?>

                    <table>
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th style="width:50%;" colspan="2"><h5>Product Detail</h5></th>
                                <th style="width:5%;"><h5>Qty</h5></th>
                                <th style="width:35%;" colspan="3"><h5>Price</h5></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($this->mod_cart->items)):?>
                                <?php $x = 0;?>
                                <?php foreach($this->mod_cart->items as $item):?>
                                <?php $x++;?>
                                <tr id="row-<?php echo $item->id;?>">
                                    <td style="width:5%;"><?php echo $x;?>.</td>
                                    <td width="10%">
                                        <img src="<?php echo $item->get_img_src(true);?>" />
                                        <a class="visible-xs" href="<?php echo $item->get_link();?>"><?php echo $item->name;?></a>
                                    </td>
                                    <td class="hidden-xs">
                                        <a href="<?php echo $item->get_link();?>"><?php echo $item->name;?></a>
                                        <p>
                                            <?php echo $item->get_category_name();?> <br />
                                            <?php echo 'Size : '.$item->p.' x '.$item->l.' x '.$item->t.' mm';?> <br />
                                            <?php echo 'Weight : '.$item->weight.' grams';?> <br />
                                        </p>
                                    </td>
                                    <td style="width:10%;"><?php echo $item->qty.' Pcs';?></td>
                                    <td class="hidden-xs" style="width:15%;"><?php echo '@'.$item->price_format;?></td>
                                    <td style="width:15%;"><?php echo $item->price_line_format;?></td>
                                    <td style="width:10%;"><a class="remove-item" data-id="<?php echo $item->id;?>" href="javascript:void(0);"> X </a></td>
                                </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                        </tbody>
                        <tfoot>
                            <tr style="border-top:solid 1px #000;">
                                <td colspan="5"><strong>Total</strong></td>
                                <td class="total_price" colspan="2"><strong><?php echo $this->mod_cart->total_price_format;?></strong></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align:left;">
                                    <a class="btn btn-default" href="#"><span class="fa fa-angle-left"></span> &nbsp; Back To Shop</a>
                                </td>
                                <td colspan="3" style="text-align:right;">
                                    <a class="btn btn-default" href="<?php echo base_url();?>checkout/account/">Proceed to Checkout &nbsp; <span class="fa fa-angle-right"></span> </a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
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
                        $('td.total_price').html('<strong>'+data.total_price+'</strong>')
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