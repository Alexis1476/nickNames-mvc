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
        try {
            self::$_connector = new PDO(
                'mysql:host=' . $dataConfig['host'] .
                ';dbname=' . $dataConfig['dbName'] .
                ';charset=' . $dataConfig['charset'],
                $dataConfig['user'],
                $dataConfig['password']
            );
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    protected function getDb()
    {
        // Si la connexion n'est pas instanciée
        self::$_connector ?: self::setDb();
        return self::$_connector;
    }

    protected function querySimpleExecute($query)
    {
        return $this->getDb()->query($query);
    }

    protected function queryPrepareExecute($query, $binds)
    {
        $req = $this->getDb()->prepare($query);
        foreach ($binds as $key => $element) {
            $req->bindValue($key, $element['value'], $element['type']);
        }
        $req->execute();

        return $req;
    }

    protected function formatData($req)
    {
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function unsetData($req)
    {
        $req->closeCursor();
    }
}