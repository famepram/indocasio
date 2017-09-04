<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo $page_name;?></title>
		<?php include('inc/load_top.php');?>
		<style type="text/css">
			.datatable td{
				vertical-align: top !important;
			}
		</style>
	</head>
	<body class="skin-blue sidebar-collapse">
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
							  		<div class="row">
							  			<div class="col-sm-4">
							  				<form method="post" role="form" action="<?php echo $root_path;?>config/updater/?redirect=site" enctype="multipart/form-data">
									  			<div class="form-group">
			                                        <label class="control-label">Category</label>
			                                        <select class="form-control filter-category" name="category">
			                                            <option value="0">Pilih Kategori</option>
			                                            <?php echo get_option_category($this->category);?>
			                                        </select>
			                                    </div>
									  		</form>
							  			</div>
							  		</div>
							  		
								  	<table id="product-datatable" class="table table-condensed">
									  	<thead>
										  	<tr>
											  	<th class="hidden-xs">No</th>
											  	<th style="width:50px;text-align:center;" class="hidden-xs">Image</th>
											  	<th align="center hidden-xs" style="text-align:center;">Name</th>
											  	<th align="center" style="text-align:center;">Code</th>
											  	<th class="hidden-xs">Category</th>
											  	<th class="hidden-xs">Final Price</th>
											  	<th class="hidden-xs">Discount</th>
											  	
											  	<th class="hidden-xs">Status Stock</th>
											  	<th class="hidden-xs">Publish</th>
											  	<?php if(!empty($this->category)):?>
											  	<th class="hidden-xs">sort</th>
											  	<?php endif;?>
												<th>Action</th>
										  	</tr>
									  	</thead>
									  	<tbody>
									  		<?php if(!empty($list)):?>
									  		<?php $x = 0;?>
									  		<?php $count = count($list);?>
										  		<?php foreach($list as $row): ?>
										  		<?php $x++;?>
										  	<tr>
											  	<td class="hidden-xs"><?php echo $x;?>.</td>
											  	<td style="padding:5px !important;text-align:center;">
											  		<h4 class="visible-xs" style="font-size:18px;font-weight:bold;text-align:center;"><?php echo $row->code;?></h4>
											  		<img src="<?php echo $row->get_img_src(true);?>" style="width:100%;min-width:64px;max-width:120px;" />
											  	</td>
											  	<td class="hidden-xs" style="text-align:center;"><?php echo $row->code;?></td>
											  	<td style="text-align:center;"><?php echo $row->sku;?></td>
											  	<td class="hidden-xs"><small><?php echo $row->get_cat_str();?></small></td>
											  	
											  	<td class="hidden-xs"><?php echo 'IDR '.number_format($row->get_final_price())?></td>
											  	<td class="hidden-xs">
											  		<?php 
											  		if(!empty($row->disc_type)){
										  				if($row->disc_type == 1){
										  					echo $row->disc_value.'%';
										  				} else {
										  					echo 'IDR '.number_format($row->disc_value);
										  				}
											  		} else {
											  			echo ' - ';
											  		}	
											  		?>

											  	</td>
											  	<td class="hidden-xs">
											  		<div class="hidden-xs hidden-sm form-group">
												  		<?php if($row->status == 1):?>
												  		<label class="label label-success">Ready</label>
												  		<?php else:?>
												  		<label class="label label-warning">On Vendor</label>
												  		<?php endif;?>
											  		</div>
											  		

											  	</td>
											  	<td class="hidden-xs">
											  		<?php if($row->publish == 1):?>
											  		<label class="label label-success">Publish</label>
											  		<?php else:?>
											  		<label class="label label-default">Hidden</label>
											  		<?php endif;?>
											  	</td>
											  	<?php if(!empty($this->category)):?>
											  	<td class="hidden-xs">
											  		<div class="btn-group">
											  			<?php $up = $x>1?$x-1:$count; ?>
											  			<?php $down = $x==$count?1:$x+1; ?>
											  			<?php $redir = urlencode(current_url()).'/?'.$_SERVER['QUERY_STRING'];?>
													  	<a href="<?php echo $root_path.'product/move/?id='.$row->id.'&dir=up&to='.$up.'&redir='.$redir; ?>" class="btn btn-info btn-flat"><i class="fa fa-arrow-up"></i></a>
													  	<a href="<?php echo $root_path.'product/move/?id='.$row->id.'&dir=down&to='.$down.'&redir='.$redir;?>" class="btn btn-success btn-flat"><i class="fa fa-arrow-down"></i></a>
												  	</div>
											  	</td>
											  	<?php endif;?>
											  	
											  	<td style="min-width:80px;padding:0px 10px;text-align:left;">
											  		<div class="visible-xs form-group">
											  			<label>Status Stock</label>
													    <select name="status" class="form-control quick-status" data-id="<?php echo $row->id;?>">
													    	<option <?php echo $row->status == 0?'selected':'';?> value="0">On Vendor</option>
													    	<option <?php echo $row->status == 1?'selected':'';?> value="1">Ready</option>
													    </select>
												  	</div>
												  	<div class="visible-xs form-group">
											  			<label>Visibility</label>
													    <select name="visible" class="form-control quick-visible" data-id="<?php echo $row->id;?>">
													    	<option <?php echo $row->publish == 0?'selected':'';?> value="0">Hidden</option>
													    	<option <?php echo $row->publish == 1?'selected':'';?> value="1">Publish</option>
													    </select>
												  	</div>
												  	<div class="btn-group">
													  	<a href="<?php echo $page_path.'duplicate/'.$row->id;?>" class="btn btn-info btn-flat" data-toggle="tooltip" data-placement="top" title="Duplicate <?php echo $row->name;?>"><i class="fa fa-copy"></i></a>
													  	<a href="<?php echo $page_path.'update/'.$row->id;?>" class="btn btn-success btn-flat" data-toggle="tooltip" data-placement="top" title="Edit <?php echo $row->name;?>"><i class="fa fa-pencil"></i></a>
													  	<a href="javsscript:void(0)" data-toggle="tooltip" data-placement="top" title="Delete <?php echo $row->name;?>" data-url="<?php echo $root_path.'product/delete/'.$row->id;?>" class="btn btn-danger btn-del" title="Delete  <?php echo $row->name;?>"><i class="fa fa-trash"></i></a>
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

            $('body').on('change','.quick-status',function(e){
            	var id = $(this).attr('data-id');
            	var val = $(this).val();
            	var url = "<?php echo $page_path?>set?field=status&id="+id+"&val="+val;
            	window.location.assign(url);
            });

            $('body').on('change','.quick-visible',function(e){
            	var id = $(this).attr('data-id');
            	var val = $(this).val();
            	var url = "<?php echo $page_path?>set?field=publish&id="+id+"&val="+val;
            	window.location.assign(url);
            });

            $('body').on('change','.filter-category',function(e){
            	var val = $(this).val();
            	var url = "<?php echo $page_path?>?category="+val;
            	window.location.assign(url);
            });
		});

	</script>
	</body>
</html>
