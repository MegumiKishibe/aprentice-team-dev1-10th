document.addEventListener("DOMContentLoaded", () => {//DOM読み込み後に開始
	const imgs = document.querySelectorAll(".photo-list img");
  const form = document.querySelector("#signup-form") || document.querySelector("form");//#signup-form（なければ最初の<form>）… 値をPOSTするフォーム
//name="character_image" の hidden <input> を一度だけ生成してフォームに追加
  let hiddenInput;// 最初は undefined
  const ensureHidden = () => {//クリックのたびに増殖しないよう遅延・1回だけ作る
    if (hiddenInput) return hiddenInput;// 既に作ってあればそれを返す（早期return）
    hiddenInput = document.createElement("input");// まだ無ければ初回だけ作成
    hiddenInput.type = "hidden";
    hiddenInput.name = "character_image";
    hiddenInput.id = "character_image";
    if (form) form.appendChild(hiddenInput);// 追加
    return hiddenInput;
  };

  const saved = localStorage.getItem("selectedCharacter");//selectedCharacter というキーに保存済みなら、その src と一致する画像に.is-selected を付与
  if (saved) {
    imgs.forEach(img => {
      if (img.getAttribute("src") === saved) img.classList.add("is-selected");
    });
  }

  imgs.forEach(img => {
    img.style.cursor = "pointer";
    img.addEventListener("click", () => {//クリックした画像の src を localStorage に保存
      const src = img.getAttribute("src");
      localStorage.setItem("selectedCharacter", src);

      imgs.forEach(i => i.classList.remove("is-selected"));//全画像から .is-selected を外して、クリックした画像にだけ付与
      img.classList.add("is-selected");

      const h = ensureHidden();
      h.value = src;//hidden input を用意して、その value に src をセット（POSTで送る値になる）
    });
  });

  if (form) {
    form.addEventListener("submit", () => {//ページ再読込後に“クリックしていなくても”保存済みの選択を hidden に入れて送れる
      const src = localStorage.getItem("selectedCharacter");
      if (src) ensureHidden().value = src;
    });
  }
});
