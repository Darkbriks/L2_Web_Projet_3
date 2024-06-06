<?php

namespace mdb;

use Exception;
use pdo_wrapper\PdoWrapper;

class AccountDB extends PdoWrapper
{
    /**
     * @throws Exception
     */
    public function __construct()
    {
        try { parent::__construct($GLOBALS['db_name'], $GLOBALS['db_host'], $GLOBALS['db_port'], $GLOBALS['db_user'], $GLOBALS['db_pwd']); }
        catch (Exception $e) { throw new Exception($e->getMessage(), (int)$e->getCode()); }
    }

    public function getAccountPasswords(): array
    {
        return $this->execute("SELECT password FROM account",NULL,"mdb\data_template\Account");
    }

    public function getAccountUsername(): array
    {
        return $this->execute("SELECT username FROM account",NULL,"mdb\data_template\Account");
    }

    public function getAccounts(): array
    {
        return $this->execute("SELECT * FROM account",NULL,"mdb\data_template\Account");
    }
}