<?php
require_once __DIR__ . '/../Models/user.php';

class signupController
{
    public function store(): void
    {
        // フォーム値を先に取得＆トリム
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $name     = trim($_POST['name'] ?? '');

        // バリデーション
        if ($email === '' || $password === '' || $name === '') {
            $_SESSION['error'] = 'すべての項目を入力してください。';
            header('Location: index.php?page=create');
            exit;
        }

        // メール重複チェック（ここで初めて使う）
        if (User::emailExists($email)) {
            $_SESSION['error'] = 'このメールアドレスは既に登録されています。';
            header('Location: index.php?page=create');
            exit;
        }

        // 作成（モデルを呼ぶ）
        $user = User::create($name, $email, $password);

        if ($user) {
            // 成功：ユーザー情報をセッションへ入れて次画面へ
            $_SESSION['user'] = $user; // ['id','user_name','email'] を想定
            header('Location: index.php?page=create2');
            exit;
        } else {
            // 失敗：戻す
            $_SESSION['error'] = '登録に失敗しました。';
            header('Location: index.php?page=create');
            exit;
        }
    }
}