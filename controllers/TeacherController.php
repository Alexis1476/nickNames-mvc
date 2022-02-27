<?php

class TeacherController
{
    private $_teacherModel;
    private $_view;

    public function __construct()
    {
        $action = 'teacher' . ucfirst(strtolower($_GET['action']));
        $this->$action();
    }

    private function teacherList()
    {
        $this->_teacherModel = new TeacherModel();
        $teachers = $this->_teacherModel->getAllTeachers();

        $this->_view = new View('Home');
        $this->_view->displayView(['teachers' => $teachers]);
    }

    private function checkGender($teacher)
    {
        if ($teacher['teaGender'] == 'M') {
            $genre = "male";
        } else if ($teacher['teaGender'] == 'F') {
            $genre = "femelle";
        } else {
            $genre = "autre";
        }
        return $genre;
    }

    private function teacherEdit()
    {
        // TODO
        echo "teacherEdit";
    }

    private function teacherDelete()
    {
        // TODO
    }

    private function teacherDetail()
    {
        $this->_teacherModel = new TeacherModel();
        $teacher = $this->_teacherModel->getOneTeacher($_GET['idTeacher']);
        $genre = $this->checkGender($teacher);

        $this->_view = new View('Detail');
        $this->_view->displayView(['teacher' => $teacher, 'genre' => $genre]);
    }
}