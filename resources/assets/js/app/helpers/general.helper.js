/**
 * @module helper/general
 */

 /**
 * set new title to document
 *
 * @param {string} title
 */
export function setDocumentTitle(title) {
	title = title || null;

	if (title) {
		let oldTitle = document.title;

		let array = oldTitle.split('|');
		document.title = title + ' | '+ array[1];

		return true;
	}
	return false;
}

/**
 * uses the browser's copy function to copy a string
 *
 * @param {string} stringToCopy
 */
export function copyToClipboard(stringToCopy) {
	const tempTextArea = document.createElement('textarea');
	tempTextArea.value = stringToCopy;
	document.body.appendChild(tempTextArea);
	tempTextArea.select();
	document.execCommand('copy');
	document.body.removeChild(tempTextArea);
}


/**
  * If a console object is defined (e.g: when using firebug, chrome developer tools),
  * this function uses it to display the given message. If no console object is defined
  * them message is just put away.
  *
  * @param {String} message the message
  */
export function log(message) {
	if (window.console) {
		window.console.log(message);
	}
}


/**
 * Simple hack for changing scrollTop on mobile, otherwise the page doesn't scroll
 */
export function mobileScrollTo(element, scrollPosition) {
	element.css('overflow-y', 'hidden');
	element.scrollTop(scrollPosition)
	element.css('overflow-y', 'auto');
  }
