<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - Payment Confirmation</title>
        <?php include('inc/load_top.php');?>
        <link href="<?php echo base_url();?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="home">
        <?php include('inc/header.php');?>
        <div class="container content-checkout">       
            <div class="row">
                <div class="col-sm-offset-4 col-sm-4 ">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 style="margin-top:25px;padding-bottom:25px; text-align:center; border-bottom:solid 1px #000;">Konfirmasi Pembayaran</h4>
                        </div>
                    </div>
                    <form id="form-payconf" data-toggle="validator" role="form" class="account-form" method="post" action="<?php echo base_url();?>checkout/payconfpost/">
                        <div class="form-group">
                            <label>No Order</label>
                            <div class="input-group">
                                <div class="input-group-addon">#</div>
                                <?php if(isset($this->_order)):?>
                                <input type="hidden" class="form-control" name="order_id" value="<?php echo $this->_order->id;?>">
                                <input type="text" class="form-control" name="no_order" value="<?php echo str_replace('#', '', $this->_order->get_no_order());?>" placeholder="No Order" disabled>
                                <?php else : ?>
                                <input type="text" class="form-control" name="no_order" value="" placeholder="No Order">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>No. Rekening</label>
                            <input name="acc_no" type="text" class="form-control"  placeholder="Account No.">
                        </div>
                        <div class="form-group">
                            <label>Rekening Atas Nama</label>
                            <input name="acc_name" type="text" class="form-control"  placeholder="Account Name">
                        </div>
                        <div class="form-group">
                            <label>Nama Bank</label>
                            <input name="bank_name" type="text" class="form-control"  placeholder="Bank Name">
                        </div>
                        <div class="form-group">
                            <label>Bank Tujuan Transfer</label>
                            <select name="transfer_to" class="form-control">
                                <?php $reks = get_atm_account();?>
                                <?php if(!empty($reks)):?>
                                    <option value="0">Bank Tujuan</option>
                                    <?php foreach($reks as $rek):?>
                                        <option value="<?php echo $rek->id;?>"><?php echo $rek->bank_name;?> <?php //echo $rek->acc_no;?> A/N <?php // echo $rek->acc_name;?></option>
                                    <?php endforeach;?>
                                <?php endif;?>
                             </select>
                            
                        </div>

                        <div class="row">
                            <div class="col-sm-7 half">
                                <div class="form-group">
                                    <label>Tanggal Transfer</label>
                                    <input type="text" class="form-control datepicker" data-date-format="dd-mm-yyyy" data-provide="datepicker" name="date_trans"  placeholder="dd-mm-yyyy" required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
<!--                             <div class="col-sm-5 half">
                                <div class="form-group">
                                    <label>Time Transfer</label>
                                    <div class="input-append bootstrap-timepicker">
                                        <input type="text" class="form-control timepicker" name="time_trans"  placeholder="hh:mm" required>
                                        <span class="add-on"><i class="icon-time"></i></span>
                                    </div>
                                    
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div> -->
                        </div>
                        <div class="form-group">
                            <label>Amount Transfer</label>
                            <?php if(isset($this->_order)):?>
                            <input name="amount" type="text" class="form-control"  placeholder="Amount Transfer" value="<?php echo $this->_order->total_cost;?>">
                            <?php else : ?>
                            <input name="amount" type="text" class="form-control"  placeholder="Amount Transfer">
                            <?php endif; ?>
                        
                        </div>
                         <button type="submit" class="btn btn-default">Confirm</button>
                    </form>
                </div>
            </div>     
        </div>
        <?php include('inc/footer.php');?>
        <?php include('inc/load_bottom.php');?>
        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery.scrollTo.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.datepicker').datepicker({'autoclose':true});
                $('.timepicker').timepicker({'showMeridian':false,'template':'modal','modalBackdrop':true,'minuteStep':5});
            });
        </script>
    </body>
</html>