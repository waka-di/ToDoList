<?php
    session_start();
    require_once '../config/db.php';

    if ($user_name === '' || $mail === '' || $password === '') {
        $_SESSION['error'] = '不正なアクセスです';
        header('Location: ../index.php');
        exit;
    }

    $user_name = $_POST['user_name'] ?? '';
    $mail = $_POST['mail'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_data WHERE mail = ?");
    $stmt->execute([$mail]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $_SESSION['errors']['mail'] = 'このメールアドレスは既に登録されています。';
        $_SESSION['form_data'] = $_POST;
        header('Location: regist.php');
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO user_data (user_name, mail, password, insert_date) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$user_name, $mail, password_hash($password, PASSWORD_DEFAULT)]);

    $user_id = $pdo->lastInsertId();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $user_name;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>アカウント登録完了</title>

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Murecho:wght@100..900&family=Noto+Sans+JP:wght@100..900&family=Outfit:wght@100..900&family=Playwrite+DE+Grund+Guides&family=Poppins:ital,wght@0,700;0,800;1,700;1,800&display=swap" rel="stylesheet">

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
    <div class="footer-container">
        <small class="footer-copyright">Copyright © 2025 M/W's Portfolio. All Rights Reserved.</small>
    </div>
</footer>
</body>
</html>
