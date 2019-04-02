streaming =	false,
video = document.querySelector('#video'),
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

// Takes the picture
function saveImage(filtername) {
	canvas.width = width;
	canvas.height = height;
	canvas.getContext('2d').drawImage(video, 0, 0, width, height);
	data = canvas.toDataURL("image/png");
	request('studio/saveImage', ('image=' + data + '&filter=' + filtername), function (response) {
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
		saveImage(filtername);
		if (path !== undefined) {
			photo.src = path;
			photo.style.display = 'inline-block';
			container = document.getElementById('imgContainer');
			newImg = document.createElement('img');
			newImg.src = path;
			newBr = document.createElement('br');
			container.prepend(newBr);
			container.prepend(newImg);
		}
	}
}

function uploadImage() {
	path = document.getElementById("picturePath").value;
	photo.src = path;
	photo.style.display = 'inline-block';
	console.log(path);
}

function addEventListenerToClass(className, event, f) {
	var classElements = document.getElementsByClassName(className);
	for (var i = 0; i < classElements.length; i++) {
		classElements[i].addEventListener(event, f, false);
	}
}

startbutton.addEventListener('click', function(ev){
	showPicture();
	ev.preventDefault();
}, false);


addEventListenerToClass('filters', 'click', selectFilter); 