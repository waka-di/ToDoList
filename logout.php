<?php
session_start();

$_SESSION = [];

session_destroy();

if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 1, '/');
}
header("Location: index.php");
exit;
?>
