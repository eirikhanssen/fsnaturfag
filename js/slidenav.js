window.addEventListener("load", slidenavInit, false);

var slide_controls;

/*var slidenavInit = (function () {
	console.log("foo! bar ! slidenav!! foo!");
	slidevar = "some random foo";
}());*/

function slidenavInit() {
	console.log("foo! bar ! slidenav!! foo!");
	
	// get all control buttons
	slide_controls = document.querySelectorAll('.smil-timeController');
	
	for (var i = 0; i< slide_controls.length; i++) {
		console.log('adding control to: ');
		addSlideControls(slide_controls[i]);
		
	}

}

var sm = function () {
	console.log(slide_control_buttons.length);
};

var addSlideControls = function (el) {
	var audioElementToControl = el.parentNode.getElementsByTagName('audio')[0];
	var controlButtons = el.getElementsByTagName('button');
	console.log(audioElementToControl.getAttribute('id'));
	for (var i = 0; i< controlButtons.length; i++) {
		switch (controlButtons[i].getAttribute('class')) {
			case "smil-play":
				console.log('found a play button');
				controlButtons[i].addEventListener("click", 
					function() {
						playAudio(audioElementToControl);
					}, false);
				break;
			default:
				break;
		}
	}
};

var playAudio = function (audioElement) {
	console.log('playAudio() called on ' + audioElement.getAttribute('id'));
	if (audioElement.paused === true) {
		audioElement.play();
	} else {
		audioElement.pause();
	}
}



// Play/Pause knapp
// 1) få tak i audio element som er i samme språk