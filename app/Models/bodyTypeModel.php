<?php
namespace App\Models;

require_once '/var/www/config/db.php';

use DB;
use PDO;

class BodyTypeModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = DB::conn();
    }

    public function getBodyTypeById(int $id): ?array {
        $stmt = $this->pdo->prepare("
            SELECT id, body_type_name, protein, fat, carbohydrates
            FROM body_types
            WHERE id = ?
        ");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
