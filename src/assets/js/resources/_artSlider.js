export default function artSlider() {
  const $carrousel = document.querySelectorAll(".artSlider01");

  $carrousel.forEach(($el) => {
    const $pista = $el.querySelector(".artSlider01__pista");
    const $dots = $el.querySelectorAll(".artSlider01__track__dot");
    const $slides = $pista.querySelectorAll(".artSlider01__slide");
    const $btnPrev = $el.querySelector(".artSlider01__arrow--prev");
    const $btnNext = $el.querySelector(".artSlider01__arrow--next");

    //Este archivo no contiene lógia pra los btones por eso los eliminamos
    $btnNext.remove();
    $btnPrev.remove();

    // Comprobar que nuestra pista y los slider existan dentro del DOM
    if (!$pista || $slides.length === 0) return;

    // Estos tiempos estan separados para que sea facil cambiarlos en clase.
    const tiempoTransicion = 500;
    const tiempoEspera = 3000;
    let contador = 0;

    $slides.forEach(($slide) => {
      const $copia = $slide.cloneNode(true);
      $pista.appendChild($copia);
    });

    setInterval(() => {
      //Actualizamos el contador sumando 1
      contador++;
      $pista.style.transition = `transform ${tiempoTransicion}ms`;
      $pista.style.transform = `translateX(-${100 * contador}%)`;
      //Actual elemento dot "activo"
      $dots[contador - 1]?.classList.remove("active");
      // Siguiente elemento dot
      if ($dots[contador]) {
        // Comprobamos que nuestro dot no contenga la clase "active"
        if (!$dots[contador].classList.contains("active")) {
          $dots[contador].classList.add("active");
        }
      } else {
        $dots[0].classList.add("active");
      }

      if (contador === $slides.length) {
        setTimeout(() => {
          // Reiniciar la posición del visor para mostrar el primer slide
          $pista.style.transition = "none";
          $pista.style.transform = `translateX(0)`;
          contador = 0;
        }, tiempoTransicion);
      }
    }, tiempoEspera);
  });
}
