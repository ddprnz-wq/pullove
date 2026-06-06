/*global window, localStorage, fontSizeTitle, bigger, reset, smaller, biggerTitle, resetTitle, smallerTitle, Cookie */
var prefsLoaded = false;
var defaultFontSize = 100;
var currentFontSize = defaultFontSize;
var fontSizeTitle;
var bigger;
var smaller;
var reset;
var biggerTitle;
var smallerTitle;
var resetTitle;

Object.append(Browser.Features, {
	localstorage: (function() {
		return ('localStorage' in window) && window.localStorage !== null;
	})()
});

function setFontSize(fontSize) {
	document.body.style.fontSize = fontSize + '%';
}

function changeFontSize(sizeDifference) {
	currentFontSize = parseInt(currentFontSize, 10) + parseInt(sizeDifference * 5, 10);
	if (currentFontSize > 180) {
		currentFontSize = 180;
	} else if (currentFontSize < 60) {
		currentFontSize = 60;
	}
	setFontSize(currentFontSize);
	callIsotope();
}

function revertStyles() {
	currentFontSize = defaultFontSize;
	changeFontSize(0);
}

function writeFontSize(value) {
	if (Browser.Features.localstorage) {
		localStorage.fontSize = value;
	} else {
		Cookie.write("fontSize", value, {duration: 180});
	}
}

function readFontSize() {
	if (Browser.Features.localstorage) {
		return localStorage.fontSize;
	} else {
		return Cookie.read("fontSize");
	}
}

function setUserOptions() {
	if (!prefsLoaded) {
		var size = readFontSize();
		currentFontSize = size ? size : defaultFontSize;
		setFontSize(currentFontSize);
		prefsLoaded = true;
	}
}

function addControls() {
	var container = document.id('fontsize');
	var content = '<p><a href="#" title="font size" onclick="revertStyles(); return false">font size</a> <a class="decrease-size" href="#"  title="Decrease size" onclick="changeFontSize(-2); return false"></a> <a class="increase-size" title="Increase size" href="#" onclick="changeFontSize(2); return false"></a></p>';
	container.set('html', content);
}

function saveSettings() {
	writeFontSize(currentFontSize);
}

window.addEvent('domready', setUserOptions);
window.addEvent('domready', addControls);
window.addEvent('unload', saveSettings);