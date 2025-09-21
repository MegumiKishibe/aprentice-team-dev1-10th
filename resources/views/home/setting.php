<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>home-setting 開始画面</title>
  <link rel="stylesheet" href="/css/home-setting.css">
</head>

<body>
  <div class="start">
    <a href="index.php?page=home">
      <h1 class="title">献立提案アプリ/ユーザー登録画面 🏠</h1>
    </a>

    <div class="inner">
    <form method="post" action="/index.php?page=home_setting_update" id="login-form" novalidate>
      <div class="main wrapper">
        <!-- 左サイド ----------------------------------->
        <section id="nutrition">
          <div class="section-box">
            <div class="shine-button button-electric">
              <h3>ユーザ情報を変更する</h3>

              <?php if (!empty($_SESSION['error'])): ?>
                <div class="flash flash-error">
                  <?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?>
                </div>
                <?php unset($_SESSION['error']); ?>
              <?php endif; ?>

              <?php if (!empty($_SESSION['success'])): ?>
                <div class="flash flash-success">
                  <?= htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8') ?>
                </div>
                <?php unset($_SESSION['success']); ?>
              <?php endif; ?>
              <!-- バリデーション入れる -->

              <div class="error-ms">8文字以上</div>
              <!-- バリデーション入れる -->

              <!-- action id for type nameの変更の確認をお願いします！ -->
                <ul class="menu">
                  <li class="user-field">
                    <label class="user-label" for="email">メールアドレス</label>
                    <input id="email" class="login-input card-input" type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"
                      placeholder="hello@example.com" required />
                  </li>
                  <li class="user-field">
                    <label class="user-label" for="password">パスワード</label>
                    <input id="password" class="login-input card-input" type="password" name="password" value=""
                      placeholder="8文字以上" required />
                  </li>
                  <li class="user-field">
                    <label class="user-label" for="name">ユーザー名</label>
                    <input id="name" class="login-input card-input" type="name" name="name" value="<?= htmlspecialchars($user['user_name'] ?? '') ?>"
                    placeholder="ユーザー名" required />
                  </li>
                </ul>

            </div>

          </div>

          <div class="section-box">

            <div class="shine-button button-electric">
              <h3>なりたい体格を変更する</h3>


                <div class="settingman">
                  <div class="form-img">
                    <input type="radio" id="bt-1" name="body_type_id" value="1" <?= (isset($user['body_type_id']) && $user['body_type_id'] == 1) ? 'checked' : '' ?> required>
                    <img src="/image/man1.png" alt="マッチョ1">
                    <label for="bt-1">マッチョ</label>
                  </div>
                  <div class="form-img">
                    <input type="radio" id="bt-2" name="body_type_id" value="2" <?= (isset($user['body_type_id']) && $user['body_type_id'] == 2) ? 'checked' : '' ?> required>
                    <img src="/image/man2.png" alt="マッチョ2">
                    <label for="bt-2">少しマッチョ</label>
                  </div>
                  <div class="form-img">
                    <input type="radio" id="bt-3" name="body_type_id" value="3" <?= (isset($user['body_type_id']) && $user['body_type_id'] == 3) ? 'checked' : '' ?> required>
                    <img src="/image/man3.png" alt="マッチョ3">
                    <label for="bt-3">これからマッチョ</label>
                  </div>
                </div>

            </div>


          </div>
        </section>
        <!-- 右サイド -------------------------------------------------->
        <aside id="bodydata">
          <div class="aside-box">

            <div class="shine-button button-electric">
              <h3>体組成を変更する</h3>
                <div class="measure-update">
                  <div class="form"><label>体重</label><input type="number" name="weight" value="<?= htmlspecialchars($measurement['weight'] ?? '', ENT_QUOTES, 'UTF-8') ?>"><span>kg</span></div>
                  <div class="form"><label>身長</label><input type="number" name="height" value="<?= htmlspecialchars($measurement['height'] ?? '', ENT_QUOTES, 'UTF-8') ?>"><span>cm</span></div>
                  <div class="form"><label>体脂肪率</label><input type="number" name="body_fat" value="<?= htmlspecialchars($measurement['body_fat'] ?? '', ENT_QUOTES, 'UTF-8') ?>"><span>%</span></div>
                  <div class="form"><label>筋肉量</label><input type="number" name="muscle_mass" value="<?= htmlspecialchars($measurement['muscle_mass'] ?? '', ENT_QUOTES, 'UTF-8') ?>"><span>kg</span></div>
                </div>
            </div>

          </div>

          <div class="aside-box">
            <div class="submit-field">
              <button type="submit" class="card">登録を変更する</button>
            </div>
          </div>
        </aside>
      </div>
      </form>

      <footer class="start-footer">
        <div class="container">© 2025 TeamProject1</div>
      </footer>
    </div>
  </div>

</body>

</html>