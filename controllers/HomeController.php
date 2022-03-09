<?php
require_once 'public/views/View.php';

/**
 * Controller de la page d'accueil
 */
class HomeController
{
    /**
     *  Constructeur
     */
    public function __construct()
    {
        $this->teachers();
    }

    /**
     * Instancie Teacher-controller pour affiche la liste des teachers
     * @return void
     */
    private function teachers()
    {
        require_once 'TeacherController.php';
        new TeacherController();
    }
}