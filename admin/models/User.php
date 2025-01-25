<?php

require '../config/database.php';

class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function authenticate($username, $password)
    {
        // Sanitasi input untuk mencegah SQL Injection
        $query = $this->db->prepare("SELECT * FROM admin WHERE username = :username AND password = :password");
        $query->execute([
            'username' => $username,
            'password' => $password
        ]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // Verifikasi password
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
?>
