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
			$this->studio();
		}
	}

	private function studio() {
		$this->_view = new View('Studio');
		$this->_view->generate([]);
	}

	public function addFilter() {
		if (isset($_SESSION['userId'])) {
			if (isset($_POST['filter'])) {
				$filter = $_POST['filter'];
				$path = 'public/filters/'.$filter;
				$file = imagecreatefrompng($path);
				$file = imagescale($file, 600);
			}
			else {
				throw new Exception('An error occured while trying to put a sticker.');
			}
		}
	}

	public function saveimage() {
		if (isset($_SESSION['userId'])) {
			if (isset($_POST['image']) && isset($_POST['filter'])) {
				$this->_imageManager = new ImageManager();
				$image = $_POST['image'];
				$image = str_replace('data:image/png;base64,', '', $image);
				$image = str_replace(' ', '+', $image);
				$data = base64_decode($image);
				$id = uniqid();
				$file = 'public/images/' . $id . '.png';
				if(!file_put_contents($file, $data)) {
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
		/*		$image = new Image([
					'userId' => $_SESSION['userId'],
					'path' => $file,
				]);
				$this->_imageManager->pushImage($image);*/
			}
        }
		else {
			throw new Exception('You must be connected to save images');
		}
    }
}

?>