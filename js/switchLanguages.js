// language menu interaction
// Eirik Hanssen, (c) 2015

// Todo1: reset showslide and slidesync when playing audio to avoid collision
// if changing what language is played
// add event listener that will listen on all audio elements whent they start playing,
//	or when they are clicked.
//  remove class slidesync of all decendands of containing article
// remove class showslide from all decendants of other article

// Todo2: add forward/back buttons to click between slides
// Maybe use this solution: http://wam.inrialpes.fr/timesheets/slideshows/audio.html

// Todo3: add function to maximise main / show and hide language selection.

// Todo4: add possibility of clicking through slides, and playing the audio segment of // the slide only before pausing audio.

window.addEventListener("load", behaviourInit, false);
var primary_lang_controls,
	secondary_lang_controls,
	primary_lang_labels,
	secondary_lang_labels,
	all_lang_controls,
	primary_language_container,
	secondary_language_container,
	hidden_languages_container,
	all_languages = [],
	all_audio_elements = [],
	timesheetDOM;


function behaviourInit() {
	console.log("initializing language menu interaction");
	primary_lang_controls = document.querySelectorAll("#primary_language input");
	primary_lang_labels = document.querySelectorAll("#primary_language label");
	secondary_lang_controls = document.querySelectorAll("#secondary_language input");
	secondary_lang_labels = document.querySelectorAll("#secondary_language label");
	all_lang_controls = document.querySelectorAll("#lang_select input");
	primary_language_container = document.getElementById("primary_language_container");
	secondary_language_container = document.getElementById("secondary_language_container");
	hidden_languages_container = document.getElementById("hidden_languages_container");
	all_audio_elements = document.getElementsByTagName("audio");
	timesheetDOM
	addLanguageMenuBehaviour();
	console.log("adding article elements to array");
	var articles_in_document = document.getElementsByTagName("article");
	for (var i = 0; i < articles_in_document.length; i++) {
		if (articles_in_document[i].id.indexOf("language-contents") == 0) {
			var lang = articles_in_document[i].id.replace(/.+-(.+)$/, "$1");
			all_languages[i] = articles_in_document[i];
			//console.log(articles_in_document[i].id + ": pass");
		} else {
			//console.log(articles_in_document[i].id + ": fail");
		}
	}
	addAudioResetSlideSyncBehaviour();
}

function addAudioResetSlideSyncBehaviour() {
	for (var i = 0; i < all_audio_elements.length; i++) {
		all_audio_elements[i].addEventListener('play', resetOtherSlidesync, false);
	}
}

/*function eventualize(evt) {
	console.log(evt.target.nodeName + ' was eventualized!');
	var showslides = document.querySelectorAll('.showslide');
	for (var i = 0; i < showslides.length; i++) {
		removeClass(showslides[i], 'showslide');
		showslides[i].setAttribute('smil', 'idle');
		showslides[i].querySelectorAll("[smil]").setAttribute('smil', 'idle');
	}
}*/

function resetOtherSlidesync(evt) {
	var T = evt.target;
	var current_time = T.currentTime;
	var TP = T.parentElement;
	var TPID = TP.getAttribute('id');
	var showslides = document.querySelectorAll('.showslide');
	var playing = document.querySelectorAll('.playing');
	var active = document.querySelectorAll(['[smil="active"]']);
	for (var i = 0; i < showslides.length; i++) {
		// sjekk om showslides[i] er barn av samme article som audio element.
		/*if (showslides[i].parentElement !== TP) {
			removeClass(showslides[i], 'showslide');
		}*/
		removeClass(showslides[i], 'showslide');
	}
	for (var j = 0; j < playing.length; j++) {
		/*if (playing[i].parentElement !== TP) {
			removeClass(playing[j], 'playing')
		}*/
		removeClass(playing[j], 'playing')

	}

	for (var k = 0; k < active.length; k++) {
		// sjekk om showslides[i] er barn av samme article som audio element.
		/*if (active[k].parentElement !== TP) {
				active[k].setAttribute('smil', 'idle');
		}*/
		active[k].setAttribute('smil', 'idle');

	}



	console.log('audio: ' + T.getAttribute('id') + ' : ' + current_time);
}

function addLanguageMenuBehaviour() {
	// add selected class to preselected input elements.
	for (var i = 0; i < all_lang_controls.length; i++) {
		toggleSelectedDisplayStatus(all_lang_controls[i]);
	}

	// add behaviour to input elements
	for (var i = 0; i < primary_lang_controls.length; i++) {
		primary_lang_controls[i].addEventListener('change', primaryLanguageDisplayState, false);
	}

	for (var i = 0; i < secondary_lang_controls.length; i++) {
		secondary_lang_controls[i].addEventListener('change', secondaryLanguageDisplayState, false);
	}
}

