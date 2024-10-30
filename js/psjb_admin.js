jQuery(document).ready(function($){

	$(document).on('click','.note-form-open',function(){	
		$(this).parent('td').find('.note-section').toggle();
	});

});