<?php
    session_start();

    $user_id = $_SESSION['user_id'] ?? null;
    if (!$user_id) {
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
        $errors['mail'] = '正しいメールアドレスを入力してください';
    }
    if ($password !== '') {
        if (!preg_match("/^[a-zA-Z0-9]+$/", $password)) {
            $errors['password'] = 'パスワードは半角英数字のみ可能です';
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
        }
    }
    if ($errors) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = [
            'user_name' => $user_name,
            'mail' => $mail
        ];
        header('Location: update.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>アカウント情報変更確認</title>

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Murecho:wght@100..900&family=Noto+Sans+JP:wght@100..900&family=Outfit:wght@100..900&family=Playwrite+DE+Grund+Guides&family=Poppins:ital,wght@0,700;0,800;1,700;1,800&display=swap" rel="stylesheet">

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
<main class="update-confirm">
    <div class="update-confirm-container">
        <table>
            <tr>
                <th>ニックネーム</th>
                <td>：<?= htmlspecialchars($user_name) ?></td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>：<?= htmlspecialchars($mail) ?></td>
            </tr>
            <tr>
                <th>パスワード</th>
                <td>：
                    <?php if ($password !== ''): ?>
                        <?= str_repeat('●', strlen($password)) ?>
                    <?php else: ?>
                        （変更なし）
                    <?php endif; ?>
                </td>
            </tr>
        </table>
        <div class="button-group">
            <form action="update.php" method="post">
                <input type="hidden" name="user_name" value="<?= htmlspecialchars($user_name) ?>">
                <input type="hidden" name="mail" value="<?= htmlspecialchars($mail) ?>">
                <input type="hidden" name="password" value="<?= htmlspecialchars($password) ?>">
                <input type="submit" value="戻る">
            </form>
            <form action="update_complete.php" method="post">
                <input type="hidden" name="user_name" value="<?= htmlspecialchars($user_name) ?>">
                <input type="hidden" name="mail" value="<?= htmlspecialchars($mail) ?>">
                <input type="hidden" name="password" value="<?= htmlspecialchars($password) ?>">
                <input type="submit" value="変更する">
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
