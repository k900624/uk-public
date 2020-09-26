/*
	@author SillexLab (sillexlab@gmail.com)
	@copyright 2020

	jQuery plugins
*/

// Avoid `console` errors in browsers that lack a console.
(function() {
	var method;
	var noop = function() {};
	var methods = [
		'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
		'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
		'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
		'timeStamp', 'trace', 'warn'
	];
	var length = methods.length;
	var console = (window.console = window.console || {});

	while (length--) {
		method = methods[length];

		// Only stub undefined methods.
		if (!console[method]) {
			console[method] = noop;
		}
	}
}());

(function($) {
	$.fn.buttonLoader = function(action, textBtn) {
		var self = $(this);
		if (action === 'start') {
			if ($(self).attr('disabled') === 'disabled') {
				return false;
			}

			if (typeof textBtn === 'undefined') {
				textBtn = 'Подождите';
			}
			$(self).attr('disabled', 'disabled');
			$(self).attr('data-btn-text', $(self).text());
			$(self).html('<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span> ' + textBtn);
			$(self).addClass('active');
		}
		if (action === 'stop') {
			$(self).html($(self).attr('data-btn-text'));
			$(self).removeClass('active');
			$(self).removeAttr('disabled');
		}
	}
})(jQuery);

// Restricts input for each element in the set of matched elements to the given inputFilter.
// Example: https://jsfiddle.net/emkey08/tvx5e7q3
(function($) {
	$.fn.inputFilter = function(inputFilter) {
		return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
			if (inputFilter(this.value)) {
				this.oldValue = this.value;
				this.oldSelectionStart = this.selectionStart;
				this.oldSelectionEnd = this.selectionEnd;
			} else if (this.hasOwnProperty("oldValue")) {
				this.value = this.oldValue;
				this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
			} else {
				this.value = "";
			}
		});
	};
}(jQuery));

// Place any jQuery/helper plugins in here.

$(document).ready(function() {
	
	$('.validate').validate();

	$('[data-toggle="popover"]').popover();
	$('[data-toggle="tooltip"]').tooltip();

	$('.js-scroll').slimscroll({
		height: 'auto',
		size: '5px',
		alwaysVisible: true,
		railVisible: true
	});

	$('.block').widgster({bodySelector: '.block_body'});

	$('time.timeago').timeago();

	// close modal on key ESC
	$(document).on('keyup', function(e) {
		if (e.keyCode === 27) {
			$('.modal').modal('hide');
		}
	});

	// header bug fix
	$('.modal').on('show.bs.modal', function(e) {
		$('.l-header .header').css('marginRight', 2);
	});
	$('.modal').on('hidden.bs.modal', function(e) {
		$('.l-header .header').css('marginRight', -15);
	});
});
