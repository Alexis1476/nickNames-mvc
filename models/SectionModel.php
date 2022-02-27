<?php

class SectionModel extends Model
{
    static function getAllSections()
    {
        $query = 'SELECT * FROM t_section';
        $req = (new SectionModel)->querySimpleExecute($query);

        return (new SectionModel)->formatData($req);
    }
}