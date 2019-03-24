<?php
	require_once('views/View.class.php');
	define('UPLOAD_DIR', '../../public/images/');

class ControllerStudio {
	private $_imageManager;
	private $_view;

	public function __contruct($url) {
		if (isset($url) && count($url) > 1) {
			throw new Exception('Page not found');
		}

		$this->studio();
	}

	private function studio() {
		$this->_view = new View('Studio');
		$this->_view->generate([]);
	}

	public function saveimage() {
		$error = null;
		if (isset($_POST['img'])) {
		$this->$_imgManager = new ImageManager();
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
        }
    }
}

?>