<?php

namespace pdo_wrapper;

use Exception;

class PdoWrapper
{
    private $db_name;
    private $db_host;
    private $db_port;
    private $db_user;
    private $db_pwd;
    protected $pdo;

    public function __construct($db_name, $db_host, $db_port, $db_user, $db_pwd)
    {
        $this->db_name = $db_name;
        $this->db_host = $db_host;
        $this->db_port = $db_port;
        $this->db_user = $db_user;
        $this->db_pwd = $db_pwd;

        $dsn = 'mysql:dbname=' . $this->db_name . ';host=' . $this->db_host . ';port=' . $this->db_port;
        try { $this->pdo = new \PDO($dsn, $this->db_user, $this->db_pwd); $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); }
        catch (\PDOException $e) { throw new \PDOException($GLOBALS['pdo-connect-error'] . $e->getMessage(), (int)$e->getCode()); }
    }

    /**
     * @throws Exception
     */
    public function execute($statement, $params, $class_name=null): bool|array
    {
        try
        {
            $res = $this->pdo->prepare($statement);
            $res->execute($params);

            if ($class_name != null) { return $res->fetchAll(\PDO::FETCH_CLASS, $class_name); }
            else { return $res->fetchAll(\PDO::FETCH_CLASS); }
        }
        catch (\PDOException $ex) { throw new Exception($GLOBALS['pdo-execute-error'] . $ex->getMessage(), (int)$ex->getCode()); }
    }

    /**
     * @throws Exception
     */
    public function getDataOld($attribute, $value, $limit = 10, $order = 'id', $direction = 'ASC', $useLike = false, $table='movies', $class_name=null): bool|array|null
    {
        $query = "SELECT * FROM " . $table . " WHERE " . $attribute . " " . ($useLike ? "LIKE" : "=") . " " . ($useLike ? "'%" . $value . "%'" : "'" . $value . "'") . " ORDER BY " . $order . " " . $direction . " LIMIT " . $limit;
        try { $res = $this->execute($query, null, $class_name); }
        catch (Exception $e) { throw new Exception($e->getMessage()); }
        return $res;
    }

    /**
     * @throws Exception
     */
    public function getData($attributes, $values, $and = true, $limit = 10, $order = 'id', $direction = 'ASC', $useLike = false, $table='movies', $class_name=null): bool|array
    {
        if (count($attributes) !== count($values)) { throw new \Exception("Le nombre d'attributs doit correspondre au nombre de valeurs."); }

        // Construction de la clause WHERE
        $conditions = [];
        for ($i = 0; $i < count($attributes); $i++) { $conditions[] = $attributes[$i] . ($useLike ? " LIKE " : " = ") . ($useLike ? "'%" . $values[$i] . "%'" : "'" . $values[$i] . "'"); }
        $where = implode(($and === true ? " AND " : " OR "), $conditions);

        // Construction de la requête
        $query = "SELECT * FROM " . $table . (count($conditions) > 0 ? " WHERE " . $where : "") . " ORDER BY " . $order . " " . $direction . " LIMIT " . $limit;
        try { $res = $this->execute($query, null, $class_name); }
        catch (Exception $e) { throw new Exception($e->getMessage()); }
        return $res;
    }
}