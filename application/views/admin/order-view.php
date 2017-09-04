<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo $page_name;?></title>
		<?php include('inc/load_top.php');?>
		<style type="text/css">
            .table td{
                vertical-align: top !important;
                font-size: 14px;
            }
            .table td ul{
                padding-left: 0px;
            }
            .table td ul li{
                list-style : none;
            }

            table.payment td {
                font-size: 14px !important;
            }
        </style>
	</head>
	<body class="skin-blue">
		<div class="wrapper">
			<!-- header. contains the top menu-->
			<?php include('inc/header.php');?>
			<!-- Left side column. contains the logo and sidebar -->
			<?php include('inc/sidebar.php');?>

			<!-- Content Wrapper. Contains page content -->
		  	<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header" style="padding:15px 30px;">
				 	  <h1>Order Review</h1>
				  	<ol class="breadcrumb">
						<li class="active"><i class="fa fa-dashboard"></i>&nbsp; <?php echo $page_name;?></li>
				  	</ol>
				</section>

        				<!-- Main content -->
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-newspaper-o"></i> Order No. <?php echo $this->_order->get_no_order();?>
                                <small class="pull-right"><?php echo date('l, d/m/Y H:i',$this->_order->cdate);?></small>
                            </h2>
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <b>Buyer Info</b>
                            <section>
                                <strong><?php echo $this->_order->fname.' '.$this->_order->lname;?></strong><br>
                                <?php echo $this->_order->email;?><br>
                                <?php echo 'Phone : '.$this->_order->phone;?><br>
                            </section>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Delivery Info</b>
                          <address>
                            <?php echo $this->_order->address;?><br>
                            <?php echo get_city_name($this->_order->city_id).' '.get_province_name_by_city($this->_order->city_id).' '.$this->_order->postal_code;?>
                          </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Order Info</b>
                            <br/>
                            <b>Order No : </b> <?php echo $this->_order->get_no_order();?><br/>
                            <b>Order date : </b> <?php echo date('l, d/m/Y H:i',$this->_order->cdate);?><br/>
                            <b>Order Status : </b> <label class="label label-default"><?php echo get_status_order($this->_order->status);?></label>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                  <!-- Table row -->
                  <div class="row" style="margin-top:25px;">
                    <div class="col-xs-12 table-responsive">
                      <table class="table">
                        <thead>
                            <tr>
                                <th style="width:5%;"><h5>#</h5></th>
                                <th  style="width:50%;" colspan="2"><h5>Product Detail</h5></th>
                                <th style="width:5%;"><h5>Qty</h5></th>
                                <th style="width:20%;"><h5>Price</h5></th>
                                <th style="width:15%;"><h5>Total</h5></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $items = $this->_order->get_detail();?>
                            <?php if(!empty($items)):?>
                                <?php $x = 0;?>
                                <?php $total_price = 0;?>
                                <?php foreach($items as $item):?>
                                <?php $x++;?>
                                <tr>
                                    <td style="width:5%;"><?php echo $x;?>.</td>
                                    <td width="15%"><img src="<?php echo $item->thumb;?>" style="width:75px;" /></td>
                                    <td>
                                        <a href="<?php echo $item->link;?>"><?php echo $item->product_code;?></a>
                                        <p>
                                            <?php echo $item->category;?> <br />
                                            <?php echo 'Size : '.$item->p.' x '.$item->l.' x '.$item->t.' mm';?> <br />
                                            <?php echo 'Weight : '.$item->weight.' grams';?> <br />
                                        </p>
                                    </td>
                                    <td style="width:10%;"><?php echo $item->qty.' Pcs';?></td>
                                    <td style="width:15%;"><?php echo '@ IDR '.number_format($item->final_price);?></td>
                                    <?php $price_line = $item->final_price * $item->qty;?>
                                    <td style="width:15%;"><?php echo 'IDR '.number_format($price_line);?></td>

                                </tr>
                                <?php endforeach;?>
                            <?php endif;?>

                        </tbody>
                      </table>
                    </div><!-- /.col -->
                  </div><!-- /.row -->

                  <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <p class="lead"><strong>Amount Total</strong></p>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td style="padding:8px !important;"><?php echo 'IDR '.number_format($this->_order->total_price);?></td>
                                </tr>

                                <tr>
                                    <th>Shipping:</th>
									<?php 
									$orderdelcost=$this->_order->delivery_cost;
									if($this->_order->courier=="GOJEK"){
										$orderdelcost=$this->_order->bk_gojek;
									} ?>
                                    <td style="padding:8px !important;"><?php echo 'IDR '.number_format($orderdelcost);?></td>
                                </tr>
                                <?php if(!empty($this->_order->assurance)):?>
                                <tr>
                                    <th>Assurance : </th>
                                    <td style="padding:8px !important;"><?php echo 'IDR '.number_format($this->_order->assurance);?></td>
                                </tr>
                                <?php endif;?>
                                <?php if(!empty($this->_order->ext_cc)):?>
                                <tr>
                                    <th>Convenience Fee : </th>
                                    <td style="padding:8px !important;"><?php echo 'IDR '.number_format($this->_order->ext_cc);?></td>
                                </tr>
                                <?php endif;?>
                                <tr>
                                    <th>Total:</th>
									<?php 
									$orderdelcosttotal=$this->_order->total_cost;
									if($this->_order->courier=="GOJEK"){
										$orderdelcosttotal=(($this->_order->total_cost)+($this->_order->bk_gojek));
									} ?>
                                    <td style="padding:8px !important;"><b><?php echo 'IDR '.number_format($orderdelcosttotal);?></b></td>
                                </tr>
							<?php
							if(!empty($this->_order->latlong)){ 
							$latlong=str_replace(" ","",$this->_order->latlong);
							$latlong=str_replace("(","",$latlong);
							$latlong=str_replace(")","",$latlong);
							?>
								<tr><td colspan="4">
									<img src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo $latlong; ?>&zoom=13&size=500x300&maptype=roadmap&markers=color:red%7Clabel:A%7C<?php echo $latlong; ?>&key=AIzaSyC3Q3qyaJlH6Hyaib-nkXL3BEmm48MPtuk" /><br/>
									<a href="http://maps.google.com/?q=<?php echo $latlong; ?>" target="_blank"  >Click Here To Google Maps</a>
								</td></tr>
							<?php } ?>
                            </table>
                        </div>
                    </div><!-- /.col -->
                    <!-- accepted payments column -->
                    <div class="col-xs-12 col-sm-6">
                        <p class="lead"><strong>Payment Information</strong></p>
                        <?php if($this->_order->payment_method == 1):?>
                        <table class="payment" style="font-size:12px;">
                            <tr>
                                <td style="padding:8px !important;vertical-align:top !important">Method</td>
                                <td style="padding:8px !important;vertical-align:top !important">:</td>
                                <td style="padding:8px !important;vertical-align:top !important">Transfer ATM</td>
                            </tr>
                            <?php $payment = $this->_order->get_payment();?>
                            <?php if($payment !== false):?>
                            <tr>
                                <td style="padding:8px !important;vertical-align:top !important">Data Akun</td>
                                <td style="padding:8px !important;vertical-align:top !important">:</td>
                                <td style="padding:8px !important;vertical-align:top !important">Bank <?php echo $payment->bank_name;?> - <?php echo $payment->acc_no;?><br/> <?php echo $payment->acc_name;?></td>
                            </tr>
                            <tr>
                                <td style="padding:8px !important;vertical-align:top !important">Tanggal</td>
                                <td style="padding:8px !important;vertical-align:top !important">:</td>
                                <td style="padding:8px !important;vertical-align:top !important"><?php echo date('d F Y H:i',$payment->date);?> </td>
                            </tr>
                            <tr>
                                <td style="padding:8px !important;vertical-align:top !important">Transfer Ke</td>
                                <td style="padding:8px !important;vertical-align:top !important">:</td>
                                <td style="padding:8px !important;vertical-align:top !important"><?php echo get_transfer_to($payment->transfer_to);?> </td>
                            </tr>

                            <tr>
                                <td style="padding:8px !important;vertical-align:top !important">Jumlah</td>
                                <td style="padding:8px !important;vertical-align:top !important">:</td>
                                <td style="padding:8px !important;vertical-align:top !important"><?php echo 'IDR '.number_format($payment->amount);?> </td>
                            </tr>
                            <?php endif;?>
                        </table>
                        <?php else : ?>
                            <table>
                                <tr>
                                    <td style="padding:8px !important;vertical-align:top !important">Method</td>
                                    <td style="padding:8px !important;vertical-align:top !important">:</td>
                                    <td style="padding:8px !important;vertical-align:top !important">Credit Card</td>
                                </tr>
                            </table>
                        <?php endif;?>
                        <p class="lead" style="margin-top:35px;"><strong>Update Status Order</strong></p>
                        <form action="<?php echo $root_path;?>order/updater/" class="form-horizontal" method="post" style="padding:0px 50px 10px 15px;">
                            <input type="hidden" name="id" value="<?php echo $this->_order->id;?>">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <?php echo get_option_status_order($this->_order->status);?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>No Order GOJEK</label>
                                <input name="no_gojek" class="form-control" placeholder="No Order GOJEK" value="<?php echo $this->_order->no_gojek;?>" >
                            </div>
                            <div class="form-group">
                                <label>Biaya Kirim GOJEK</label>
                                <input type="number" name="bk_gojek" style="width: 25%;" class="form-control" value="<?php echo $this->_order->bk_gojek;?>" >
                            </div>
                            <div class="form-group">
                                <label>Informasi Order</label>
                                <textarea name="info" class="form-control" placeholder="Informasi Order"><?php echo $this->_order->info;?></textarea>
                            </div>
                            <div class="form-group">
                                <label>No. Resi </label>
                                <input name="no_resi" type="text" class="form-control" placeholder="No. Resi" value="<?php echo $this->_order->track_no;?>">
                            </div>
                            <div class="form-group">
                                <button style="margin-left:0px;" type="submit" class="btn btn-default">Update</button>
                                <a target="_blank" href="<?php echo $root_path;?>order/address/<?php echo $this->_order->id;?>" style="margin-left:15px;" type="submit" class="btn btn-info"><span class="fa fa-print"></span> Print address</a>
                            </div>
                            
                        </form>
                    </div><!-- /.col -->
                    
                  </div><!-- /.row -->

                  <!-- this row will not appear when printing -->
<!--                   <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                            <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                        </div>
                  </div> -->
                </section><!-- /.content -->
		  	</div><!-- /.content-wrapper -->


		  	<div id="modal-conf-delete" class="modal fade">
				<div class="modal-dialog">
				  	<div class="modal-content">
						<div class="modal-header">
						  	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  	<h4 class="modal-title">Delete Confirmation</h4>
						</div>
						<div class="modal-body">
						  	<p>Are you sure to delete this data?</p>
						</div>
						<div class="modal-footer">
						  	<button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
						  	<a href="#" class="btn btn-flat btn-danger btn-cdel">Delete</a>
						</div>
				  	</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		  	<?php include('inc/footer.php');?>
		</div><!-- ./wrapper -->
	<?php include('inc/load_bottom.php');?>
	<script type="text/javascript">
		$(document).ready(function(){
			$('body').on('click','.btn-del',function(e){
				e.preventDefault();
                var url = $(this).attr('data-url');
                $('.btn-cdel').attr('href',url);
                $('#modal-conf-delete').modal('show');
            });
		});

	</script>
	</body>
</html>
