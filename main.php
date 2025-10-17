<?php
// --- パラメータ受け取り ---
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');

// --- 前月・翌月を計算 ---
$prevMonth = $month - 1;
$nextMonth = $month + 1;
$prevYear = $nextYear = $year;

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
$startWeek = date('w', $firstDay);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>メインページ</title>

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">

<!-- リセットCSS -->
<link rel="stylesheet" href="https://unpkg.com/ress@4.0.0/dist/ress.min.css">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<link rel="stylesheet" href="css/style.css">

</head>

<body>
<!-- ヘッダー -->
<header class="header">
    <div class="logo">
            <img src="images/logo.png" alt="WHO’S ToDo List">
    </div>
</header>

<!-- メイン -->
<main class="main-container">
    <div class="main-up">
        <div class="search">
            <a href="?year=<?= $prevYear ?>&month=<?= $prevMonth ?>">◀</a>
            <?= $year ?>年 <?= $month ?>月
            <a href="?year=<?= $nextYear ?>&month=<?= $nextMonth ?>">▶</a>
            <table>
                <tr>
                    <th>日</th><th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th>土</th>
                </tr>
                <tr>
                    <?php
                    for ($i = 0; $i < $startWeek; $i++) echo "<td></td>";

                    // 日付を出力
                    for ($day = 1; $day <= $daysInMonth; $day++) {
                        $w = ($startWeek + $day - 1) % 7;
                        echo "<td>$day</td>";
                        if ($w == 6 && $day != $daysInMonth) echo "</tr><tr>";
                    }

                    for ($i = ($startWeek + $daysInMonth) % 7; $i < 7 && $i != 0; $i++) echo "<td></td>";
                    ?>
                </tr>
            </table>
        
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