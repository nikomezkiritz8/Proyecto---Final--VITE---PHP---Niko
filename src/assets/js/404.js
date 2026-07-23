import "../scss/404.scss";
import "./resources/_global.js";

const historyBackButton = document.querySelector("[data-history-back]");

historyBackButton?.addEventListener("click", () => {
  if (window.history.length > 1) {
    window.history.back();
    return;
  }

  const language = document.documentElement.lang === "eu" ? "eu" : "es";
  window.location.assign(`/${language}`);
});
