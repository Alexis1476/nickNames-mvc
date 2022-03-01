<?php
require_once 'public/views/View.php';

class Router
{
    private $_controller;
    private $_view;

    public function routeReq()
    {
        try {
            // Remplace le require [Charge les class]
            spl_autoload_register(function ($class) {
                require_once('models/' . $class . '.php');
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