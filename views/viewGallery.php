<?php $this->_title = 'Gallery'; ?>
<?php
    foreach ($images as $image) {
        require_once('layout/image');
    }
?>