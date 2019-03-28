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

    private function gallery() {
        $error = null;
        $userId = isset($_POST['userId']) ? htmlspecialchars($_POST['userId']) : null;
        $imageId = isset($_POST['imageId']) ? htmlspecialchars($_POST['imageId']) : null;

        if (isset($_POST['commentForm'])) {
            $this->_commentManager = new CommentManager();
            $error = $this->_commentManager->postComment();
            if (!$error) {
                $this->_commentManager->notif($imageId, $userId);
            }
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
        $allImages = $this->_imageManager->getImages();

        $limit = 5;
        $total = count($allImages);
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

        $this->_view = new View('Gallery');
        $this->_view->generate([
            'images' => $images,
            'imageId' => $imageId,
            'error' => $error,
            'currentPage' => $currentPage,
            'pagesTotal' => $pagesTotal
        ]);
    }
}

?>