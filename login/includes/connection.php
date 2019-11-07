<?php
class Config {
  private $host = "localhost";
  private $db_name = "dbahp";
  private $username = "root";
  private $password = "";
  public $conn;

  public function getConnection() {
    $this->conn = null;
    try {
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
    } catch (PDOException $exception) {
      echo "Database Not Connect. error: " . $exception->getMessage();
    }
    return $this->conn;
  }
}
