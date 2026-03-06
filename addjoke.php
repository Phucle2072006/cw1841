<?php
if (isset($_POST['joketext'])) {
    try {
        include 'includes/DatabaseConnection.php';

        // 1. Logic xử lý Upload ảnh
        $imageName = null; 
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $imageName = $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $imageName);
        }

        // 2. Insert vào Database với đầy đủ các trường [cite: 446, 449]
        // Chúng ta sử dụng placeholder (:placeholder) để bảo mật dữ liệu [cite: 452]
        $sql = 'INSERT INTO joke SET
                joketext = :joketext,
                jokedate = CURDATE(),
                image = :image,
                authorid = :authorid,
                categoryid = :categoryid';
                
        $stmt = $pdo->prepare($sql);
        
        // Ràng buộc các giá trị từ Form vào câu lệnh SQL [cite: 452, 457]
        $stmt->bindValue(':joketext', $_POST['joketext']);
        $stmt->bindValue(':image', $imageName); 
        $stmt->bindValue(':authorid', $_POST['authors']); // Lấy ID tác giả từ dropdown [cite: 457]
        $stmt->bindValue(':categoryid', $_POST['categories']); // Lấy ID chuyên mục từ dropdown
        
        $stmt->execute();
        
        // Sau khi thêm thành công, chuyển hướng về trang danh sách [cite: 456]
        header('location: jokes.php');
        exit(); // Luôn dùng exit sau header location
        
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
} else {
    // 3. Chuẩn bị dữ liệu cho các menu thả xuống (Dropdowns) [cite: 391, 397]
    try {
        include 'includes/DatabaseConnection.php';
        $title = 'Add a new joke';

        // Truy vấn danh sách tác giả [cite: 403]
        $sql_a = 'SELECT * FROM author';
        $authors = $pdo->query($sql_a); // [cite: 405]

        // Truy vấn danh sách chuyên mục [cite: 475]
        $sql_c = 'SELECT * FROM category';
        $categories = $pdo->query($sql_c); // [cite: 476]

        ob_start();
        include 'templates/addjoke.html.php';
        $output = ob_get_clean();
        
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
}

include 'templates/layout.html.php';