$(document).ready(function() {

	OldBrowsers.RemoveIframeBorder();
	OldBrowsers.RedrawPseudoElements();
	
});

var OldBrowsers = (function() {
	return {

		//	1) Clones iframes and adds non-compliant "frameBorder" attribute
		//	2) Inserts clone after original element
		//	3) Removes original element
		//	Note: Simply adding the attribute to the existing iframe doesn't work
		RemoveIframeBorder: function() {
			var iframes = $("iframe");
			if (iframes.length) {
				iframes.each(function() {
					var iframeClone = $(this).clone().attr("frameBorder", 0);
					$(this).after(iframeClone);
					$(this).remove();
				});
			}
		},

		// Fixes fonts used within pseudo elements only displaying on hover in IE8 (XP)
		RedrawPseudoElements: function() {
			var head = document.getElementsByTagName('head')[0],
			    style = document.createElement('style');
			style.type = 'text/css';
			style.styleSheet.cssText = ':before,:after{content:none !important';
			head.appendChild(style);
			setTimeout(function(){
			    head.removeChild(style);
			}, 0);
		}

	}
})();