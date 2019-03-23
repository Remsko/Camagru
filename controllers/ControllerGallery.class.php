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
        $error = null;
        $userId = isset($_POST['userId']) ? htmlspecialchars($_POST['userId']) : null;
        $imageId = isset($_POST['imageId']) ? htmlspecialchars($_POST['imageId']) : null;

        if (isset($_POST['commentForm'])) {
            $this->_commentManager = new CommentManager();
            $error = $this->_commentManager->postComment();
        }
        if (isset($_POST['like'])) {
            $this->_imageManager = new ImageManager();
            $this->_imageManager->like($userId, $imageId);
        }
        if (isset($_POST['dislike'])) {
            $this->_imageManager = new ImageManager();
            $this->_imageManager->dislike($userId, $imageId);
        }

        $this->_imageManager = new ImageManager();
        $images = $this->_imageManager->getImages();

        $this->_view = new View('Gallery');
        $this->_view->generate([
            'images' => $images,
            'error' => $error,
            'imageId' => $imageId
        ]);
    }
}

?>