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

	public function saveimage() {
		if (isset($_SESSION['userId'])) {
			if (isset($_POST['image'])) {
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
				$image = new Image([
					'userId' => $_SESSION['userId'],
					'path' => $file,
				]);
				$this->_imageManager->pushImage($image);
			}
    }
		else {
			throw new Exception('You must be connected to save images');
		}
  }
}

?>