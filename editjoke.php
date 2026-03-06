<?php
include 'includes/DatabaseConnection.php';
include 'includes/DataBaseFunctions.php';

try {
    if (isset($_POST['joketext'])) {
        // Kịch bản 1: Lưu dữ liệu đã sửa
        $sql = 'UPDATE joke SET 
                joketext = :joketext,
                authorid = :authorid,
                categoryid = :categoryid
                WHERE id = :id';
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':joketext', $_POST['joketext']);
        $stmt->bindValue(':authorid', $_POST['authors']); // Lấy từ dropdown [cite: 457]
        $stmt->bindValue(':categoryid', $_POST['categories']); // Lấy từ dropdown [cite: 376]
        $stmt->bindValue(':id', $_POST['id']);
        $stmt->execute();

        header('location: jokes.php');
        exit();

    } else {
        // Kịch bản 2: Hiển thị form với dữ liệu hiện tại
        // 1. Lấy thông tin câu đố cần sửa
        $stmt = $pdo->prepare('SELECT * FROM joke WHERE id = :id');
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        $joke = $stmt->fetch();

        // 2. Lấy danh sách tác giả và chuyên mục cho dropdown [cite: 338, 391, 473]
        $authors = $pdo->query('SELECT * FROM author');
        $categories = $pdo->query('SELECT * FROM category');

        $title = 'Edit joke';

        ob_start();
        include 'templates/editjoke.html.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';