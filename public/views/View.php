<?php

/**
 * Class qui gère la view
 */
class View
{
    /**
     * Controller
     * @var
     */
    private $_controller;

    /**
     * Retourne le controller de la view
     * @return mixed
     */
    public function getController()
    {
        return $this->_controller;
    }

    /**
     * Fichier contenant la page à afficher
     * @var string
     */
    private $_file;
    /**
     * Title de la page
     * @var
     */
    private $_title;

    /**
     * Constructeur par nom de la view et controller
     * @param $viewName
     * @param $controller
     */
    public function __construct($viewName, $controller)
    {
        $this->_file = 'public/views/view' . $viewName . '.php';
        $this->_controller = $controller;
    }

    /**
     * Affiche la page
     * @param $data
     * @return void
     */
    public function displayView($data)
    {
        $content = $this->generateFile($this->_file, $data);
        $view = $this->generateFile("public/views/template.php", ['title' => $this->_title, 'content' => $content]);

        echo $view;
    }

    /**
     * Extrait les données des variables se retrouvant dans le fichier $file
     * @param $file
     * @param $data
     * @return Exception|false|string
     */
    public function generateFile($file, $data)
    {
        if (file_exists($file)) {
            extract($data);

            ob_start();

            require $file;

            return ob_get_clean();
        } else {
            return new Exception('Fichier ' . $file . ' introuvable');
        }
    }
}