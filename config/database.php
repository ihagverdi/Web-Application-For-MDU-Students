<?php 
  class Database {
    // DB Params
    private $host = 'bs9fos3w35vyojubi2ah-mysql.services.clever-cloud.com';
    private $db_name = 'bs9fos3w35vyojubi2ah';
    private $username = 'u7t50cgmvcm8r2qd';
    private $password = 'pKhsYb3jlp3EXcZKpzNx';
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;
      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }
      return $this->conn;
    }
  }
?>