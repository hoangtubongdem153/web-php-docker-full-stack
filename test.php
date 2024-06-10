<!DOCTYPE html>
<html>
<head>
    <title>Blog của tôi </title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }
        .post {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #ccc;
        }
        .post h2 {
            margin-top: 0;
        }
        .post .date {
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>

    <h1>Chào mừng đến với blog của tôi! </h1>

    <?php
    // Mảng chứa các bài viết
    $posts = [
        [
            'title' => 'Bài viết đầu tiên',
            'date' => '2024-06-04',
            'content' => 'Đây là nội dung bài viết đầu tiên của tôi. Chào mừng các bạn!'
        ],
        [
            'title' => 'Bài viết thứ hai',
            'date' => '2024-06-05',
            'content' => 'Bài viết này nói về một chủ đề thú vị khác.'
        ],
        // Thêm các bài viết khác ở đây
    ];

    // Hiển thị các bài viết
    foreach ($posts as $post) {
        echo '<div class="post">';
        echo '<h2>' . $post['title'] . '</h2>';
        echo '<p class="date">' . $post['date'] . '</p>';
        echo '<p>' . $post['content'] . '</p>';
        echo '</div>';
    }
    ?>

</body>
</html>
