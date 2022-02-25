<?php

class TeacherModel extends Model
{
    public function getAllTeachers()
    {
        $query = 'SELECT * FROM t_teacher';
        $req = $this->querySimpleExecute($query);

        return $this->formatData($req);
    }

    public function getOneTeacher($id)
    {
        $query = "SELECT * FROM t_teacher INNER JOIN t_section ON t_teacher.fkSection = idSection WHERE idTeacher = :idTeacher";
        $binds = ['idTeacher' => ['value' => $id, 'type' => PDO::PARAM_INT]];
        $req = $this->queryPrepareExecute($query, $binds);

        return $this->formatData($req);
    }

    public function insertTeacher($genre, $firstName, $name, $nickName, $origin, $section)
    {
        $query = "INSERT INTO t_teacher (idTeacher, teaFirstname, teaName, teaGender, teaNickname, teaOrigine, fkSection) 
                  VALUES (NULL, :firstName, :name, :genre, :nickName, :origin, :section)";

        $binds = [
            'firstName' => ['value' => $firstName, 'type' => PDO::PARAM_STR],
            'name' => ['value' => $name, 'type' => PDO::PARAM_STR],
            'genre' => ['value' => $genre, 'type' => PDO::PARAM_STR],
            'nickName' => ['value' => $nickName, 'type' => PDO::PARAM_STR],
            'origin' => ['value' => $origin, 'type' => PDO::PARAM_STR],
            'section' => ['value' => $section, 'type' => PDO::PARAM_INT]
        ];

        return $this->queryPrepareExecute($query, $binds);
    }

    public function deleteTeacher($id)
    {
        $query = "DELETE FROM t_teacher WHERE t_teacher.idTeacher = :idTeacher";
        $binds = ['idTeacher' => ['value' => $id, 'type' => PDO::PARAM_INT]];

        return $this->queryPrepareExecute($query, $binds);
    }

    public function modifyTeacher($id, $genre, $firstName, $name, $nickName, $origin, $section)
    {
        $query = "UPDATE t_teacher SET teaFirstname = :firstName, teaName = :name, teaGender = :genre, teaNickname = :nickName,
                     teaOrigine = :origin, fkSection = :section WHERE t_teacher.idTeacher = :id";

        $binds = [
            'firstName' => ['value' => $firstName, 'type' => PDO::PARAM_STR],
            'name' => ['value' => $name, 'type' => PDO::PARAM_STR],
            'genre' => ['value' => $genre, 'type' => PDO::PARAM_STR],
            'nickName' => ['value' => $nickName, 'type' => PDO::PARAM_STR],
            'origin' => ['value' => $origin, 'type' => PDO::PARAM_STR],
            'section' => ['value' => $section, 'type' => PDO::PARAM_INT],
            'id' => ['value' => $id, 'type' => PDO::PARAM_INT]
        ];

        return $this->queryPrepareExecute($query, $binds);
    }
}