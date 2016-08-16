// Rename "boiler" on line 4 and 7 to your field name

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
			// Put you code here
			console.log('Hello from Javascript!');

			// Ajax call - Ajax is optional
			$.fn.ajax(fieldname);
		});
	};

	// Ajax function - Ajax is optional
	$.fn.ajax = function(fieldname) {
		var blueprint_key = $('[data-field="' + fieldname + '"]').find('[name]').attr('name');
		var base_url = window.location.href.replace('/edit', '/field') + '/' + blueprint_key + '/' + fieldname + '/ajax/';
		$.ajax({
			url: base_url + '1/value',
			type: 'GET',
			success: function(result) {
				console.log('Hello from Ajax!');
				console.log(result);
			}
		});
	};
})(jQuery);