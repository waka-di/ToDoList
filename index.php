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
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">

<!-- リセットCSS -->
<link rel="stylesheet" href="https://unpkg.com/ress@4.0.0/dist/ress.min.css">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<link rel="stylesheet" href="./css/style.css">

</head>

<body>

<!-- ヘッダー -->
<header class="header">
    <div class="regist_link">
        <a href="#">新規登録はこちらから</a>
    </div>
</header>

<!-- メイン -->
<main class="top-main">
    <div class="top-container">
        <div class="title">
            <img src="images/logo.png" alt="WHO’S ToDo List">
        </div>
        <div class="login">
            <form action="login.php" method="post">
                <input type="email" name="mail" placeholder="メールアドレス" required>
                <input type="password" name="password" placeholder="パスワード" required>
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
    <div class="container">
        <small class="footer-copyright">Copyright © 2025 M/W's Portfolio. All Rights Reserved.</small>
    </div>
</footer>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Slick -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="./js/main.js"></script>
</body>
</html>
