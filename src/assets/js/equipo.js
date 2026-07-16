// Importamos el archivo principal de estilos.
import "../scss/equipo.scss";
import "./resources/_global.js";
import artSlider from "./resources/_artSlider.js";

document.addEventListener("DOMContentLoaded", () => {
    artSlider();

});

// JavaScript del audio

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
