<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo $page_name;?></title>
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
				 	<h1><?php echo $page_caption;?></h1>
				  	<ol class="breadcrumb">
						<li class="active"><i class="fa fa-dashboard"></i>&nbsp; <?php echo $page_caption;?></li>
				  	</ol>
				</section>

				<!-- Main content -->
				<section class="content">
				  	<div class="row">
					  	<div class="col-md-12 col-sm-12">
						  	<div class="box">
							  	<div class="box-header clearfix">
									  <!-- <h3 class="box-title">Master Sparepart</h3> -->
								  	<a href="<?php echo $page_path.'add/';?>" class="btn btn-primary btn-md" style="float:right;"><i class="fa fa-plus-square"></i>&nbsp; Add New</a>
							  	</div>
							  	<div class="box-body">
								  	<table class="datatable table table-condensed">
									  	<thead>
										  	<tr>
											  	<th width="30">No</th>
											  	<th class="hidden-xs" width="120">Date Transfer</th>
											  	<th width="120">No Order</th>
											  	<th class="hidden-xs" width="220">Transfer From</th>
											  	<th class="hidden-xs" width="150">Transfer To</th>
											  	<th class="hidden-xs" width="120">Total Amount</th>
											</tr>
									  	</thead>
									  	<tbody>
									  		<?php $list = $this->mod_payment->get_all();?>
									  		<?php if(!empty($list)):?>
									  		<?php $x = 0;?>
										  		<?php foreach($list as $row): ?>
										  		<?php $x++;?>
										  	<tr>
										  		<td class="hidden-xs"><?php echo $x;?>.</td>
										  		<td><?php echo date('d-m-y H:i',$row->date);?></td>
											  	<td><?php echo no_order($row->order_id);?>.</td>
											  	<td>
											  		<p>
											  			Bank <?php echo $row->bank_name;?><br/>
											  			No. rekening  <?php echo $row->acc_no;?><br/>
											  			Atas nama <?php echo $row->acc_name;?>
											  		</p>
											  	</td>
											  	<td>
											  		<p><?php echo get_transfer_to($row->transfer_to);?></p>
											  	</td>
											  	<td><?php echo 'IDR '.number_format($row->amount);?>.</td>
										  	</tr>
										  		<?php endforeach;?>
										 	<?php endif;?> 	
									  	</tbody>
								  	</table>
							  	</div>
					 	 	</div><!-- /.box -->
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
