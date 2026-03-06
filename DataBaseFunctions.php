<?php
// Hàm đếm tổng số câu đố
function totalJokes($pdo) {
    $query = $pdo->prepare('SELECT COUNT(*) FROM joke');
    $query->execute();
    $row = $query->fetch();
    return $row[0];
}

// Hàm xóa câu đố
function deleteJoke($pdo, $id) {
    $parameters = [':id' => $id];
    $query = $pdo->prepare('DELETE FROM joke WHERE id = :id');
    $query->execute($parameters);
}