<?php
namespace Prams;

class DbConnection {
    private $_dbh;

    public function __construct() {
        $dsn = sprintf("mysql:host=%s;port=%s;dbname=%s;charset=utf8", PRAMS_DB_HOST, PRAMS_DB_PORT, PRAMS_DB_NAME);
        $this->_dbh = new \PDO($dsn, PRAMS_DB_USER, PRAMS_DB_PASS);
        $this->_dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getDbh() {
        return $this->_dbh;
    }
}