<?php

class View {
    private $_file;
    private $_title;

    public function __construct($action) {
        $this->_file = 'views/view'.$action.'.php';
    }

    public function generate($data) {
        try {
            $content = $this->generateFile($this->_file, $data);

            $templateData = [
                'title' => $this->_title,
                'content' => $content
            ];
            $view = $this->generateFile('views/template.php', $templateData);

            echo $view;
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function generateFile($file, $data) {
        if (file_exists($file)) {
            extract($data);

            ob_start();
            require $file;
            $content = ob_get_clean();
            
            return $content;
        }
        else {
            throw new Exception('File '.$file.' not found');
        }
    }
}

?>