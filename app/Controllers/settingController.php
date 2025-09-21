<?php
require_once __DIR__ . '/../Models/measurementModel.php';
require_once __DIR__ . '/../Models/user.php';

use App\Models\MeasurementModel; 

class settingController
{
    public function store(): void
    {

        // ログインをしているかどうかを判定
        if (empty($_SESSION['user']['id'])) {
            $_SESSION['error'] = 'ログインしてください。';
            header('Location: /index.php?page=login');
            exit;
        }

        // フォーム値を受け取る。空なら ''が入る
        $bodyTypeId = trim($_POST['body_type_id'] ?? '');
        $weight      = trim($_POST['weight']      ?? '');
        $height      = trim($_POST['height']      ?? '');
        $body_fat    = trim($_POST['body_fat']    ?? '');
        $muscle_mass = trim($_POST['muscle_mass'] ?? '');

        // バリデーション（体重・身長・理想体型が必須）
        if ($weight === '' || $height === '' || $bodyTypeId === '') {
            $_SESSION['error'] = '理想体型・体重・身長は必須です。';
            header('Location: /index.php?page=create2');
            exit;
        }

        // 保存（文字列ー＞数値に直し、体脂肪率と筋肉量はNULLを許容）
        $userId      = (int)$_SESSION['user']['id'];
        $bodyTypeIdI  = (int)$bodyTypeId;
        $weightF     = (float)$weight;
        $heightF     = (float)$height;
        $bodyFatF    = ($body_fat === '')    ? null : (float)$body_fat;
        $muscleMassF = ($muscle_mass === '') ? null : (float)$muscle_mass;

        // 理想体型をユーザーに更新
        User::updateBodyType($userId, $bodyTypeIdI);

        //　理想体型以外の身体情報を登録
        $user = MeasurementModel::create($userId, $weightF, $heightF, $bodyFatF, $muscleMassF);

        if ($user) {
            $_SESSION['success'] = '体組成データを保存しました。';
            header('Location: /index.php?page=home');
            exit;
        } else {
            $_SESSION['error'] = '保存に失敗しました。';
            header('Location: /index.php?page=create2');
            exit;
        }
    }
}