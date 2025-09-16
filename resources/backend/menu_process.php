<?php
require_once '/var/www/config/db.php';
function getSuggestedMenu(array $data) {
    global $pdo;

    $genreId  = $data['genre'] ?? '';
    $foodId   = $data['food'] ?? '';
    $methodId = $data['method'] ?? '';

    if (!$genreId || !$foodId || !$methodId) {
        return "選択してください";
    }

    $stmt = $pdo->prepare("
        SELECT dish_name
        FROM dishes
        WHERE genre_id = ? AND main_food_id = ? AND method_id = ?
        ORDER BY RAND()
        LIMIT 1
    ");
    $stmt->execute([$genreId, $foodId, $methodId]);

    $dish = $stmt->fetchColumn();

    return $dish ?: "該当する献立はありません";
}