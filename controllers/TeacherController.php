<?php

class TeacherController
{
    private $_teacherModel;
    private $_view;

    public function __construct()
    {
        $action = 'teacher';
        if (isset($_GET['action'])) {
            $action .= ucfirst(strtolower($_GET['action']));
        } else {
            $action .= 'List';
        }

        $this->$action();
    }

    public function checkGenderToRadioBtn($teacher, $gender)
    {
        return $teacher['teaGender'] == $gender ? "checked" : "";
    }

    private function teacherList()
    {
        $this->_teacherModel = new TeacherModel();
        $teachers = $this->_teacherModel->getAllTeachers();

        $this->_view = new View('Home', $this);
        $this->_view->displayView(['teachers' => $teachers]);
    }

    private function teacherEdit()
    {
        $this->_teacherModel = new TeacherModel();
        $teacher = $this->_teacherModel->getOneTeacher($_GET['idTeacher']);
        $sections = SectionModel::getAllSections();

        $this->_view = new View('Edit', $this);
        $this->_view->displayView(['teacher' => $teacher, 'sections' => $sections]);
    }

    private function defineGenderImage($teacher)
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


    private function teacherDelete()
    {
        // TODO
    }

    private function teacherDetail()
    {
        $this->_teacherModel = new TeacherModel();
        $teacher = $this->_teacherModel->getOneTeacher($_GET['idTeacher']);
        $genre = $this->defineGenderImage($teacher);

        $this->_view = new View('Detail', $this);
        $this->_view->displayView(['teacher' => $teacher, 'genre' => $genre]);
    }
}