<?php $this->_title = 'Gallery'; ?>
<?php
    foreach ($images as $image) {
        echo '<div id="'.$image->getId().'" class="Images">';
        echo '<div id="container2">';
        echo '<div id="block2">';
        require('layout/image.php');
        if (isset($_SESSION['userId'])) {
            require('layout/like.php');
            require('layout/allComments.php');
            require('layout/newComment.php');
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    if ($currentPage == $pagesTotal) {
        echo '<div id="block2">';
        echo '<h1>That\'s it ! There is no more pictures !</h1>';
        echo '</div>';
    }
    if ($pagesTotal > 1) {
        if ($currentPage != 1) {
            echo '<a class="button_class" href="index.php?page='.($currentPage - 1).'"><<</a>';
        }
        for ($i = 1; $i <= $pagesTotal; $i++) {
            echo '<a class="button_class" href="/index.php?page='.$i.'">'.$i.'</a>';
        }
        if ($currentPage != $pagesTotal) {
            echo '<a class="button_class" href="index.php?page='.($currentPage + 1).'">>></a>';
        }
    }
?>