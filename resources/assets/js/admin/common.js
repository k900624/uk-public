/*
  @author SillexLab (sillexlab@gmail.com)
  @copyright 2020

  common scripts
*/

$(document).ready(function() {

	/**
	 * Place the CSRF token as a header on all pages for access in AJAX requests
	 */
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $csrfToken
		}
	});

	$('.js-order-contenteditable').on('blur', function() {
		var order = $(this).text(),
			id = $(this).data('id'),
			object = $(this).data('object'),
			json = {'id' : id, 'object': object, 'order' : order},
			url = $adminUrl +'/ajax/ordering_edit';

		$.post(url, json, function(response) {
			if (response.type === 'success') {
				window.location.reload();
			}
		});
	});


	$(document).on('submit', '#ajax-email-form', function(e) {
		e.preventDefault();

		var form = $(this);

		$.ajax({
			type: 'post',
			url: $adminUrl +'/feedback/store',
			data: form.serialize(),
			dataType: 'json',
			beforeSend: function() {
				$('#email-message').remove();
			},
			success: function(response, textStatus, xhr) {
				if (response.type === 'success') {
					form[0].reset();
					$('.modal').modal('hide');
					notifyAdd(response.message, 'success');
				} else {
					form.before('<div id="email-message" class="alert alert-'+ response.type +'">'+ response.message +'</div>');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				serverError(xhr, ajaxOptions, thrownError);
			}
		});
	});


	$(document).on('submit', '#set-meters-form', function(e) {
		e.preventDefault();

		var form = $(this)
			url = form.attr('action');

		$.ajax({
			type: 'post',
			url: url,
			data: form.serialize(),
			dataType: 'json',
			beforeSend: function() {
				$('#meters-message').remove();
			},
			success: function(response, textStatus, xhr) {
				if (response.type === 'success') {
					form[0].reset();
					$('.modal').modal('hide');
					notifyAdd(response.message, 'success');
					window.location.reload();
				} else {
					form.before('<div id="meters-message" class="alert alert-'+ response.type +'">'+ response.message +'</div>');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				serverError(xhr, ajaxOptions, thrownError);
			}
		});
	});


	$(document).on('submit', '#ajax-tariff-form', function(e) {
		e.preventDefault();

		var form = $(this);

		$.ajax({
			type: 'post',
			url: $adminUrl +'/registry/update',
			data: form.serialize(),
			dataType: 'json',
			beforeSend: function() {
				form.find('.has-spinner').buttonLoader('start');
				$('#email-message').remove();
			},
			success: function(response, textStatus, xhr) {
				form.find('.has-spinner').buttonLoader('stop');
				if (response.type === 'success') {
					form[0].reset();
					$('.modal').modal('hide');
					notifyAdd(response.message, 'success');
					window.location.reload();
				} else {
					form.before('<div id="email-message" class="alert alert-'+ response.type +'">'+ response.message +'</div>');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				form.find('.has-spinner').buttonLoader('stop');
				serverError(xhr, ajaxOptions, thrownError);
			}
		});
	});


	$('#my-notes').on('change', function(e) {
		var notes = $(this).val(),
			headerWidget = $(this).parents('.block').find('.block_header h2');

		if (notes.length > 0) {
			$.ajax({
				type: 'post',
				url: $adminUrl +'/ajax/ajax_save_notes',
				data: {'notes' : notes},
				dataType: 'json',
				beforeSend: function() {
					widgetMessage(headerWidget, 'Сохранение', 'warning');
				},
				success: function(response, textStatus, xhr) {
					if (response === 'error') {
						widgetMessage(headerWidget, 'Ошибка', 'danger');
					}
					widgetMessage(headerWidget, 'Сохранено', 'success');
					return true;
				},
				error: function(xhr, ajaxOptions, thrownError) {
					serverError(xhr, ajaxOptions, thrownError)
				}
			});
		}
	});


	$('.js-my-notes-clear').on('click', function(e) {
		e.preventDefault();

		var headerWidget = $(this).parents('.block').find('.block_header h2');

		if (confirmMessage()) {
			$.ajax({
				type: 'post',
				url: $adminUrl +'/ajax/ajax_save_notes',
				data: {'notes': ''},
				dataType: 'json',
				success: function(response, textStatus, xhr) {
					if (response === 'error') {
						widgetMessage(headerWidget, 'Ошибка', 'danger');
					}
					$('#my-notes').val('');
					return true;
				},
				error: function(xhr, ajaxOptions, thrownError) {
					serverError(xhr, ajaxOptions, thrownError)
				}
			});
		}
	});


	$(document).on('click', '.js-todo-add-action', function() {
		var newTodoId = (typeof newTodoId !== 'undefined') ? newTodoId : $(this).data('new-todo-id'),
			toAdd = $('.js-todo-add-input').val(),
			headerWidget = $(this).parents('.block').find('.block_header h2');

		if (toAdd === '') {
			widgetMessage(headerWidget, 'Добавьте задачу!', 'warning');
			return false;
		}

		$('.todo-items').append('<li class="todo-item" data-todo-id="'+ newTodoId +'"><div class="checkbox"><label><input type="checkbox" class="js-todo-item-checkbox"><span class="todo-item-title">' + toAdd + '</span></label></div><span class="todo-item-action-remove js-todo-item-action-remove">×</span></li>');

		$('.js-todo-add-input').val('');

		var json = {'title': toAdd, 'action': 'add'};
		$.post($adminUrl +'/ajax/ajax_todo', json, function(response) {
			widgetMessage(headerWidget, 'Добавлено', 'success');
			newTodoId++;
		});
		
	});


	$(document).on('keyup', '.js-todo-add-input', function(e) {
		if (e.keyCode === 13) {
			$('.js-todo-add-action').click();
		}
	});


	$(document).on('click', '.js-todo-item-action-remove', function() {
		if (confirmMessage()) {
			var todoItem = $(this).parents('.todo-item'),
				id = todoItem.data('todo-id'),
				headerWidget = $(this).parents('.block').find('.block_header h2');
			todoItem.fadeOut('slow');

			var json = {'id': id, 'action': 'delete'};
			$.post($adminUrl +'/ajax/ajax_todo', json, function(response) {
				widgetMessage(headerWidget, 'Удалено', 'success');
			});
		}
	});


	$('.js-todo-clear').on('click', function(e) {
		e.preventDefault();
		if (confirmMessage()) {
			$('.todo-item').fadeOut('slow');

			var json = {'action': 'clear'};
			$.post($adminUrl +'/ajax/ajax_todo', json);
		}
	});


	$(document).on('change', '.js-todo-item-checkbox', function() {
		var todoItem = $(this).parents('.todo-item'),
			id = todoItem.data('todo-id'),
			status = ($(this).is(':checked')) ? 1 : 0;
		
		todoItem.toggleClass('strike');

		var json = {'id': id, 'status': status, 'action': 'edit'};
		$.post($adminUrl +'/ajax/ajax_todo', json);
	});
	
	
	// Check unique the alias
	$('.js-check-unique-alias').on('input', function() {
		var url = $adminUrl +'/ajax/check_unique_alias',
			alias = $(this).val(),
			table = $(this).data('table'),
			id = $(this).data('id'),
			inputGroup = $(this).parent('.input-group'),
			label = '<label class="error">Такой "ЧПУ URL" уже существует! Он должен быть уникальным</label>',
			ths = $(this);
			
		ths.removeClass('error');
		if (inputGroup.length) {
			inputGroup.next('label.error').remove();
		} else {
			ths.next('label.error').remove();
		}
		
		$.post(
			url, {
				'id' : id,
				'alias' : alias,
				'table' : table
			}, function(response) {
				
				if (response.status === 'error') {
					ths.removeClass('valid');
					ths.addClass('error');
					
					if (inputGroup.length) {
						inputGroup.next('label.error').remove();
						inputGroup.after(label);
					} else {
						ths.next('label.error').remove();
						ths.after(label);
					}
				}
				
			}
		);
	});

});
