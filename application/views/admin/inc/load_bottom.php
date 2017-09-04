    <script type="text/javascript">var base_url = "<?php echo base_url();?>";</script>
    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url();?>assets/admin/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url();?>assets/admin/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>assets/admin/plugins/fastclick/fastclick.min.js"></script>
    <!-- Datatable -->
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- <script src="<?php echo base_url();?>assets/admin/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <!--<script src="<?php // echo base_url();?>assets/admin/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script> -->
    <script src="<?php echo base_url();?>assets/admin/plugins/validator.js"></script>

     <!-- Datatable -->
    <script src="<?php echo base_url();?>assets/admin/plugins/jasny-fileupload/jasny-bootstrap.min.js" type="text/javascript"></script>
    <!-- Icheck -->
    <script src="<?php echo base_url();?>assets/admin/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url();?>assets/admin/plugins/toastr/toastr.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>assets/admin/js/app.js" type="text/javascript"></script>
    <!-- Bootstrap Wysiwig -->
    <script src="<?php echo base_url();?>assets/admin/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>

    <!-- Global -->
    <script src="<?php echo base_url();?>assets/admin/js/global.js" type="text/javascript"></script>


    <script type="text/javascript">
        $(document).ready(function(){

            <?php if(isset($error) && !empty($error)):?>
                toastr.error('<?php echo $error;?>', 'Error!')
            <?php endif;?>
            <?php if(isset($success) && !empty($success)):?>
                toastr.success('<?php echo $success;?>', 'Success!')
            <?php endif;?>

            $('.wysihtml5').wysihtml5({"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
                    "emphasis": true, //Italics, bold, etc. Default true
                    "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                    "html": true, //Button which allows you to edit the generated HTML. Default false
                    "link": true, //Button to insert a link. Default true
                    "image": true, //Button to insert an image. Default true,
                    "color": false //Button to change color of font  
            });
        });

    </script>



 
    
    