
<?php //die($this->_preorder['city_id'].'----------------------------');?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - Checkout Confirmation</title>
        <?php include('inc/load_top.php');?>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <style>
     #map {
        width: 100%;
        height: 400px;
     }
	 .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
      #target {
        width: 345px;
      }
	  .img-caption{
		  width: 70px;
		  border-radius: 20px;
		  margin-top: -3px;
	  }
	  .rgojek-caption{
		  padding: 2px 4px;
		  float: right;
	  }
    </style>
    <script>

      /*function initialize() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 2,
          center: new google.maps.LatLng(2.8,-187.3),
          mapTypeId: 'terrain'
        });

        // Create a <script> tag and set the USGS URL as the source.
        var script = document.createElement('script');
        // (In this example we use a locally stored copy instead.)
        // script.src = 'http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_week.geojsonp';
        script.src = 'https://developers.google.com/maps/documentation/javascript/tutorials/js/earthquake_GeoJSONP.js';
        document.getElementsByTagName('head')[0].appendChild(script);
      }

      // Loop through the results array and place a marker for each
      // set of coordinates.
      window.eqfeed_callback = function(results) {
        for (var i = 0; i < results.features.length; i++) {
          var coords = results.features[i].geometry.coordinates;
          var latLng = new google.maps.LatLng(coords[1],coords[0]);
          var marker = new google.maps.Marker({
            position: latLng,
            map: map
          });
        }
      }*/
    </script>
    </head>
    <body class="home">
        <?php include('inc/header.php'); 
		$latlngofice=empty($_POST['latlong'])?"-6.130169,106.653339":$_POST['latlong'];
		?>
        <div class="container content-checkout">       
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="checkout-breadcrump  hidden-xs">
                                <hr>
                                <ul>
                                    <li><h5>Sign In <span class="fa fa-angle-double-right"></span></h5></li>
                                    <li><h5>Delivery <span class="fa fa-angle-double-right"></span></h5></li>
                                    <li class="active"><h5>Confirmation</h5></li>
                                    <li><h5>Finish <span class="fa fa-angle-double-right"></span></h5></li>
                                </ul>
                            </div>
                            <div class="checkout-breadcrump visible-xs" style="text-align:center;">
                                <h4>Checkout  <span class="fa fa-angle-double-right"></span> Confirmation </h4>
                            </div>
                        </div>
                    </div>
                    <form id="form-order-confirmation" data-toggle="validator" role="form" class="account-form" method="post" action="<?php echo base_url();?>checkout/confirmation_post/">
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
                                                            <?php echo 'Size : '.$p.' x '.$l.' x '.$t.' cm';?><br />
                                                            <?php echo 'Weight : '.$weight.' kgs';?> <br />
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
                                                        <?php echo '@'.$item->price_format;?>
                                                    </div>
                                                    <div class="col-sm-7 col-xs-12">
                                                        <?php echo $item->price_line_format;?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endforeach;?>
                                <?php endif;?>
                                <div class="row foot-table">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-sm-9 col-xs-7">
                                                <strong>Total</strong>
                                            </div>
                                            <div class="total_price col-sm-3 col-xs-5">
                                                <strong><?php echo $this->mod_cart->total_price_format;?></strong>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-9 col-xs-7">
                                                <?php if(isset($this->_ab)):?>
                                                    <?php $city_id = $this->_ab->city_id;
													$citynameval=get_city_name($this->_ab->city_id);
													$statusgojek=get_gojekstatus($this->_ab->kecamatan_id);
													?>
                                                    <strong>Delivery </strong> (<?php echo $this->_ab->address;?>, 
                                                    Kec. <?php echo get_kecamatan_name($this->_ab->kecamatan_id);?>,  
                                                    <?php echo get_city_name($this->_ab->city_id);?> 
                                                    <?php echo get_province_name_by_city($this->_ab->city_id);?> 
                                                    <?php echo $this->_ab->postal_code;?>)
                                                <?php else:?>
                                                    <?php //$city_id = $preorder['city_id'];?>
                                                    <?php //die(print_r($preorder['address']));?>
                                                <?php //die($city_id."----------------------rererere");
												$citynameval=get_city_name($preorder['city_id']);
												$statusgojek=get_gojekstatus($preorder['kecamatan_id']);
												?>
                                                    <strong>Delivery </strong> (<?php echo $preorder['address'];?>, Kec. <?php echo get_kecamatan_name($preorder['kecamatan_id']);?>, <?php echo $citynameval;?> <?php echo get_province_name_by_city($preorder['city_id']);?> <?php echo $preorder['postal_code'];?>)
                                                <?php endif;?>
                                                <?php 
                                                    //$costs = get_courier($city_id,($this->mod_cart->total_weight * 10));
                                                    $sc = 0;
                                                    if(!empty($this->costs)){
                                                        $x = 0;
                                                        foreach($this->costs as $cost){
                                                            $price = $cost->cost[0];
                                                            if($x == 0){
                                                                $sc = $price->value;
                                                            }
                                                ?>
                                                    <div class="radio">
                                                        <?php $price = $cost->cost[0];?>
                                                        <input class="radio-courier" id="jne-<?php echo $cost->service;?>" type="radio" name="courier" data-value="<?php echo $price->value;?>" value="JNE <?php echo $cost->service;?>|<?php echo $price->value;?>" <?php echo $x==0?'checked="checked"':'';?>> 
                                                        <label for="jne-<?php echo $cost->service;?>" style="margin-left:10px;margin-top:-20px;">
                                                            <?php echo "JNE ".$cost->service;?> IDR <?php echo number_format($price->value);?> (<?php echo $price->etd;?> Hari)
                                                        </label>
                                                    </div>

                                                <?php
                                                            $x++;
                                                        }
                                                    }
                                                ?>
												<!-- Radio Gojek -->
                                                <?php 
												// $citynamevalcek=explode(" ",trim($citynameval));
												// $arrjabodetabek=array("Jakarta","Tangerang","Bogor","Depok","Bekasi");
												if($statusgojek=="1"){
												// if(in_array($citynamevalcek[0],$arrjabodetabek)){
													?>
                                                <div class="radio">
                                                   <input class="radio-courier" id="GOJEK" type="radio" name="courier" data-value="0" value="GOJEK|0" />
												   <input type="hidden" id="latlong" name="latlong" value="<?php echo $latlngofice; ?>" />
                                                   <label for="GOJEK" style="margin-left:10px;margin-top:-20px;">
												   <img src="<?php echo base_url()."assets/img/gojek-caption.jpg"; ?>" class="img-caption" /><span class="rgojek-caption" >
                                                   <?php //echo "GOJEK";?> Borne By Orderer </span><span id="gojekaddr" ></span>
                                                   </label>
                                                </div>
												<?php } ?>
                                            </div>
                                            <div id="del_cost" class="col-sm-3 col-xs-5">
                                                <?php //$sc = get_shipping_cost($city_id) * round($this->mod_cart->total_weight);?>
                                                <strong>IDR <?php echo number_format($sc);?></strong>
                                            </div>
                                        </div>
                                        <div class="row" id="rowasurance" >
                                            <?php $val_assurance = floor(($this->mod_cart->total_price/500000)) * 1000 + 8000;?>
                                            <div class="col-sm-9 col-xs-7" >
                                                <div class="checkbox" id="checkboxansuran" >
                                                    <input id="assurance" name="assurance" data-value="<?php echo $val_assurance;?>" type="checkbox" value="1"> 
                                                    <label for="assurance">Delivery Assurance (IDR <?php echo number_format($val_assurance);?>)</label>
                                                </div>
                                            </div>
                                            <div class="assurance col-sm-3 col-xs-5">
                                                <strong>IDR 0</strong>
                                            </div>
                                        </div>
                                        <div id="ext_cc" class="row" style="display:none;">
                                            <?php $val_ext_cc = (3.2 * $this->mod_cart->total_price /100) + 2500;?>
                                            <div class="col-sm-9 col-xs-7">
                                                <strong>Convenience Fee</strong>
                                            </div>
                                            <div id="ext_cc_c" class="col-sm-3 col-xs-5">
                                                <strong>IDR <?php echo number_format($val_ext_cc);?></strong>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-9 col-xs-7">
                                                <strong>Grand Total</strong>
                                            </div>
                                            <div id="grand-total" class="col-sm-3 col-xs-5">
                                                <?php $total = $this->mod_cart->total_price + $sc;?>
                                                <strong>IDR <?php echo number_format($total);?></strong>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-9 col-xs-6">
                                                <strong>Payment With</strong>
                                            </div>
                                            <div class="col-sm-3 col-xs-6">
                                                <div class="form-group">
                                                    <select id="sel_payment" name="payment" class="form-control">
                                                        <option value="1">Bank Transfer</option>
                                                        <option value="2">Credit Card </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                        <div class="row" style="margin-top:25px;">
                            <div class="col-sm-12 clearfix">
                                <a href="<?php echo base_url();?>checkout/delivery/" class="btn btn-default" style="float:left"><span class="fa fa-angle-double-left"></span> Previous Step</a>
                                <button type="submit" class="btn btn-default" style="float:right">Place Order  <span class="fa fa-angle-double-right"></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>     
        </div>
        <div id="modal-added-cart" class="modal fade" data-backdrop="static" data-keyboard="false">
            <div class="modal-maps modal-dialog">
                <div class="modal-content-maps">
                    <div class="modal-header">
                        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                        <h4 class="modal-title">Chose Your Address</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row" id="rowsmaps">
							<input id="pac-input" class="controls" type="text" placeholder="Search Box">
							<div id="map"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-shopping" onclick="okgojek();" >OK</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
            
        </div><!-- /.modal -->
        <?php include('inc/footer.php');?>
        <?php include('inc/load_bottom.php');?>
        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery.scrollTo.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/numeral.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery.elevatezoom-3.0.8.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
        <script type="text/javascript">
                var total_price = <?php echo $this->mod_cart->total_price;?>;
                var assurance = 0;
                var del_cost = <?php echo $sc;?>;
                var ext_cc = <?php echo $val_ext_cc;?>;
                var ext_cc_u = 0;

                function get_ext_cc(){
                    var pm = $('#sel_payment').val();
                    if(pm == 1){
                        ext_cc_u = 0;
                    } else {
                        ext_cc_u = (total_price + del_cost + assurance) * 3.2 / 100 + 2500;
                    }
                    return ext_cc_u;
                }


            $(document).ready(function(){

                $('#assurance').on('ifChecked', function(event){
                    var val = parseInt($(this).attr('data-value'));
                    assurance = val;
                    var gt = total_price + del_cost + val+ ext_cc_u;
                    var val_format = numeral(val).format('0,0');
                    var gt_format = numeral(gt).format('0,0');
                    //ext_cc_u = (total_price + del_cost + assurance) * 3.2 / 100 + 2500;
                    ext_cc_u = get_ext_cc();
                    var ext_cc_u_format = numeral(ext_cc_u).format('0,0');
                    $('.assurance').html('<strong> IDR '+val_format+'</strong>');
                    $('#grand-total').html('<strong> IDR '+gt_format+'</strong>');
                    $('#ext_cc_c').html('<strong> IDR '+ext_cc_u_format+'</strong>');
                });

                $('#assurance').on('ifUnchecked', function(event){
                    var val = 0;
                    assurance = val;
                    var gt = total_price + del_cost + val + ext_cc_u;
                    var val_format = numeral(val).format('0,0');
                    var gt_format = numeral(gt).format('0,0');
                    //ext_cc_u = (total_price + del_cost + assurance) * 3.2 / 100 + 2500;
                    ext_cc_u = get_ext_cc();
                    var ext_cc_u_format = numeral(ext_cc_u).format('0,0');
                    $('.assurance').html('<strong> IDR '+val_format+'</strong>');
                    $('#grand-total').html('<strong> IDR '+gt_format+'</strong>');
                    $('#ext_cc_c').html('<strong> IDR '+ext_cc_u_format+'</strong>');
                });

                $('#sel_payment').change(function(){
                    var val = $(this).val();
                    if(val == 1){
                        ext_cc_u = 0;
                        $('#ext_cc').css('display','none');
                        var gt = total_price + del_cost + assurance + ext_cc_u;
                    } else {
                        ext_cc_u = (total_price + del_cost + assurance) * 3.2 / 100 + 2500;
                        var gt = total_price + del_cost + assurance + ext_cc_u;
                        var ext_cc_u_format = numeral(ext_cc_u).format('0,0');
                        $('#ext_cc').css('display','');
                        $('#ext_cc_c').html('<strong> IDR '+ext_cc_u_format+'</strong>');
                    }
                    var gt_format = numeral(gt).format('0,0');
                    $('#grand-total').html('<strong> IDR '+gt_format+'</strong>');
                });
                $('.radio-courier').on('ifChecked', function(event){
					if($(this).attr("id") == "GOJEK"){
						// $('#checkboxansuran .icheckbox_minimal-grey').attr('aria-checked', 'false');
						document.getElementById("assurance").checked = false;
						$("#rowasurance").slideUp();
						assurance = 0;
						var val = parseInt($(this).attr('data-value'));
						//alert(val);
						del_cost = val;
						del_cost_format = numeral(del_cost).format('0,0');
						var gt = total_price + val + assurance + ext_cc_u;
						//ext_cc_u = (total_price + del_cost + assurance) * 3.2 / 100 + 2500;
						ext_cc_u = get_ext_cc();
						var ext_cc_u_format = numeral(ext_cc_u).format('0,0');
						$('#ext_cc_c').html('<strong> IDR '+ext_cc_u_format+'</strong>');
						var gt_format = numeral(gt).format('0,0');
						// $('#del_cost').html('<strong> IDR '+del_cost_format+'</strong>');
                        $('#del_cost').html('<strong> Bayar ditempat tujuan</strong>');
						$('#grand-total').html('<strong> IDR '+gt_format+'</strong>');
                        $('#modal-added-cart').modal('show');
                        $(window).scrollTo('#wrap-navbar',400);
						$( "#map" ).remove();
						$( "#pac-input" ).remove();
						setTimeout(function(){
							$("#rowsmaps").append('<input id="pac-input" class="controls" type="text" placeholder="Search Box"><div id="map" style="width: 100%;height: 400px;" ></div>');
							initAutocomplete("<?php echo $latlngofice; ?>");
						}, 2000);
					}else{
						$("#rowasurance").slideDown();
						if($('#checkboxansuran .icheckbox_minimal-grey').attr('aria-checked') != "false"){
							document.getElementById("assurance").checked = true;
							assurance = parseInt($("#assurance").attr('data-value'));
						}
						var val = parseInt($(this).attr('data-value'));
						//alert(val);
						del_cost = val;
						del_cost_format = numeral(del_cost).format('0,0');
						var gt = total_price + val + assurance + ext_cc_u;
						//ext_cc_u = (total_price + del_cost + assurance) * 3.2 / 100 + 2500;
						ext_cc_u = get_ext_cc();
						var ext_cc_u_format = numeral(ext_cc_u).format('0,0');
						$('#ext_cc_c').html('<strong> IDR '+ext_cc_u_format+'</strong>');
						var gt_format = numeral(gt).format('0,0');
						$('#del_cost').html('<strong> IDR '+del_cost_format+'</strong>');
						$('#grand-total').html('<strong> IDR '+gt_format+'</strong>');
					}
                });
			// function initialize(latLng) {
				// latLng = latLng.split(",")
				// var mapOptions = {
					// center: new google.maps.LatLng(latLng[0],latLng[1]),
					// zoom: 8
				// };
				// var map = new google.maps.Map(document.getElementById("map"), mapOptions);
			// }
				var checkradioValue = $("input[name='courier']:checked").attr("id");
				if(checkradioValue=="GOJEK"){
					$('#modal-added-cart').modal('show');
					$(window).scrollTo('#wrap-navbar',400);
					initAutocomplete("<?php echo $latlngofice; ?>");
				}

                // $('input#GOJEK').click(function(){})

                $('#modal-added-cart').find('button').click(function(e){
                    e.preventDefault();
                    $('#modal-added-cart').modal('hide');
                });
            });
			
		var map;
		var latlngloc;
		var marker;
		function okgojek(){
			var inputadrgojek = $("#latlong").val();
			if(inputadrgojek=="-6.130169,106.653339" || inputadrgojek==""){
				alert("Chose Your Address!");
				return false;
			}else{
				 $('#modal-added-cart').modal('hide');
			}
		}
		function placeMarker(location) {
			if(marker) {
				marker.setPosition(location);
				var latlngStr = $("#latlong").val();
				latlngStr=latlngStr.replace(/ /g,"");
				latlngStr=latlngStr.replace("(","");
				latlngStr=latlngStr.replace(")","");
				// latlngStr=parseFloat(latlngStr);
				url="http://maps.googleapis.com/maps/api/geocode/json?latlng="+latlngStr+"&sensor=true";
				$.post(url,function( data ) {
					if(data.status=="OK"){
						var yaddr=data.results[0].formatted_address;
						alert("Your Address "+yaddr);
						$("#gojekaddr").val("("+yaddr+")");
					}else{
						alert("Address Not Found");
					}
				}, "json");
			}else{
				marker = new google.maps.Marker({
					position: location,
					map: map
				});
				var latlngStr = $("#latlong").val();
				latlngStr=latlngStr.replace(/ /g,"");
				latlngStr=latlngStr.replace("(","");
				latlngStr=latlngStr.replace(")","");
				// latlngStr=parseFloat(latlngStr);
				url="http://maps.googleapis.com/maps/api/geocode/json?latlng="+latlngStr+"&sensor=true";
				$.post(url,function( data ) {
					if(data.status=="OK"){
						var yaddr=data.results[0].formatted_address;
						alert("Your Address "+yaddr);
						$("#gojekaddr").val("("+yaddr+")");
					}else{
						alert("Address Not Found");
					}
				}, "json");
			}
		}
		function initAutocomplete(longlatoldoldold) {
			latLangLangLong = "<?php echo $latlngofice; ?>";
			latLangLangLong = latLangLangLong.split(",");
			var latlanglang = parseFloat(latLangLangLong[0]);
			var latlanglong = parseFloat(latLangLangLong[1]);
			// var map;
			var mapOptions = {
				center: new google.maps.LatLng(latlanglang,latlanglong), //assign Seprately
				zoom: 12
			};
			map = new google.maps.Map(document.getElementById("map"), mapOptions);
			var layer = new google.maps.FusionTablesLayer({
			  query: {
				select: 'Location',
				from: '1NIVOZxrr-uoXhpWSQH2YJzY5aWhkRZW0bWhfZw'
			  },
			  map: map
			});
			google.maps.event.trigger(map, 'resize');
			marker = new google.maps.Marker({
				position: <?php echo "(".$latlngofice.")"; ?>,
				map: map
			});
			google.maps.event.addListener(map, "click", function (e) {
				positionfirst = e.latLng;
				$("#latlong").val(e.latLng);
				// var marker;
				// marker = new google.maps.Marker({
					// position: positionfirst,
					// map: map
				// });
				placeMarker(e.latLng);
			});
			// Create the search box and link it to the UI element.
			var input = document.getElementById('pac-input');
			var searchBox = new google.maps.places.SearchBox(input);
			map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
			// Bias the SearchBox results towards current map's viewport.
			map.addListener('bounds_changed', function() {
				searchBox.setBounds(map.getBounds());
			});
			var markers = [];
			// Listen for the event fired when the user selects a prediction and retrieve
			// more details for that place.
			searchBox.addListener('places_changed', function() {
			var places = searchBox.getPlaces();

			if (places.length == 0) {
				return;
			}

			// Clear out the old markers.
			markers.forEach(function(marker) {
				marker.setMap(null);
			});
			markers = [];
	
			// For each place, get the icon, name and location.
			var bounds = new google.maps.LatLngBounds();
			places.forEach(function(place) {
				if (!place.geometry) {
					console.log("Returned place contains no geometry");
					return;
				}
				var icon = {
					url: place.icon,
					size: new google.maps.Size(71, 71),
					origin: new google.maps.Point(0, 0),
					anchor: new google.maps.Point(17, 34),
					scaledSize: new google.maps.Size(25, 25)
				};

				// Create a marker for each place.
				markers.push(new google.maps.Marker({
					map: map,
					icon: icon,
					title: place.name,
					position: place.geometry.location
				}));

				if (place.geometry.viewport) {
				// Only geocodes have viewport.
					bounds.union(place.geometry.viewport);
				} else {
					bounds.extend(place.geometry.location);
				}
			});
			map.fitBounds(bounds);
			});
		}
		// google.maps.event.addDomListener(window, 'load', initAutocomplete);
				// alert(latLang);
        </script><script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAEPYxjyK64PFxLA9V55M3paCNYavTCC-s&libraries=geometr‌​y,places&callback=initAutocomplete" async defer>
		</script>
    </body>
</html>