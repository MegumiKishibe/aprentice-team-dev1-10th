<?php
session_start();
// ===== Controller requires =====
require_once __DIR__ . '/../app/Controllers/settingController.php';
require_once __DIR__ . '/../app/Controllers/signinController.php';
require_once __DIR__ . '/../app/Controllers/signupController.php';
require_once __DIR__ . '/../app/Controllers/SignoutController.php';
require_once __DIR__ . '/../app/Controllers/HomeSettingController.php';
require_once __DIR__ . '/../app/Controllers/menuController.php';
require_once __DIR__ . '/../app/Controllers/homeController.php';

// ① page取得（デフォルトは start）
$page = $_GET['page'] ?? 'start';

// ② ビューの基点パス（Docker の実パス）
$viewsPath = '/var/www/resources/views/';

// ③ ルーティング
switch ($page) {
  // ========== サインアップ関連 ==========
  // 新規登録ページ GET
  case 'create':
    $file = $viewsPath . 'set-login/create.php';
    break;

  // 新規登録 POST
  case 'create_store':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      (new SignupController())->store();
      exit;
    }
    header('Location: /index.php?page=create');
    exit;

  // ========== 初期設定（体型/体組成） ==========
  // 初回の体型/体組成入力ページ GET
  case 'create2':
    $file = $viewsPath . 'set-login/create2.php';
    break;

  // 初回の体型/体組成入力 POST
  case 'create2_store':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      (new settingController())->store();
      exit;
    }
    header('Location: /index.php?page=create2');
    exit;

  // ========== サインイン関連 ==========
  // ログインページ GET
  case 'login':
    $file = $viewsPath . 'set-login/login.php';
    break;

  // ログイン POST（認証）
  case 'signin_verify':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      (new signinController())->authenticate();
      exit;
    }
    header('Location: /index.php?page=login');//POST以外でアクセスされた場合はloginに戻す
    exit;

  // ========== 一般ページ ==========
  case 'index':
    $file = $viewsPath . 'set-login/index.php';
    break;

  case 'start':
    $file = $viewsPath . 'start.html';
    break;

  case 'home':
    // home のビュー側で HomeController を呼んでいる想定
    // （もしコントローラで描画までやるならここを controller->show();exit; に変更）
    $file = $viewsPath . 'set-login/home.php';
    break;

  case 'eat':
    $file = $viewsPath . 'input/eat.php';
    break;

  case 'menu':
    $file = $viewsPath . 'input/menu.php';
    break;

  // ========== ユーザー設定（再設定） ==========
  case 'home-setting':                 // 再設定ページ GET（コントローラが view を require）
    (new HomeSettingController())->show();
    exit;

  case 'home_setting_update':          // 再設定 POST
    (new HomeSettingController())->update();
    exit;

  // ========== サインアウト ==========
  case 'signout':
    (new SignoutController())->logout();
    exit;

  // ========== デフォルト ==========
  default:
    $file = $viewsPath . 'start.html';
    break;
}

// ===== ビューの読み込み =====
if (!empty($file) && is_file($file)) {
  require $file;
} else {
  http_response_code(404);
  echo "<p>❌ ページが見つかりません: " . htmlspecialchars($file ?? '(unset)') . "</p>";

}
