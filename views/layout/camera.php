<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="/public/css/camera.css">
</head>
<body>
<video id="video"></video>
<button id="startbutton" disabled>Take Picture</button>
<div id='picture'>
<img id='photo' src='#' />
<br /><br />
<img id='like' class='choice' onclick="decide(event)" src='/public/icons/jaime.jpg'/>
<img id='dislike' class='choice' onclick="decide(event)" src='/public/icons/jaimepo.jpg'/>
</div>
<canvas id="canvas"></canvas>
<div id=" bar" class="post_icontray">
	<img id="banana" class="filters" src="/public/filters/banana.png"/>
	<img id="cock" class="filters" src="/public/filters/cock.png"/>
	<img id="sax" class="filters" src="/public/filters/sax.png"/>
</div>
<script src="/public/js/camera.js"></script>
<script src="/public/js/ajax.js"></script>
<body>
</html>