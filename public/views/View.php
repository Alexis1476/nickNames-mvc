<?php

class View
{
    private $_controller;

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->_controller;
    }

    private $_file;
    private $_title;

    public function __construct($viewName, $controller)
    {
        $this->_file = 'public/views/view' . $viewName . '.php';
        $this->_controller = $controller;
    }

    public function displayView($data)
    {
        $content = $this->generateFile($this->_file, $data);

        $view = $this->generateFile("public/views/template.php", ['title' => $this->_title, 'content' => $content]);

        echo $view;
    }

    public function generateFile($file, $data)
    {
        if (file_exists($file)) {
            extract($data);

            ob_start();

            require $file;

            return ob_get_clean();
        } else {
            throw new Exception('Fichier ' . $file . ' introuvable');
        }
    }
}