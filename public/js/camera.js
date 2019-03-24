	streaming	= false,
	video		= document.querySelector('#video'),
	cover		= document.querySelector('#cover'),
	canvas		= document.querySelector('#canvas'),
	photo		= document.querySelector('#photo'),
	startbutton	= document.querySelector('#startbutton'),
	width		= 640,
	height		= 400;

	navigator.getMedia = (
			navigator.getUserMedia ||
			navigator.webkitGetUserMedia ||
			navigator.mozGetUserMedia ||
			navigator.msGetUserMedia
		);

	navigator.getMedia(
			{
				video: true,
				audio: false
			},
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

	function takepicture() {
		video.pause();
		video.style.display = 'none';
		canvas.width = width;
		canvas.height = height;
		canvas.getContext('2d').drawImage(video, 0, 0, width, height);
	}

	startbutton.addEventListener('click', function(ev){
		takepicture();
		ev.preventDefault();
	}, false);

	function saveImage() {
		var data = canvas.toDataURL("image/png");
		if (window.XMLHttpRequest) {
			ajax = new XMLHttpRequest();
		}
		else if (window.ActiveXObject) {
			ajax = new ActiveXObject("Microsoft.XMLHTTP");
		}
		ajax.open('POST', '/views/layout/saveimg.php', true);
		ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && (ajax.status == 200)) {
			console.log(ajax.responseText);
		}
			else
				console.log(ajax.readyState);
		}
		ajax.send('img=' + data);
	}

	savebutton.addEventListener('click', function(ev) {
		saveImage();
		ev.preventDefault;
	}, false);
