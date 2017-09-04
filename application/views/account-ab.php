<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - List Address Books</title>
        <?php include('inc/load_top.php');?>
    </head>
    <body class="home">
        <?php include('inc/header.php');?>

        <div class="container account-content-outter">            
            <div class="row">
                <div id="sidebar-category" class="col-md-3">
                    <div class="wrap-breadcrump">
                        <h4>Dashboard &gt; Address Book </h4>

                    </div>
                    <?php include('inc/sidebar-account.php');?>
                </div>
                <div id="account-content-inner" class="col-md-9">
                    <h4><span class="fa fa-street-view"></span> &nbsp;Your Address Book</h4>
                    <div class="row">
                        <div class="col-md-6 wrap-content">
                            <a class="btn" href="<?php echo base_url();?>account/ab_add/" style="margin-bottom:25px;">Add New Address Book</a>         
                            
                        </div>
                    </div>
                            <?php $abs = $this->_customer->get_address_book();?>
                            <?php if($abs):?>
                            <ul class="list-ab">
                                <?php foreach($abs as $ab):?>
                                <li>    
                                    <div class="wrap-ab">
                                        <p><?php echo $ab->address;?>, <br /><?php echo get_city_name($ab->city_id);?> 
                                            <?php echo get_province_name_by_city($ab->city_id);?> <?php echo $ab->postal_code;?>.
                                            <?php echo $ab->is_default==1?'(Default)':'';?>
                                        </p>
                                        <a class="btn" href="<?php echo base_url();?>account/ab_default/<?php echo $ab->id;?>">Set As Default</a>
                                        <a class="btn" href="<?php echo base_url();?>account/ab_update/<?php echo $ab->id;?>">Update</a>
                                        <a class="btn btn-del" data-url="<?php echo base_url();?>account/ab_delete/<?php echo $ab->id;?>" href="javascript:void(0)">Delete</a>
                                    </div>
                                </li>
                                <?php endforeach;?>
                            </ul> 
                            <?php endif;?>          
                            
                        </div>
                    </div>
                    
                    
                </div>
            </div>

        </div>
        <?php include('inc/footer.php');?>

        <div id="modal-conf-delete" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Delete Confirmation</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure to delete this data?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
                            <a href="#" class="btn btn-flat btn-danger btn-cdel">Delete</a>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        <?php include('inc/load_bottom.php');?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#list-category li a.has-sub').click(function(e){
                    var _this = $(this);
                    var $parent = $(this).parent('li');
                    var is_active = $parent.hasClass('active');
                    $('#list-category li').removeClass('active');
                    $('#list-category li ul.subcategory').slideUp('slow');
                    console.log(is_active);
                    if(!is_active){
                        _this.find('span').removeClass('fa-angle-double-right').addClass('fa-angle-double-down');
                        if($(this).hasClass('has-sub')){
                            
                            $parent.find('ul').slideDown('slow',function(){
                                $parent.addClass('active');
                            });
                        }
                    } else {
                        _this.find('span').removeClass('fa-angle-double-down').addClass('fa-angle-double-right');
                    }
                    
                    e.preventDefault();

                });

                $('body').on('click','.btn-del',function(e){
                    e.preventDefault();
                    var url = $(this).attr('data-url');
                    $('.btn-cdel').attr('href',url);
                    $('#modal-conf-delete').modal('show');
                });
            });
        </script>
    </body>
</html>