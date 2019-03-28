<?php $this->_title = 'Gallery'; ?>
<?php
    foreach ($images as $image) {
        require('layout/image.php');
        if (isset($_SESSION['userId'])) {
            require('layout/like.php');

            $comments = $image->getComments();
            foreach ($comments as $comment) {
                require('layout/comment.php');
            }
            require('layout/commentForm.php');
        }
    }
    if ($currentPage != 1) {
        echo '<a href="index.php?page='.($currentPage - 1).'"><<</a>';
    }
    for ($i = 1; $i <= $pagesTotal; $i++) {
        echo '<a href="/index.php?page='.$i.'">'.$i.'</a>';
    }
    if ($currentPage != $pagesTotal) {
        echo '<a href="index.php?page='.($currentPage + 1).'">>></a>';
    }
?>
<h3>That's it ! There is no more pictures !</h3>