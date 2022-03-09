<?php

/**
 * Permet de gérer les requêtes à la table t_section
 */
class SectionModel extends Model
{
    /**
     * Récupère la liste de tous les enseignants de la BD
     * @return mixed
     */
    static function getAllSections()
    {
        $query = 'SELECT * FROM t_section';
        $req = (new SectionModel)->querySimpleExecute($query);

        return (new SectionModel)->formatData($req);
    }
}