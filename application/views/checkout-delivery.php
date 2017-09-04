<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - Checkout Delivery</title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>
        <div class="container content-checkout">       
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="checkout-breadcrump hidden-xs">
                                <hr>
                                <ul>
                                    <li><h5>Sign In <span class="fa fa-angle-double-right"></span></h5></li>
                                    <li class="active"><h5>Delivery</h5></li>
                                    <li><h5>Confirmation <span class="fa fa-angle-double-right"></span></h5></li>
                                    <li><h5>Finish <span class="fa fa-angle-double-right"></span></h5></li>
                                </ul>
                            </div>
                            <div class="checkout-breadcrump visible-xs" style="text-align:center;">
                                <h4>Checkout  <span class="fa fa-angle-double-right"></span> Delivery </h4>
                            </div>
                        </div>
                    </div>
                    <form id="form-order-delivery" data-toggle="validator" role="form" class="account-form" method="post" action="<?php echo base_url();?>checkout/delivery_post/">
                        <div class="row">
                            <?php 
                                $abs = array();
                                $class_div = '';
                                if(!empty($this->_customer_id)){
                                    $abs = $this->_customer->get_address_book();
                                }
                            ?>
                            <?php if(!empty($abs)):?>
                            <div class="col-xs-12 col-md-offset-1 col-md-4" style="margin-top:35px;">
                                <h4>This order will deliver to : </h4>
                                <?php foreach($abs as $ab):?>
                                <div class="row row-address-book">
                                    <div class="col-sm-12 wrap-address-book">
                                        <div class="radio">
                                            <input id="ab-<?php echo $ab->id;?>" type="radio" name="ab_id" value="<?php echo $ab->id;?>"  class="radio_dev" <?php echo $ab->is_default==1?'checked="checked"':'';?>> 
                                            <label for="ab-<?php echo $ab->id;?>" style="margin-left:10px;margin-top:-20px;">
                                              
                                              <?php echo $ab->address;?>, <?php echo get_city_name($ab->city_id);?> <?php echo get_province_name_by_city($ab->city_id);?> <?php echo $ab->postal_code;?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach;?>
                                <hr class="visible-xs">
                                <div class="or visible-xs">
                                    <h4 class="visible-xs">OR</h4>
                                </div>
                            </div>
                            <?php endif;?>

                            
                            <?php if(!empty($abs)):?>
                            <?php $display = 'style="display:none;"';?>
                            <div class="col-xs-12 col-md-offset-2 col-md-4" style="margin-top:35px;">
                                <h4>Or deliver to new address</h4>
                                <div class="radio">
                                    <input id="ab-new" type="radio" class="radio_dev" name="ab_id" value="new"> 
                                    <label for="ab-new">
                                      Deliver to new address
                                    </label>
                                </div>
                            <?php else:?>
                            <?php $display = '';?>
                                <div class="col-xs-12 col-md-offset-4 col-md-4" style="margin-top:35px;">
                                    <h4>This order will be delivered to :</h4>
                                <input type="hidden" name="ab_id" value="new">
                            <?php endif;?>
                                <div class="wrap-new-address" <?php echo $display;?>>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Provinsi</label>
                                        <select id="province" name="province" class="form-control">
                                            <option value="0">Pilih Provinsi...</option>
                                            <?php echo get_option('province');?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Kota / Kabupaten</label>
                                        <select id="city" name="city" class="form-control">
                                            <option value="0">Pilih Kota / Kabupaten...</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kecamatan</label>
                                        <select id="kecamatan_id" name="kecamatan_id" class="form-control">
                                            <option value="0">Pilih Kecamatan...</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address</label>
                                        <textarea name="address" class="form-control" rows="5" placeholder="alamat"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Postal Code</label>
                                        <input name="postal_code" type="text" class="form-control"  placeholder="Postal Code">
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                        <div class="row" style="margin-top:25px;">
                            <div class="col-sm-12">
                                <?php if(!empty($this->_customer_id)):?>
                                <a href="<?php echo base_url();?>cart" class="btn btn-default" style="float:left;"><span class="fa fa-angle-double-left"></span> Back to cart</a>
                                <?php else :?>
                                <a href="<?php echo base_url();?>checkout/account" class="btn btn-default" style="float:left;"><span class="fa fa-angle-double-left"></span> Previous Step</a>
                                <?php endif;?>
                                <button id="next_to_order" type="submit" class="btn btn-default" style="float:right;">Order Confirmation  <span class="fa fa-angle-double-right"></span></button>
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

            function get_option_kecamatan(city_id,selected){
                var data="city_id="+city_id;
                var url = base_url+"checkout/get_option_kecamatan";
                var success = function(data){
                    if(selected != ''){
                        //alert(selected);
                        $('select#kecamatan_id').html(data.options).delay(500).val(selected);
                    } else {
                        $('select#kecamatan_id').html(data.options);
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
                var province = $('select#province').val();
                var selected = $('select#city').data('selected');
                get_option_province(province,selected);
                $('select#province').change(function(){
                    var province = $(this).val();
                    get_option_province(province,'');

                });

                $('select#city').change(function(){
                    var city = $(this).val();
                    get_option_kecamatan(city,'');

                });

                $('.radio_dev').on('ifChanged', function(event){
                    var val = $(this).val();
                    if(val == "new"){
                        $('.wrap-new-address').css('display','');
                    } else {
                        $('.wrap-new-address').css('display','none');
                    }
                });

                $('button#next_to_order').click(function(e){
                    e.preventDefault();
                    var len_ab_checked = $('.wrap-address-book').find('.radio').find('.checked').length;
                    console.log(len_ab_checked);
                    if(len_ab_checked == 0) {
                        var province = $('select#province').val();
                        var city = $('select#city').val();
                        var kec = $('select#kecamatan_id').val();
                        var address = $('textarea[name="address"]').val();

                        if(province!= 0 && city!= 0 && kec!= 0 && address !=''){
                            $('#form-order-delivery').submit();
                        } else {
                            alert("Semua data alamat harus disi")
                        }
                    } else {
                        $('#form-order-delivery').submit();
                    }
                    
                    
                });

            });
        </script>
    </body>
</html>