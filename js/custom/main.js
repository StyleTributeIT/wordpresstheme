(function($) {
	$(document).ready(function() {
		st.initMainMenu();
		st.initExternalLinks();
		st.initFooterMenu();
	});

	window.styleTribute = window.styleTribute || {};
	var st = window.styleTribute;
	st.initExternalLinks = function() {
		$('a[rel="external"]').attr('target', '_blank');
	};
	st.initFooterMenu = function() {
		$('#menu-secondary-menu > li > a').on('click', function(e) {
			e.preventDefault();
		});
	};
	st.initMainMenu = function() {
		if ($.fn.horizontalNav) {
			var $menuItems = $('#menu-main-menu > .menu-item'),
				menuItemsSize = $menuItems.size();
			if (menuItemsSize != undefined) {
				var menuItemWidth = 100 / menuItemsSize;
				$menuItems.css('width', menuItemWidth + '%');
			}
			$('.horizontal-nav > div').horizontalNav();
		}
	};
	st.bookmark = function(x) {
		var url   = location.href;
		var title = document.title;
		if ((typeof window.sidebar == "object")
			 && (typeof window.sidebar.addPanel == "function")
			 && (window.sidebar.addPanel != undefined)) {
			window.sidebar.addPanel(title, url, "");
		}
		else if ((typeof window.external == "object")
				 && (typeof window.external.AddFavorite == "function")
				 && (window.external.AddFavorite != undefined)) {
			window.external.AddFavorite(url, title);
		}
		else if (window.opera) {
			x.href  = url;
			x.title = title;
			x.rel   = "sidebar";
			return true;
		}
		else alert("Press Ctrl+D");
		return true;
	};
})(jQuery);
