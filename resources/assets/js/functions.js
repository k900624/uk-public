/*
  @author SillexLab (sillexlab@gmail.com)
  @copyright 2020

  functions
*/

// Confirm Action
function confirmMessage(title) {
	if (typeof title === 'undefined') {
		// title = $lang.confirmDelete;
	}

	if (confirm(title)) {
		return true;
	} else {
		return false;
	}
}


function loadMsg() {
	$.ajax({
		url: $siteUrl + '/ajax/loadMsg',
		dataType: 'json',
		success: function(response, textStatus, xhr) {
			if (response.status === 'on') {
				let msgs = response.messages;
				$.each(msgs, function(type, value) {
					if (value.length > 0) {
						let content = '';
						if (value.length > 1) {
							$.each(value, function(key, val) {
								content += val + '<br/>';
							});
						} else {
							content = value;
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


/**
 * Place the CSRF token as a header on all pages for access in AJAX requests
 */
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $csrfToken
	}
});

// Functions
// loadMsg();
// retriveMsg();

/**
* Load links and scripts
* after loading page
*
* Usage:
* addLinks([
*   "./fonts/font-awesome/css/font-awesome.min.css",
*   "./messenger/build/css/messenger.css",
* ], function() {});
*
* addScripts([
*   "./modernizr-3.5.0.min.js",
*   "./bootstrap/js/bootstrap.min.js",
* ], function() {});
*/
function addLinks(sources, callback) {
	let counter = 0;
	function onLoad() {
		counter++;
		if (counter == sources.length) callback();
	}
	for (let i = 0; i < sources.length; i++) {
		let link = document.createElement('link');
		// сначала onload/onerror, затем src - важно для IE8-
		link.onload = link.onerror = onLoad;
		link.href = sources[i];
		link.rel = 'stylesheet';
		document.body.appendChild(link);
	}
	return link;
}

function addScript(src) {
	let script = document.createElement('script');
	script.src = src;
	document.body.appendChild(script);
	return script;
}

function addScripts(scripts, callback) {
	let loaded = {}, // Для загруженных файлов loaded[i] = true
		counter = 0,
		loadTimeout = 0; // Отложенная загрузка, ms
	function onload(i) {
		if (loaded[i]) return; // лишний вызов onload
		loaded[i] = true;
		counter++;
		if (counter == scripts.length) callback();
	}
	for (let i = 0; i < scripts.length; i++)(function(i) {
		setTimeout(function() {
			let script = addScript(scripts[i]);
			script.onload = function() {
				onload(i);
			};
		}, loadTimeout);
	}(i));
}


// Display response error from server with ajax
function serverError(xhr, ajaxOptions, thrownError) {
	$('#server_error').remove();
	let errorText = '';
	errorText = xhr.status === 0 ? 'Not connect.\n Verify Network.' : xhr.status == 404 ? 'Requested page not found. [404]' : xhr.status == 500 ? 'Internal Server Error [500].' : ajaxOptions === 'parsererror' ? 'Requested JSON parse failed.' : ajaxOptions === 'timeout' ? 'Time out error.' : ajaxOptions === 'abort' ? 'Ajax request aborted.' : 'Uncaught Error.\n' + xhr.responseText;
	$('body').append('<div id="server_error" class="server_error">' + errorText + '<\/div>');
	$('#server_error').fadeIn(1e3).delay(1e3).fadeOut(3000, function() {
		$('#server_error').remove();
	});
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
