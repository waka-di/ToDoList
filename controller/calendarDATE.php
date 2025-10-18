<?php
session_start();
require_once __DIR__ . '/../config/db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'ログインが必要です']);
    exit;
}

// --- 日付パラメータ ---
$date = $_GET['date'] ?? date('Y-m-d');

// --- 投稿データ取得 ---
$stmt = $pdo->prepare("
    SELECT post_data.*, user_data.user_name 
    FROM post_data
    JOIN user_data ON post_data.user_id = user_data.user_id
    WHERE DATE(post_date) = ?
    ORDER BY post_id DESC
");
$stmt->execute([$date]);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['posts' => $posts]);