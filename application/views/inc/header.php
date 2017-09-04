<div class="container">
    <nav id="navbar" class="navbar navbar-default">
        <div id="head-1-menu" class="container-fluid">
            <div class="row">
                <div id="wrap-top-logo" class="col-md-offset-3 col-xs-12 col-sm-8 col-md-6">
                    <?php $logo = get_meta('logo');?>
                    <?php if(!empty($logo)):?>
                        <a href="<?php echo base_url();?>"><img src="<?php echo base_url().'uploads/site/'.$logo;?>" style="width:100%;"></a>
                    <?php else:?>
                        <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/img/logo-black.png" style="width:100%;"></a>
                    <?php endif;?>
                </div>
                <div id="login-menu" class="col-xs-12 col-sm-4 col-md-3">
                    <div class="row">
                        <div id="btn-group-login" class="col-sm-9 col-md-12 col-xs-9">
                            <?php if(!empty($this->_customer_id)):?>
                            <ul>    
                                <li class="bg-black" style="min-width:100px;"><a href="<?php echo base_url();?>account/profile/" class="btn-bg-white">Account</a></li>
                                <li class="bg-white" style="min-width:100px;"><a href="<?php echo base_url();?>login/off/">Logout</a></li>
                            </ul>
                            <div class="clearfix">&nbsp; </div>
                            <?php else :?>
                            <ul>    
                                <li class="bg-black" style="min-width:100px;"><a href="<?php echo base_url();?>login/" class="btn-bg-white" >LOGIN</a></li>
                                <li class="bg-white" style="min-width:100px;"><a href="<?php echo base_url();?>register/">SIGN UP</a></li>
                            </ul>
                            <div class="clearfix">&nbsp; </div>
                            <?php endif;?>                            
                        </div>
                        <div id="btn-mob-menu" class="col-xs-3 col-sm-3">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <!-- <a class="navbar-brand" href="#">Brand</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            $rt = get_meta('running_text');
            if(!empty($rt)){
                echo '<marquee>'.$rt.'</marquee>';
            }
        ?>
        <div id="head-2-menu" class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <div class="row">
                    <div id="wrap-navbar" class="col-sm-offset-3 col-sm-6">
                        <ul id="top-main-menu" class="nav navbar-nav navbar-center">
                            <li><a href="<?php echo base_url();?>">Home <span class="sr-only">(current)</span></a></li>
                            <li id="menu-category" class=""><a href="<?php echo base_url();?>g-shock">Categories</a></li>
                            <li class="cart"><a href="<?php echo base_url();?>cart">Cart (<?php echo $this->mod_cart->get_total_qty();?>) </a></li>
                        </ul>
                        <input name="q" style="display:none;">
                    </div>
                    <div class="col-sm-3">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a id="top-search" href="#"><span id="caption-search">Search &nbsp;</span><span class="fa fa-search"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div id="wrap-box-search" class="row">
                    <div class="col-sm-12">
                        <form method="get" action="<?php echo base_url();?>search/">
                            <div class="form-group">
                             <input id="q-search" name="q" type="text" class="form-control" placeholder="Enter Keyword  ">
                          </div>
                        </form>
                    </div>
                </div>
                
                
            </div><!-- /.navbar-collapse -->

        </div><!-- /.container-fluid -->
    </nav>
    <div id="wrap-dd-category" class="row" style="display:;position:relative;">
        <div id="inner-dd-category" class="col-sm-12" style="">
            <div class="row">


    
            <?php 
                $cats = get_cat_by_parent(0);
                if(!empty($cats)):?>
                <?php foreach ($cats as $key => $cat) : ?>
                <?php $childs = get_cat_by_parent($cat->id);?> 
                
                    
                    <?php if(!empty($childs)):?>
                        <div class="col-sm-2">

                            
                            <a href="<?php echo $cat->get_link();?>" class="parent has-child"><?php echo $cat->name;?></a>
                            <ul class="ul-child">
                            <?php foreach ($childs as $c) :?>
                                <li><a class="child" href="<?php echo $c->get_link();?>"><?php echo $c->name;?></a></li>
                            <?php endforeach;?>
                            </ul>
                        </div>
                    <?php endif;?>
                   
                <?php endforeach;?>
                <div class="col-sm-2">
                    <a href="javascript:void(0)" class="parent has-child">OTHERS</a>
                    <ul class="ul-child">
                        <?php foreach ($cats as $key => $cat) : ?>
                            <?php $childs = get_cat_by_parent($cat->id);?> 
                            <?php if(empty($childs)):?>
                            <li><a class="child" href="<?php echo $cat->get_link();?>"><?php echo ucwords(strtolower($cat->name));?></a></li>
                            <?php endif;?>
                        <?php endforeach;?>
                    </ul>
                
                </div>

                <?php endif;?>
                <div class="col-sm-2">
                    <a href="javascript:void(0)" class="parent has-child">NEW PRODUCTS</a>
                    <?php $nps = get_new_product(true,8);?>
                    <ul class="ul-child">
                        <?php foreach ($nps as  $np) : ?>
                            <li><a class="child" href="<?php echo $np->get_link();?>"><?php echo strtoupper($np->name);?></a></li>

                        <?php endforeach;?>
                    </ul>
                </div>

            
            </div>
        </div>
    </div>
</div>