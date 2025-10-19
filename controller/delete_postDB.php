<?php
session_start();
require_once '../config/db.php'; 

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'];
$post_id = $_GET['id'] ;

$stmt = $pdo->prepare("DELETE FROM post_data WHERE post_id = ? AND user_id = ?");
$stmt->execute([$post_id, $user_id]);

echo json_encode(['success' => true]);

