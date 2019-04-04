<?php
	require_once('views/View.class.php');

class ControllerStudio {
	private $_imageManager;
	private $_view;

	public function __construct($url) {
		if (!isset($url) || count($url) > 2) {
			throw new Exception('Page not found');
		}
		if (count($url) === 1) {
			if (empty($_SESSION['userId'])) {
				throw new Exception('You must be connected to access the studio !');
			}
			$this->studio();
		}
	}

	private function studio() {
		$this->_view = new View('viewStudio');
		$this->_imageManager = new ImageManager();
		$images = $this->_imageManager->getImagesByUserId($_SESSION['userId']);
		$this->_view->generate(['images' => $images]);
	}

	public function uploadImage() {
		if (!isset($_SESSION['userId'])) {
			throw new Exception('You must be connected to save images');	
		}
		if (!isset($_FILES['picture'])) {
			throw new Exception('Something goes wrong, please try again.');
		}
		if (!is_uploaded_file($_FILES['picture']['tmp_name'])) {
			throw new Exception('Please, select a picture you want to share.');
		}
		if ($_FILES['picture']['size'] > 5000000) {
			throw new Exception('Your picture is too big, please select another one.');
		}
		$id = uniqid();
		$file = 'public/images/' . $id . '.png';
		$image = file_get_contents($_FILES['picture']['tmp_name']);
		if(!file_put_contents($file, $image)) {
			throw new Exception('An error occurred while trying to save image.');
		}
		$image = new Image([
			'userId' => $_SESSION['userId'],
			'path' => $file,
		]);
		$this->_imageManager = new ImageManager();
		$this->_imageManager->pushImage($image);
		Router::redirectionRequest('/studio');
	}

	public function saveImage() {
		if (isset($_SESSION['userId'])) {
			if (isset($_POST['image']) && isset($_POST['filter'])) {
				$image = $_POST['image'];
				$image = str_replace('data:image/png;base64,', '', $image);
				$image = str_replace(' ', '+', $image);
				$data = base64_decode($image);
				$id = uniqid();
				$file = 'public/images/' . $id . '.png';
				if(!file_put_contents($file, $data)) {
					echo('ERRROR');
					throw new Exception('An error occurred while trying to save image.');
				}
				$filter = $_POST['filter'];
				$path = 'public/filters/'.$filter;
				$filter = imagecreatefrompng($path);
				$image = imagecreatefrompng($file);
				$image = imagescale($image, 400);
				imagecopy($image, $filter, 0, 0, 0, 0, imagesx($filter) - 1, imagesy($filter) - 1);
				imagepng($image, $file);
					$image = new Image([
						'userId' => $_SESSION['userId'],
						'path' => $file,
					]);
				$this->_imageManager = new ImageManager();
				$this->_imageManager->pushImage($image);
				echo($file);
			}
			else {
				echo('ERROR');
				throw new Exception('There is no image to save !');
			}
		}
		else {
			echo('ERROR');
			throw new Exception('You must be connected to save images');
		}
	}
}

?>