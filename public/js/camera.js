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

// Start streaming webcam
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

// Adapt size of camera 
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

function request(url, data, success) {
	if (window.XMLHttpRequest) {
		ajax = new XMLHttpRequest();
	}
	else if (window.ActiveXObject) {
		ajax = new ActiveXObject("Microsoft.XMLHTTP");
	}
	ajax.open('POST', url, false);
	ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	ajax.onload = function () {
		console.log('Ajax request to ' + url + ' returned successfully.');
		if (ajax.responseText === 'ERROR') {
			console.log('An error occured.');
		}
		else {
			success(this.responseText);
		}
    };
	ajax.send(data);
}

// Takes the picture
function saveeImage(filtername) {
	canvas.width = width;
	canvas.height = height;
	canvas.getContext('2d').drawImage(video, 0, 0, width, height);
	data = canvas.toDataURL("image/png");
	request('studio/saveimage', ('image=' + data + '&filter=' + filtername), function (response) {
		path = response;
	});
}

// Select the clickable sticker
function selectFilter(e) {
	id = e.currentTarget.id;
	filtername = document.getElementById(id).src;
	filtername = filtername.split('/')[5];
	document.getElementById("startbutton").disabled = false;
}

// Show the picture
function showPicture() {
	if (filters.indexOf(filtername) !== -1) {
		saveeImage(filtername);
		if (path !== undefined) {
			photo.src = path;
			photo.style.display = 'inline-block';
		}
	}
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