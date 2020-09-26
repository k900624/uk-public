// userAgent
if (!window._ua) {
	var _ua = navigator.userAgent.toLowerCase();
}
const browser = {
	version: (_ua.match(/.+(?:me|ox|on|rv|it|era|opr|ie)[\/: ]([\d.]+)/) || [0, '0'])[1],
	opera: (/opera/i.test(_ua) || /opr/i.test(_ua)),
	vivaldi: /vivaldi/i.test(_ua),
	msie: (/msie/i.test(_ua) && !/opera/i.test(_ua) || /trident\//i.test(_ua)) || /edge/i.test(_ua),
	msie6: (/msie 6/i.test(_ua) && !/opera/i.test(_ua)),
	msie7: (/msie 7/i.test(_ua) && !/opera/i.test(_ua)),
	msie8: (/msie 8/i.test(_ua) && !/opera/i.test(_ua)),
	msie9: (/msie 9/i.test(_ua) && !/opera/i.test(_ua)),
	msie_edge: (/edge/i.test(_ua) && !/opera/i.test(_ua)),
	mozilla: /firefox/i.test(_ua),
	chrome: /chrome/i.test(_ua) && !/edge/i.test(_ua),
	safari: (!(/chrome/i.test(_ua)) && /webkit|safari|khtml/i.test(_ua)),
	iphone: /iphone/i.test(_ua),
	ipod: /ipod/i.test(_ua),
	iphone4: /iphone.*OS 4/i.test(_ua),
	ipod4: /ipod.*OS 4/i.test(_ua),
	ipad: /ipad/i.test(_ua),
	android: /android/i.test(_ua),
	bada: /bada/i.test(_ua),
	mobile: /iphone|ipod|ipad|opera mini|opera mobi|iemobile|android/i.test(_ua),
	msie_mobile: /iemobile/i.test(_ua),
	safari_mobile: /iphone|ipod|ipad/i.test(_ua),
	opera_mobile: /opera mini|opera mobi/i.test(_ua),
	opera_mini: /opera mini/i.test(_ua),
	mac: /mac/i.test(_ua),
	search_bot: /(yandex|google|stackrambler|aport|slurp|msnbot|bingbot|twitterbot|ia_archiver|facebookexternalhit)/i.test(_ua)
};

// helpers
function rand(mi, ma) {
	return Math.random() * (ma - mi + 1) + mi;
}

function irand(mi, ma) {
	return Math.floor(rand(mi, ma));
}

function sxRand() {
	return Math.round(rand(0, 100));
}

function isFunction(obj) {
	return Object.prototype.toString.call(obj) === '[object Function]';
}

function isArray(obj) {
	return Object.prototype.toString.call(obj) === '[object Array]';
}

function isObject(obj) {
	return Object.prototype.toString.call(obj) === '[object Object]' && !(browser.msie8 && obj && obj.item !== 'undefined' && obj.namedItem !== 'undefined');
}

function isEmpty(o) {
	if (Object.prototype.toString.call(o) !== '[object Object]') {
		return false;
	}
	for (let i in o) {
		if (o.hasOwnProperty(i)) {
			return false;
		}
	}
	return true;
}

function sxNow() {
	return +new Date;
}

function sxImage() {
	return window.Image ? (new Image()) : ce('img');
} // IE8 workaround

function trim(text) {
	return (text || '').replace(/^\s+|\s+$/g, '');
}

function stripHTML(text) {
	return text ? text.replace(/<(?:.|\s)*?>/g, '') : '';
}

function escapeRE(s) {
	return s ? s.replace(/([.*+?^${}()|[\]\/\\])/g, '\\$1') : '';
}

function intval(value) {
	if (value === true) return 1;
	return parseInt(value) || 0;
}

function floatval(value) {
	if (value === true) return 1;
	return parseFloat(value) || 0;
}

function inArray(elem, arr, i) {
	return arr === null ? -1 : indexOf.call(arr, elem, i);
}

function positive(value) {
	value = intval(value);
	return value < 0 ? 0 : value;
}

function winToUtf(text) {
	return text.replace(/&#(\d\d+);/g, function(s, c) {
		c = intval(c);
		return (c >= 32) ? String.fromCharCode(c) : s;
	}).replace(/&quot;/gi, '"').replace(/&lt;/gi, '<').replace(/&gt;/gi, '>').replace(/&amp;/gi, '&');
}

function replaceEntities(str) {
	return se('<textarea>' + ((str || '').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;')) + '</textarea>').value;
}

function clean(str) {
	return str ? str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;') : '';
}

function unclean(str) {
	return replaceEntities(str.replace(/\t/g, "\n"));
}


// Запуск ф-ции после окончания
// рендеринга предыдущего задания (вместо setTimeOut)
// См. у Дм. Лаврика - Javascipt и анимации - взаимодействие с CSS
//
//  raf(function() {
//	$(class).addClass('qwerty');
//  });
function raf(fn) {
	window.requestAnimationFrame(function() {
		window.requestAnimationFrame(function() {
			fn();
		});
	});
}


// Display all property and
// methods of object
function printObject(obj) {
	let res = '<ul>';

	for (i in obj) {
		res += '<li><strong>' + i + '</strong>: ' + obj[i] + '</li>';
	}
	res += '<ul>';
	document.write(res);
}


// Random integer
// between min и max
function mtRand(min, max) {
	return Math.floor(Math.random() * (max - min + 1));
}


// Return real screen width
function viewport() {
	let e = window, a = 'inner';
	if (!('innerWidth' in window)) {
		a = 'client';
		e = document.documentElement || document.body;
	}
	return {width: e[a + 'Width'], height: e[a + 'Height']};
}


// Прижимаем футер к низу,
// для браузеров, которые не поддерживают flex
(function fixFlex() {
	let obj = document.body || document.documentElement,
		s = obj.style,
		wrapper = $('.l-wrapper');

	// Прекращаем выполнение, если браузер поддерживает flex
	if (s.webkitFlexWrap === '' || s.msFlexWrap === '' || s.flexWrap === '') {
		return true;
	}
	// Обнуляем отступ
	wrapper.css('paddingBottom', 0);

	let footerH = $('.l-footer').outerHeight(),
		topH = $('.l-header').outerHeight(),
		widH = $(window).height(),
		sum = footerH + topH + wrapper.outerHeight(),
		padding = widH - sum;

	if (widH > sum) {
		wrapper.css('paddingBottom', padding);
	} else {
		wrapper.css('paddingBottom', 0);
	}
}());
