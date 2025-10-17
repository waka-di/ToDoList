<?php
require_once '../config/db.php';
require_once '../dto/userDTO.php';

class UserDAO {
    private $pdo;

    public function __construct($pdo = null) {
        if ($pdo === null) {
            $db = new Database(); 
            $this->pdo = $db->getConnection();
        } 
        else {
            $this->pdo = $pdo;
        }
    }

    public function insert(User $user) {
        $sql = "INSERT INTO user_data (user_name, mail, password)
                VALUES (:user_name, :mail, :password)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':user_name', $user->getUserName());
        $stmt->bindValue(':mail', $user->getMail());
        $stmt->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT)PDO::PARAM_STR);
        
        try {
            return $stmt->execute();
        } 
        catch (PDOException $e) {
            error_log("Insert error: " . $e->getMessage());
            return false;
        }
    }
}
?>