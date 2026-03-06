<?php
try {
    include 'includes/DatabaseConnection.php';
    include 'includes/DataBaseFunctions.php'; // Nhúng thư viện hàm

    // Gọi hàm xóa từ thư viện thay vì viết lại prepare/execute
    deleteJoke($pdo, $_POST['id']);

    // Xóa xong thì quay về trang danh sách
    header('location: jokes.php');

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';