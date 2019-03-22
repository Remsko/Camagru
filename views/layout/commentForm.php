<form method="post" action="">
    <input type="hidden" name="imageId" value="<?= $image->getId() ?>" />
    <input type="hidden" name="userId" value="<?= $_SESSION['userId'] ?>" />

    <input type="text" name="comment" />
    <input type="submit" name="commentForm" value="Post" />
</form>