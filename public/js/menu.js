document.addEventListener("DOMContentLoaded", function () {
  const resetBtn = document.getElementById("resetButton");
  const form = document.querySelector("form");
  const resultArea = document.querySelector(".confirm");

  // ボタンクリック時の処理
  resetBtn.addEventListener("click", function () {
    if (form) {
      const radios = form.querySelectorAll('input[type="radio"]');
      radios.forEach((radio) => (radio.checked = false));
      form.reset();
    }

    if (resultArea) {
      resultArea.innerHTML = "";
    }
  });
});
