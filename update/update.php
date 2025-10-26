<?php
    session_start();
    require_once '../config/db.php';

    $user_id = $_SESSION['user_id'] ?? null;
    if (!$user_id) {
        $_SESSION['error'] = "不正なアクセスです";
        header('Location: ../index.php'); 
        exit;
    }

    $stmt = $pdo->prepare("SELECT user_name, mail FROM user_data WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $user_name = $user['user_name'];
    $mail = $user['mail'];
    $password = ''; 

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['user_name'])) {
        $user_name = $_POST['user_name'] ?? $user_name;
        $mail      = $_POST['mail'] ?? $mail;
        $password  = $_POST['password'] ?? '';
    }

    if (!empty($_SESSION['form_data']) || !empty($_SESSION['errors'])) {
        $errors = $_SESSION['errors'] ?? [];
        $form_data = $_SESSION['form_data'] ?? [];
        unset($_SESSION['errors'], $_SESSION['form_data']);

        $user_name = $form_data['user_name'] ?? $user['user_name'];
        $mail      = $form_data['mail'] ?? $user['mail'];
        $password  = $form_data['password'] ?? '';
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>アカウント情報変更</title>

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
<header class="common-header">
    <div class="logo">
            <img src="../images/logo.png" alt="WHO’S ToDo List">
    </div>
    <div class="mypage_link">
        <a href="../mypage.php">My page</a>
    </div>
</header>

<!-- メイン -->
<main class="update">
    <div class="update-container">
        <h1>アカウント情報変更</h1>
            <form action="update_confirm.php" method="post" class="update-form">
                <div class="form-row">
                    <label for="user_name">ニックネーム：</label>
                    <input type="text" id="user_name" name="user_name" value="<?= htmlspecialchars($user_name) ?>">
                </div>
                <?php if (isset($errors['user_name'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['user_name']) ?></span>
                <?php endif; ?>

                <div class="form-row">
                    <label for="mail">メールアドレス：</label>
                    <input type="text" id="mail" name="mail" value="<?= htmlspecialchars($mail) ?>">
                </div>
                <?php if (isset($errors['mail'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['mail']) ?></span>
                <?php endif; ?>

                <div class="form-row">
                    <label for="password">パスワード：</label>
                    <input type="text" id="password" name="password" value="<?= htmlspecialchars($password) ?>">
                    <p>※パスワードは変更する場合のみ<br>　入力してください</p>
                </div>
                <?php if (isset($errors['password'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['password']) ?></span>
                <?php endif; ?>
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
