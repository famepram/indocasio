<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/owl-carousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/slick/slick.min.js"></script>
 <!-- Toastr -->
<script src="<?php echo base_url();?>assets/plugins/toastr/toastr.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/global.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		<?php if(isset($this->_error) && !empty($this->_error)):?>
			toastr.error('<?php echo $this->_error;?>', 'Error!')
		<?php endif;?>
		<?php if(isset($this->_success) && !empty($this->_success)):?>
			//alert("<?php echo $this->_success;?>");
		    toastr.success('<?php echo $this->_success;?>', 'Success!')
		<?php endif;?>
	});
</script>

<script type="text/javascript">
	var $_Tawk_API={},$_Tawk_LoadStart=new Date();
	(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/5572d1aafffb3e772347ec4b/default';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
	})();
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65278705-1', 'auto');
  ga('send', 'pageview');

</script>