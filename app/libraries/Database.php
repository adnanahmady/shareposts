<?php

class Database
{
    private $host    = HOST;
    private $user    = USER;
    private $pass    = PASS;
    private $dbname  = DBNAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct() {

        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        $options = [
            PDO::ATTR_PERSISTENT    => TRUE,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        ];


        try {

            $this->dbh      = new PDO($dsn, $this->user, $this->pass, $options);
        } catch ( PDOException $ex ) {
            $this->error = $ex->getMessage();
            echo $this->error;
        }

    }

    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null) {
        if ($type === null) {
            switch(true) {
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statment
    public function execute() {
        return $this->stmt->execute();
    }

    // Get result set as array of objects
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get RowCount
    public function rowCount() {
        return $this->stmt->rowCount();
    }
}