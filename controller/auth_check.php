<?php
session_start();

if (empty($_SESSION['user_name']) || empty($_SESSION['mail']) || empty($_SESSION['password'])) {
    $_SESSION['error'] = '不正なアクセスです';
    header('Location: ../index.php');
    exit;
}