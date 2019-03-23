<strong>
<?php
    $likeNumber = $image->getLikes();
    $likePlurial = $likeNumber > 1 ? 's' : '';
    echo $likeNumber.' like'.$likePlurial;
?>
</strong>
<form method="post" action="">
    <input type="hidden" name="imageId" value="<?= $image->getId() ?>" />
    <input type="hidden" name="userId" value="<?= $_SESSION['userId'] ?>" />
    <?php
        if (!$image->getLiked()) {
            echo '<input type="submit" name="like" value="like" />';
        }
        else {
            echo '<input type="submit" name="dislike" value="dislike" />';
        }
    ?>
</form>
