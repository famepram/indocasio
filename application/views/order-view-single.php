<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - Order <?php echo $this->_order->get_no_order();?></title>
        <?php include('inc/load_top.php');?>
        <style type="text/css">
            .head-table div {
                padding-top: 15px;
                padding-bottom: 15px;
            }
            .head-table {
                margin-bottom: 15px;
            }
        </style>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>

        <div class="container account-content-outter content-checkout">            
            <div class="row">

                <div id="account-content-inner" class="col-md-12" style="border-left:none;">
                    <h4><span class="fa fa-shopping-cart"></span> &nbsp;Order No. <?php echo $this->_order->get_no_order();?></h4>
                    <div class="row">
                        <div class="col-md-12 wrap-content">
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <h4><strong>Order Information</strong></h4>
                                    <p>
                                        Order No. <?php echo $this->_order->get_no_order();?><br>
                                        <?php echo date('d-m-Y H:i',$this->_order->cdate);?><br>
                                        Status : <?php echo get_status_order($this->_order->status)?>  </br>
                                        <?php if($this->_order->status == 1):?>
                                            <?php if($this->_order->payment_method == 1):?>
                                                <a href="<?php echo base_url().'checkout/payment_conf?oid='.$this->_order->id;?>">Konfirmasi Pembayaran</a>
                                            <?php else : ?>
                                                <a href="<?php echo base_url().'checkout/cc_payment/'.$this->_order->id;?>">Lanjut Ke Pembayaran</a>
                                            <?php endif;?>
                                        <?php endif;?></br>
                                        Payment : <?php echo $this->_order->payment_method == 1?"Transfer ATM":"Credit Card";?>
                                    </p>
                                </div>
                                <div class="col-md-offset-4 col-md-4 col-sm-6">
                                    <h4><strong>Buyer Information</strong></h4>
                                    <p>
                                        <?php echo $this->_order->fname.' '.$this->_order->lname;?><br>
                                        <?php echo $this->_order->email;?><br>
                                        <?php echo $this->_order->phone;?></br>
                                        <?php echo $this->_order->address;?><br/><?php echo get_city_name($this->_order->city_id).', '.get_province_name_by_city($this->_order->city_id).' '.$this->_order->postal_code;?></br>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row head-table" style="border-bottom:solid 1px #000;">
                                        <div class="col-sm-1 col-xs-1">#</div>
                                        <div class="col-sm-4 col-xs-4">Product Detail</div>
                                        <div class="col-sm-2 col-xs-2">Qty</div>
                                        <div class="col-sm-4 col-xs-4">Price</div>
                                    </div>
                                    <?php $items = $this->_order->get_detail();?>
                                    <?php $x = 0;?>
                                    <?php $total_price = 0;?>
                                    <?php if(!empty($items)):?>
                                        <?php foreach($items as $item):?>
                                        <?php $x++;?>
                                    <div class="row row-item">
                                        <div class="col-sm-1 col-xs-1 item-col"><?php echo $x;?>.</div>
                                        <div class="col-sm-4 col-xs-4 item-col">
                                            <div class="row">
                                                <div class="col-sm-4 col-xs-12">
                                                    <img src="<?php echo $item->thumb;?>" style="width:100%" />
                                                    <a class="visible-xs" href="<?php echo $item->link;?>"><?php echo $item->product_code;?></a>
                                                </div>
                                                <div class="col-sm-8 hidden-xs" style="font-size:12px;">
                                                    <a href="<?php echo $item->link;?>"><?php echo $item->product_code;?></a>
                                                    <p>
                                                        <?php echo get_cat_str($item->product_id);?> <br />
                                                        <small><?php echo 'Size : '.$item->p.' x '.$item->l.' x '.$item->t.' mm';?></small> <br />
                                                        <?php echo 'Weight : '.$item->weight.' grams';?> <br />
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-xs-2 item-col">
                                            <?php echo $item->qty.' Pcs';?>
                                        </div>
                                        <div class="col-sm-5 col-xs-5 item-col">
                                            <div class="row">
                                                <div class="col-sm-5 hidden-xs">
                                                    <?php echo '@ IDR '.number_format($item->final_price);?>
                                                </div>
                                                <div class="col-sm-7 col-xs-12">
                                                    <?php $price_line = $item->final_price * $item->qty;?>
                                                    <?php echo 'IDR '.number_format($price_line);?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <?php $total_price += $price_line;?>
                                        <?php endforeach;?>
                                    <?php endif;?>

                                </div>
                            </div>  
                            <div class="row foot-table" style="margin-top:25px;">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="row" style="margin-bottom:10px;">
                                        <div class="col-sm-9 col-xs-7">
                                            <strong>Total</strong>
                                        </div>
                                        <div class="total_price col-sm-3 col-xs-5">
                                            <strong><?php echo 'IDR '.number_format($total_price);?></strong>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-bottom:10px;">
                                        <div class="col-sm-9 col-xs-7">
                                            Delivery </strong> <small> (<?php echo $this->_order->address;?>, <?php echo get_city_name($this->_order->city_id);?> <?php echo get_province_name_by_city($this->_order->city_id);?> <?php echo $this->_order->postal_code;?></small>)
                                        </div>
                                        <div class="col-sm-3 col-xs-5">
                                            <strong>IDR <?php echo number_format($this->_order->delivery_cost);?></strong>
                                        </div>
                                    </div>
                                    <?php $assurance = 0;?>
                                    <?php if(!empty($this->_order->assurance)):?>
                                    <?php $assurance = $this->_order->assurance;?>
                                    <div class="row" style="margin-bottom:10px;">
                                        <div class="col-sm-9 col-xs-7">
                                            <strong>Assurance Delivery </strong>
                                        </div>
                                        <div class="assurance col-sm-3 col-xs-5">
                                            <strong>IDR <?php echo number_format($assurance);?></strong>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                    <?php $ext_cc = 0;?>
                                    <?php if(!empty($this->_order->ext_cc)):?>
                                    <?php $ext_cc = $this->_order->ext_cc;?>
                                    <div class="row" style="margin-bottom:10px;">
                                        <div class="col-sm-9 col-xs-7">
                                            <strong>Convenience Fee</strong>
                                        </div>
                                        <div class="ext-cc col-sm-3 col-xs-5">
                                            <strong>IDR <?php echo number_format($ext_cc);?></strong>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                    <div class="row" style="margin-bottom:10px;">
                                        <div class="col-sm-9 col-xs-7">
                                            <strong>Grand Total</strong>
                                        </div>
                                        <div id="grand-total" class="col-sm-3 col-xs-5">
                                            <?php $total_cost = $total_price +  $this->_order->delivery_cost + $assurance + $ext_cc;?>
                                            <strong>IDR <?php echo number_format($total_cost);?></strong>
                                        </div>
                                    </div>

                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>

        </div>
        <?php include('inc/footer.php');?>
        <?php include('inc/load_bottom.php');?>
        <script type="text/javascript">
            function get_option_province(province,selected){
                var data="province="+province;
                var url = base_url+"checkout/get_option_city";
                var success = function(data){
                    if(selected != ''){
                        //alert(selected);
                        $('select#city').html(data.options).delay(500).val(selected);
                    } else {
                        $('select#city').html(data.options);
                    }
                };
                var beforeSend = function(){
                    
                }
                var options = {
                    url:url,
                    data:data,
                    success: success,
                    beforeSend:beforeSend,
                    type:"post",
                    dataType:"json"
                };
                $.ajax(options);
            }

            $(document).ready(function(){
                // var province = $('select#province').val();
                // var selected = $('select#city').data('selected');
                //get_option_province(province,selected);
                $('select#province').change(function(){
                    var province = $(this).val();
                    get_option_province(province,'');

                });

            });
        </script>
    </body>
</html>