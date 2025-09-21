<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>login画面</title>
  <!-- <link rel="stylesheet" href="/css/styleset-home.css" /> -->
  <link rel="stylesheet" href="/css/start.css" />
  <!-- <link rel="stylesheet" href="/css/login.css" /> -->
</head>

<body>
  <div class="start">
    <h1 class="title">献立提案アプリ/ログイン</h1>

    <div class="inner">

      <!-- 入力されたデータが一致しない場合はSigninControllerから発行されたエラー文を表示 -->
      <?php if (!empty($_SESSION['error'])): ?>
        <p style="color:red;"><?php echo $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']); ?>
      <?php endif; ?>

      <!-- aタグではなく、フォームでPOSTする リンクGETではなくフォーム送信-->
      <form method="post" action="/index.php?page=signin_verify" id="login-form" novalidate><!--PHPでは $_POST[...]で受け取る-->
        <ul class="menu">
          <li class="login-field">
            <label class="login-label" for="email">メールアドレス</label>
            <input id="email" class="login-input card-input" type="email" name="email" placeholder="hello@example.com" required />
          </li>
          <li class="login-field">
            <label class="login-label" for="password">パスワード</label>
            <input id="password" class="login-input card-input" type="password" name="password" placeholder="8文字以上" required />
          </li>
          <li class="login_actions">
            <button type="submit" class="card">ログイン</button>
          </li>
        </ul>
      </form>

      <footer class="start-footer">
        <div class="container">© 2025 TeamProject1</div>
      </footer>
    </div>
  </div>
  <script src="/js/login.js"></script>
</body>


</html>
