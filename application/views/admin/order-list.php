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
						<li class="active"><i class="fa fa-dashboard"></i>&nbsp; <?php echo $page_name;?></li>
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
											  	<th>No. </th>
										  		<th>No Order</th>
											  	<th class="hidden-xs" width="120">Date</th>
											  	<th width="120">Buyer</th>
											  	<th class="hidden-xs" width="220">Items</th>
											  	<th class="hidden-xs" width="120">Total Cost</th>
											  	<!-- <th class="hidden-xs" width="150">Delivery</th> -->
											  	<th>Status</th>
											  	<th>Action</th>
										  	</tr>
									  	</thead>
									  	<tbody>
									  		<?php $list = $this->mod_order->get_all();?>
									  		<?php if(!empty($list)):?>
									  		<?php $x = 0;?>
										  		<?php foreach($list as $row): ?>
										  		<?php $x++;?>
										  	<tr>
											  	<td><?php echo $x;?>.</td>

											  	<td><?php echo $row->get_no_order();?>.</td>
											  	<td class="hidden-xs"><?php echo date('d-m-y H:i',$row->cdate);?></td>
											  	<td align="left">
											  		<?php echo '<strong>'.$row->fname.' '.$row->lname.'</strong> ('.$row->email.') ';?><br />
											  		<?php echo $row->phone;?><br />
											  	</td>
											  	<td class="hidden-xs">
											  		<ul>
											  		<?php $items = $row->get_detail();?>
											  		<?php foreach($items as $item):?>
											  			<?php echo '<li> - '.$item->product_code.' x '.$item->qty.' @ IDR '.number_format($item->final_price).' <li>';?>
											  		<?php endforeach;?>
											  		</ul>
											  	</td>
											  	
											  	<td class="hidden-xs"><?php echo 'IDR '.number_format($row->total_cost);?></td>
<!-- 											  	<td class="hidden-xs">
											  		<?php // echo $row->address;?><br />
											  		<?php // echo get_city_name($row->city_id).' '.get_province_name_by_city($row->city_id).' '.$row->postal_code;?><br />
											  	</td> -->
											  	<td>
											  		<?php if($row->status == 0):?>
											  		<label class="label label-default"><?php echo get_status_order($row->status);?></label>
													<?php elseif($row->status == 1):?>
											  		<label class="label label-default"><?php echo get_status_order($row->status);?></label>
											  		<?php elseif($row->status == 2):?>
											  		<label class="label label-warning"><?php echo get_status_order($row->status);?></label>
											  		<?php elseif($row->status == 3):?>
											  		<label class="label label-success"><?php echo get_status_order($row->status);?></label>
											  		<?php elseif($row->status == 4):?>
											  		<label class="label label-success"><?php echo get_status_order($row->status);?></label>
											  		<?php elseif($row->status == 5):?>
											  		<label class="label label-success"><?php echo get_status_order($row->status);?></label>
											  		<?php elseif($row->status == 6):?>
											  		<label class="label label-danger"><?php echo get_status_order($row->status);?></label>
											  		<?php endif;?>
											  	</td>
											  	<td style="min-width:80px;">
												  	<div class="btn-group">
													  	<a href="<?php echo $page_path.'view/'.$row->id;?>" class="btn btn-info btn-flat" data-toggle="tooltip" data-placement="top" title="View <?php echo $row->get_no_order();?>"><i class="fa fa-search"></i></a>
														<a href="javsscript:void(0)" data-toggle="tooltip" data-placement="top" title="Delete <?php echo $row->get_no_order();?>" data-url="<?php echo $page_path.'delete/'.$row->id;?>" class="btn btn-danger btn-del" title="Delete  <?php echo $row->get_no_order();?>"><i class="fa fa-trash"></i></a>
													</div>
											  	</td>
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
