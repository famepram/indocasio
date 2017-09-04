<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"></meta>
		<title>Order Receipt</title>
		<?php include('inc/load_top.php');?>
	</head>
	<body style="padding:25px;">
		<div class="wrap-address" style="padding:25px; border:solid 1px #000; width:auto; max-width:400px;">
			<p>
				<strong><?php echo $this->_order->fname.' '.$this->_order->lname;?></strong><br>
				<?php echo $this->_order->phone;?><br>
				<address>
	                <?php echo $this->_order->address;?><br>
	                <?php echo get_city_name($this->_order->city_id).' '.get_province_name_by_city($this->_order->city_id).' '.$this->_order->postal_code;?><br />
              	</address>
			</p>
		</div>
	</body>
</html>