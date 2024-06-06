<?php

namespace mdb\data_template;
use mdb\AccountDB;
class Account
{
    public function getId() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getPassword() { return $this->password; }
}