<?php
class Kriteria {
	private $conn;
	private $table_name = "data_kriteria";

	public $id;
	public $nama;
	public $bobot;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_name} VALUES(?, ?, 0, 0)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->bindParam(2, $this->nama);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
//
	function getNewID() {
		$query = "SELECT MAX(id_kriteria) AS code FROM {$this->table_name}";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], 'C', 1);
		} else {
			return $this->genCode($nomor_terakhir, 'C', 1);
		}
	}
//
	function genCode($latest, $key, $chars = 0) {
    $new = intval(substr($latest, strlen($key))) + 1;
    $numb = str_pad($new, $chars, "0", STR_PAD_LEFT);
    return $key . $numb;
	}
//check
	function readAll() {
		$query = "SELECT * FROM {$this->table_name} ORDER BY id_kriteria ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}
//
	function readAllmaster() {
		$query = "SELECT * FROM {$this->table_name} ORDER BY id_kriteria ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}
//
	function genShow(){
		$query = "SELECT * FROM {$this->table_name} ORDER BY nama_kriteria ASC";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		
		return $stmt;
	}
//
	function genTable(){
		$query ="INSERT INTO {$this->table_join1} VALUES (NULL, ?, ?, 0, 0)";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id_pengguna);
		$stmt->bindParam(2, $this->id_kriteria);

		if($stmt->execute()){
			return true;
		}
		else{
			return false;
		}
	}
//yes
	function countAll() {
		$query = "SELECT * 
		FROM {$this->table_name} ORDER BY id_kriteria ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt->rowCount();
	}
//
	function readOne() {
		$query = "SELECT * FROM {$this->table_name} WHERE id_kriteria=? LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->id = $row['id_kriteria'];
		$this->nama = $row['nama_kriteria'];
	}
//
	function readSatu($a) {
		$query = "SELECT id_kriteria, nama_kriteria FROM {$this->table_name} WHERE id_kriteria='$a' LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function update() {
		$query = "UPDATE {$this->table_name}
				SET
					nama_kriteria = :nama
				WHERE
					id_kriteria = :id";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':nama', $this->nama);
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function delete() {
		$query = "DELETE FROM {$this->table_name} WHERE id_kriteria=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
