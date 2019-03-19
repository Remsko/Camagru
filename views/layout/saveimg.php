<?php
    include("../../models/Image.class.php");
    include("../../models/ImageManager.class.php");
    define('UPLOAD_DIR', '../../public/images/');

	$img = $_POST['img'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
    $id = uniqid();
	$file = UPLOAD_DIR . $id . '.png';
    $success = file_put_contents($file, $data);
    $manager = new ImageManager();
    $img = new Image([
        'userid' => $_SESSION['user'],
        'name' => $file,
        'type' => '/png',
        'Descrip' => 'Premiere photo lol!'
    ]);
    $manager->add($img);
?>