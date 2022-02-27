<?php
require_once 'public/views/View.php';

class HomeController
{
    /*private $_teacherModel;
    private $_view;*/

    public function __construct()
    {
        $this->teachers();
    }

    private function teachers()
    {
        require_once 'TeacherController.php';
        new TeacherController();
    }
}