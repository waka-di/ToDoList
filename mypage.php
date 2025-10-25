<?php
session_start();
require_once 'config/db.php'; 

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message'] = "不正なアクセスです";
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id']; 

$stmt = $pdo->prepare("SELECT post_id, content, post_date FROM post_data WHERE user_id = ? ORDER BY post_date DESC");
$stmt->execute([$user_id]);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>My Page</title>

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&&family=Hachi+Maru+Pop&family=Murecho:wght@100..900&family=Murecho:wght@100..900&family=Noto+Sans+JP:wght@100..900&family=Outfit:wght@100..900&family=Playwrite+DE+Grund+Guides&family=Poppins:ital,wght@0,700;0,800;1,700;1,800&display=swap" rel="stylesheet">

<!-- リセットCSS -->
<link rel="stylesheet" href="https://unpkg.com/ress@4.0.0/dist/ress.min.css">
<link rel="stylesheet" href="css/style.css">

</head>

<body>
<!-- ヘッダー -->
<header class="common-header">
    <div class="logo">
            <img src="images/logo.png" alt="WHO’S ToDo List">
    </div>
    <div class="mainpage_link">
        <a href="main.php">Main Page</a>
    </div>
</header>

<!-- メイン -->
<main class="mypage">
    <div class="mypage-wrapper">
        <div class="mypage-container">
            <div class="sidebar">
                <h3>過去の投稿検索</h3>
                <input type="month" id="searchMonth">
                <div class="search-button">
                    <button onclick="searchPosts()">検索</button>
                </div>
                <div class="links">
                    <a href="update/update.php">アカウント情報変更</a>
                    <a href="delete/delete.php">アカウント情報削除</a>
                </div>
            </div>
            <div class="post-list" id="postList">
            </div>
        </div>
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
<script>
    function searchPosts() {
        const searchMonth = document.getElementById('searchMonth').value; // 例: "2025-10"
        const posts = document.querySelectorAll('.mypost-item');
        posts.forEach(post => {
            const postMonth = post.dataset.date.substring(0,7);
            post.style.display = (postMonth === searchMonth) ? 'flex' : 'none';
        });
    }
    function confirmDelete(postId) {
        if (confirm('本当に削除しますか？')) {
            fetch(`controller/delete_postDB.php?id=${postId}`, { method: 'POST' })
            .then(response => response.json())
            .then(data => {
                if(data.success){
                    alert('削除しました');
                    location.reload();
                } else {
                    alert('削除に失敗しました');
                }
            });
        }
    }
    const posts = <?php echo json_encode($posts); ?>;
    const postList = document.getElementById('postList');

    posts.forEach(post => {
        const div = document.createElement('div');
        div.className = 'mypost-item';
        div.dataset.date = post.post_date;
        div.dataset.id = post.post_id;

        const contentDiv = document.createElement('div');
        contentDiv.textContent = post.content;

        const btn = document.createElement('button');
        btn.className = 'delete-btn';
        btn.textContent = '削除';
        btn.onclick = () => confirmDelete(post.post_id);

        div.appendChild(contentDiv);
        div.appendChild(btn);
        postList.appendChild(div);
    });
</script>
</body>
</html>