function primaryLanguageDisplayState(ev) {
	//console.log(ev.target.id + " - primary - has changed");
	for (var i = 0; i < secondary_lang_controls.length; i++) {
		activateInput(secondary_lang_controls[i]);
	}
	for (var i = 0; i < primary_lang_controls.length; i++) {
		toggleSelectedDisplayStatus(primary_lang_controls[i]);
	}
	rotateLanguages();
}

function secondaryLanguageDisplayState(ev) {
	//console.log(ev.target.id + " - secondary - has changed");
	//console.log(current_lang);
	for (var i = 0; i < secondary_lang_controls.length; i++) {
		toggleSelectedDisplayStatus(secondary_lang_controls[i]);
	}

	rotateLanguages();
}

function activateInput(element) {
	element.disabled = false;
	removeClass(element.parentElement, 'disabled');
}

function deActivateInput(element) {
	element.disabled = true;
	addClass(element.parentElement, 'disabled');
}

function toggleSelectedDisplayStatus(element) {
	if (element.checked === true) {
		addClass(element.parentElement, 'selected');
	} else {
		removeClass(element.parentElement, 'selected');
	}
}

function rotateLanguages() {
	// put language in primary_language_container in hidden_languages_container
	// put language in secondary_language_container in hidden_languages_container
	// append primary selected lanuage to primary_language_container
	// append secondary selected language to secondary_language_container
	// set/unset 'dual' class on body

	if (secondary_language_container.getElementsByTagName("article").length > 0) {
		hidden_languages_container.appendChild(secondary_language_container.getElementsByTagName("article")[0]);
	}
	if (primary_language_container.getElementsByTagName("article").length > 0) {
		hidden_languages_container.appendChild(primary_language_container.getElementsByTagName("article")[0]);
	}

	if (language_selected(primary_lang_controls) === language_selected(secondary_lang_controls)) {
		primary_language_container.appendChild(getLanguageContentsElement(language_selected(primary_lang_controls)));
	} else {
		if (language_selected(primary_lang_controls) !== false) {
			primary_language_container.appendChild(getLanguageContentsElement(language_selected(primary_lang_controls)));
		}

		if (language_selected(secondary_lang_controls) !== false) {
			secondary_language_container.appendChild(getLanguageContentsElement(language_selected(secondary_lang_controls)));
		}
	}



	updateDualClassOnBody();

	resetSyncDisplay();

	//console.log("pri: "+language_selected(primary_lang_controls));
	//console.log("sec: "+language_selected(secondary_lang_controls));
}



function resetSyncDisplay() {
	var played_elements = document.querySelectorAll(".playing");
	// bad idea to remove "playing" class after all
	//for (var i = 0; i < played_elements.length; i++) {
	//	removeClass(played_elements[i], 'playing');
	//}
	var smil_active_elements = document.querySelectorAll("[smil=active]");
	for (var i = 0; i < smil_active_elements.length; i++) {
		smil_active_elements[i].setAttribute('smil', 'idle');
	}
}

function getLanguageContentsElement(str) {
	// receive language string , "ar" | "no" | "so" | "ti";
	// return languageContainerElement of the appropriate language
	var languageContainerElement;
	for (var i = 0; i < all_languages.length; i++) {
		if (all_languages[i].id.replace(/^.+-([^-]+)$/, '$1') == str) {
			return all_languages[i];
		}
	}
	return false;
}

function language_selected(lang_controls_array) {
	// return language code string of selected input in param lang_controls_array or false
	// returns the last part of the id-string after the final underscore, that's how the language
	// code is represented in the id's
	var selected_language;
	for (var i = 0; i < lang_controls_array.length; i++) {
		if (lang_controls_array[i].checked === true) {
			selected_language = lang_controls_array[i].id.replace(/.+_(.+)$/, "$1");
			if (selected_language !== "none")
				return (selected_language);
		}
	}
	return false;
}

function updateDualClassOnBody() {
	// if there is language content (article element) in both
	// primary_language_container and secondary_language_container,
	// make sure that body has the 'dual' class.
	// otherwise, make sure body doesn't have the 'dual' class
	if (secondary_language_container.getElementsByTagName("article").length + primary_language_container.getElementsByTagName("article").length > 1) {
		addClass(document.body, 'dual');
	} else {
		removeClass(document.body, 'dual');
	}
}