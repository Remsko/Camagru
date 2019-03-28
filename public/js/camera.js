streaming =	false,
video = document.querySelector('#video'),
cover = document.querySelector('#cover'),
canvas = document.querySelector('#canvas'),
photo =	document.querySelector('#photo'),
startbutton	= document.querySelector('#startbutton'),
width =	600,
height = 600;
filters = ['cock.png', 'banana.png', 'sax.png'];
filtername = null;
var path;

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

// Save Image button function
function saveImage(filtername) {
	takepicture();
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
			path = ajax.responseText;
		}
	}
	ajax.send('image=' + data + '&filter=' + filtername);
	return path;
}

function selectFilter(e) {
	id = e.currentTarget.id;
	filtername = document.getElementById(id).src;
	filtername = filtername.split('/')[5];
	if (filters.indexOf(filtername) !== -1) {
		path = saveImage(filtername);
		if (path !== undefined) {
			document.getElementById("startbutton").disabled = false;
			photo.src = path;
		}
	}
}

function showPicture() {
	photo.style.display = 'inline-block';
}

function addEventListenerToClass(className, event, f) {
    var classElements = document.getElementsByClassName(className);
    for (var i = 0; i < classElements.length; i++) {
        classElements[i].addEventListener(event, f, false);
	}
}

savebutton.addEventListener('click', function(ev) {
	saveImage();
	ev.preventDefault;
}, false);

startbutton.addEventListener('click', function(ev){
	showPicture();
	ev.preventDefault();
}, false);


addEventListenerToClass('filters', 'click', selectFilter); 