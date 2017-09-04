$(document).ready(function(){
	$(".datatable").dataTable();
	$("#product-datatable").dataTable({
		"iDisplayLength": -1,
	});
	$('input').iCheck({
        checkboxClass: 'icheckbox_minimal-grey',
        radioClass: 'iradio_minimal-grey'
    });
});