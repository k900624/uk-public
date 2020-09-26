/*
  @author SillexLab (sillexlab@gmail.com)
  @copyright 2020

  main scripts
*/


// let btnOnTop = $('#scroll-top');
// $(window).on('load scroll', function() {

	// if ($(window).scrollTop() > $(window).height() / 2) {
		// btnOnTop.addClass('active');
	// } else {
		// btnOnTop.removeClass('active');
	// }

// });

$(document).ready(function() {

	$('#toggle-chat').on('click', function(event) {
	    event.preventDefault();
	    $(this).hide();
	    $('#body-chat').show();
	});
	$('#close-chat').on('click', function(event) {
	    event.preventDefault();
	    $('#toggle-chat').show();
	    $('#body-chat').hide();
	});
	$('#icon-chat-file').off('click').on('click', function (e) {
	    e.preventDefault();
	    $('#chat-file').trigger('click');
	});

	// let viewPort = viewport(),
		// windowWidth = viewPort.width,
		// windowHeight = viewPort.height;


	// btnOnTop.on('click', function(e) {
		// e.preventDefault();
		// $('html, body').stop().animate({scrollTop: 0}, 'slow', 'swing');
	// });

	// pure Js
	// function runScroll() {
	// 	scrollTo(document.body, 0, 600);
	// }
	// let scrollme;
	// scrollme = document.querySelector("#scroll-top");
	// scrollme.addEventListener("click",runScroll,false)

	// function scrollTo(element, to, duration) {
	// 	if (duration <= 0) return;
	// 	let difference = to - element.scrollTop;
	// 	let perTick = difference / duration * 10;

	// 	setTimeout(function() {
	// 		element.scrollTop = element.scrollTop + perTick;
	// 		if (element.scrollTop == to) return;
	// 		scrollTo(element, to, duration - 10);
	// 	}, 10);
	// }


	// setTimeout(function() {
	// 	$('.loader-container').addClass('hide');
	// }, 100);


	// $(document).on('click', '.form-control ~ .js-lock', function(e) {
	// 	e.preventDefault();
	// 	let icon = $(this),
	// 		input = icon.prevAll('.form-control');

	// 	if (input.val()) {
	// 		setTimeout(function() {
	// 			if (icon.hasClass('icon-lock')) {
	// 				input.attr('type', 'text');
	// 				icon.removeClass('icon-lock').addClass('icon-unlock');
	// 			} else {
	// 				input.attr('type', 'password');
	// 				icon.removeClass('icon-unlock').addClass('icon-lock');
	// 			}
	// 		}, 500);
	// 	}
	// });


	//SVG Fallback
	// if (!Modernizr.svg) {
	// 	$('img[src*="svg"]').attr('src', function() {
	// 		return $(this).attr('src').replace('.svg', '.png');
	// 	});
	// };

	// $('img[src$=".svg"]').each(function() {
	// 	let $img = jQuery(this),
	// 		imgURL = $img.attr('src'),
	// 		attributes = $img.prop('attributes');

	// 	$.get(imgURL, function(data) {
	// 		// Get the SVG tag, ignore the rest
	// 		let $svg = jQuery(data).find('svg');
	// 		// Remove any invalid XML tags
	// 		$svg = $svg.removeAttr('xmlns:a');
	// 		// Loop through IMG attributes and apply on SVG
	// 		$.each(attributes, function() {
	// 			$svg.attr(this.name, this.value);
	// 		});
	// 		// Replace IMG with SVG
	// 		$img.replaceWith($svg);
	// 	}, 'xml');
	// });


	// $('[data-href]').on('click', function() {
		// let href = $(this).data('href');
		// window.open(href);
	// });


	// Navbar-toggle
	// $('.js-navbar-toggle').on('click', function() {
	// 	let toggle = $(this).data('toggle');
	// 	$('body').toggleClass(toggle);
	// 	$(this).toggleClass('is-active');
	// });

	// $('.l-content').on('click', function() {
	// 	$('body').removeClass('navbar-nav-show');
	// 	$('.hamburger').removeClass('is-active');
	// });


	// (function() {
	// 	'use strict';

	// 	let cookieAlert = $('.cookiealert'),
	// 		acceptCookies = $('.acceptcookies');

	// 	if (!cookieAlert) return false;

	// 	cookieAlert.offsetHeight; // Force browser to trigger reflow (https://stackoverflow.com/a/39451131)

	// 	if (!$.cookie('accept_cookies')) {
	// 		cookieAlert.addClass('show');
	// 	}

	// 	acceptCookies.on('click', function() {
	// 		$.cookie('accept_cookies', true, {expires: 7, path: '/'});
	// 		cookieAlert.removeClass('show');
	// 	});
	// }());


	// Загрузка скрипта при скроле до гугл карт
	// (function() {
	// 	if ($('#maps').length > 0) {
	// 		window.onscroll = function() {
	// 			let scrollingObj = document.scrollElement || document.documentElement,
	// 				currentBottomOfScrolledViewPort = window.innerHeight + scrollingObj.scrollTop,
	// 				offsetTopOfMapContainer = document.querySelector('#maps').offsetTop;

	// 			if (currentBottomOfScrolledViewPort >= offsetTopOfMapContainer) {
	// 				let el = document.createElement('script');
	// 				el.src = 'https://maps.googleapis.com/maps/api/js?callback=initMap&key=' + googleMapsKey + '&libraries=places';
	// 				document.body.appendChild(el, document.body.firstElementChild);

	// 				window.onscroll = null;
	// 			}
	// 		}
	// 	}
	// }());

});
