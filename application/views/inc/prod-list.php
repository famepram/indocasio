<?php $current_url = current_url();?>
<?php 
    if($_category->has_child()) {
        $_fsubcat = $_subcats[0];
        //die(print_r())
        //die("-dsadasdasda");
        $_prods = $_fsubcat->get_product($this->from, $this->show,$this->order_by,$this->order_seq);
    } else {
        $_prods = $_category->get_product($this->from, $this->show,$this->order_by,$this->order_seq);
    }

    //$_prods = $_category->get_product($this->from, $this->show,$this->order_by,$this->order_seq);

?>
<?php //$_prods = $_category->get_product($this->from, $this->show,$this->order_by,$this->order_seq);?>
<?php if(!empty($_prods)):?>
<div id="product-sort-filter" class="row <?php echo $_category->has_child() ? 'hidden-sm hidden-xs' : '';?>"> 
    <div class="col-md-6">
        <form class="form-inline">
            <div id="wrap-sorting" class="form-group">
                <?php $_sort_url = $current_url.'?page='.$this->page.'&show='.$this->show;?>
                <label for="exampleInputName2">SORT BY :</label>
                <select id="product_sort" class="form-control">
                    <option value="<?php echo $_sort_url.'&order_by=popular';?>" <?php echo $this->sort=='newest'?'selected':'';?>>Popular</option>
                   <!--  <option value="<?php // echo $_sort_url.'&order_by=latest';?>" <?php echo $this->sort=='latest'?'selected':'';?>>Latest</option> -->
                    <option value="<?php echo $_sort_url.'&order_by=name';?>" <?php echo $this->sort=='name'?'selected':'';?>>Name</option>
                    <option value="<?php echo $_sort_url.'&order_by=price';?>" <?php echo $this->sort=='price'?'selected':'';?>>Price</option>
                </select>
                <span class="clearfix">&nbsp;</span>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <form id="form-filter" class="form-inline">
            <div id="wrap-filter" class="form-group">
                <label for="exampleInputName2">SHOW :</label>
                <?php $_show_url = $current_url.'?page='.$this->page.'&order_by='.$this->sort;?>
                <select id="product_show" class="form-control">
                    <option value="<?php echo $_show_url.'&show=12';?>" <?php echo $this->show==12?'selected':'';?>>12</option>
                    <option value="<?php echo $_show_url.'&show=24';?>" <?php echo $this->show==24?'selected':'';?>>24</option>
                    <option value="<?php echo $_show_url.'&show=48';?>" <?php echo $this->show==48?'selected':'';?>>48</option>
                    <option value="<?php echo $_show_url.'&show=60';?>" <?php echo $this->show==60?'selected':'';?>>60</option>
                </select>
                <label for="exampleInputName2">PER PAGE</label>
                <span class="clearfix">&nbsp;</span>
            </div>
        </form>
    </div>
</div>
<div id="wrap-product" class="row  <?php echo $_category->has_child() ? 'hidden-sm hidden-xs' : '';?>">
    <?php //die(json_encode($_category));?>
    
    <?php //if(!empty()):?>
    <?php //die(print_r($_prods));?>
    <?php foreach($_prods as $_prod):?>
    <div class="item col-xs-6 col-sm-4 col-md-3">
        <a href ="<?php echo $_prod->get_link();?>">
            <div class="content-item">
                <div class="thumbnail">
                	<div class="wrap-image">
                		<img src="<?php echo $_prod->get_img_src(true);?>" alt="...">
                	</div>
			      	<div class="caption">
				      	<div class="row">
				      		<div class="col-xs-12 col-md-12 prod-name">
				      			<h4><?php echo $_prod->code;?></h4>
				      		</div>
				      		<div class="col-xs-12 col-md-12 prod-price">
				      			<span><strike>IDR <?php echo number_format($_prod->price);?></strike></span>
				      			<span>IDR <?php echo number_format($_prod->get_final_price());?></span>
				      		</div>
				      	</div>
			      	</div>
			    </div>
            </div>
        </a>
    <!--     <div class="cat-overlay"></div> -->
    </div>
    <?php endforeach;?>
</div>
<div class="row  <?php echo $_category->has_child() ? 'hidden-sm hidden-xs' : '';?>">
    <div class="col-md-12">
        <?php //die($_category->get_total_prod().'-------------dasdsa-------------------');?>
        <?php $_base_url=$current_url.'?order_by='.$this->sort.'&show='.$this->show;?>
        <?php $totprod = $_category->has_child() ? $_fsubcat->get_total_prod() : $_category->get_total_prod();?>
        <?php $paging = pagination($this->page,$this->show,$totprod,false,$_base_url);?>
        <?php echo $paging;?>
<!--         <ul class="pagination">
            <li class="prev">
                <a href=""><span class="fa fa-angle-double-left"></span>&nbsp; PREVIOUS</a>
            </li>
            <li class="page">
                <a class="active" href="">1</a>
            </li>
            <li class="page">
                <a href="">2</a>
            </li>
            <li class="page">
                <a href="">3</a>
            </li>
            <li class="next">
                <a href=""> NEXT &nbsp; <span class="fa fa-angle-double-right"></span></a>
            </li>
        </ul> -->
        <!-- <span class="clearfix">&nbsp;</span> -->
    </div>
</div>
<?php else:?>
    <h4 style="margin-top:35px;text-align:center;">No Items </h4>
<?php endif;?>