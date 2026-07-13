import "../scss/showroom.scss";
import "./resources/_global.js";

import "./resources/_artForm02.js";

import artSlider from "./resources/_artSlider.js";
import { artAcordeon01 } from "./resources/_artAcordeon01.js";

document.addEventListener("DOMContentLoaded", () => {
  artAcordeon01();
  artSlider();
});
