<?php

/**
 * Class abstraite qui permet de faire un singleton PDO
 */
abstract class Model
{
    /**
     * Connecteur à la db
     * @var PDO
     */
    private static $_connector;

    /**
     * Lit les donnés de config de la db des fichiers .json
     * @return mixed Tableau associatif contenant les données de config de la db
     */
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

    /**
     * Instancie le connecteur PDO
     * @return void
     */
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

    /**
     * Retourne le connecteur PDO
     * @return PDO
     */
    protected function getDb()
    {
        // Si la connexion n'est pas instanciée
        self::$_connector ?: self::setDb();
        return self::$_connector;
    }

    /**
     * Exécute une requête simple
     * @param $query
     * @return false|PDOStatement
     */
    protected function querySimpleExecute($query)
    {
        return $this->getDb()->query($query);
    }

    /**
     * Permet de préparer, de binder et d’exécuter une requête (select avec where ou insert, update et delete)
     * @param $query
     * @param $binds
     * @return false|PDOStatement
     */
    protected function queryPrepareExecute($query, $binds)
    {
        $req = $this->getDb()->prepare($query);
        foreach ($binds as $key => $element) {
            $req->bindValue($key, $element['value'], $element['type']);
        }
        $req->execute();

        return $req;
    }

    /**
     * Traite les données pour les retourner en tableau associatif (avec FETCH_ASSOC)
     * @param $req
     * @return mixed
     */
    protected function formatData($req)
    {
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Vide le jeu d'enregistrement
     * @param $req
     * @return void
     */
    protected function unsetData($req)
    {
        $req->closeCursor();
    }
}