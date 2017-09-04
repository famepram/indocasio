<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?></title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>
        <div class="container">
            <div class="row">
                <div id="wrap-home-banner" class="col-sm-3">
                    <div class="row">
                        <div class="col-sm-12 col-xs-6" style="margin-bottom:25px;">
                            <a href="http://www.casio-intl.com/asia-mea/en/wat/new_products/" target="_blank">
                                <img src="<?php echo base_url().'uploads/site/'.get_meta('home_np_img');?>" style="width:100%">
                            </a>
                        </div>
                        <div class="col-sm-12 col-xs-6" style="margin-bottom:0px;">
                            <a href="http://www.casio-intl.com/asia-mea/en/wat/product_finder/" target="_blank" >
                                <img src="<?php echo base_url().'uploads/site/'.get_meta('home_pf_img');?>" style="width:100%">
                            </a>
                        </div>
                    </div>
                </div>
                <div id="wrap-home-banner" class="col-sm-9">
                    <div id="home-banner" class="owl-carousel owl-theme">
                        <?php $banners = $this->mod_banner->get_all(true,6,0);?>
                        <?php foreach($banners as $banner):?>
                        <div class="item"><img src="<?php echo $banner->get_img_src();?>" style="width:100%;"></div>
                        <?php endforeach;?>
                     
                    </div>
                    <div id="home-banner-nav">
                        <a class="nav-left" href="#">
                            <img src="<?php echo base_url();?>assets/img/arrow-left.png" />
                        </a>
                        <a class="nav-right" href="#">
                            <img src="<?php echo base_url();?>assets/img/arrow-right.png" />
                        </a>
                        <span class="clearfix"></span>
                    </div>
                </div>

            </div>
            <div id="wrap-category" class="row">
                <?php foreach($cats as $cat):?>
                <div class="item col-xs-12 col-sm-6 col-md-4">
                    <a href ="<?php echo $cat->get_link();?>">
                        <div class="content-item">
                            <img src="<?php echo $cat->get_img_src(true);?>" />
                            <div class="cat-overlay">
                                <div class="cat-caption">
                                    <h4><?php echo strtoupper($cat->name);?></h4>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                <!--     <div class="cat-overlay"></div> -->
                </div>
                <?php endforeach;?>
            </div>

            <div class="row">
                <div id="testi-ads" class="col-md-12">
                    <hr />
                    <div class="row">
                        <div id="ads" class="hidden-xs col-md-3 col-xs-12">
                            <div class="row">
                                <?php $adss = $this->mod_ads->get_all(true,2,0);?>
                                <?php if(!empty($adss)):?>
                                <?php foreach($adss as $ads):?>
                                    <div class="col-md-12 col-sm-6 col-xs-6">
                                        <a target="_blank" href="http://<?php echo $ads->link;?>"><img src="<?php echo $ads->get_img_src(true);?>"></a>
                                    </div>
                                <?php endforeach;?>
                                <?php else:?>
                                <div class="col-md-12 col-sm-6 col-xs-6">
                                    <img src="http://placehold.it/350x150&text=ads here">
                                </div>
                                <div class="col-md-12 col-sm-6 col-xs-6">
                                    <img src="http://placehold.it/350x150&text=ads here">
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                        <div id="testi" class="col-md-3 col-xs-12">
                            <h4>Testimoni</h4>
                            <hr>
                            <?php $testimonis = $this->mod_testimoni->get_all(2,0,true);?>
                            <?php if(!empty($testimonis)):?>
                            <ul>
                                <?php foreach($testimonis as $testi):?>
                                <li>
                                    <div class="testi-item">
                                        <h5><?php echo $testi->fname.' '.$testi->lname;?></h5>
                                        <p><?php echo nl2br($testi->content);?></p>
                                    </div>
                                </li>
                                <?php endforeach;?>
                            </ul>
                            <?php endif;?>
                        </div>
                        <div id="video" class="col-md-6 col-xs-12" style="padding-bottom:20px;">
                            <h4 class="sr-only">Testimoni</h4>
                            <hr class="sr-only">
                            <div class="embed-responsive embed-responsive-16by9">
                                
                                <iframe width="560" height="315" src="<?php echo get_meta('video_link');?>" frameborder="0" allowfullscreen></iframe>

                            </div>
                        </div>
                        <div id="ads" class="hidden-sm hidden-md hidden-lg col-md-3 col-xs-12" style="padding-bottom:0px;">
                            <div class="row">
                                <?php if(!empty($adss)):?>
                                    <?php if(count($adss) > 1):?>
                                    <?php foreach($adss as $ads):?>
                                        <div class="col-md-12 col-sm-6 col-xs-6">
                                            <!-- <img src="http://placehold.it/350x150&text=ads here"> -->
                                             <a target="_blank" href="http://<?php echo $ads->link;?>"><img src="<?php echo $ads->get_img_src(true);?>"></a>
                                        </div>
                                    <?php endforeach;?>
                                    <?php else : ?>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <!-- <img src="http://placehold.it/350x150&text=ads here"> -->
                                             <a target="_blank" href="http://<?php echo $ads->link;?>"><img src="<?php echo $ads->get_img_src(true);?>"></a>
                                        </div>
                                    <?php endif;?>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 


        </div>
        <?php include('inc/footer.php');?>
        <?php include('inc/load_bottom.php');?>
        <script type="text/javascript">
            $(document).ready(function(){
                // $("#home-banner").owlCarousel({
 
                //     navigation : false, // Show next and prev buttons
                //     slideSpeed : 300,
                //     paginationSpeed : 400,
                //     singleItem:true
                 
                //       // "singleItem:true" is a shortcut for:
                //       // items : 1, 
                //       // itemsDesktop : false,
                //       // itemsDesktopSmall : false,
                //       // itemsTablet: false,
                //       // itemsMobile : false
             
                // });

                $('#home-banner').slick({
                    arrows:false,
                    autoplay:true,
                    autoplaySpeed:2000
                });

                $('.nav-left').click(function(e){
                    $('#home-banner').slick('slickPrev');
                    e.preventDefault();
                });

                $('.nav-right').click(function(e){
                    $('#home-banner').slick('slickNext');
                    e.preventDefault();
                });

                

                var owl_latest = $("#slider-latest");
 
                owl_latest.owlCarousel({
                    items : 4, //10 items above 1000px browser width
                    itemsDesktop : [1000,4], //5 items between 1000px and 901px
                    itemsDesktopSmall : [900,4], // betweem 900px and 601px
                    itemsTablet: [600,2], //2 items between 600 and 0
                    itemsMobile : [480,2] // itemsMobile disabled - inherit from itemsTablet option
                });
            });
        </script>
    </body>
</html>