<?php
    echo '<div class="all_comments" id="'.$image->getId().'">';
    $comments = $image->getComments();

    foreach ($comments as $comment) {
        require('comment.php');
    }
    echo '</div>';
?>