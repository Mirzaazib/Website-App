<?php 
class Login {
    private $conn;
    private $table_name = "users";

    public $user;
    public $userid;
    public $passid;
    public $email;
    public $username;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login() {
        $user = $this->checkCredentials();
        if ($user) {
            $this->user = $user;
            session_start();
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['id_pengguna'] = $user['id_pengguna'];
            $_SESSION['level_user'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            return $user['nama'];
        }
        return false;
    }

    protected function checkCredentials() {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_name.' WHERE username=? and password=? ');
        $stmt->bindParam(1, $this->userid);
        $stmt->bindParam(2, $this->passid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->passid;
            if ($submitted_pass == $data['password']) {
                return $data;
            }
        }
        return false;
    }

    public function getUser() {
        return $this->user;
    }
    //
    function read() {
		$query = "SELECT email FROM {$this->table_name} WHERE username=? LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->username);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->email = $row['email'];
    }
    //
    function update() {
		$query = "UPDATE {$this->table_name}
							SET
								email = :email
							WHERE
								username = :username";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':username', $this->username);
		$stmt->bindParam(':email', $this->email);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
