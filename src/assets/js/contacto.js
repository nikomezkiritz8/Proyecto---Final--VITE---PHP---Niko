import "../scss/contacto.scss";
import "./resources/_global.js";

import "./resources/_artForm02.js";
import { artAcordeon01 } from "./resources/_artAcordeon01.js";

document.addEventListener("DOMContentLoaded", () => {
  artAcordeon01();
  artSlider();
});

const music = document.getElementById("bgMusic");

const player = document.getElementById("focusPlayer");

const button = document.getElementById("focusButton");

const subtitle = document.querySelector(".focus-info small");

let playing = false;

button.addEventListener("click",()=>{

    if(playing){

        music.pause();

        subtitle.textContent="Lo-fi Coding Mix";

        player.classList.remove("playing");

    }else{

        music.play();

        subtitle.textContent="Playing...";

        player.classList.add("playing");

    }

    playing=!playing;

});