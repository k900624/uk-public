/*
  @author SillexLab (sillexlab@gmail.com)
  @copyright 2020

  functions scripts
*/

// Вывод сообщений о подтверждении удаления
function confirmMessage(title, type) {

	if (typeof title === 'undefined') {
		title = 'Вы подтверждаете удаление?';
	}
	if (typeof type === 'undefined') {
		type = 'warning';
	}

	// Не работает, нужен promise
	// swal({
	//	title: title,
	//		type: type,
	//		showCancelButton: true,
	//		confirmButtonColor: '#ff3547',
	//		confirmButtonText: 'Удалить',
	//		cancelButtonText: 'Отмена',
	//		closeOnConfirm: true,
	//		closeOnCancel: true,
	//		html: false
	// }, function(isConfirm) {
	//		if (isConfirm) {
	//			return true;
	//		} else {
	//			return false;
	//		}
	// });
	// return false;
	
	if (confirm(title)) {
		return true;
	} else {
		return false;
	}
}

function loadMsg() {
	$.ajax({
		url: $siteUrl +'/ajax/loadMsg',
		dataType: 'json',
		success: function(response, textStatus, xhr) {
			if (response.status === 'on') {
				var msg = response.messages;
				$.each(msg, function(type, value) {
					if (value.length > 0) {
						if (value.length > 1 ) {
							var content = '';
							$.each(value, function(key, val) {
								content += val +'<br/>';
							});
						} else {
							var content = value;
						}
						notifyAdd(content, type);
					}
				});
			}
		},
		global: false
	});
}
function retriveMsg() {
	$(document).ajaxStop(function() {
		loadMsg();
	});
}


// Транслитерация заголовка
function transliteTitle(from, to, id) {
	var url = $adminUrl +'/ajax/translite_title',
		str = $(from).val();

	if (str === '') {
		notifyAdd('Сначала нужно ввести название', 'info');
		return false;
	}

	$.post(
		url, {
			'str' : str,
			'id' : id,
			'_token': $csrfToken
		}, function(response) {
			$(to).val(response);
		}
	);
}


// Вывод ответа от сервера при ошибке ajax запроса
function serverError(xhr, ajaxOptions, thrownError) {
	var errorContainer = $('#server_error'),
		errorText = '';
	errorContainer.remove();
	errorText = xhr.status === 0 ? 'Not connect.\n Verify Network.' : xhr.status === 404 ? 'Requested page not found. [404]' : xhr.status === 500 ? 'Internal Server Error [500].' : ajaxOptions === 'parsererror' ? 'Requested JSON parse failed.' : ajaxOptions === 'timeout' ? 'Time out error.' : ajaxOptions === 'abort' ? 'Ajax request aborted.' : 'Uncaught Error.\n' + xhr.responseText;
	$('body').append('<div id="server_error" class="server_error">' + errorText + '<\/div>');
	errorContainer.fadeIn(1e3).delay(1e3).fadeOut(3000, function() {
		errorContainer.remove();
	});
}


// Вывод оповещения в header блока или виджета
function widgetMessage(headerWidget, message, type) {
	headerWidget.find('.js-widget-message').remove();
	headerWidget.append('<span class="js-widget-message badge badge-'+ type +'">'+ message +'</span>');

	setTimeout(function() {
		$('.js-widget-message').animate({'opacity':'0'}, 'slow', '', function() {
			this.remove();
		}
	)}, 1000);
}


/**
 * notifyAdd
 * @example notifyAdd('Hello world', 'success');
 */
function notifyAdd(content, type) {
	Messenger.options = {
		extraClasses: 'messenger-fixed messenger-on-top messenger-on-right',
		theme: 'air'
	}
	Messenger().post({
		message: content,
		type: type,
		hideAfter: 10,
		showCloseButton: true
	});
}


/** 
 * функция заменяет get-параметр в строке параметров uri
 * (либо добавляет, либо удаляет, если передать val='')
 */
function setAttr(prmName, val) {
	var res = '',
		h = $uri.split('#'),
		d = h[0].split('?'),
		base = d[0],
		query = d[1];

	if (query) {
		var params = query.split('&');
		for (var i = 0; i < params.length; i++) {
			var keyval = params[i].split('=');

			if (keyval[0] !== prmName) {
				res += params[i] + '&';
			}
		}
	}
	if (val !== '') res += prmName + '=' + val;
	return base + '?' + res;
}
