// classmod.js is a utility library for modifying css classes on DOM elements

window.addEventListener("load", classModInit, false);

function classModInit() {
	//console.log("initializing class mod");
}

var hasClass = function (el, classname) {
	return (el.className.split(" ").indexOf(classname) > -1);
};

var addClass = function (el, classname) {
	if (!hasClass(el, classname)) {
		var newClassName = el.className + " " + classname;
		newClassName = newClassName.trim();
		el.className = newClassName;
		//console.log("Adding " + classname + " since it was not present!");
	} else {
		//console.log(classname + " (addClass) was already present! Did nothing.");
	}
};

var elementClassExistsOrNot = function (el, classname) {
	if (hasClass(el, classname)) {
		console.log("(elementClassExistsOrNot) Element has the class: " + classname);
	} else {
		console.log("(elementClassExistsOrNot) Element doesn't have the class: " + classname);
	}
};

var removeClass = function (el, classname) {
	if (hasClass(el, classname)) {
		var elementClassArray = el.className.split(" ");

		classnameIndex = elementClassArray.indexOf(classname);
		//alert(classname + " has index: " + classnameIndex);

		removed = elementClassArray.splice(classnameIndex, 1);
		//console.log("removed: " + removed);
		//alert("Classes left: " + elementClassArray);

		var new_classNameString = "";
		for (var i = 0; i < elementClassArray.length; i++) {
			new_classNameString = new_classNameString + " " + elementClassArray[i];
		}
		el.className = new_classNameString.trim();
		//console.log(" (removeClass) Removed the class: '" + classname + "'");
	} else {
		//console.log(" (removeClass) class '" + classname + "' was not present. Did nothing.");
	}
};

var toggleClass = function (el, classname) {
	if (hasClass(el, classname)) {
		removeClass(el, classname);
	} else {
		addClass(el, classname);
	}
};

var displayClasses = function (idname) {
	var d = document.getElementById(idname);
	console.log(idname + " has " + d.className.split(' ').length + " classes: " + d.className);
};