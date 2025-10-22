<?php
    session_start();
    require_once '../config/db.php';

    $user_id = $_SESSION['user_id'] ?? null;
    
    if (!$user_id) {
        $_SESSION['error'] = "不正なアクセスです";
        header('Location: ../index.php');
        exit;
    }

try {
    $stmt = $pdo->prepare("DELETE FROM post_data WHERE user_id=?");
    $stmt->execute([$user_id]);

    $stmt = $pdo->prepare("DELETE FROM user_data WHERE user_id=?");
    $stmt->execute([$user_id]);

    $pdo->commit();

    session_destroy();

} 
atch (PDOException $e) {
    $pdo->rollBack();

    $_SESSION['error_message'] = "エラーが発生したためアカウント削除できません。";
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>アカウント削除完了</title>

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
<main class="delete-complete-container">
        <p>ご利用いただきありがとうございました！</p>
        <form action="../index.php" method="get">
        <input type="submit" value="ログインページへ">
</main>

<!-- フッター -->
<footer class="footer">
    <div class="footer-container">
        <small class="footer-copyright">Copyright © 2025 M/W's Portfolio. All Rights Reserved.</small>
    </div>
</footer>
</body>
</html>
