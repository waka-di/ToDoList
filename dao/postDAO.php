<?php
require_once '../config/db.php';
require_once '../dto/postDTO.php';

class PostDAO {
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

    public function insert(Post $post) {
        $sql = "INSERT INTO post_data (content)
                VALUES (:content)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':content', $post->getContent());
        
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