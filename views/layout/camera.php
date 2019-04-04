<div id="container4">
<div id="container2">
	<video id="video"></video>
	<button id="startbutton" disabled>Take Picture</button>
	<div class="imgform">
	<form enctype="multipart/form-data" action="studio/uploadImage" method="post">
		<input type="hidden" name="MAX_FILE_SIZE" value="2500000"/>
		<label for="file"><span>Select your own picture :</span></label><br />
		<input type="file" id="picturePath" name="picture" size=50 accept="image/*"/>
		<input type="submit" value="Send" />
	</form>
</div>
</div>
<canvas id="canvas"></canvas>
<br />
<div id="container2">
	<div id="block2">
		<div id=" bar" class="post_icontray">
			<img id="banana" class="filters" src="/public/filters/banana.png"/>
			<img id="cock" class="filters" src="/public/filters/cock.png"/>
			<img id="sax" class="filters" src="/public/filters/sax.png"/>
		</div>
	</div>
</div>
</div>

<script src='/public/js/camera.js'></script>