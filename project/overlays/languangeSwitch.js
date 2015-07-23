// this code is unused because the event-handling can be done in interactive xslt
		window.addEventListener("load", init, false);
		var language_data_files = {
			no: "no-chap06-long-001.xml",
			ar: "ar-chap06-long-001.xml"
		};

		function init() {
			console.log("The document has loaded.");
			addLanguageSelectBehaviour();
		}

		function addLanguageSelectBehaviour() {
			var lang_select_inputs = document.querySelectorAll('#lang_select input');
			console.log(lang_select_inputs.length + " language select inputs detected");
			for (var i=0; i < lang_select_inputs.length; i++) {
				console.log("lang_select: " + i + ": " + lang_select_inputs[i].id + " " + lang_select_inputs[i].checked);
				lang_select_inputs[i].addEventListener("click", function(){switchLanguage(event);},false);
			}
		}
		function switchLanguage(ev) {
			console.log(ev.target.id + " was clicked ");
			var language = ev.target.id.replace(/.+_(\w+)$/,"$1");
			var primary_lang_regex = /^primary/;
			var secondary_lang_regex = /^secondary/;
			var is_primary = primary_lang_regex.exec(ev.target.id);
			var is_secondary = secondary_lang_regex.exec(ev.target.id);
			if (is_primary) {
				switchPrimaryLanguage(language);
			} else if (is_secondary) {
				switchSecondaryLanguage(language);
			} else {
				console.log("clicked input is neither primary or secondary language, this means error in the code.");
			}
		}
		function switchPrimaryLanguage(language) {
			console.log("switching primary language to: " + language);
			var language_transformation = document.getElementById("language_transformation");
			switch (language) {
				case 'none':
					console.log("disabling language");
					break;
				default:
					language_transformation.setAttribute('data-source', language_data_files[language]);
					console.log("switching to: " + language_data_files[language]);
					break;
				case 'ti':
					console.log("ti language not added yet");
					break;
				case 'so':
					console.log("so language not added yet");
					break;
			}
		}
		function switchSecondaryLanguage(language) {
			console.log("switching secondary language to: " + language);
		}
