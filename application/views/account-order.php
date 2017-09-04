<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - List Order</title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>

        <div class="container account-content-outter">            
            <div class="row">
                <div id="sidebar-category" class="col-md-3">
                    <div class="wrap-breadcrump">
                        <h4>Dashboard &gt; History Orders </h4>

                    </div>
                    <?php include('inc/sidebar-account.php');?>
                </div>
                <div id="account-content-inner" class="col-md-9">
                    <h4><span class="fa fa-shopping-cart"></span> &nbsp;Your Orders</h4>
                    <div class="row">
                        <div class="col-md-12 wrap-content">
                            <?php $orders = $this->_customer->get_order();?>
                            <?php if(!empty($orders)):?>
                            <table id="table-h-order" class="table">
                                <thead>
                                    <tr>
                                        <th width="40">#</th>
                                        <th width="80">No Order</th>
                                        <th width="140">Date</th>
                                        <th width="120">Status</th>
                                        <th width="140">Total Price</th>
                                        <th width="140">Delivery Cost</th>
                                        <th colspan="2" width="140">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $x = 0;?>
                                    <?php foreach($orders as $order):?>
                                    <?php $x++;?>
                                    <tr>
                                        <td><?php echo $x;?>. </td>
                                        <td><?php echo $order->get_no_order();?></td>
                                        <td><?php echo date('d-m-Y',$order->cdate);?></td>
                                        <td><?php echo get_status_order($order->status);?></td>
                                        <td><?php echo 'IDR '.number_format($order->total_price);?></td>
                                        <td><?php echo 'IDR '.number_format($order->delivery_cost);?></td>
                                        <td><?php echo 'IDR '.number_format($order->total_cost);?></td>
                                        <td><a class="btn" href="<?php echo base_url().'account/view_order/'.$order->id;?>">View </a></td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>      
                            <?php else : ?>
                            <?php endif;?>
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