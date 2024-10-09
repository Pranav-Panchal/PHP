<?php
require_once 'BaseRepository.php';

class UserRepository extends BaseRepository {

    public function __construct($pdo) {
        parent::__construct($pdo, 'users');
    }

    public function create($data) {
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, password, role) VALUES (:username, :password, :role)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'username' => $data['username'],
            'password' => $hashedPassword,
            'role' => $data['role'] ?? 'employee'
        ]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data) {
        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':id' => $id,
        ]);
        return $stmt->rowCount();  
    }

    public function findByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function login($username, $password) {
        $user = $this->findByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}