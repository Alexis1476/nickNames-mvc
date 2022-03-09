<?php

/**
 * Permet de gérer le pages et le model Teacher
 */
class TeacherController
{
    /**
     * Message d'erreur quand un champ n'est pas remplie
     */
    const ERROR_REQUIRED = "Renseignez ce champ";
    /**
     * Message d'erreur quand un champ ne respecte pas les règles
     */
    const ERROR_FORMAT = "Seuls les caractères alphabétiques sont permis";

    /**
     * @var TeacherModel
     */
    private $_teacherModel;
    /**
     * @var View
     */
    private $_view;

    /**
     * Constructeur
     */
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

    /**
     * Défini si le bouton radio du formulaire doit être coché en fonction du genre
     * @param $teacher
     * @param $gender
     * @return string
     */
    public function checkGenderToRadioBtn($teacher, $gender)
    {
        return $teacher['teaGender'] == $gender ? "checked" : "";
    }

    /**
     * Vérifie le formulaire pour ajouter un teacher
     * @return void
     */
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

    /**
     * Affiche la view viewAddTeacher
     * @return void
     */
    private function teacherAdd()
    {
        $sections = SectionModel::getAllSections();

        $this->_view = new View('AddTeacher', $this);
        $this->_view->displayView(['sections' => $sections]);
    }

    /**
     * Affiche la liste de teachers
     * @return void
     */
    private function teacherList()
    {
        $this->_teacherModel = new TeacherModel();
        $teachers = $this->_teacherModel->getAllTeachers();

        $this->_view = new View('Home', $this);
        $this->_view->displayView(['teachers' => $teachers]);
    }

    /**
     * Vérifie le formulaire pour ajouter un teacher
     * @return void
     */
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

    /**
     * Vérifie les erreurs d'un formulaire
     * @return array
     */
    private function checkFormData()
    {
        $errors = [];

        // Pattern firstName, name et origin
        $stringPattern = "/^([a-zA-Z' -]+)$/";

        // Validation du genre
        if (!isset($_POST['genre']) || !$_POST['genre']) {
            $errors['genre'] = "Genre: " . TeacherController::ERROR_REQUIRED;
        }
        // Validation du firstName
        if (isset($_POST['firstName']) && !$_POST['firstName']) {
            $errors['firstName'] = "FirstName: " . TeacherController::ERROR_REQUIRED;
        } else if (!preg_match($stringPattern, $_POST['firstName'])) {
            $errors['firstName'] = "Firstname: " . TeacherController::ERROR_FORMAT;
        }
        // Validation du name
        if (isset($_POST['name']) && !$_POST['name']) {
            $errors['name'] = "Name: " . TeacherController::ERROR_REQUIRED;
        } elseif (!preg_match($stringPattern, $_POST['name'])) {
            $errors['name'] = "Name: " . TeacherController::ERROR_FORMAT;
        }
        // Validation du nickname
        if (isset($_POST['nickName']) && !$_POST['nickName']) {
            $errors['nickName'] = "Nickname: " . TeacherController::ERROR_REQUIRED;
        } elseif (!preg_match($stringPattern, $_POST['nickName'])) {
            $errors['nickName'] = "Nickname: " . TeacherController::ERROR_FORMAT;
        }
        // Validation de l'origine
        if (isset($_POST['origin']) && !$_POST['origin']) {
            $errors['origin'] = "Origin: " . TeacherController::ERROR_REQUIRED;
        } elseif (!preg_match($stringPattern, $_POST['origin'])) {
            $errors['origin'] = "Origin: " . TeacherController::ERROR_FORMAT;
        }
        // Validation de la section
        if (!isset($_POST['section']) || !$_POST['section']) {
            $errors['section'] = "Section: " . TeacherController::ERROR_REQUIRED;
        }

        return $errors;
    }

    /**
     * Affiche la view viewEdit
     * @return void
     */
    private function teacherEdit()
    {
        $this->_teacherModel = new TeacherModel();
        $teacher = $this->_teacherModel->getOneTeacher($_GET['idTeacher']);
        $sections = SectionModel::getAllSections();

        $this->_view = new View('Edit', $this);
        $this->_view->displayView(['teacher' => $teacher, 'sections' => $sections]);
    }

    /**
     * Retourne le genre du teacher en fonction de son attribut teaGender
     * @param $teacher
     * @return string
     */
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

    /**
     * Efface un teacher
     * @return void
     */
    private function teacherDelete()
    {
        $this->_teacherModel = new TeacherModel();
        $this->_teacherModel->deleteTeacher($_GET['idTeacher']);

        header('Location: index.php');
    }

    /**
     * Affiche la view viewDetail
     * @return void
     */
    private function teacherDetail()
    {
        $this->_teacherModel = new TeacherModel();
        $teacher = $this->_teacherModel->getOneTeacher($_GET['idTeacher']);
        $genre = $this->defineGenderImage($teacher);

        $this->_view = new View('Detail', $this);
        $this->_view->displayView(['teacher' => $teacher, 'genre' => $genre]);
    }
}