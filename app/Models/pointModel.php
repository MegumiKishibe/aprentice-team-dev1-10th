<?php
namespace App\Models;

require_once '/var/www/config/db.php';

use DB;
use PDO;

class PointModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = DB::conn();
    }

    // ユーザーIDからポイントを取得
    public function getPointByUserId(int $userId): ?int {
        $stmt = $this->pdo->prepare("
            SELECT point
            FROM points
            WHERE user_id = ?
        ");
        $stmt->execute([$userId]);
        $row = $stmt->fetch();

        return $row ? (int)$row['point'] : null;
    }
}
