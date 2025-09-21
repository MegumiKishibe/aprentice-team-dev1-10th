/*!50503 SET NAMES utf8mb4 */;
USE app;

-- body_types
INSERT INTO body_types (body_type_name, protein, fat, carbohydrates) VALUES
('筋肉質', 150, 50, 200),
('標準', 100, 60, 250),
('やせ型', 80, 40, 300);

-- users
INSERT INTO users (user_name, email, password, body_type_id) VALUES
('Taro Yamada', 'taro@example.com', '$2y$10$abcdefghijklmnopqrstuv111111111111111', 1),
('Hanako Suzuki', 'hanako@example.com', '$2y$10$abcdefghijklmnopqrstuv222222222222222', 2),
('John Smith', 'john@example.com', '$2y$10$abcdefghijklmnopqrstuv333333333333333', 3);

-- points
INSERT INTO points (user_id, point) VALUES
(1, 100),
(2, 50),
(3, 200);

-- measurements
INSERT INTO measurements (user_id, weight, height, body_fat, muscle_mass) VALUES
(1, 70.5, 175.0, 15.0, 30.0),
(2, 55.0, 160.0, 20.0, 25.0),
(3, 68.0, 172.0, 18.0, 28.0);

-- genres
INSERT INTO genres (genre_name) VALUES
('和風'),
('中華'),
('洋風');

-- main_foods
INSERT INTO main_foods (main_food_name) VALUES
('肉'),
('魚'),
('卵'),
('豆');

-- methods
INSERT INTO methods (method_name) VALUES
('焼く'),
('煮る'),
('揚げる'),
('蒸す');

-- dishes (ジャンル×主材料×調理法 = 3×4×4 = 48通り)
INSERT INTO dishes (dish_name, genre_id, main_food_id, method_id) VALUES
-- 和風
('照り焼きチキン', 1, 1, 1),
('肉じゃが',       1, 1, 2),
('唐揚げ',         1, 1, 3),
('蒸し鶏',         1, 1, 4),
('鮭の塩焼き',     1, 2, 1),
('サバの味噌煮',   1, 2, 2),
('魚の唐揚げ',     1, 2, 3),
('鯛の酒蒸し',     1, 2, 4),
('だし巻き卵',     1, 3, 1),
('煮卵',           1, 3, 2),
('卵の天ぷら',     1, 3, 3),
('茶碗蒸し',       1, 3, 4),
('豆腐ステーキ',   1, 4, 1),
('湯豆腐',         1, 4, 2),
('揚げ出し豆腐',   1, 4, 3),
('蒸し豆腐',       1, 4, 4),

-- 中華
('回鍋肉',         2, 1, 1),
('紅焼肉',         2, 1, 2),
('酢豚',           2, 1, 3),
('シュウマイ',     2, 1, 4),
('白身魚の香味焼き',2, 2, 1),
('水煮魚',         2, 2, 2),
('魚の唐揚げ中華風',2, 2, 3),
('清蒸魚',         2, 2, 4),
('蟹玉',           2, 3, 1),
('トマト卵スープ', 2, 3, 2),
('卵の揚げ団子',   2, 3, 3),
('中華茶碗蒸し',   2, 3, 4),
('麻婆豆腐',       2, 4, 1),
('豆腐と野菜煮込み',2, 4, 2),
('豆腐唐揚げ',     2, 4, 3),
('蒸し豆腐中華風', 2, 4, 4),

-- 洋風
('ビーフステーキ', 3, 1, 1),
('ビーフシチュー', 3, 1, 2),
('フライドチキン', 3, 1, 3),
('鶏肉のハーブ蒸し',3,1,4),
('サーモングリル', 3, 2, 1),
('ブイヤベース',   3, 2, 2),
('フィッシュアンドチップス',3,2,3),
('魚のハーブ蒸し', 3, 2, 4),
('オムレツ',       3, 3, 1),
('エッグシチュー', 3, 3, 2),
('スコッチエッグ', 3, 3, 3),
('洋風茶碗蒸し',   3, 3, 4),
('豆腐ステーキ洋風',3, 4, 1),
('豆腐トマト煮',   3, 4, 2),
('豆腐フリット',   3, 4, 3),
('豆腐のハーブ蒸し',3,4,4);

-- meal_log
INSERT INTO meal_log (users_id, detail) VALUES
<<<<<<< HEAD
(1, '朝食：ご飯と味噌汁'),
(2, '昼食：パスタとサラダ'),
(3, '夕食：餃子とビール');

