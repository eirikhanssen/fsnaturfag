window.addEventListener("load", currentPage, false);
	function currentPage() {
		console.log('currentPage()');
		var chapmenu = document.getElementById('chapmenu');
		var menulinks = chapmenu.getElementsByTagName('A');
		var tail = chapmenu.getAttribute('data-tail');
		var folder_level = parseInt(chapmenu.getAttribute('data-folder-level'));
		var folder = chapmenu.getAttribute('data-folder');
		var toc = document.getElementById('toc');
		var toc_filename, toc_folder, toc_links;
		if (toc !== null) {
			toc_filename = toc.getAttribute('data-filename');
			toc_links = toc.getElementsByTagName('A');
			for (var j = 0; j< toc_links.length; j++) {
				if(toc_links[j].getAttribute('href').indexOf(toc_filename) > -1) {
					addClass(toc_links[j], 'currentPage');
				}
			}
		}
		for (var i = 0; i < menulinks.length; i++) {
			if (menulinks[i].getAttribute('href').indexOf(chapmenu.getAttribute('data-tail')) > -1) {
				addClass(menulinks[i], 'currentPage');
			} else if (folder_level > 0 && menulinks[i].getAttribute('href').indexOf(chapmenu.getAttribute('data-folder')) > -1) {
				addClass(menulinks[i], 'currentPage');
			}
		}
	}