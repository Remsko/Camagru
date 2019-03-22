<?php

require_once('views/View.class.php');

class ControllerGallery {
    private $_imageManager;
    private $_commentManager;
    private $_view;

    public function __construct($url) {
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page not found');
        }

        $this->gallery();
    }

    /* imageid + error to display error on good image commentForm */
    private function gallery() {
        if (isset($_POST['commentForm'])) {
            $this->_commentManager = new CommentManager();
            $this->_commentManager->postComment();
        }
        
        $this->_imageManager = new ImageManager();
        $images = $this->_imageManager->getImages();

        $this->_view = new View('Gallery');
        $this->_view->generate(['images' => $images]);
    }
}

?>