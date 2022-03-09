<?php
require_once 'public/views/View.php';

/**
 * Gère les redirections du site
 */
class Router
{
    /**
     * Controller
     * @var
     */
    private $_controller;
    /**
     * @var View
     */
    private $_view;

    /**
     * Reçois la requête HTTP et instancie le controller correspondant
     * @return void
     */
    public function routeReq()
    {
        try {
            // Remplace le require [Charge les class]
            spl_autoload_register(function ($class) {
                require_once("models/$class.php");
            });

            // Inclure le controller selon l'action
            if (isset($_GET['controller'])) {
                $controller = ucfirst(strtolower($_GET['controller']));
                $controllerClass = $controller . "Controller";
                $controllerFile = "controllers/" . $controllerClass . '.php';

                if (file_exists($controllerFile)) {
                    require_once($controllerFile);
                    $this->_controller = new $controllerClass();
                } else {
                    throw new Exception('Page introuvable');
                }
            } // S'il n'y a pas de paramètres dans l'url
            else {
                require_once('controllers/HomeController.php');
                $this->_controller = new HomeController();
            }
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            $this->_view = new View('Error', null);
            $this->_view->displayView(['errorMsg' => $errorMsg]);
        }
    }
}