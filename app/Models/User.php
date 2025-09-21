<?php

require_once __DIR__ . '/../../config/db.php'; // config/db.phpを呼び出している

class User
{

    public static function emailExists(string $email): bool
    {
        $pdo = DB::conn();
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }
    
    public static function create(string $name, string $email, string $password)
    {
        $pdo = DB::conn();

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO users (user_name, email, password) VALUES (?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $hash]);

            // 挿入したレコードのIDを取得
        $id = (int)$pdo->lastInsertId();

            // すぐにユーザー情報を返す
        return [
            'id'        => $id,
            'user_name' => $name,
            'email'     => $email,
        ];
    }

    //　setting内での理想体型のユーザー入力をユーザーテーブルに更新　（UXの関係上一気に登録することができないため、理想体型のみ更新するようにしています）
    public static function updateBodyType(int $userId, int $bodyTypeId): bool
    {
        $pdo = DB::conn();

        $sql = 'UPDATE users SET body_type_id = ? WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$bodyTypeId, $userId]);
    }

    public static function verify(string $email, string $password)
    {
        $pdo = DB::conn();

        // ユーザーを取得
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // ユーザーが存在し、パスワードが正しいか確認(password_verify=ハッシュを解釈して、平文パスワードを同じ条件でハッシュ化して比較する関数)
        if ($user && password_verify($password, $user['password'])) {
            return $user; // 成功時はユーザー情報を返す
        }
        return null; // 失敗時はnull
    }

        public static function findById(int $userId): ?array
    {
        $pdo = DB::conn();
        $stmt = $pdo->prepare('SELECT id, user_name, email, body_type_id FROM users WHERE id = ? LIMIT 1');
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    //　自分以外の他の人に同じメールアドレスがいないかチェック
    public static function emailExistsForOther(string $email, int $excludeUserId): bool
    {
        $pdo = DB::conn();
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = ? AND id <> ?');
        $stmt->execute([$email, $excludeUserId]);
        return $stmt->fetchColumn() > 0;
    }

    //　ユーザー情報再設定ページ用メソッド（ユーザー情報を全て更新するとき）
    public static function updateProfile(?int $userId, ?string $email, string $name, ?string $password, ?int $bodyTypeId
    ): bool {
        $pdo = DB::conn();
    
        // 更新対象を動的に組み立て
        $fields = ['email = ?', 'user_name = ?', 'body_type_id = ?'];
        $params = [$email, $name, $bodyTypeId];
    
        if (!empty($password)) {
            $fields[] = 'password = ?';
            $params[] = password_hash($password, PASSWORD_BCRYPT);
        }
    
        $params[] = $userId;
    
        $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = ?";
        $stmt = $pdo->prepare($sql);
    
        return $stmt->execute($params);
    }
}