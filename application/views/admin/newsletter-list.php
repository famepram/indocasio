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
					  	<div class="col-md-8 col-sm-8">
						  	<div class="box">

							  	<div class="box-body">
								  	<table class="datatable table table-condensed">
									  	<thead>
										  	<tr>
											  	<th>No</th>
											  	<th width="120">Name</th>
											  	<th >Email</th>
										  	</tr>
									  	</thead>
									  	<tbody>
									  		<?php $list = $this->list;?>
									  		<?php if(!empty($list)):?>
									  		<?php $x = 0;?>
										  		<?php foreach($list as $row): ?>
										  		<?php $x++;?>
										  	<tr>
											  	<td class="hidden-xs"><?php echo $x;?>.</td>
											  	<td class="hidden-xs"><?php echo $row->fname.' '.$row->lname;?></td>
											  	<td><?php echo $row->email;?></td>
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
