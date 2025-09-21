<?php
require_once __DIR__ . '/../Models/user.php';
require_once __DIR__ . '/../Models/measurementModel.php';
require_once __DIR__ . '/../../config/db.php';

use App\Models\MeasurementModel;


class HomeSettingController
{
    public function show(): void {

        if (empty($_SESSION['user']['id'])) {
            header('Location: /index.php?page=login');
            exit;
        }

        $userId = $_SESSION['user']['id'];

        // ユーザー情報
        $user = User::findById($userId);

        //体組成情報
        $measurementModel = new MeasurementModel();
        $measurement = $measurementModel->getMeasurementByUserId($userId);

        // view に渡す
        require_once __DIR__ . '/../../resources/views/home/setting.php';
    }

    public function update(): void
    {

        $userId      = (int)$_SESSION['user']['id'];
        // users
        $email       = trim($_POST['email'] ?? '');
        $name        = trim($_POST['name'] ?? '');
        $passwordRaw = trim($_POST['password'] ?? ''); 
        $bodyTypeId  = isset($_POST['body_type_id']) ? (int)$_POST['body_type_id'] : null;

        // measurements
        $weight      = trim($_POST['weight'] ?? '');
        $height      = trim($_POST['height'] ?? '');
        $body_fat    = trim($_POST['body_fat'] ?? '');
        $muscle_mass = trim($_POST['muscle_mass'] ?? '');


        $pdo = DB::conn();
        try {
            $pdo->beginTransaction();

            // users 更新（パスワードは空なら据え置き）
            // 同一メールの重複チェック（自分以外）
            if (User::emailExistsForOther($email, $userId)) {
                throw new Exception('このメールアドレスは既に使用されています。');
            }

            $password = ($passwordRaw === '') ? null : $passwordRaw;
            User::updateProfile($userId, $email, $name, $password, $bodyTypeId);

            // measurements upsert（なければ作成、あれば更新）
            $weightF     = ($weight      === '') ? null : (float)$weight;
            $heightF     = ($height      === '') ? null : (float)$height;
            $bodyFatF    = ($body_fat    === '') ? null : (float)$body_fat;
            $muscleMassF = ($muscle_mass === '') ? null : (float)$muscle_mass;

            MeasurementModel::upsertForUser(
                $userId, $weightF, $heightF, $bodyFatF, $muscleMassF
            );

            $pdo->commit();

            // セッションの user 表示名などを更新しておくとUIがすぐ反映
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['user_name'] = $name;
            if (!is_null($bodyTypeId)) {
                $_SESSION['user']['body_type_id'] = $bodyTypeId;
            }

            $_SESSION['success'] = 'ユーザー情報を更新しました。';
            header('Location: /index.php?page=home');
            exit;
        } catch (Exception $e) {
            if ($pdo->inTransaction()) $pdo->rollBack();
            $_SESSION['error'] = $e->getMessage() ?: '更新に失敗しました。';
            header('Location: /index.php?page=home-setting');
            exit;
        }
    }
}