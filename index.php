<?php
    session_start();
    $errors = [];

    if (!empty($_SESSION['error_message'])) {
    echo '<p style="color:red; text-align:center;">' . htmlspecialchars($_SESSION['error_message']) . '</p>';
    unset($_SESSION['error_message']);
    }

    if (!empty($_SESSION['error']) && is_array($_SESSION['error'])) {
        $errors = $_SESSION['error'];
        unset($_SESSION['error']);
    } 
    elseif (!empty($_SESSION['error'])) {
        echo '<p style="color:red; text-align:center;">' . htmlspecialchars($_SESSION['error']) . '</p>';
        unset($_SESSION['error']);
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WHO'S ToDo List?</title>
<meta name="description" content="「WHO’S ToDo List?」は、ユーザーが日々のタスクを匿名で投稿し、他のユーザーのタスクを共有・参考にできるWebアプリです。">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Murecho:wght@100..900&family=Noto+Sans+JP:wght@100..900&family=Outfit:wght@100..900&family=Playwrite+DE+Grund+Guides&family=Poppins:ital,wght@0,700;0,800;1,700;1,800&display=swap" rel="stylesheet">

<!-- リセットCSS -->
<link rel="stylesheet" href="https://unpkg.com/ress@4.0.0/dist/ress.min.css">

<link rel="stylesheet" href="./css/style.css">

</head>

<body>

<!-- ヘッダー -->
    <header class="header">
        <div class="regist_link">
            <a href="regist\regist.php">新規登録はこちらから</a>
        </div>
    </header>

    <!-- メイン -->
    <main class="top-main">
        <div class="top-container">
            <div class="title">
                <img src="images/logo.png" alt="WHO’S ToDo List">
            </div>
            <div class="login">
                <form action="main.php" method="post">
                    <input type="email" name="mail" placeholder="メールアドレス">
                    <?php if (isset($errors['mail'])): ?>
                        <p style="color:red"><?= $errors['mail'] ?></p>
                    <?php endif; ?>

                    <input type="password" name="password" placeholder="パスワード">
                    <?php if (isset($errors['password'])): ?>
                        <p style="color:red"><?= $errors['password'] ?></p>
                    <?php endif; ?>
                    <input type="submit" value="ログイン">
                </form>
            </div>
            <div class="top-bottom-image">
                <img src="images/top_image.png" alt="Let's take a look together">
            </div>
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
