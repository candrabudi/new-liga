$(() => {
  const n = document.getElementById("game_list"),
    t = () => {
      n &&
        (n.onclick = (n) => {
          if (n.target.className === "favourite-game-btn") {
            let t = "";
            t = n.target.checked
              ? "/game/new-favourite"
              : "/game/remove-favourite";
            $.ajax({
              type: "POST",
              data: JSON.stringify({
                Provider: n.target.dataset.provider,
                GameCode: n.target.value,
              }),
              url: t,
              contentType: "application/json; charset=utf-8",
              dataType: "json",
              success: (t) => {
                t.errorCode != 0 &&
                  ((n.target.checked = !n.target.checked),
                  registerPopup({
                    content: `Unable to update favourite game. ${t.message}`,
                  }));
              },
              error: () => {
                (n.target.checked = !n.target.checked),
                  registerPopup({
                    content: "Unable to update favourite game.",
                  });
              },
            });
          }
        });
    };
  t();
});
$(() => {
  const n = document.querySelector("#filter_categories"),
    i = document.querySelector("#filter_input"),
    t = document.querySelector("#game_list"),
    r = document.querySelector("#game_modal"),
    u = document.querySelector("#game_modal_image"),
    e = document.querySelector("#game_modal_name"),
    f = document.querySelector("#game_modal_links");
  window.initializeSlotGames = (o) => {
    $.ajax({
      type: "GET",
      url: `/mobile/slots/games/${o.provider}`,
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      success: (s) => {
        const h = 84,
          c = 89,
          a = new Set(),
          y = document.createDocumentFragment();
        s.forEach((n) => {
          n.categories.forEach((n) => a.add(n.name));
          const v = document.createElement("img");
          v.src = `${n.gameImage}`;
          v.alt = n.name;
          const s = document.createElement("div");
          if (
            ((s.className = "wrapper-container"),
            s.appendChild(v),
            n.rtpChanged !== null &&
              isFinite(n.rtpChanged.from) &&
              isFinite(n.rtpChanged.to))
          ) {
            const u = document.createElement("span");
            u.className = "rtp-title";
            u.innerText = "RTP";
            const t = document.createElement("div"),
              f = n.rtpChanged.from.toFixed(2),
              o = n.rtpChanged.to.toFixed(2);
            t.className = "rtp-progress-bar";
            t.dataset.rtpFrom = f;
            t.dataset.rtpTo = o;
            t.style.width = f + "%";
            t.style.setProperty("--from-value", `${f}%`);
            t.style.setProperty("--to-value", `${o}%`);
            n.rtpChanged.from < h &&
              t.style.setProperty("--from-color", "var(--low)");
            n.rtpChanged.from >= h &&
              n.rtpChanged.from <= c &&
              t.style.setProperty("--from-color", "var(--medium)");
            n.rtpChanged.from > c &&
              t.style.setProperty("--from-color", "var(--high)");
            n.rtpChanged.to < h &&
              t.style.setProperty("--to-color", "var(--low)");
            n.rtpChanged.to >= h &&
              n.rtpChanged.to <= c &&
              t.style.setProperty("--to-color", "var(--medium)");
            n.rtpChanged.to > c &&
              t.style.setProperty("--to-color", "var(--high)");
            t.dataset.rtpFrom != "medium" && t.dataset.rtpTo != "medium"
              ? t.style.setProperty("--transition-color", "var(--medium)")
              : t.style.setProperty("--transition-color", "var(--from-color)");
            const e = document.createElement("div");
            e.className = "rtp-progress";
            e.appendChild(t);
            const r = document.createElement("span");
            r.className = "rtp-percentage";
            r.dataset.rtpFrom = Math.ceil(n.rtpChanged.from);
            r.dataset.rtpTo = Math.ceil(n.rtpChanged.to);
            const i = document.createElement("div");
            i.className = "rtp-container";
            i.appendChild(u);
            i.appendChild(e);
            i.appendChild(r);
            s.appendChild(i);
          } else if (n.rtpValue !== null && isFinite(n.rtpValue)) {
            const r = document.createElement("span");
            r.className = "rtp-title";
            r.innerText = "RTP";
            const t = document.createElement("div");
            t.className = "rtp-progress-bar";
            t.style.width = n.rtpValue.toFixed(2) + "%";
            n.rtpValue < h && (t.dataset.rtp = "low");
            n.rtpValue >= h && n.rtpValue <= c && (t.dataset.rtp = "medium");
            n.rtpValue > c && (t.dataset.rtp = "high");
            const u = document.createElement("div");
            u.className = "rtp-progress";
            u.appendChild(t);
            const f = document.createElement("span");
            f.className = "rtp-percentage";
            f.innerHTML = Math.ceil(n.rtpValue) + "%";
            const i = document.createElement("div");
            i.className = "rtp-container";
            i.appendChild(r);
            i.appendChild(u);
            i.appendChild(f);
            s.appendChild(i);
          }
          const l = document.createElement("div");
          l.className = "game-name-container";
          const p = document.createElement("div");
          p.className = "game-name";
          p.innerText = n.name;
          l.appendChild(p);
          const i = document.createElement("li");
          if (
            ((i.className = "game-item"),
            (i.dataset.game = n.name),
            (i._categories = n.categories.filter((n) => n.seqNo >= 0)),
            n.isFavourite !== undefined && n.isFavourite !== null)
          ) {
            const t = document.createElement("input");
            t.type = "checkbox";
            t.dataset.provider = o.provider;
            t.value = n.gameCode;
            t.id = n.gameCode;
            t.className = "favourite-game-btn";
            n.isFavourite && (t.checked = !0);
            const r = document.createElement("label");
            r.htmlFor = n.gameCode;
            o.altFavouriteBtnPosition
              ? (l.appendChild(t), l.appendChild(r))
              : (i.appendChild(t), i.appendChild(r));
          }
          if (r)
            (s.onclick = () => {
              if (t.dataset.isLoggedIn === "true")
                window.location.href = n.link;
              else {
                u.src = v.src;
                u.alt = n.name;
                e.innerText = n.name;
                const i = document.createDocumentFragment();
                if (o.onDemoLinkClicked) {
                  const t = document.createElement("a");
                  t.className = "free-play";
                  t.innerText = o.translations.demo;
                  t.onclick = () => o.onDemoLinkClicked(n.gameCode);
                  i.appendChild(t);
                }
                const t = document.createElement("a");
                t.className = "play-now";
                t.dataset.game = n.name;
                t.href = n.link;
                t.innerText = o.translations.playNow;
                i.appendChild(t);
                f.innerHTML = "";
                f.appendChild(i);
                $(r).modal();
              }
            }),
              i.appendChild(s),
              i.appendChild(l);
          else {
            const u = document.createElement("span");
            if (((u.className = "link-container"), o.onDemoLinkClicked)) {
              const t = document.createElement("a");
              t.className = "free-play";
              t.innerText = o.translations.demo;
              t.onclick = () => o.onDemoLinkClicked(n.gameCode);
              u.appendChild(t);
            }
            s.appendChild(u);
            const t = document.createElement("a");
            t.className = "play-now";
            t.dataset.game = n.name;
            t.href = n.link;
            t.innerText = o.translations.playNow;
            u.appendChild(t);
            const f = document.createElement("input");
            f.type = "radio";
            f.name = "game-list-radio-button";
            const r = document.createElement("label");
            r.className = "inner-game-item";
            r.appendChild(f);
            r.appendChild(s);
            r.appendChild(p);
            i.appendChild(r);
          }
          y.appendChild(i);
        });
        t.appendChild(y);
        const p = document.createDocumentFragment();
        a.forEach((t) => {
          if (t === "DEFAULT") {
            const i = n.querySelector('[data-category=""]');
            i.dataset.category = t;
            return;
          }
          const i = document.createElement("div");
          i.className = "category-filter-link";
          i.dataset.category = t;
          i.innerText = t;
          p.appendChild(i);
        });
        n.appendChild(p);
        const k = t.querySelectorAll(".game-item"),
          l = { name: null, category: null },
          w = () => {
            Array.prototype.slice.call(k).forEach((n) => {
              const i = n.dataset.game.toLowerCase(),
                t = n._categories.find((n) => n.name === l.category),
                r = !l.category || t !== undefined,
                u = !l.name || i.indexOf(l.name) >= 0;
              r && u
                ? ((n.style.order = (t && t.seqNo) || 0), $(n).show())
                : ((n.style.order = 0), $(n).hide());
            });
          };
        $(i).keyup(function () {
          l.name = i.value.toLowerCase();
          w();
        });
        $(n).on("click", ".category-filter-link", function () {
          const n = $(this);
          n.siblings().removeClass("active");
          n.addClass("active");
          l.category = this.dataset.category;
          w();
        });
        const b = new URLSearchParams(window.location.search).get(
          "PromotionCategory"
        );
        if (b) {
          const t = Array.from(a).find(
            (n) => n.toLowerCase() === b.toLowerCase()
          );
          if (t) {
            n.querySelector(`[data-category="${t}"]`).click();
            return;
          }
        }
        const v = n.querySelector(".active");
        v && v.dataset.category !== "" && v.click();
      },
    });
  };
});
