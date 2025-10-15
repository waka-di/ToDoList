<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>アカウント登録確認</title>

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">

<!-- リセットCSS -->
<link rel="stylesheet" href="https://unpkg.com/ress@4.0.0/dist/ress.min.css">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<link rel="stylesheet" href="../css/style.css">

</head>

<body>
<!-- ヘッダー -->
<header class="header">
    <div class="logo">
            <img src="../images/logo.png" alt="WHO’S ToDo List">
    </div>
</header>

<!-- メイン -->
 <?php
session_start();

$user_name = $_POST['user_name'] ?? '';
$mail = $_POST['mail'] ?? '';
$password = $_POST['password'] ?? '';

$errors = [];

// バリデーション
if (trim($user_name) === '') $errors['user_name'] = 'ニックネームを入力してください';
if (trim($mail) === '') $errors['mail'] = 'メールアドレスを入力してください';
elseif (!preg_match("/^[a-zA-Z0-9@\-\.]+$/", $mail)) $errors['mail'] = 'メールアドレスは半角英数字、@、-、.のみ可能';
if (trim($password) === '') $errors['password'] = 'パスワードを入力してください';
elseif (!preg_match("/^[a-zA-Z0-9]+$/", $password)) $errors['password'] = 'パスワードは半角英数字のみ可能';

$_SESSION['user_name'] = $user_name;
$_SESSION['mail'] = $mail;
$_SESSION['password'] = $password;

// エラーがあればフォームに戻す
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;  // セッションにエラーを保存
    header('Location: regist.php');
    exit;
}

// エラーなし → 確認画面表示
?>
<main class="regist-confirm">
    <div class="regist-confirm-container">
        <?php if (!empty($errors)): ?>
    <div class="errors">
        <ul>
        <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e, ENT_QUOTES, 'UTF-8') ?></li>
        <?php endforeach; ?>
        </ul>
        <a href="register_form.php">戻る</a>
    </div>
<?php else: ?>
    <table>
        <tr>
            <th>ニックネーム</th>
            <td><?= htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8') ?></td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td><?= htmlspecialchars($mail, ENT_QUOTES, 'UTF-8') ?></td>
        </tr>
        <tr>
            <th>パスワード</th>
            <td><?= str_repeat('●', strlen($password)) ?></td>
        </tr>
    </table>
    <form action="register_complete.php" method="post">
        <input type="submit" value="登録する">
    </form>
    <form action="register_form.php" method="post">
        <input type="submit" value="戻る">
    </form>
<?php endif; ?>
    </div>
</main>

<!-- フッター -->
<footer class="footer">
    <div class="container">
        <small class="footer-copyright">Copyright © 2025 M/W's Portfolio. All Rights Reserved.</small>
    </div>
</footer>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Slick -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="../js/main.js"></script>
</body>
</html>
