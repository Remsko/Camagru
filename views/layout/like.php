<div class="like" id="<?= $image->getId() ?>">
<strong>
<?php
    $likeNumber = $image->getLikes();
    $likePlurial = $likeNumber > 1 ? 's' : '';
    echo $likeNumber.' like'.$likePlurial;
?>
</strong>
<?php
    if ($image->getLiked()) {
        echo '<button onclick="dislike(event);" data-imageid="'.$image->getId().'">Dislike</button>';
    }
    else {
        echo '<button onclick="like(event);" data-imageid="'.$image->getId().'">Like</button>';
    }
?>
</div>
<script src="/public/js/like.js"></script>
<script src="/public/js/ajax.js"></script>