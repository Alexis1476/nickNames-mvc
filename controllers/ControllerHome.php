<?php

class ControllerHome
{
    private $_teacherModel;
    private $_view;

    public function __construct($url)
    {
        $this->teachers();
    }

    private function teachers()
    {
        $this->_teacherModel = new TeacherModel();
        $teachers = $this->_teacherModel->getAllTeachers();

        require_once 'public/views/viewHome.php';
    }
}