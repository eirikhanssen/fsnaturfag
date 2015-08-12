window.addEventListener("load", currentPage, false);
	function currentPage() {
		var chapmenu = document.getElementById('chapmenu');
		var menulinks = chapmenu.getElementsByTagName('A');
		var tail = chapmenu.getAttribute('data-tail');
		var folder_level = parseInt(chapmenu.getAttribute('data-folder-level'));
		var folder = chapmenu.getAttribute('data-folder');
		console.log('currentPage()');
		for (var i = 0; i < menulinks.length; i++) {
			if (menulinks[i].getAttribute('href').indexOf(chapmenu.getAttribute('data-tail')) > -1) {
				addClass(menulinks[i], 'currentPage');
			} else if (folder_level > 0 && menulinks[i].getAttribute('href').indexOf(chapmenu.getAttribute('data-folder')) > -1) {
				addClass(menulinks[i], 'currentPage');
			}
		}
	}