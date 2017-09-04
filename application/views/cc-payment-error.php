<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - Payment Error</title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>
        <div class="container content-checkout">       
            <div class="row">
                <div class="col-sm-12 wrap-finish-order">
                    <div class="row">
                        <div class="col-sm-12">
                            
                                <h4 style="text-align:center;margin-bottom:25px;">Error Payment</h4>

                        </div>
                    </div>

                    <div class="alert alert-danger" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Error Code : <?php echo $code;?>!</strong> <?php echo vt_status_code($code);?>
                    </div>
                    <?php if($backorder):?>
                        <a href="<?php echo base_url();?>checkout/confirmation/" class="btn btn-default">Back to Order Confirmation</a>
                    <?php else : ?>
                    <?php 
                        $id_raw = $this->input->get('order_id');
                        $id = intval(str_replace('#', '', $id_raw));
                        $order_id = !empty($id)?$id:$oid;
                    ?>
                        <a href="<?php echo base_url();?>checkout/cc_payment/<?php echo $order_id;?>" class="btn btn-default">Try Again</a>
                        <a href="<?php echo base_url();?>" class="btn btn-info">Cancel Payment</a>
                    <?php endif;?>
                </div>
            </div>     
        </div>
        <?php include('inc/footer.php');?>
        <?php include('inc/load_bottom.php');?>
        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery.scrollTo.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                
            });
        </script>
    </body>
</html>