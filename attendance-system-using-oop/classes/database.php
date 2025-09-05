<?php

class Database {

    protected $pdo;
    private $host = 'localhost';
    private $db = 'attendance_system_OOP';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';

    // constructor
    public function __construct() {
        try {
            // Use class properties here
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db . ';charset=' . $this->charset;
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $event) {
            die("Database connection failed: " . $event->getMessage());
        }
    }

    // database connection 
    public function getConnection() {
        return $this->pdo;
    }


    // insert function
    public function insert($table, $data) {
        $keys = array_keys($data);
        $fields = implode(', ', $keys);
        $placeholders = ':' . implode(', :', $keys);

        $sql = "INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})";
        $stmt = $this->pdo->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        return $stmt->execute($data);
    }


    // read function
    public function read($table, $where = null, $params = []) {
        $sql = "SELECT * FROM {$table}";
        if ($where) {
            $sql .= " WHERE {$where}";
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // update function
    public function update($table, $data, $where) {
        $set = "";
        foreach ($data as $key => $val) {
            $set .= "$key=:$key, ";
        }
        $set = rtrim($set, ", ");
        $sql = "UPDATE $table SET $set WHERE $where";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }


    // delete function
    public function delete($table, $where, $params) {
        $sql = "DELETE FROM $table WHERE $where";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

}
?>