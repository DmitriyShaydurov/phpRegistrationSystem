<?php

namespace lib;

class Db
{
    private $pdo;
    private static $instance;
    private $stmt;
    public $error;


    private function __construct()
    {
        $dsn = 'mysql:host=' . Config::get('mysql/host') . ';dbname=' .  Config::get('mysql/db');
        try {
            $this->pdo = new \PDO($dsn, Config::get('mysql/username'), Config::get('mysql/password'));
            $this->pdo->exec("set names utf8");
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

    // Prepare statement with query
    public function query($sql, $params)
    {
        $this->stmt = $this->pdo->prepare($sql);
        return $this->stmt->execute($params);
    }

    // Get result set as array of arrays
    public function fetchAll($sql, $params = [])
    {
        $this->query($sql, $params);
        return $this->stmt->fetchAll();
    }
    // Get single record as array
    public function fetchSingle($sql, $params = [])
    {
        $this->query($sql, $params);
        return $this->stmt->fetch();
    }
    // Get row count
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    public function lastId()
    {
        return $this->pdo->lastInsertId();
    }
}
