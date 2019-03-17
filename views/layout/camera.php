<!DOCTYPE html>
<html>
<video id="video"></video>
<button id="startbutton">Take Picture</button>
<button id="savebutton">Save Image</button>
<canvas id="canvas"></canvas>
<!-- <img src="/public/images/om" id="photo" alt="photo"> -->
<script src="/public/js/camera.js"></script>
</html>
<?php
	define('UPLOAD_DIR', '/views/public/images/');
	$img = $_POST['img'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . uniqid() . '.png';
	$success = file_put_contents($file, $data);
?>