<div id="wrap-category" class="row">
    <?php $_subcats = $_category->get_child();?>
    <?php foreach($_subcats as $_subcat):?>
    <div class="item col-xs-12 col-sm-6 col-md-4">
        <a href ="<?php echo $_subcat->get_link();?>">
            <div class="content-item">
                <img src="<?php echo $_subcat->get_img_src(true);?>" />
                <div class="cat-overlay">
                    <div class="cat-caption">
                        <h4><?php echo $_subcat->name;?></h4>
                    </div>
                    
                </div>
            </div>
        </a>
    <!--     <div class="cat-overlay"></div> -->
    </div>
    <?php endforeach;?>
</div>