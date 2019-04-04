<div class="new_comment" id="<?= $image->getId() ?>">
    <input class ="input_comment" onkeydown="onEnter(event, comment);" data-imageid="<?= $image->getId() ?>" type="text" />
    <button class = "button_comment" onclick="comment(event);" data-imageid="<?= $image->getId() ?>">Comment</button>
</div>
<?php
    if (isset($error)) {
        echo '<font color="red">'.$error."</font><br/>";
    }
?>
<script src="/public/js/comment.js"></script>
<script src="/public/js/ajax.js"></script>