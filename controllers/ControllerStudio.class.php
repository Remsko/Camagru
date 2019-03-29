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
		$this->_view = new View('Studio');
		$this->_view->generate([]);
	}
  
	public function pushImage() {
		if (isset($_SESSION['userId'])) {
			if (isset($_POST['path']) && isset($_POST['response'])) {
				$response = $_POST['response'];
				$path = $_POST['path'];
				if ($response === 'like')
				{
					$this->_imageManager = new ImageManager();
					$image = new Image([
						'userId' => $_SESSION['userId'],
						'path' => $path,
					]);
					$this->_imageManager->pushImage($image);
					echo('LIKE');
				}
				else if ($response === 'dislike') {
					unlink($path);
					echo('DISLIKE');
				}
			}
		}
		else {
			echo('ERROR');
			throw new Exception('You must be connected to save images');
		}
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
				$image = imagescale($image, 600);
				imagecopy($image, $filter, 0, 0, 0, 0, imagesx($filter) - 1, imagesy($filter) - 1);
				imagepng($image, $file);
				echo($file);
			}
			else {
				echo('ERROR');
			}
			else {
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