<?php
require_once '../dto/UserDTO.php';
require_once '../dao/UserDAO.php';

$user_name = $_POST['user_name'] ?? '';
$mail = $_POST['mail'] ?? '';
$password = $_POST['password'] ?? '';

$user = new User(null, $user_name, $mail, $password);

$userDAO = new UserDAO();
$result = $userDAO->insert($user);

if ($result) {
    header("Location: regist_complete_view.php");
    exit;
} else {
    echo "登録に失敗しました";
}
?>