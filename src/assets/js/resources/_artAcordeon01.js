export function artAcordeon01() {
  const botones = document.querySelectorAll(".mostrar");
  botones.forEach((item) => {
    item.addEventListener("click", () => {
      const contenedorPadre = item.parentElement;
      const parrafo = contenedorPadre.querySelector(".respuesta");
      parrafo.classList.toggle("open");

      item.textContent = parrafo.classList.contains("open")
        ? "Mostras menos"
        : "Mostrar más";
    });
  });
}
