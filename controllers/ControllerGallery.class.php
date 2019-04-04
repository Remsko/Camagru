<?php

require_once('views/View.class.php');

class ControllerGallery {
    private $_imageManager;
    private $_commentManager;
    private $_view;

    public function __construct($url) {
        if (isset($url) && count($url) > 2) {
            throw new Exception('Page not found');
        }
        if (count($url) === 1) {
            $this->gallery();
        }
    }

    public function like() {
		$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
        $imageId = isset($_POST['imageId']) ? $_POST['imageId'] : null;
        if (isset($userId) && isset($imageId)) {
			$this->_imageManager = new ImageManager();
            if (!$this->_imageManager->like($userId, $imageId)) {
                echo 'ERROR';
            }
            $view = new View('layout/like');
            $view->render(['image' => $this->_imageManager->getByImageId($imageId)]);
        }
        else {
            throw new Exception('Page not found');
        }
    }

    public function dislike() {
        $userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
        $imageId = isset($_POST['imageId']) ? $_POST['imageId'] : null;
        if (isset($userId) && isset($imageId)) {
			$this->_imageManager = new ImageManager();
            if (!$this->_imageManager->dislike($userId, $imageId)) {
                echo 'ERROR';
            }
            $view = new View('layout/like');
            $view->render(['image' => $this->_imageManager->getByImageId($imageId)]);
        }
        else {
            throw new Exception('Page not found');
        }
    }

    public function comment() {
        $userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
        $imageId = isset($_POST['imageId']) ? $_POST['imageId'] : null;
        $comment = isset($_POST['comment']) ? $_POST['comment'] : null;
        if (isset($userId) && isset($imageId) && isset($comment)) {
            $this->_commentManager = new CommentManager();
            $error = $this->_commentManager->postComment();
            if (!$error) {
                //$this->_commentManager->notif($imageId, $userId);
            }
            $view = new View('layout/newComment');
            $this->_imageManager = new ImageManager();
            $view->render([
                'image' => $this->_imageManager->getByImageId($imageId),
                'error' => $error
            ]);
        }
        else {
            throw new Exception('Page not found');
        }
    }

    public function reloadComments() {
        $imageId = isset($_POST['imageId']) ? $_POST['imageId'] : null;
        if (isset($imageId)) {
            $view = new View('layout/allComments');
            $this->_imageManager = new ImageManager();
            $view->render(['image' => $this->_imageManager->getByImageId($imageId)]);
        }
        else {
            throw new Exception('Page not found');
        }
    }

    private function gallery() {
        $this->_imageManager = new ImageManager();
        $allImages = $this->_imageManager->getImages();
        $limit = 5;
        if ($allImages) {
            $total = count($allImages);
        }
        else {
            $total = 1;
        }
        $pagesTotal = ceil($total / $limit);
        if (isset($_GET['page']) && $_GET['page'] > 0) {
            $currentPage = $_GET['page'];
        }
        else {
            $currentPage = 1;
        }
        if ($currentPage > $pagesTotal) {
            throw new Exception('Page not found');
        }
        $offset = ($currentPage - 1) * $limit;
        $images = $this->_imageManager->getImagesFromStart($limit, $offset);
        $this->_view = new View('viewGallery');
        $this->_view->generate([
            'images' => $images,
            'currentPage' => $currentPage,
            'pagesTotal' => $pagesTotal
        ]);
    }
}

?>