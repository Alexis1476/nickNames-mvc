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
        $teacher = $this->formatData($req);

        return $teacher[0];
    }

    public function insertTeacher($teacherData)
    {
        $query = "INSERT INTO t_teacher (idTeacher, teaFirstname, teaName, teaGender, teaNickname, teaOrigine, fkSection) 
                  VALUES (NULL, :firstName, :name, :genre, :nickName, :origin, :section)";

        $binds = [
            'firstName' => ['value' => $teacherData['firstName'], 'type' => PDO::PARAM_STR],
            'name' => ['value' => $teacherData['name'], 'type' => PDO::PARAM_STR],
            'genre' => ['value' => $teacherData['genre'], 'type' => PDO::PARAM_STR],
            'nickName' => ['value' => $teacherData['nickName'], 'type' => PDO::PARAM_STR],
            'origin' => ['value' => $teacherData['origin'], 'type' => PDO::PARAM_STR],
            'section' => ['value' => $teacherData['section'], 'type' => PDO::PARAM_INT]
        ];

        return $this->queryPrepareExecute($query, $binds);
    }

    public function deleteTeacher($id)
    {
        $query = "DELETE FROM t_teacher WHERE t_teacher.idTeacher = :idTeacher";
        $binds = ['idTeacher' => ['value' => $id, 'type' => PDO::PARAM_INT]];

        return $this->queryPrepareExecute($query, $binds);
    }

    public function modifyTeacher($teacherData)
    {
        $query = "UPDATE t_teacher SET teaFirstname = :firstName, teaName = :name, teaGender = :genre, teaNickname = :nickName,
                     teaOrigine = :origin, fkSection = :section WHERE t_teacher.idTeacher = :id";

        $binds = [
            'firstName' => ['value' => $teacherData['firstName'], 'type' => PDO::PARAM_STR],
            'name' => ['value' => $teacherData['name'], 'type' => PDO::PARAM_STR],
            'genre' => ['value' => $teacherData['genre'], 'type' => PDO::PARAM_STR],
            'nickName' => ['value' => $teacherData['nickName'], 'type' => PDO::PARAM_STR],
            'origin' => ['value' => $teacherData['origin'], 'type' => PDO::PARAM_STR],
            'section' => ['value' => $teacherData['section'], 'type' => PDO::PARAM_INT],
            'id' => ['value' => $teacherData['id'], 'type' => PDO::PARAM_INT]
        ];

        return $this->queryPrepareExecute($query, $binds);
    }
}