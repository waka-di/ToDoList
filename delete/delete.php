<?php
    session_start();
    require_once '../config/db.php';

    $user_id = $_SESSION['user_id'] ?? null;
    if (!$user_id) {
        header('Location: index.php'); 
        exit;
    }

    $stmt = $pdo->prepare("SELECT user_name, mail FROM user_data WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "ユーザー情報が見つかりません。";
        exit;
    }

    $user_name = $_POST['user_name'] ?? $user['user_name'];
    $mail      = $_POST['mail'] ?? $user['mail'];
    $password  = $_POST['password'] ?? '';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>アカウント削除</title>

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
<header class="delete-header">
    <div class="logo">
            <img src="../images/logo.png" alt="WHO’S ToDo List">
    </div>
    <div class="mainpage_link">
        <a href="main.php">main page</a>
    </div>
</header>

<!-- メイン -->
<main class="delete">
    <div class="delete-container">
        <h1>アカウント情報削除</h1>
        <table>
            <tr>
                <th>表示名<br>（ニックネーム）</th>
                <td>：<?= htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>：<?= htmlspecialchars($mail, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        </table>
        <form action="delete_confirm.php" method="post">
            <input type="submit" value="確認する">
        </form>
    </div>
</main>

<!-- フッター -->
<footer class="footer">
    <div class="footer-container">
        <small class="footer-copyright">Copyright © 2025 M/W's Portfolio. All Rights Reserved.</small>
    </div>
</footer>
</body>
</html>
