/* A polyfill for browsers that don't support ligatures. */
/* The script tag referring to this file must be placed before the ending body tag. */

/* To provide support for elements dynamically added, this script adds
   method 'icomoonLiga' to the window object. You can pass element references to this method.
*/
(function () {
	'use strict';
	function supportsProperty(p) {
		var prefixes = ['Webkit', 'Moz', 'O', 'ms'],
			i,
			div = document.createElement('div'),
			ret = p in div.style;
		if (!ret) {
			p = p.charAt(0).toUpperCase() + p.substr(1);
			for (i = 0; i < prefixes.length; i += 1) {
				ret = prefixes[i] + p in div.style;
				if (ret) {
					break;
				}
			}
		}
		return ret;
	}
	var icons;
	if (!supportsProperty('fontFeatureSettings')) {
		icons = {
			'menu': '&#xe5fe;',
			'bubble': '&#xe601;',
			'search': '&#xe602;',
			'previous': '&#xe603;',
			'prev': '&#xe603;',
			'next': '&#xe604;',
			'menulist': '&#xe605;',
			'list': '&#xe605;',
			'mail': '&#xe600;',
			'email': '&#xe600;',
			'rss': '&#xe606;',
			'feed': '&#xe606;',
			'play': '&#xe607;',
			'github': '&#xe608;',
			'flickr': '&#xe609;',
			'twitter': '&#xe60a;',
			'facebook': '&#xe60b;',
			'googleplus': '&#xe60c;',
			'pinterest': '&#xe60d;',
			'linkedin': '&#xe60e;',
			'rdio': '&#xe60f;',
			'instagram': '&#xe610;',
			'0': 0
		};
		delete icons['0'];
		window.icomoonLiga = function (els) {
			var classes,
				el,
				i,
				innerHTML,
				key;
			els = els || document.getElementsByTagName('*');
			if (!els.length) {
				els = [els];
			}
			for (i = 0; ; i += 1) {
				el = els[i];
				if (!el) {
					break;
				}
				classes = el.className;
				if (/icon-/.test(classes)) {
					innerHTML = el.innerHTML;
					if (innerHTML && innerHTML.length > 1) {
						for (key in icons) {
							if (icons.hasOwnProperty(key)) {
								innerHTML = innerHTML.replace(new RegExp(key, 'g'), icons[key]);
							}
						}
						el.innerHTML = innerHTML;
					}
				}
			}
		};
		window.icomoonLiga();
	}
}());