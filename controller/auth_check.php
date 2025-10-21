<?php
session_start();

if (empty($_SESSION['user_id'])) {
    $_SESSION['error'] = '不正なアクセスです';
    header('Location: ../index.php');
    exit;
}