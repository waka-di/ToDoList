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
    echo "データベースに接続できませんでした。時間をおいて再度お試しください。";
    exit;
}