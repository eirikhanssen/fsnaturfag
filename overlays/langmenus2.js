// language menu interaction
// when a primary language input is selected, set the same language input control for secondary language to disabled
// this prevents displaying the same language twice

// if the same language is selected two times, by first selecting a language on the right, then the same on the left
// then the right language should be removed

window.addEventListener("load", langMenusInit, false);
var primary_lang_controls, secondary_lang_controls, primary_lang_labels, secondary_lang_labels, all_lang_controls;

function langMenusInit () {
	console.log("initializing language menu interaction");
	addLanguageMenuBehaviour();
}

function addLanguageMenuBehaviour() {
	primary_lang_controls = document.querySelectorAll("#primary_language input");
	primary_lang_labels = document.querySelectorAll("#primary_language label");
	secondary_lang_controls = document.querySelectorAll("#secondary_language input");
	secondary_lang_labels = document.querySelectorAll("#secondary_language label");
	all_lang_controls = document.querySelectorAll("#lang_select input");

	// add selected class to preselected input elements.
	for (var i=0; i < all_lang_controls.length; i++) {
		toggleSelected(all_lang_controls[i]);
	}

	// add behaviour to input elements
	for (var i=0; i < primary_lang_controls.length; i++) {
		primary_lang_controls[i].addEventListener('click', primaryLanguageState,false);
	}

	for (var i=0; i < secondary_lang_controls.length; i++) {
		secondary_lang_controls[i].addEventListener('click', secondaryLanguageState,false);
	}
}

function primaryLanguageState(ev) {
	console.log(ev.target.id + " - primary - was clicked");
	for (var i=0; i < secondary_lang_controls.length; i++) {
		activateInput(secondary_lang_controls[i]);
	}
	for (var i=0; i < primary_lang_controls.length; i++) {
		toggleSelected(primary_lang_controls[i]);
	}
}

function secondaryLanguageState(ev) {
	var inactive_container = document.getElementById("inactive_languages");
	var target_container = document.getElementById("secondary_language_container");
	//inactive_container.appendChild(target_container.firstElementChild);

	console.log(ev.target.id + " - secondary - was clicked");
	var current_lang = ev.target.id.replace(/.*_([^_]+)$/,"$1");
	
	var el_id=current_lang+"c06-long";
	console.log("el id: "+el_id);
	target_container.appendChild(document.getElementById(el_id));
	
	console.log(current_lang);
	for (var i=0; i < secondary_lang_controls.length; i++) {
		toggleSelected(secondary_lang_controls[i]);
	}

	// add "dual" class to body if two languages are shown at the same time
	// remove this class if only one language is shown.
	switch (current_lang) {
		case 'none':
			removeClass(document.body, 'dual');
			break;
		default:
			addClass(document.body, 'dual');
			break;
	}
}

function activateInput(element) {
	element.disabled=false;
	removeClass(element.parentElement, 'disabled');
}

function deActivateInput(element) {
	element.disabled=true;
	addClass(element.parentElement, 'disabled');
}

function toggleSelected(element) {
	if(element.checked === true) {
		addClass(element.parentElement, 'selected');
	} else {
		removeClass(element.parentElement, 'selected');
	}
}