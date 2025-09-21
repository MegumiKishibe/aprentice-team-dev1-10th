<?php
namespace App\Models;

require_once '/var/www/config/db.php';

use DB;
use PDO;

class MenuModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = DB::conn();
    }

    public function getSuggestedDish($genreId, $foodId, $methodId): string {
        $stmt = $this->pdo->prepare("
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
}
