<?php

require_once('views/View.php');

class ControllerHome {
    private $_imageManager;
    private $_view;

    public function __construct($url) {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page not found');
        }
        else {
            $this->images();
        }
    }

    private function images() {
        $this->_imageManager = new ImageManager();
        $images = $this->_imageManager->getImages();

        $this->_view = new View('Home');
        $this->_view->generate(array('images' => $images));
    }
}

?>