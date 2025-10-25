<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php');
        exit;
    }

    $user_name = trim($_POST['user_name'] ?? '');
    $mail = trim($_POST['mail'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // バリデーション
    $errors = [];
    if (trim($user_name) === '') {
        $errors['user_name'] = 'ニックネームを入力してください';
    }
    if (trim($mail) === '') {
        $errors['mail'] = 'メールアドレスを入力してください';
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $errors['mail'] = '正しいメールアドレスを<br>入力してください';
    }
    if (trim($password) === '') {
        $errors['password'] = 'パスワードを入力してください';
    } elseif (!preg_match("/^[a-zA-Z0-9\-@]+$/", $password)) {
    $errors['password'] = 'パスワードは半角英数字、-、@のみ使用可能です';
    }

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = [
        'user_name' => $user_name,
        'mail'      => $mail
    ];
    header('Location: regist.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>アカウント登録確認</title>

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
<main class="regist-confirm">
    <div class="regist-confirm-container">
        <h1>アカウント情報登録</h1>
        <table>
            <tr>
                <th>ニックネーム</th>
                <td>：<?= htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>：<?= htmlspecialchars($mail, ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
            <tr>
                <th>パスワード</th>
                <td>：<?= str_repeat('●', strlen($password)) ?></td>
            </tr>
        </table>
        <div class="precautions">
            <p>※このサイトは皆様に楽しい一日を<br>　過ごしていただくために作られました。<br>　他の方を傷つけるような投稿や個人情報などを<br>　投稿しないようお願い申し上げます。</p>
        </div>
        <div class="button-group">
            <form action="regist.php" method="post">
                <input type="hidden" name="user_name" value="<?= htmlspecialchars($user_name) ?>">
                <input type="hidden" name="mail" value="<?= htmlspecialchars($mail) ?>">
                <input type="hidden" name="password" value="<?= htmlspecialchars($password) ?>">
                <input type="hidden" name="from_confirm" value="1">
                <input type="submit" value="戻る">
            </form>
            <form action="regist_complete.php" method="post">
                <input type="hidden" name="user_name" value="<?= htmlspecialchars($user_name) ?>">
                <input type="hidden" name="mail" value="<?= htmlspecialchars($mail) ?>">
                <input type="hidden" name="password" value="<?= htmlspecialchars($password) ?>">
                <input type="submit" value="登録する">
            </form>
            
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
