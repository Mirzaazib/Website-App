<?php
class register {
	private $conn;
	private $table_name = "users";

	public $id;
	public $nama;
	public $role;
	public $username;
	public $password;
	public $foto;

  public function __construct($db) {
        $this->conn = $db;
    }

    function insert() {
		$query = "INSERT INTO {$this->table_name} VALUES(?, ?, ?, ?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->bindParam(2, $this->nama);
		$stmt->bindParam(3, $this->role);
		$stmt->bindParam(4, $this->username);
		$stmt->bindParam(5, $this->password);
		$stmt->bindParam(6, $this->foto);

		if ($stmt->execute()) {
			session_start();
            $_SESSION['id_pengguna'] = $this->id;
            $_SESSION['nama'] = $this->nama;
            $_SESSION['level_user'] = $this->role;
            $_SESSION['username'] = $this->username;
			return true;
		} else {
			return false;
		}
	}

	function getNewID() {
		$query = "SELECT MAX(id_pengguna) AS code FROM {$this->table_name}";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], 'USR', 3);
		} else {
			return $this->genCode($nomor_terakhir, 'USR', 3);
		}
	}

	function genCode($latest, $key, $chars = 0) {
    $new = intval(substr($latest, strlen($key))) + 1;
    $numb = str_pad($new, $chars, "0", STR_PAD_LEFT);
    return $key . $numb;
	}

}