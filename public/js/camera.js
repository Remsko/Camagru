streaming =	false,
video = document.querySelector('#video'),
cover = document.querySelector('#cover'),
canvas = document.querySelector('#canvas'),
photo =	document.querySelector('#photo'),
startbutton	= document.querySelector('#startbutton'),
width =	640,
height = 400;

navigator.getMedia = (
	navigator.getUserMedia ||
	navigator.webkitGetUserMedia ||
	navigator.mozGetUserMedia ||
	navigator.msGetUserMedia
);

navigator.getMedia( {
	video: true,
	audio: false
},
// Starting camera
	function(stream) {
		if (navigator.mozGetUserMedia) {
			video.mozSrcObject = stream;
		} else {
			video.srcObject = stream;
		}
		video.play();
	},
	function(err) {
		console.log("An error occured! " + err);
	}
);
// Adapt Size 
video.addEventListener('canplay', function(ev){
	if (!streaming) {
		height = video.videoHeight / (video.videoWidth/width);
		video.setAttribute('width', width);
		video.setAttribute('height', height);
		canvas.setAttribute('width', width);
		canvas.setAttribute('height', height);
		streaming = true;
	}
}, false);
// Take Picture Button function
function takepicture() {
	canvas.width = width;
	canvas.height = height;
	canvas.getContext('2d').drawImage(video, 0, 0, width, height);
}

startbutton.addEventListener('click', function(ev){
	takepicture();
	ev.preventDefault();
}, false);

// Save Image button function
function saveImage() {
	var data = canvas.toDataURL("image/png");
	if (window.XMLHttpRequest) {
		ajax = new XMLHttpRequest();
	}
	else if (window.ActiveXObject) {
		ajax = new ActiveXObject("Microsoft.XMLHTTP");
	}
	ajax.open('POST', 'studio/saveimage', true);
	ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	ajax.onreadystatechange = function() {
	if (ajax.readyState == 4 && (ajax.status == 200)) {
		console.log(ajax.responseText);
	}
	else
		console.log(ajax.readyState);
	}
	ajax.send('image=' + data);
}

savebutton.addEventListener('click', function(ev) {
	saveImage();
	ev.preventDefault;
}, false);
<<<<<<< HEAD

startbutton.addEventListener('click', function(ev){
	takepicture();
	ev.preventDefault();
}, false);

function addFilter(e) {
	var id = e.currentTarget.id;
	var name = document.getElementById(id).src;
	name = name.split('/')[5];
	if (window.XMLHttpRequest) {
		ajax = new XMLHttpRequest();
	}
	else if (window.ActiveXObject) {
		ajax = new ActiveXObject("Microsoft.XMLHTTP");
	}
	ajax.open('POST', 'studio/addFilter', true);
	ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && (ajax.status == 200)) {
			console.log(ajax.responseText);
		}
		else
			console.log(ajax.readyState);
		}
	ajax.send('filter=' + name);
}

function addEventListenerToClass(className, event, f) {
    var classElements = document.getElementsByClassName(className);
    for (var i = 0; i < classElements.length; i++) {
        classElements[i].addEventListener(event, f, false);
	}
}

<<<<<<< HEAD
addEventListenerToClass('filters', 'click', addFilter); 
=======
addEventListenerToClass('filters', 'click', addFilter);
>>>>>>> parent of a02b404... fail.
=======
>>>>>>> parent of b4fb169... New method in studio's controller. Modified camera.js/.php + new sticker
