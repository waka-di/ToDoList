<?php
$host = 'localhost';
$dbname = 'todo_list';
$user = 'root';
$pass = 'disql';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    echo "DB接続エラー: " . $e->getMessage();
    exit;
}