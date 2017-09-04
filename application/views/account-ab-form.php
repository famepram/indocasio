<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo get_meta('page_prefix');?> - Update Address Book</title>
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
                    <?php if($this->_ab!==false):?>
                    <h4><span class="fa fa-street-view"></span> &nbsp;Update Address Book</h4>
                    <?php else : ?>
                    <h4><span class="fa fa-street-view"></span> &nbsp;Add New Address Book</h4>
                    <?php endif;?>
                    <div class="row">
                        <div class="col-md-6 wrap-content">
                            
                            <form id="form-register" data-toggle="validator" role="form" class="account-form" method="post" action="<?php echo base_url();?>account/ab_updater/">
                                <input type="hidden" name="ab_id" value="<?php echo $this->_ab!==false?$this->_ab->id:'';?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Provinsi</label>
                                    <select id="province" name="province" class="form-control">
                                        <option value="0">Pilih Provinsi</option>
                                        <?php $prov_id = $this->_ab!==false?get_province_by_city($this->_ab->city_id):0; ?>
                                        <?php echo get_option('province',$prov_id);?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Kota / Kabupaten</label>
                                    <select id="city" name="city_id" class="form-control">
                                        <option value="0">Pilih Kota / Kabupaten</option>
                                        <?php $city_id =  $this->_ab!==false?$this->_ab->city_id:0;?>
                                        <?php echo get_option_city($prov_id,$city_id);?> 

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Kecamatan</label>
                                    <select id="kecamatan_id" name="kecamatan_id" class="form-control">
                                        <?php $kecamatan_id =  $this->_ab!==false?$this->_ab->kecamatan_id:0;?>
                                        <option value="0">Pilih Kecamatan</option>
                                        <?php echo get_option_kecamatan($city_id,$kecamatan_id);?> 

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control" rows="5" required><?php echo $this->_ab!==false?$this->_ab->address:'';?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input name="postal_code" type="text" class="form-control" value="<?php echo $this->_ab!==false?$this->_ab->postal_code:'';?>" placeholder="Postal Code">
                                </div> 
                                <div class="checkbox">
                                    <?php $is_def =  $this->_ab!==false?$this->_ab->is_default:0;?>
                                    <label>
                                        <input type="checkbox" name="is_default" <?php echo $is_def==1?'checked':'';?> value="1"> Set as default
                                    </label>
                                </div>                               
                                <button type="submit" class="btn btn-default">Update Address Book</button>
                            </form>        
                            
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

            function get_option_kecamatan(city_id,selected){
                var data="city_id="+city_id;
                var url = base_url+"checkout/get_option_kecamatan";
                var success = function(data){
                    if(selected != ''){
                        //alert(selected);
                        $('select#kecamatan_id').html(data.options).delay(500).val(selected);
                    } else {
                        $('select#kecamatan_id').html(data.options);
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

                $('select#city').change(function(){
                    var city = $(this).val();
                    get_option_kecamatan(city,'');

                });

            });
        </script>
    </body>
</html>