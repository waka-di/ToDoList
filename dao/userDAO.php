<?php
require_once 'User.php';

class UserDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function insert(User $user) {
        $sql = "INSERT INTO user_data (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':name', $user->getName());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT));
        return $stmt->execute();
    }
}