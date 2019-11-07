<?php
class Profile {
	private $conn;
	private $table_name= "users";

	public $id;
	public $role;
	public $nama;
	public $username;
	public $password;
	public $foto;

	public function __construct($db) {
			$this->conn = $db;
	}

	function read() {
		$query = "SELECT * FROM {$this->table_name} WHERE id_pengguna=? LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->foto = $row['foto'];
		$this->nama = $row['nama'];
		$this->role = $row['role'];
		$this->username = $row['username'];
		$this->password = $row['password'];
	}
	
	function update() {
		$query = "UPDATE {$this->table_name}
							SET
								foto = :foto,
								nama = :nama, 
								username = :username,
								password = :password
							WHERE
								id_pengguna = :id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':foto', $this->foto);
		$stmt->bindParam(':nama', $this->nama);
		$stmt->bindParam(':username', $this->username);
		$stmt->bindParam(':password', $this->password);
		$stmt->bindParam(':id', $this->id);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
?>