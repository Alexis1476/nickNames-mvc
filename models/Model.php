<?php

abstract class Model
{
    private static $_connector;

    private static function getDbConfig()
    {
        // Lecture des données de config de la base de données
        $json = file_get_contents('./config/dbConfig.json');
        $dataConfig = json_decode($json, true);

        // Lecture du mot de passe
        $json = file_get_contents('./config/secrets.json');
        $dataConfig += json_decode($json, true);

        return $dataConfig;
    }

    private static function setDb()
    {
        $dataConfig = self::getDbConfig();
        self::$_connector = new PDO(
            'mysql:host=' . $dataConfig['host'] .
            ';dbname=' . $dataConfig['dbName'] .
            ';charset=' . $dataConfig['charset'],
            $dataConfig['user'],
            $dataConfig['password']
        );
    }
}