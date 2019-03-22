<?php $this->_title = 'Gallery'; ?>
<?php
    foreach ($images as $image) {
        require('layout/image.php');
        if (isset($_SESSION['user'])) {
            require('layout/like.php');

            $comments = $image->getComments();
            foreach ($comments as $comment) {
                require('layout/comment.php');
            }
        }
    }
?>
<h3>That's it ! There is no more pictures !</h3>