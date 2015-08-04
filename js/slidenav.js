window.addEventListener("load", slidenavInit, false);

var slide_controls;

/*var slidenavInit = (function () {
	console.log("foo! bar ! slidenav!! foo!");
	slidevar = "some random foo";
}());*/

function slidenavInit() {
	//console.log("foo! bar ! slidenav!! foo!");
	
	// get all control buttons
	slide_controls = document.querySelectorAll('.smil-timeController');
	
	for (var i = 0; i< slide_controls.length; i++) {
		//console.log('adding control to: ');
		addSlideControls(slide_controls[i]);
	}
}

var sm = function () {
	//console.log(slide_control_buttons.length);
};

var addSlideControls = function (el) {
	var audioElementToControl = el.parentNode.getElementsByTagName('audio')[0];
	var slides = el.parentNode.querySelectorAll('div[id^=slide]');
	var controlButtons = el.getElementsByTagName('button');
	//console.log(audioElementToControl.getAttribute('id'));
	for (var i = 0; i< controlButtons.length; i++) {
		switch (controlButtons[i].getAttribute('class')) {
			case "smil-play":
				//console.log('found a play button');
				controlButtons[i].addEventListener("click", 
					function() {
						playAudio(audioElementToControl);
					}, false);
				break;
			case "smil-next":
				//console.log('found a next button');
				controlButtons[i].addEventListener("click", 
					function() {
						nextSlide(audioElementToControl, slides);
					}, false);
				break;
				case "smil-prev":
				//console.log('found a next button');
				controlButtons[i].addEventListener("click", 
					function() {
						prevSlide(audioElementToControl, slides);
					}, false);
				break;
				case "smil-first":
				//console.log('found a next button');
				controlButtons[i].addEventListener("click", 
					function() {
						firstSlide(audioElementToControl, slides);
					}, false);
				break;
				case "smil-last":
				//console.log('found a next button');
				controlButtons[i].addEventListener("click", 
					function() {
						lastSlide(audioElementToControl, slides);
					}, false);
				break;
			default:
				break;
		}
	}
};

var playAudio = function (audioElement) {
	console.log('playAudio() called on ' + audioElement.getAttribute('id'));
	// remember to pause other audio playback
	if (audioElement.paused === true) {
		audioElement.play();
	} else {
		audioElement.pause();
	}
}

var getCurrentSlide = function (audioElement, slides) {
// sjekk audio sin currentTime og sammenlikn med data-begin og data-end i alle div#slide...
//	returner div elementet som matcher
	
	var i,j;
	var currentTime = audioElement.currentTime;
	//console.log('getCurrentSlide - currentTime: ' + currentTime);
	var min = Infinity;
	var max = 0;
	var begintime,endtime;
	for (i = 0; i < slides.length; i++) {
		if (slides[i].getAttribute('data-begin') < min) {
			min = parseFloat(slides[i].getAttribute('data-begin'));
		}
		if (slides[i].getAttribute('data-end') > min) {
			max = parseFloat(slides[i].getAttribute('data-end'));
		}
	}
	if (currentTime <= min) {
		//console.log('a5');
		return slides[0];
	} else if (currentTime >= max) {
		return slides[slides.length-1];
	} else {
		for (j = 0; j<slides.length; j++) {
			begintime = parseFloat(slides[j].getAttribute('data-begin'));
			endtime = parseFloat(slides[j].getAttribute('data-end'));
			console.log('begin: ' + begintime + ' end: ' + endtime);
			if (currentTime >= begintime && currentTime < endtime) {
				console.log('a6');
				return slides[j];
			}
		}
	}
	//console.log('match not found!!, returning first');
	return slides[0];
};

// pause playback (if playing), move to next slide
var nextSlide = function (audioElement, slides) {
	audioElement.pause();
	var currentSlide = getCurrentSlide(audioElement, slides);
	//console.log(currentSlide.getAttribute('id'));
	if (currentSlide.nextElementSibling.nodeName === 'DIV') {
		currentSlide.setAttribute('smil','done');
		audioElement.setCurrentTime(currentSlide.nextElementSibling.getAttribute('data-begin'));
		clearOtherSlides(currentSlide);
	}
};

// pause playback (if playing), move to prev slide
var prevSlide = function (audioElement, slides) {
	audioElement.pause();
	var currentSlide = getCurrentSlide(audioElement, slides);
	//console.log(currentSlide.getAttribute('id') + ', nodename: ' + currentSlide.nodeName);
	if (currentSlide.previousElementSibling.nodeName === 'DIV') {
		currentSlide.setAttribute('smil','idle');
		audioElement.setCurrentTime(currentSlide.previousElementSibling.getAttribute('data-begin'));
		clearOtherSlides(currentSlide);
	}
};

var clearOtherSlides = function (slideEl) {
	var slides = document.querySelectorAll('[id^=slide]');
	var playingClassActive = document.querySelectorAll('.playing');
	var activeElements = document.querySelectorAll('[smil=active]');
	for (var j = 0; j < playingClassActive.length; j++) {
		removeClass(playingClassActive[j], 'playing');
	}
	for (var i = 0; i < slides.length; i++) {
		removeClass(slides[i], 'showslide');
	}
	for (var k = 0; k < activeElements.length; k++) {
		activeElements[k].setAttribute('smil','idle');
	}
}

var firstSlide = function (audioElement, slides) {
	audioElement.pause();
	for (var i = 0; i<slides.length; i++) {
		slides[i].setAttribute('smil','idle');
	}
	audioElement.setCurrentTime(0);
	//console.log('to first slide');
};

var lastSlide = function (audioElement, slides) {
	audioElement.pause();
	var newCurrentTime = slides[slides.length-1].getAttribute('data-begin');
	for (var i = 0; i<slides.length; i++) {
		slides[i].setAttribute('smil','done');
	}
	slides[slides.length-1].setAttribute('smil','active');
	audioElement.setCurrentTime(newCurrentTime);
	//console.log('to last slide');
};



// Play/Pause knapp
// 1) få tak i audio element som er i samme språk