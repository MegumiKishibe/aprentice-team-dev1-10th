<?php
// session_start(); // セッション開始（ファイルの先頭で必須）
// 仮ログイン用（テスト）
// if (!isset($_SESSION['user'])) {
//     $_SESSION['user'] = [
//         'id'    => 1,
//         'name'  => 'Taro',
//         'email' => 'taro@example.com',
//     ];
// }

require_once '/var/www/app/Models/bodyTypeModel.php';
require_once '/var/www/app/Models/userModel.php';
require_once '/var/www/app/Models/measurementModel.php';
require_once '/var/www/app/Models/pointModel.php';

use App\Models\BodyTypeModel;
use App\Models\UserModel;
use App\Models\MeasurementModel;
use App\Models\PointModel;

class HomeController {
    private BodyTypeModel $bodyTypeModel;
    private UserModel $userModel;
    private MeasurementModel $measurementModel;
    private PointModel $pointModel;

    public function __construct() {
        $this->bodyTypeModel    = new BodyTypeModel();
        $this->userModel        = new UserModel();
        $this->measurementModel = new MeasurementModel();
        $this->pointModel       = new PointModel();
    }

    public function handle(array $postData): array {
        $values = [
            'protein'       => '',
            'fat'           => '',
            'carbohydrates' => '',
            'body_type_name'=> '',
            'image_path'    => '',
            'user_name'     => '',
            'point'         => '',
            'weight'        => '',
            'height'        => '',
            'body_fat'      => '',
            'muscle_mass'   => '',
        ];

        // セッションからログインユーザーIDを取得
        $userId = $_SESSION['user']['id'] ?? null;

        // 未ログインならログイン画面へ
        if (!$userId) {
            header("Location: index.php?page=login");
            exit;
        }

        // ユーザー情報を取得
        $user = $this->userModel->getUserById($userId);

        if (!$user) {
            // 不正なセッション → ログイン画面へ
            header("Location: index.php?page=login");
            exit;
        }

        // ユーザー名
        $values['user_name'] = $user['user_name'];

        // // ポイント
        // $point = $this->pointModel->getPointByUserId($userId);
        // if ($point) {
        //     $values['point'] = $point['point'];
        // }

        // 計測データ
        $measurement = $this->measurementModel->getMeasurementByUserId($userId);
        if ($measurement) {
            $values['weight']      = $measurement['weight'];
            $values['height']      = $measurement['height'];
            $values['body_fat']    = $measurement['body_fat'];
            $values['muscle_mass'] = $measurement['muscle_mass'];
        }

        // 体型タイプ
        if (!empty($user['body_type_id'])) {
            $bodyType = $this->bodyTypeModel->getBodyTypeById($user['body_type_id']);
            
            if (!empty($bodyType) && is_array($bodyType)) {
                $values['protein']        = $bodyType['protein'];
                $values['fat']            = $bodyType['fat'];
                $values['carbohydrates']  = $bodyType['carbohydrates'];
                $values['body_type_name'] = $bodyType['body_type_name'];

                $images = [
                    1 => '/image/man1.png',
                    2 => '/image/man2.png',
                    3 => '/image/man3.png',
                ];

                $values['image_path'] = $images[$bodyType['id']] ?? '';
            }
        }

        return ['values' => $values];
    }
}
