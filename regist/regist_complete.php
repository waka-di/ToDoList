<?php
$user_name = $_POST['user_name'] ?? '';
$mail = $_POST['mail'] ?? '';
$password = $_POST['password'] ?? '';

if ($user_name === '' || $mail === '' || $password === '') {
    header('Location: regist.php');
    exit;
}

 require_once '../config/db.php';
 $stmt = $pdo->prepare("INSERT INTO user_data (user_name, mail, password, insert_date) VALUES (?, ?, ?, NOW())");
 $stmt->execute([$user_name, $mail, password_hash($password, PASSWORD_DEFAULT)]);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>アカウント登録完了</title>

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
<main class="regist-complete-container">
        <p>登録完了しました！<br>ようこそ　<?= htmlspecialchars($user_name) ?> 　さん</p>
        <form action="../main.php" method="get">
        <input type="submit" value="メインページへ">
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
