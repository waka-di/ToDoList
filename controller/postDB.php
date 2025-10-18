<?php
session_start();
require_once __DIR__ . '/../config/db.php';

$user_id = $_SESSION['user_id'] ?? null;
$user_name = $_SESSION['user_name'] ?? '';

if (!$user_id) {
    http_response_code(403); 
    echo json_encode(['error' => 'ログインが必要です']);
    exit;
}

// --- 投稿内容を受け取る ---
$content = $_POST['content'] ?? '';

if ($content === '') {
    http_response_code(400);
    echo json_encode(['error' => '投稿内容が未入力です']);
    exit;
}

// --- データ登録処理 ---
$stmt = $pdo->prepare("INSERT INTO post_data (user_id, content) VALUES (?, ?)");
$stmt->execute([$user_id, $content]);

echo json_encode([
    'success' => true,
    'user_id' => $user_id,
    'content' => $content,
    'user_name' => $_SESSION['user_name'],
]);