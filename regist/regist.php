<?php
    session_start();
    $errors = $_SESSION['errors'] ?? [];
    unset($_SESSION['errors']);

    $form_data = $_POST ?: ($_SESSION['form_data'] ?? []);
    unset($_SESSION['form_data']);

    // 安全にデフォルト値を入れる
    $user_name = $form_data['user_name'] ?? '';
    $mail      = $form_data['mail'] ?? '';

    if (!empty($_POST['from_confirm'])) {
    $_SESSION['from_confirm'] = true;
}
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
    <div class="regist-container container">
            <form action="regist_confirm.php" method="post" class="regist-form" autocomplete="off">
                <input type="text" style="display:none" autocomplete="off">
                <input type="password" style="display:none" autocomplete="new-password">

                <div class="form-row">
                    <label for="user_name">ニックネーム：</label>
                    <input type="text" id="user_name" name="user_name" value="<?= htmlspecialchars($user_name) ?>" autocomplete="off">
                </div>
                <?php if (isset($errors['user_name'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['user_name']) ?></span>
                <?php endif; ?>

                <div class="form-row">
                    <label for="mail">メールアドレス：</label>
                    <input type="text" id="mail" name="mail" value="<?= htmlspecialchars($mail) ?>" autocomplete="off">
                </div>
                <?php if (isset($errors['mail'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['mail']) ?></span>
                <?php endif; ?>

                <div class="form-row">
                    <label for="password">パスワード：</label>
                    <input type="password" id="password" name="password" value="" autocomplete="new-password">
                    <p>※パスワードは半角英数字、半角ハイフン、<br>　アットマークでご入力お願いいたします。</p>
                    <?php if (!empty($_SESSION['from_confirm'])): ?>
                        <span class="notice">※確認画面から戻った場合は、パスワードを再入力してください。</span>
                    <?php endif; ?>
                    <?php unset($_SESSION['from_confirm']); ?>
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
