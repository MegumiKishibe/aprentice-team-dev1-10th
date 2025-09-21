<?php ?>
<!DOCTYPE html>
<html lang="ja">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create</title>

  <!-- <link rel="stylesheet" href="/css/styleset-home.css" /> -->
  <link rel="stylesheet" href="/css/start.css" />
  <!-- <link rel="stylesheet" href="/css/login.css" /> -->

</head>
<body>
  <div class="start">
    <h1 class="title">献立提案アプリ/新規登録画面</h1>

    <div class="inner">

    <div class="inner">
      <?php if (!empty($_SESSION['error'])): ?>
        <p class="login-alert" style="color:red;">
          <?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8'); ?>
        </p>
        <?php unset($_SESSION['error']); ?>
      <?php endif; ?>

      <!-- aタグではなく、フォームでPOSTする -->
      <form method="post" action="/index.php?page=create_store" id="signup-form" novalidate>
        <ul class="menu">
        <?php if (!empty($_SESSION['error'])): ?>
          <div class="error-ms">
            <?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8'); ?>
          </div>
          <?php unset($_SESSION['error']); // 1回だけ表示するため削除 ?>
        <?php endif; ?>
          <li class="login-field">
            <label class="login-label" for="email">メールアドレス</label> <!--「for」と「id」を一致させて明示的に関連付け-->
            <input id="email"
            class="login-input card-input"
            type="email"
            name="email"
            placeholder="hello@example.com"
            required />
          </li>
          <li class="login-field">
            <label class="login-label" for="password">パスワード</label>
            <input id="password"
            class="login-input card-input"
            type="password"
            name="password"
            placeholder="8文字以上"
            required
            minlength="8"
            autocomplete="new-password"/>
          </li>
          <li class="login-field">
            <label class="login-label" for="username">ユーザー名</label>

            <input id="username"
            class="login-input card-input"
            type="text"
            name="name"
            placeholder="Hanako1234"
            required
            minlength="3"
            maxlength="20"
            pattern="[A-Za-z0-9_]{3,20}"
            title="半角英数字と _ が使えます(3~20文字)"
            autocomplete="username"
            autocapitalize="none"
            spellcheck="false"
            inputmode="text"  />
          </li>

          <li class="submit-field">
            <button type="submit" class="card">次へ</button>
          </li>
        </ul>
      </form>

      <footer class="start-footer">
        <div class="container">© 2025 TeamProject1</div>
      </footer>
    </div>
  </div>
    <!-- <script src="/js/create.js"></script> -->
  </div>
</body>
</html>
