function switchPrimaryLanguage(ev) {
	// will be called on change event of the language input buttons
	
	// set/unset 'dual' class on body element depending on presence of language in secondary_language_container
	var new_language = getLanguageFromElId(ev.target);
	var new_language_id = "language-contents-"+new_language;
	var new_language_contents = document.getElementById(new_language_id);
	
	// move language in primary_language_container into hidden_languages_container.
	if (primary_language_container.getElementsByTagName("article").length > 0) {
		hidden_languages_container.appendChild(primary_language_container.getElementsByTagName("article")[0]);
	} else {
		console.log("switchPrimaryLanguage(ev): primary language container was empty");
	}
	
	// check if secondary_language_container is empty
	// if it is empty, check if one of the inputs is checked
	// if it is checked and is not the same language as in primary_language_container and is not 'none'
	// then add language to that container before adding the new language to the primary language container.

	// need a helper func to return what language is selected and a helper func to return what language is contained?
	
	// append selected language to primary_language_container, but only if this language is not checked in secondary_language_controls
	primary_language_container.appendChild(new_language_contents);
	
	console.log("pri: " + language_selected(primary_lang_controls));
	console.log("sec: " + language_selected(secondary_lang_controls));
	
	updateDualClassOnBody();
	console.log("switchPrimaryLanguage() called, switch to: " + new_language);
}
