<?php
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/css/eat.css">
  <title>eat画面</title>
</head>

<body>
  <div class="start">
    <a href="index.php?page=home">
      <h1 class="title">献立提案アプリ/食事記録 🏠</h1>
    </a>

    <div class="inner">
      <main>
        <div class="main wrapper">

          <div class="wrapper">
            <h3>毎日食事を記録してこつこつバーを貯めよう！</h3>
            <div class="error-ms" id="result"></div>
            <div class="section-content">

              <form id="mealForm" action="" method="post">
                <div class="meal">
                  <textarea name="meal" id="meal" placeholder="🍴" class="meal-input"></textarea>
                </div>

                <li class="submit-field">
                  <button type="submit" id="registerBtn" class="card">登録する</button>
                </li>

              </form>
            </div>

          </div>
        </div>

        <div class="bar wrapper">
          <!-- こつこつ記録バー -->
          <div class="error-ms" id="countArea"></div>

          <div class="progress-bar">
            <div class="progress"></div>
            <div class="ticks">
              <div class="tick">0%</div>
              <div class="tick">20%</div>
              <div class="tick">40%</div>
              <div class="tick">60%</div>
              <div class="tick">80%</div>
              <div class="tick">100%</div>
            </div>
          </div>
        </div>

        <div class="outputmeal wrapper">
          <h3>Meal Daily log</h3>
          <table class="meallog-table">
            <thead>
              <tr>
                <th>日付</th>
                <th>内容</th>
                <th>ごみ箱</th>
              </tr>
            </thead>
            <tbody id="mealLogBody">
              <!-- ここにJSでtr td追加される -->
            </tbody>
          </table>
        </div>
      </main>

      <footer class="start-footer">
        <div class="wrapper">
          <div class="container">© 2025 TeamProject1</div>
        </div>
      </footer>
    </div>
  </div>
  <script src="/js/eat.js"></script>
</body>

</html>