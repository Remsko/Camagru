<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/public/css/style.css">
        <link rel="stylesheet" type="text/css" href="/public/css/camera.css">
        <meta charset='utf-8' />
        <title><?= $title ?></title>
    </head>
    <body>
        <header>
            <?php require_once('layout/header.php'); ?>
        </header>
        <div class="view">
            <?= $content ?>
        </div>
        <footer>
            <?php require_once('layout/footer.php'); ?>
        </footer>
        <script src="/public/js/like.js"></script>
        <script src='/public/js/delete.js'></script>
        <script src="/public/js/ajax.js"></script>
        <script src="/public/js/comment.js"></script>
    </body>
</html>