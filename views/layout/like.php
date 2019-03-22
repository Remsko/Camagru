</strong><?= $image->getLikes() ?> likes</strong>
<form method="post" action="">
    <?php
        if ($image->isLiked()) {
            echo '<input type="submit" name="like" value="like" />';
        }
        else {
            echo '<input type="submit" name="dislike" value="dislike" />';
        }
    ?>
</form>
