<?php
class Alternatif {
    private $conn;
	private $table_name = "data_alternatif";

	public $id;
	public $lokasi;
	public $hasil;

	public function __construct($db) {
		$this->conn = $db;
    }
//    
    function insert() {
        $query = "INSERT INTO {$this->table_name} VALUES (?, ?, ?, 0)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_alternatif);
        $stmt->bindParam(2, $this->lokasi);
        $stmt->bindParam(3, $this->keterangan);
        if ($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }
//check
		function countAll(){
			$query = "SELECT * FROM {$this->table_name} ORDER BY id_alternatif ASC";
			$stmt = $this->conn->prepare( $query );
			$stmt->execute();
	
			return $stmt->rowCount();
		}
//check
		function readSatu($a) {
			$query = "SELECT * FROM {$this->table_name} WHERE id_alternatif='$a' LIMIT 0,1";
			$stmt = $this->conn->prepare( $query );
			$stmt->execute();
	
			return $stmt;
		}
//
    function readAll() {
		$query = "SELECT * FROM {$this->table_name} ORDER BY id_alternatif ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
    }
//   
    function genCode($latest, $key, $chars = 0) {
        $new = intval(substr($latest, strlen($key))) + 1;
        $numb = str_pad($new, $chars, "0", STR_PAD_LEFT);
        return $key . $numb;
        }
//    
    function getNewID() {
		$query = "SELECT MAX(id_alternatif) AS code FROM {$this->table_name}";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], 'A', 1);
		} else {
			return $this->genCode($nomor_terakhir, 'A', 1);
		}
		}
//		
		function genNextCode($start, $key, $chars = 0) {
			$new = str_pad($start, $chars, "0", STR_PAD_LEFT);
			return $key . $new;
		}
//   
    function readOne() {
		$query = "SELECT * FROM {$this->table_name} WHERE id_alternatif=? LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->id = $row['id_alternatif'];
		$this->lokasi = $row['lokasi'];
		$this->ket = $row['keterangan'];
	}
//	
	function readByRank() {
		$query = "SELECT * FROM {$this->table_name} ORDER BY hasil_akhir DESC LIMIT 0,5";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}
//   
    function update() {
		$query = "UPDATE {$this->table_name}
				SET
					lokasi = :lokasi, keterangan = :ket
				WHERE
					id_alternatif = :id";
//
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':ket', $this->ket);
		$stmt->bindParam(':lokasi', $this->lokasi);
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
    }
//  
    function delete() {
		$query = "DELETE FROM {$this->table_name} WHERE id_alternatif=?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function countMax() {
		$query = "SELECT MAX(hasil_akhir) AS hasil FROM {$this->table_name}";
			$stmt = $this->conn->prepare( $query );
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$this->hsl = $row['hasil'];
	}

}
?>