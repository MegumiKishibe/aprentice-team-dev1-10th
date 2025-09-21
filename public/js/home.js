///set-login/homeに読み込ませてます！！消さないで！9/21

// home.js
document.addEventListener("DOMContentLoaded", () => {
  const countArea = document.getElementById("countArea");
  const progress = document.querySelector(".progress");

  // 登録件数を取得
  let mealCount = JSON.parse(localStorage.getItem("meals") || "[]").length;

  // カウント表示
  countArea.textContent = `記録数: ${mealCount}件`;

  // バーをアニメーションさせる関数
  function animateProgressBar(targetCount) {
    progress.style.width = "0%";
    let current = 0;

    const interval = setInterval(() => {
      current += 1;
      if (current >= targetCount) {
        current = targetCount;
        clearInterval(interval);
      }

      progress.style.width = current + "%";

      if (current > 80) {
        progress.style.backgroundColor = "#EB489A";
      } else if (current > 60) {
        progress.style.backgroundColor = "#58A65C";
      } else if (current > 40) {
        progress.style.backgroundColor = "#5383EC";
      } else if (current > 20) {
        progress.style.backgroundColor = "#AA3A75";
      } else {
        progress.style.backgroundColor = "#F5E24D";
      }

    }, 20); 
  }

  animateProgressBar(mealCount);
});
