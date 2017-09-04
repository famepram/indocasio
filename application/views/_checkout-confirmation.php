<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Indocasio</title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>
        <div class="container content-checkout">       
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="checkout-breadcrump">
                                <hr>
                                <ul>
                                    <li><h5>Sign In <span class="fa fa-angle-double-right"></span></h5></li>
                                    <li><h5>Delivery <span class="fa fa-angle-double-right"></span></h5></li>
                                    <li class="active"><h5>Confirmation</h5></li>
                                    <li><h5>Finish <span class="fa fa-angle-double-right"></span></h5></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <form id="form-order-confirmation" data-toggle="validator" role="form" class="account-form" method="post" action="<?php echo base_url();?>checkout/confirmation_post/">
                        <div class="row">
                            <div class="col-sm-12">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="width:5%;">#</th>
                                            <th  style="width:50%;" colspan="2"><h5>Product Detail</h5></th>
                                            <th style="width:5%;"><h5>Qty</h5></th>
                                            <th style="width:35%;" colspan="2"><h5>Price</h5></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($this->mod_cart->items)):?>
                                            <?php $x = 0;?>
                                            <?php foreach($this->mod_cart->items as $item):?>
                                            <?php $x++;?>
                                            <tr>
                                                <td style="width:5%;"><?php echo $x;?>.</td>
                                                <td width="10%"><img src="<?php echo $item->get_img_src(true);?>" /></td>
                                                <td>
                                                    <a href="<?php echo $item->get_link();?>"><?php echo $item->name;?></a>
                                                    <p>
                                                        <?php echo $item->get_category_name();?> <br />
                                                        <?php echo 'Size : '.$item->p.' x '.$item->l.' x '.$item->t.' mm';?> <br />
                                                        <?php echo 'Weight : '.$item->weight.' grams';?> <br />
                                                    </p>
                                                </td>
                                                <td style="width:10%;"><?php echo $item->qty.' Pcs';?></td>
                                                <td style="width:15%;"><?php echo '@'.$item->price_format;?></td>
                                                <td style="width:15%;"><?php echo $item->price_line_format;?></td>
                                            </tr>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </tbody>
                                    <tfoot>
                                        <tr style="border-top:solid 1px #000;">
                                            <td colspan="5"><strong>Subtotal</strong></td>
                                            <td colspan="1"><strong><?php echo $this->mod_cart->total_price_format;?></strong></td>
                                        </tr>
                                        <tr>
                                            <?php if(isset($this->_ab)):?>
                                            <?php $city_id = $this->_ab->city_id;?>
                                            <td colspan="5">
                                                <strong>Delivery </strong> <small> (<?php echo $this->_ab->address;?>, <?php echo get_city_name($this->_ab->city_id);?> <?php echo get_province_name_by_city($this->_ab->city_id);?> <?php echo $this->_ab->postal_code;?>) </small>
                                            </td>
                                            <?php else:?>
                                            <?php $city_id = $this->_preoder['city_id'];?>
                                            <td colspan="5">
                                                <strong>Delivery </strong> <small> (<?php echo $this->_preoder['address'];?>, <?php echo get_city_name($this->_preoder['city_id']);?> <?php echo get_province_name_by_city($this->_preoder['city_id']);?> <?php echo $this->_preoder['postal_code'];?>) </small>
                                            </td>
                                            <?php endif;?>
                                            <?php $sc = get_shipping_cost($city_id) * round($this->mod_cart->total_weight);?>
                                            <td colspan="1"><strong>IDR <?php echo number_format($sc);?></strong></td>
                                        </tr>
                                        <tr>
                                            <?php $total = $this->mod_cart->total_price + $sc;?>
                                            <td colspan="5"><strong>Grand Total</strong></td>
                                            <td colspan="1"><strong>IDR <?php echo number_format($total);?></strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"><strong>Payment With</strong></td>
                                            <td colspan="1">
                                                <div class="form-group">
                                                    <select name="payment" class="form-control">
                                                        <option value="1">Transfer ATM</option>
                                                        <option value="2">Credit Card </option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row" style="margin-top:25px;">
                            <div class="col-sm-12 clearfix">
                                <a href="#" class="btn btn-default" style="float:left"><span class="fa fa-angle-double-left"></span> Previous Step</a>
                                <button type="submit" class="btn btn-default" style="float:right">Place Order  <span class="fa fa-angle-double-right"></span></button>
                            </div>
                        </div>
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