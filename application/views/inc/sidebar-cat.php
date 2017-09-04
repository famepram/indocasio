<ul id="list-category" class="hidden-xs">
    <?php if(!empty($cats)):?>
        <?php foreach($cats as $cat):?>
            <?php if($cat->has_child()):?>
                <?php 
                    $_cat_id = isset($_category)?$_category->id:0;
                    $_cat_parent = isset($_category)?$_category->parent:0;
                    if($cat->id == $_cat_id){
                        $class = 'active';
                    } elseif($cat->id == $_cat_parent){
                        $class = 'active';
                    } else {
                        $class = '';
                    }
                    $_subs = $cat->get_child();
                ?>
            <li class="<?php echo $class;?>">
                <a class="has-sub" href="<?php echo $cat->get_link();?>"><span class="fa <?php echo $class=='active'?'fa-angle-double-down':'fa-angle-double-right';?>">&nbsp;</span> <?php echo $cat->name;?></a>
                <ul class="subcategory">
                    <?php foreach($_subs as $_sub):?>
                    <li>
                        <a href="<?php echo $_sub->get_link();?>"><?php echo $_sub->name;?></a>
                    </li>
                    <?php endforeach;?>
                </ul>
            </li>
            <?php else :?>
            <li>
                <a href="<?php echo $cat->get_link();?>"><span class="fa fa-stop">&nbsp;</span> <?php echo $cat->name;?></a>
            </li>
            <?php endif;?>
        <?php endforeach;?>
    <?php endif;?>
</ul>