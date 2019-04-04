<div id='wholePage'>
	<div id="imgContainer">
		<?php foreach ($images as $image) {
			require('oldpics.php');
		}?>
	</div>
	<div id='PageContent'>
		<video id="video"></video>
		<button id="startbutton" disabled>Take Picture</button>
		<img id='photo' src='#' />
		<br /><br />
		<form enctype="multipart/form-data" action="studio/uploadImage" method="post">
			<input type="hidden" name="MAX_FILE_SIZE" value="2500000"/>
			<label for="file">Select your own picture :</label>
			<input type="file" id="picturePath" name="picture" size=50 accept="image/*"/>
			<input type="submit" value="Send" />
		</form>
		<canvas id="canvas"></canvas>
		<div id=" bar" class="post_icontray">
			<img id="banana" class="filters" src="/public/filters/banana.png"/>
			<img id="cock" class="filters" src="/public/filters/cock.png"/>
			<img id="sax" class="filters" src="/public/filters/sax.png"/>
		</div>
	</div>
</div>
<script src='/public/js/camera.js'></script>