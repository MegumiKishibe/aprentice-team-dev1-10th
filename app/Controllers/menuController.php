<?php
namespace app\Controllers;
require_once '/var/www/app/Models/menuModel.php';
use App\Models\MenuModel;



class MenuController {
    private MenuModel $menuModel;

    public function __construct() {
        $this->menuModel = new MenuModel();
    }

    public function handle(array $postData): array {
        $result = '';
        $error  = '';

        // POST送信時のみ処理
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($postData['genre']) || empty($postData['food']) || empty($postData['method'])) {
                $error = 'それぞれ選択してください';
            } else {
                $result = $this->menuModel->getSuggestedDish(
                    $postData['genre'],
                    $postData['food'],
                    $postData['method']
                );
            }
        }

        return ['result' => $result, 'error' => $error];
    }
}
