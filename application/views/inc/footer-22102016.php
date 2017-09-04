<div id="footer" class="container">
<hr>
<div class="row">
    <div id="about" class="footer-section col-md-3 col-lg-3 col-sm-6 col-xs-6">
        <h4>ABOUT</h4>
        <ul>
            <li><a href="<?php echo base_url();?>page/view/terms-condition">TERMS & CONDITION</a></li>
            <li><a href="<?php echo base_url();?>page/view/privacy-and-policy">PRIVACY & POLICY</a></li>
            <li><a href="<?php echo base_url();?>page/view/about-us">ABOUT US</a></li>
        </ul>
    </div>
    <div class="footer-section col-md-3 col-lg-3 col-sm-6 col-xs-6">
        <h4>HELP</h4>
        <ul>
            <li><a href="<?php echo base_url();?>page/view/how-to-buy">HOW TO BUY</a></li>
            <li><a href="<?php echo base_url();?>checkout/payment_conf">PAYMENT CONFIRMATION</a></li>
            <li><a href="<?php echo base_url();?>page/view/faq">FAQ</a></li>
        </ul>
    </div>
    <div class="footer-section col-md-3 col-lg-3 col-sm-6 col-xs-12">
        <h4>CONTACT US</h4>
        <ul>
            <li><a href="#">Phone. <?php echo get_meta('phone');?></a></li>
            <li><a href="#">Pin BB. <?php echo get_meta('bbm');?></a></li>
            <li><a href="mailto:<?php echo get_meta('email');?>">Email. <?php echo get_meta('email');?></a></li>
            <li>Jam Operasional  <?php echo get_meta('jam_buka');?></li>
        </ul>
    </div>
    <div id="newsletter" class="footer-section col-md-3 col-lg-3 col-sm-6 col-xs-12">
        <h4>NEWSLETTER</h4>
        <div class="row">
            <div class="col-sm-12">
                <form data-toggle="validator" action="<?php echo base_url();?>home/subscribe/" method="post" class="form-inline">
                    <div class="form-group">
                        <label class="sr-only">Email address</label>
                        <input name="email" type="email" class="form-control" placeholder="Enter email" required>
                        <span class="arrow fa fa-angle-right fa-2x"></span>
                    </div>
                </form>
            </div>
        </div>
        <h4 style="margin-top:25px;">FOLLOW US</h4>
        <div class="row">
            <div class="col-sm-12">
                <ul class="socmed">
                    <li>
                        <a target="_blank" href="<?php echo get_meta('fb_link');?>"><img src="<?php echo base_url();?>assets/img/facebook-black.png"></a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo get_meta('ig_link');?>"><img src="<?php echo base_url();?>assets/img/instagram-black.png"></a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo get_meta('tw_link');?>"><img src="<?php echo base_url();?>assets/img/twitter-black.png"></a>
                    </li>
                    <li>
                        <a target="_blank" href="<?php echo get_meta('gp_link');?>"><img src="<?php echo base_url();?>assets/img/gplus-black.png"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div id="visitor-info" class="col-md-12">
        <hr>
        <div id="visitor-info-row" class="row">
            <div id="footer-payment" class="visitor-info-section col-md-4">
                <div class="wehader">
                    <h4>PAYMENT METHOD</h4>
                </div>
                <div class="vis-img-wrap">
                    <div class="footer-icon-wrap">
                        <a style="margin-left:0px;" href="#"><img src="<?php echo base_url();?>assets/img/mastercard.png"></a>
                        <a href="#"><img src="<?php echo base_url();?>assets/img/visa.png"></a>
                        <a href="#"><img src="<?php echo base_url();?>assets/img/bca.png"></a>
                        <a href="#"><img src="<?php echo base_url();?>assets/img/mandiri.png"></a>
                    </div>
                    <span class="clearfix">&nbsp;</span>
                </div>
                

            </div>
            <div id="footer-delivery" class="col-md-1 visitor-info-section">
                <div class="wehader">
                    <h4>DELIVERY</h4>
                    <hr>
                </div>
                <div class="vis-img-wrap">
                    <div class="footer-icon-wrap">
                        <a style="margin-left:0px;" href="#"><img src="<?php echo base_url();?>assets/img/jne.png"></a>
                    </div>
                    <span class="clearfix">&nbsp;</span>
                </div>    
            </div>
            <div id="footer-security" class="col-md-4 visitor-info-section">
                <div class="wehader">
                    <h4>SECURITY</h4>
                    <hr>
                </div>
                <div class="vis-img-wrap">
                    <div class="footer-icon-wrap">
                        <a style="margin-left:0px;" href="#"><img src="<?php echo base_url();?>assets/img/norton.png"></a>
                        <a href="#"><img src="<?php echo base_url();?>assets/img/ver-visa.png"></a>
                        <a href="#"><img src="<?php echo base_url();?>assets/img/mastercard-secure.png"></a>
                        <a href="#"><img src="<?php echo base_url();?>assets/img/pci.png"></a>
                    </div>

                    <span class="clearfix">&nbsp;</span>
                </div> 
            </div>
            <div id="footer-marketplace" class="col-md-3 visitor-info-section">
                <div class="wehader">
                    <h4>MARKETPLACE</h4>
                    <hr>
                </div>
                <div class="vis-img-wrap">
                    <div class="footer-icon-wrap">
                        <?php $mps = get_all_marketplace();?>
                        <?php if(!empty($mps)):?>
                            <?php foreach ($mps as $mp) : ?>
                            <a target="_blank" style="margin-left:0px;" href="<?php echo $mp->link;?>">
                                <img src="<?php echo $mp->get_img_src(true);?>" style="margin-bottom:10px;">
                            </a>
                            <?php endforeach;?>
                        <?php endif;?>
                        <p style="margin-top:25px;"><small>Note : Harga Kemungkinan berbeda, tergantung kebijakan tiap marketplace.</small></p>
                    </div>
                     <span class="clearfix">&nbsp;</span>
                </div> 
               
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    setTimeout(function(){
        $('#tawkchat-maximized-iframe-element').css('left','10 !important');
    },2000);
</script>