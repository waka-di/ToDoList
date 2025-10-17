<?php
    session_start();
    $errors = $_SESSION['errors'] ?? [];
    unset($_SESSION['errors']);

    $user_name = $_POST['user_name'] ?? '';
    $mail      = $_POST['mail'] ?? '';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>アカウント登録</title>

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
<main class="regist">
    <div class="regist-container">
        <h1>アカウント登録</h1>
            <form action="regist_confirm.php" method="post" class="regist-form">
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
                    <input type="password" id="password" name="password">
                    <p>※パスワードは半角英数字、半角ハイフン、半角記号（ハイフンとアットマーク）のみでご入力お願いいたします。</p>
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
