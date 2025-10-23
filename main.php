<?php
    session_start();
    require_once 'config/db.php';
    $errors = [];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mail = $_POST['mail'];
        $password = $_POST['password'];

        if (trim($mail) === '') {
            $errors['mail'] = 'メールアドレスを入力してください';
        } 
        if (trim($password) === '') {
            $errors['password'] = 'パスワードを入力してください';
        }

        if (empty($errors)) {
            $stmt = $pdo->prepare("SELECT * FROM user_data WHERE mail = ?");
            $stmt->execute([$mail]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id']; 
                $_SESSION['user_name'] = $user['user_name'];
                header('Location: main.php');
                exit;
            } 
            else {
                $_SESSION['error'] = 'エラーが発生したためログイン情報を取得できません。';
                header('Location: index.php');
                exit;
            }
        } 
    $_SESSION['error'] = $errors;
    header('Location: index.php');
    exit;
}

    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error_message'] = "不正なアクセスです";
        header('Location: index.php');
        exit;
    }
        
    $user_name = $_SESSION['user_name'];

    require_once __DIR__ . '/vendor/autoload.php';
    use Yasumi\Yasumi;

    // --- パラメータ受け取り ---
    $year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
    $month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');

    // --- 前月・翌月を計算 ---
    $prevMonth = $month - 1;
    $nextMonth = $month + 1;
    $prevYear = $nextYear = $year;

    // --- 祝日 ---
    $holidays = Yasumi::create('Japan', $year, 'ja_JP');
    $holidayDates = [];
    foreach ($holidays as $holiday) {
        $holidayDates[] = $holiday->format('Y-n-j');
    }
    if ($prevMonth == 0) {
        $prevMonth = 12;
        $prevYear--;
    }
    if ($nextMonth == 13) {
        $nextMonth = 1;
        $nextYear++;
    }

    // --- 月の最初の日 ---
    $firstDay = strtotime("$year-$month-01");
    $daysInMonth = date('t', $firstDay);
    $startWeek = (date('w', $firstDay) + 6) % 7;

    $today = date('Y-m-d');
    $stmt = $pdo->prepare("SELECT post_data.*, user_data.user_name 
                        FROM post_data 
                        JOIN user_data ON post_data.user_id = user_data.user_id 
                        WHERE DATE(post_date) = ? 
                        ORDER BY post_id DESC");
    $stmt->execute([$today]);
    $today_posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>メインページ</title>

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&&family=Hachi+Maru+Pop&family=Murecho:wght@100..900&family=Murecho:wght@100..900&family=Noto+Sans+JP:wght@100..900&family=Outfit:wght@100..900&family=Playwrite+DE+Grund+Guides&family=Poppins:ital,wght@0,700;0,800;1,700;1,800&display=swap" rel="stylesheet">

<!-- リセットCSS -->
<link rel="stylesheet" href="https://unpkg.com/ress@4.0.0/dist/ress.min.css">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<link rel="stylesheet" href="css/style.css">

</head>

<body>
<!-- ヘッダー -->
<header class="main-header">
    <div class="logo">
            <img src="images/logo.png" alt="WHO’S ToDo List">
    </div>
    <div class="page_link">
        <a href="mypage.php">My page</a>
        <a href="logout.php">Logout</a>
    </div>
</header>

<!-- メイン -->
<main class="main-container">
    <div class="calendar-container">
        <h1>Main Page</h1>
        <div class="search">
            <a href="?year=<?= $prevYear ?>&month=<?= $prevMonth ?>">◀</a>
            <?= $year ?>年 <?= $month ?>月
            <a href="?year=<?= $nextYear ?>&month=<?= $nextMonth ?>">▶</a>
        </div>
        
        <table class="calendar">
            <tr>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
                <th>日</th>
            </tr>
            <tr>
                <?php
                for ($i = 0; $i < $startWeek; $i++) echo "<td></td>";
                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $w = ($startWeek + $day - 1) % 7;
                    $date = "$year-$month-$day";

                    $class = '';
                    if ($w == 5) $class = 'saturday';
                    elseif ($w == 6) $class = 'sunday';
                    elseif (in_array($date, $holidayDates)) $class = 'holiday';

                     echo "<td class='$class' data-date='$date'>$day</td>";

                    if ($w == 6 && $day != $daysInMonth) echo "</tr><tr>";
                }

                for ($i = ($startWeek + $daysInMonth) % 7; $i < 7 && $i != 0; $i++) echo "<td></td>";
                ?>
            </tr>
        </table>
        <div class="post-form">
            <h3>今日のやること</h3>
            <textarea id="todo_text" rows="3" cols="30" placeholder="入力してください"></textarea><br><br>
            <div class="btn-wrap">
                <button id="postBtn">投稿する</button>
            </div>
        </div>
    </div>
        <div class="post-container">
            <?php foreach($today_posts as $post): ?>
                <div class="post-item">
                    <strong><?= htmlspecialchars($post['user_name']) ?></strong>：<?= htmlspecialchars($post['content']) ?>
                </div>
            <?php endforeach; ?>
        </div>
</main>

<!-- フッター -->
<footer class="footer">
    <div class="footer_container">
        <small class="footer-copyright">Copyright © 2025 M/W's Portfolio. All Rights Reserved.</small>
    </div>
</footer>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {
        $('#postBtn').on('click', function() {
            const content = $('#todo_text').val().trim();
            if (content === '') return;

            $.post('controller/postDB.php', { content: content }, function(response) {
            console.log(response);
                const data = JSON.parse(response);
                if (data.success) {
                    $('#todo_text').val('');
                     const newPost = `<div class="post-item" data-date="${data.date}"><strong>${data.user_name}</strong>：${data.content}</div>`;
                    $('.post-container').prepend(newPost);
                }
            });
        });

        $('.calendar td').on('click', function() {
            const date = $(this).data('date');
            if (!date) return;

            $.get('controller/calendarDATE.php', { date: date }, function(response) {
                const data = typeof response === 'string' ? JSON.parse(response) : response;
                $('.post-container .post-item').hide();
                data.posts.forEach(post => {
                    const selector = `.post-container .post-item[data-date="${date}"]`;
                    if ($(selector).length) {
                        $(selector).show();
                    } 
                    else {
                        const html = `<div class="post-item" data-date="${date}"><strong>${post.user_name}</strong>：${post.content}</div>`;
                        $('.post-container').append(html);
                    }
                });
            });
        });
    });
</script>
</body>
</html>