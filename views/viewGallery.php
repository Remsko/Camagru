<?php $this->_title = 'Gallery'; ?>
<?php
    foreach ($images as $image) {
        require_once('layout/image.php');
        foreach ($images->getComments() as $comment) {
            require_once('layout/comment.php');
        }
    }
?>