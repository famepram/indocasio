$(document).ready(function(){
	$('input').iCheck({
        checkboxClass: 'icheckbox_minimal-grey',
        radioClass: 'iradio_minimal-grey'
    });

    $('#top-search').click(function(e){
    	if($('#wrap-box-search').hasClass('open')){
    		$('#wrap-box-search').slideUp('300').removeClass('open');
    	} else {
    		
    		$('#wrap-box-search').slideDown('300').addClass('open');
    		$( "input#q-search").focus();

    	}
    	e.preventDefault();
    	
    });

    $('#menu-category').click(function(e){
        e.preventDefault();
        if(parseInt($(window).width()) > 1000){
            if($(this).hasClass("open")) {
                $('#wrap-dd-category').stop( true, true ).css('display','none');
                $(this).toggleClass("open");
            } else {
                $('#wrap-dd-category').stop( true, true ).css('display','block');
                $(this).toggleClass("open");
            }
        } else {
            var link = $(this).find('a').attr('href');
            window.location = link;
        }
        
        
    });
});