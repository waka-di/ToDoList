<?php
require_once '../dto/UserDTO.php';
require_once '../dao/UserDAO.php';

session_start();
$user_id = $_SESSION['user_id'];

$user_name = $_POST['user_name'] ?? '';
$mail = $_POST['mail'] ?? '';
$password = $_POST['password'] ?? '';

$user = new User($user_id, $user_name, $mail, $password);

$userDAO = new UserDAO();
$result = $userDAO->update($user);

if ($result) {
    header("Location: update_complete_view.php");
    exit;
} else {
    echo "更新に失敗しました";
}