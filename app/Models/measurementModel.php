<?php
namespace App\Models;

require_once '/var/www/config/db.php';

use DB;
use PDO;

class MeasurementModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = DB::conn();
    }

    public static function create(
        int $userId,
        float $weight,
        float $height,
        ?float $bodyFat,
        ?float $muscleMass
    ): int {
        $pdo = DB::conn();

        $sql = 'INSERT INTO measurements (user_id, weight, height, body_fat, muscle_mass)
                VALUES (?, ?, ?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $ok = $stmt->execute([
            $userId,
            $weight,
            $height,
            $bodyFat,
            $muscleMass
        ]);

        if (!$ok) return 0;
        return (int)$pdo->lastInsertId();
    }

    //体組成データ（身長・体重・体脂肪率・筋肉量）をなければ新規作成、あれば更新する処理
    public static function upsertForUser(
        int $userId,
        ?float $weight,
        ?float $height,
        ?float $bodyFat,
        ?float $muscleMass
    ): bool {
        $pdo = DB::conn();
        // 既存有無を確認
        $stmt = $pdo->prepare('SELECT id FROM measurements WHERE user_id = ? LIMIT 1');
        $stmt->execute([$userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($row) {
            // 更新
            $sql = 'UPDATE measurements
                       SET weight = ?, height = ?, body_fat = ?, muscle_mass = ?
                     WHERE user_id = ?';
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$weight, $height, $bodyFat, $muscleMass, $userId]);
        } else {
            // 挿入
            $sql = 'INSERT INTO measurements (user_id, weight, height, body_fat, muscle_mass)
                    VALUES (?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$userId, $weight, $height, $bodyFat, $muscleMass]);
        }
    }

    // ユーザーIDから身体情報を取得
    public function getMeasurementByUserId(int $userId): ?array {
        $stmt = $this->pdo->prepare("
            SELECT weight, height, body_fat, muscle_mass
            FROM measurements
            WHERE user_id = ?
        ");
        $stmt->execute([$userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: null;
    }
}
