<?php

class View {
    private $_file;
    private $_title;

    public function __construct($action) {
        $this->_file = 'views/view'.$action.'php';
    }

    public function generate($data) {
        $content = $this->generateFile($data);
        $view = $this->generateFile('view/template.php', array(
            't' => $this->_title,
            'content' => $content
        ));

        echo $view;
    }

    private function generateFile($data) {
        if (file_exists($this->_file)) {
            extract($data);
            ob_start();
            require $this->_file;
            $content = ob_get_clean();
            return $content;
        }
        else {
            throw new Exception('File '.$file.' not found');
        }
    }
}

?>