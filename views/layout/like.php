<div class="like" id="<?= $image->getId() ?>">
<center>
<strong>
<?php
    $likeNumber = $image->getLikes();
    $likePlurial = $likeNumber > 1 ? 's' : '';
    echo '<span>'.$likeNumber.' like'.$likePlurial.'<span>';
?>
</strong>
<?php
    if ($image->getLiked()) {
        echo '<button class="button_class" onclick="dislike(event);" data-imageid="'.$image->getId().'">Dislike</button>';
    }
    else {
        echo '<button class="button_class" onclick="like(event);" data-imageid="'.$image->getId().'">Like</button>';
    }
?>
</center>
</div>