<?php
try {
    include 'includes/DatabaseConnection.php';
    include 'includes/DataBaseFunctions.php';

    // Đổi INNER JOIN thành LEFT JOIN để hiển thị cả những câu đố cũ
    $sql = 'SELECT joke.id, joketext, author.name, email, categoryName FROM joke
            LEFT JOIN author ON authorid = author.id
            LEFT JOIN category ON categoryid = category.id';

    $jokes = $pdo->query($sql);
    $title = 'Joke list';
    $totalJokes = totalJokes($pdo); 

    ob_start();
    include 'templates/jokes.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';