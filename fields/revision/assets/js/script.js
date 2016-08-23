(function($) {
	$.fn.revision = function() {
		return this.each(function() {
			var field = $(this);
			var fieldname = 'revision';

			if(field.data( fieldname )) {
				return true;
			} else {
				field.data( fieldname, true );
			}

			console.log('test');
			var data = $('.revisions__sidebar').html();

			$('.sidebar-content').prepend(data);
			console.log(data);
		});
	};
})(jQuery);