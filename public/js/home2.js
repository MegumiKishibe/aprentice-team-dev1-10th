// public/js/home2.js
//グローバル汚染を避けるために即時関数で囲む（他スクリプトと変数名が衝突しない）。
(() => {//アプリ内部の論理キー → DOMのid の対応表。set("weight", 60, "kg") のようにキーで指定できる
  const ids = { weight: "weight", height: "height", bodyFat: "bodyfat", muscle: "muscle" };
  const set = (key, val, unit = "") => {//どの項目（key）に、どの値（val）を、どの単位（unit）で表示するかを1行で指定。
    const el = document.getElementById(ids[key]);
    if (el) el.textContent = (val ?? val === 0) ? `${val}${unit}` : "-";
  };//(val ?? val === 0) は演算子優先度の関係で、val が 0 のとき 偽 になり、"-" が表示
  const pick = (...vals) => {//複数候補から**最初の“まともな値”**を返すヘルパー。
    for (const v of vals) if (v !== undefined && v !== null && v !== "") return v;//null / undefined / "" はスキップ、0 は有効（返る）
    return null;
  };
  // const pickFrom = (obj, keys) => {//オブジェクトから優先順キーで最初に見つかった値を返す。こちらも 0 は有効。
  //   if (!obj) return null;
  //   for (const k of keys) if (obj[k] !== undefined && obj[k] !== null) return obj[k];
  //   return null;
  // };

  // document.addEventListener("DOMContentLoaded", async () => {
    // --- 1) 体重・身長などの表示（data-* 優先 → API フォールバック） ---
    const statsEl = document.querySelector(".stats");
    if (statsEl && Object.keys(statsEl.dataset).length) {
      const m = {
        weight:  pick(statsEl.dataset.weight, statsEl.dataset.weightKg),
        height:  pick(statsEl.dataset.height, statsEl.dataset.heightCm),
        bodyFat: pick(statsEl.dataset.bodyFat, statsEl.dataset.body_fat, statsEl.dataset.bodyFatPct),
        muscle:  pick(statsEl.dataset.muscle, statsEl.dataset.muscleMass, statsEl.dataset.leanMass),
      };
      set("weight", m.weight, " kg");
      set("height", m.height, " cm");
      set("bodyFat", m.bodyFat, " %");
      set("muscle", m.muscle, " kg");
    // } else {
    //   try {
    //     const res = await fetch("/api/metrics/latest", {
    //       headers: { Accept: "application/json" },
    //       credentials: "include",
    //     });
    //     if (!res.ok) throw new Error(`HTTP ${res.status}`);
    //     const data = await res.json();

    //     const candidates = [data, data?.metrics, data?.profile, data?.latest, data?.data];
    //     const get = (keys) => {
    //       for (const src of candidates) {
    //         const v = pickFrom(src, keys);
    //         if (v !== null) return v;
    //       }
    //       return null;
    //     };

    //     const weight  = get(["weight", "weight_kg", "体重"]);
    //     const height  = get(["height", "height_cm", "身長"]);
    //     const bodyFat = get(["body_fat", "bodyFat", "body_fat_pct", "体脂肪"]);
    //     const muscle  = get(["muscle_mass", "muscleMass", "lean_mass", "筋肉量"]);

    //     set("weight",  weight,  " kg");
    //     set("height",  height,  " cm");
    //     set("bodyFat", bodyFat, " %");
    //     set("muscle",  muscle,  " kg");
    //   } catch (e) {
    //     console.warn("[home2] metrics fetch failed:", e);
    //   }
    // }


    const heroImg = document.querySelector(".hero-card img");
    const chosen = localStorage.getItem("selectedCharacter");
    if (heroImg && chosen) {
      heroImg.src = chosen;
      heroImg.alt = "選択したキャラクター";
    }
  });
  //   document.addEventListener('DOMContentLoaded', () => {
  //     window.location.assign('/index.php?page=setting');
  //   });
  // });
})();
