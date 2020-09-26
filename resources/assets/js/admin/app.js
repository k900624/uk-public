/*
  @author SillexLab (sillexlab@gmail.com)
  @copyright 2020

  main scripts
*/

$(window).on('load resize', function(e) {
	e.preventDefault();

	var viewPort = viewport(),
		windowWidth = viewPort.width;

	if (windowWidth <= '767') {

		$('.hamburger').bind('click', function() {
			var toggle = $(this).data('toggle');

			$('body').removeClass('sidebar-show settings-show');

			if ($(this).hasClass('is-active')) {
				$('body').removeClass(toggle);
				$(this).removeClass('is-active');
			} else {
				$('.hamburger').removeClass('is-active');
				$(this).addClass('is-active');
				$('body').addClass(toggle);
			}
		});

		$('.l-content').bind('click', function() {
			$('body').removeClass('sidebar-show settings-show');
			$('.hamburger').removeClass('is-active');
		});
	}
});

$(document).ready(function() {

	var viewPort = viewport(),
		windowWidth = viewPort.width,
		windowHeight = viewPort.height;


	// Functions
	loadMsg();
	retriveMsg();


	(function() {
		var check = $('.checkbox :checkbox');
		if (check.is(':checked')) {
			check.val(1);
		} else {
			check.val(0);
		}
	}());


	$('.checkbox :checkbox').on('change', function() {
		if ($(this).is(':checked')) {
			$(this).val(1);
		} else {
			$(this).val(0);
		}
	});


	$('.js-confirm-message').on('click', function(e) {
		e.preventDefault();

		var target = $(this).attr('href'),
			title = $(this).data('title'),
			type = $(this).data('type');

		if (typeof title === 'undefined') {
			title = 'Вы подтверждаете удаление?';
		}
		if (typeof type === 'undefined') {
			type = 'warning';
		}

		swal({
			title: title,
			type: type,
			showCancelButton: true,
			confirmButtonColor: '#ff3547',
			confirmButtonText: 'Удалить',
			cancelButtonText: 'Отмена',
			closeOnConfirm: true,
			closeOnCancel: true,
			html: false
		}, function(isConfirm) {
			if (isConfirm) {
				window.location = target;
			} else {
				return false;
			}
		});
	});


	// Ввод в поле только цифр
	$('.js-number').inputFilter(function(value) {
		return /^\d*$/.test(value);
	});

	// $(document).on('input', '.js-number', function(e) {
	// 	e.preventDefault();

	// 	this.value = this.value.replace(/[^0-9]/g, '');
	// });

	// Ввод в поле только цифр, точки и запятой
	$('.js-number-float').inputFilter(function(value) {
		return /^\d*[.,]?\d{0,2}$/.test(value);
	});
	// Заменяем запятую на точку
	$(document).on('input', '.js-number-float', function(e) {
		e.preventDefault();

		this.value = this.value.replace(/,/g, '.');
	});

	// $(document).on('input', '.js-number-float', function(e) {
	// 	e.preventDefault();

	// 	this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
	// });


	// Ввод в поле кол-во только цифры от 0
	$('.js-order-contenteditable').keyup(function(e) {
		e.preventDefault();
		var int = intval($(this).text()) || 0;
		$(this).text(int);
	});


	// Прячем / показываем sidebar
	$('.js-sidebar-toggle').on('click', function() {

		var hiddenState = $('.l-sidebar').hasClass('is_hidden') ? true : false;
		$('.l-sidebar').toggleClass('is_hidden');

		if ( ! hiddenState) {
			$('.l-container').toggleClass('is_hidden');
			$.cookie('hideSidebarState', 1, { expires: 1, path: '/admin' });
		} else {
			$('.l-container').toggleClass('is_hidden');
			$.removeCookie('hideSidebarState', { path: '/admin' });
		}
	});

});
