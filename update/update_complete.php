<?php
    session_start();
    require_once '../config/db.php';

    $user_id = $_SESSION['user_id'] ?? null;
    if (!$user_id) {
        header('Location: index.php');
        exit;
    }

    $user_name = $_POST['user_name'] ?? '';
    $mail = $_POST['mail'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($password !== '') {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE user_data SET user_name=?, mail=?, password=? WHERE user_id=?");
        $stmt->execute([$user_name, $mail, $password_hash, $user_id]);
    } else {
        $stmt = $pdo->prepare("UPDATE user_data SET user_name=?, mail=? WHERE user_id=?");
        $stmt->execute([$user_name, $mail, $user_id]);
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>アカウント情報変更完了</title>

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&&family=Hachi+Maru+Pop&family=Murecho:wght@100..900&family=Murecho:wght@100..900&family=Noto+Sans+JP:wght@100..900&family=Outfit:wght@100..900&family=Playwrite+DE+Grund+Guides&family=Poppins:ital,wght@0,700;0,800;1,700;1,800&display=swap" rel="stylesheet">
<!-- リセットCSS -->
<link rel="stylesheet" href="https://unpkg.com/ress@4.0.0/dist/ress.min.css">
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
<main class="update-complete-container">
        <p>変更完了しました！</p>
        <form action="../mypage.php" method="get">
        <input type="submit" value="マイページへ">
</main>

<!-- フッター -->
<footer class="footer">
    <div class="footer-container">
        <small class="footer-copyright">Copyright © 2025 M/W's Portfolio. All Rights Reserved.</small>
    </div>
</footer>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
