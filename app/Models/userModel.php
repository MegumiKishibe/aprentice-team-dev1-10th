<?php
namespace App\Models;

require_once '/var/www/config/db.php';

use DB;
use PDO;

class UserModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = DB::conn();
    }

    public function getUserById(int $id): ?array {
        $stmt = $this->pdo->prepare("
            SELECT id, body_type_id, user_name
            FROM users
            WHERE id = ?
        ");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
