<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo get_meta('page_prefix');?> - Order View</title>
		<?php include('inc/load_top.php');?>
		<style type="text/css">
			.datatable td{
				vertical-align: top !important;
				font-size: 14px;
			}
			.datatable td ul{
				padding-left: 0px;
			}
			.datatable td ul li{
				list-style : none;
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
				<section class="content-header">
				 	<h1 style="margin-left:25px;">HI<?php echo $page_caption;?></h1>
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
		                <i class="fa fa-globe"></i> AdminLTE, Inc.
		                <small class="pull-right">Date: 2/10/2014</small>
		              </h2>
		            </div><!-- /.col -->
		          </div>
		          <!-- info row -->
		          <div class="row invoice-info">
		            <div class="col-sm-4 invoice-col">
		              From
		              <address>
		                <strong>Admin, Inc.</strong><br>
		                795 Folsom Ave, Suite 600<br>
		                San Francisco, CA 94107<br>
		                Phone: (804) 123-5432<br/>
		                Email: info@almasaeedstudio.com
		              </address>
		            </div><!-- /.col -->
		            <div class="col-sm-4 invoice-col">
		              To
		              <address>
		                <strong>John Doe</strong><br>
		                795 Folsom Ave, Suite 600<br>
		                San Francisco, CA 94107<br>
		                Phone: (555) 539-1037<br/>
		                Email: john.doe@example.com
		              </address>
		            </div><!-- /.col -->
		            <div class="col-sm-4 invoice-col">
		              <b>Invoice #007612</b><br/>
		              <br/>
		              <b>Order ID:</b> 4F3S8J<br/>
		              <b>Payment Due:</b> 2/22/2014<br/>
		              <b>Account:</b> 968-34567
		            </div><!-- /.col -->
		          </div><!-- /.row -->

		          <!-- Table row -->
		          <div class="row">
		            <div class="col-xs-12 table-responsive">
		              <table class="table table-striped">
		                <thead>
		                  <tr>
		                    <th>Qty</th>
		                    <th>Product</th>
		                    <th>Serial #</th>
		                    <th>Description</th>
		                    <th>Subtotal</th>
		                  </tr>
		                </thead>
		                <tbody>
		                  <tr>
		                    <td>1</td>
		                    <td>Call of Duty</td>
		                    <td>455-981-221</td>
		                    <td>El snort testosterone trophy driving gloves handsome</td>
		                    <td>$64.50</td>
		                  </tr>
		                  <tr>
		                    <td>1</td>
		                    <td>Need for Speed IV</td>
		                    <td>247-925-726</td>
		                    <td>Wes Anderson umami biodiesel</td>
		                    <td>$50.00</td>
		                  </tr>
		                  <tr>
		                    <td>1</td>
		                    <td>Monsters DVD</td>
		                    <td>735-845-642</td>
		                    <td>Terry Richardson helvetica tousled street art master</td>
		                    <td>$10.70</td>
		                  </tr>
		                  <tr>
		                    <td>1</td>
		                    <td>Grown Ups Blue Ray</td>
		                    <td>422-568-642</td>
		                    <td>Tousled lomo letterpress</td>
		                    <td>$25.99</td>
		                  </tr>
		                </tbody>
		              </table>
		            </div><!-- /.col -->
		          </div><!-- /.row -->

		          <div class="row">
		            <!-- accepted payments column -->
		            <div class="col-xs-6">
		              <p class="lead">Payment Methods:</p>
		              <img src="../../dist/img/credit/visa.png" alt="Visa"/>
		              <img src="../../dist/img/credit/mastercard.png" alt="Mastercard"/>
		              <img src="../../dist/img/credit/american-express.png" alt="American Express"/>
		              <img src="../../dist/img/credit/paypal2.png" alt="Paypal"/>
		              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
		                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
		              </p>
		            </div><!-- /.col -->
		            <div class="col-xs-6">
		              <p class="lead">Amount Due 2/22/2014</p>
		              <div class="table-responsive">
		                <table class="table">
		                  <tr>
		                    <th style="width:50%">Subtotal:</th>
		                    <td>$250.30</td>
		                  </tr>
		                  <tr>
		                    <th>Tax (9.3%)</th>
		                    <td>$10.34</td>
		                  </tr>
		                  <tr>
		                    <th>Shipping:</th>
		                    <td>$5.80</td>
		                  </tr>
		                  <tr>
		                    <th>Total:</th>
		                    <td>$265.24</td>
		                  </tr>
		                </table>
		              </div>
		            </div><!-- /.col -->
		          </div><!-- /.row -->

		          <!-- this row will not appear when printing -->
		          <div class="row no-print">
		            <div class="col-xs-12">
		              <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
		              <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
		              <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
		            </div>
		          </div>
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
