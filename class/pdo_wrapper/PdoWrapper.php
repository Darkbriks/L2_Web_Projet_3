<?php

namespace pdo_wrapper;

class PdoWrapper
{
    private $db_name;
    private $db_host;
    private $db_port;
    private $db_user;
    private $db_pwd;
    private $pdo;

    public function __construct($db_name, $db_host, $db_port, $db_user, $db_pwd)
    {
        $this->db_name = $db_name;
        $this->db_host = $db_host;
        $this->db_port = $db_port;
        $this->db_user = $db_user;
        $this->db_pwd = $db_pwd;

        $dsn = 'mysql:dbname=' . $this->db_name . ';host=' . $this->db_host . ';port=' . $this->db_port;
        try { $this->pdo = new \PDO($dsn, $this->db_user, $this->db_pwd); }
        catch (\Exception $ex) { die("Erreur : " . $ex->getMessage()); }
    }

    public function execute($statement, $params, $class_name=null)
    {
        $res = $this->pdo->prepare($statement);
        $res->execute($params) or die(print_r($res->errorInfo()));

        if ($class_name != null) { return $res->fetchAll(\PDO::FETCH_CLASS, $class_name); }
        else { return $res->fetchAll(\PDO::FETCH_CLASS); }
    }
    // To call :
    // $pdo = new PdoWrapper($GLOBALS['db_name'], $GLOBALS['db_host'], $GLOBALS['db_port'], $GLOBALS['db_user'], $GLOBALS['db_pwd']);
    // $pdo->execute("SELECT * FROM films", [], "Film");
}