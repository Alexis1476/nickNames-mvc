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

    private function teacherSubmitAdd()
    {
        $errors = $this->checkFormData();
        if (!$errors) {
            $this->_teacherModel = new TeacherModel();
            $this->_teacherModel->insertTeacher($_POST);
            header('Location: index.php');
        } else {
            foreach ($errors as $error) {
                echo "<pre>$error</pre>";
            }
            echo "<a href=\"index.php\">Retour en arrière</a>";
        }
    }

    private function teacherAdd()
    {
        $sections = SectionModel::getAllSections();

        $this->_view = new View('AddTeacher', $this);
        $this->_view->displayView(['sections' => $sections]);
    }

    private function teacherList()
    {
        $this->_teacherModel = new TeacherModel();
        $teachers = $this->_teacherModel->getAllTeachers();

        $this->_view = new View('Home', $this);
        $this->_view->displayView(['teachers' => $teachers]);
    }

    private function teacherSubmitEdit()
    {
        $errors = $this->checkFormData();
        if (!$errors) {
            $this->_teacherModel = new TeacherModel();
            $this->_teacherModel->modifyTeacher($_POST);
            header('Location: index.php');
        } else {
            foreach ($errors as $error) {
                echo "<pre>$error</pre>";
            }
            $idTeacher = $_GET['idTeacher'];
            echo "<a href=\"index.php?controller=teacher&action=edit&idTeacher=$idTeacher\">Retour en arrière</a>";
        }
    }

    private function checkFormData()
    {
        $errors = [];

        if (!$_POST['genre']) {
            $errors['genre'] = "Sélectionnez un genre";
        }
        if (!$_POST['firstName']) {
            $errors['firstName'] = "Écrivez votre prénom";
        }
        if (!$_POST['name']) {
            $errors['name'] = "Écrivez votre nom";
        }
        if (!$_POST['nickName']) {
            $errors['nickName'] = "Écrivez votre nickname";
        }
        if (!$_POST['origin']) {
            $errors['origin'] = "Écrivez votre origine";
        }
        if (!$_POST['section']) {
            $errors['section'] = "Sélectionnez votre section";
        }

        return $errors;
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
        $this->_teacherModel = new TeacherModel();
        $this->_teacherModel->deleteTeacher($_GET['idTeacher']);

        header('Location: index.php');
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