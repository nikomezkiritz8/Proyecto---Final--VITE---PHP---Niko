# Componentes JavaScript Modulares

Este archivo sirve para ir guardando componentes pequenos que despues se pueden aplicar al proyecto.

La idea de trabajo sera siempre la misma:

1. Crear el HTML del componente.
2. Crear su CSS o SCSS.
3. Crear una funcion JavaScript.
4. Exportar esa funcion.
5. Importarla y ejecutarla desde `main.js`.

---

# 01. Boton Volver Arriba

Este componente muestra un boton flotante cuando el usuario baja por la pagina.
Al hacer click, la pagina vuelve arriba con scroll suave.

## HTML

Colocar este boton antes del cierre de `body`, o dentro de `main` si se quiere tenerlo junto al contenido.

```html
<button class="topBoton hidden" type="button" aria-label="Volver arriba">
  <span class="fa-arrow-up">&uarr;</span>
</button>
```

La clase `hidden` hace que el boton empiece oculto.

## CSS

Version CSS normal:

```css
.topBoton {
  width: 48px;
  height: 48px;
  position: fixed;
  right: 1rem;
  bottom: 1rem;
  z-index: 500;
  border: 0;
  border-radius: 50%;
  background-color: #410a6e;
  color: white;
  font-size: 1.5rem;
  cursor: pointer;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
  transition: opacity 0.3s, transform 0.3s, background-color 0.3s;
}

.topBoton:hover {
  background-color: #008cd5;
}

.topBoton.hidden {
  opacity: 0;
  pointer-events: none;
  transform: translateY(1rem);
}

@media only screen and (min-width: 800px) {
  .topBoton {
    right: 2rem;
    bottom: 2rem;
  }
}
```

Version SCSS para este proyecto:

```scss
@use "config" as c;

.topBoton {
  width: 48px;
  height: 48px;
  position: fixed;
  right: 1rem;
  bottom: 1rem;
  z-index: 500;
  border: 0;
  border-radius: 50%;
  background-color: c.$color04;
  color: c.$color00;
  font-size: 1.5rem;
  cursor: pointer;
  box-shadow: 0 8px 20px rgba(c.$color01, 0.25);
  transition: opacity 0.3s, transform 0.3s, background-color 0.3s;

  &:hover {
    background-color: c.$color03;
  }

  &.hidden {
    opacity: 0;
    pointer-events: none;
    transform: translateY(1rem);
  }

  @media only screen and (min-width: c.$tablet) {
    right: 2rem;
    bottom: 2rem;
  }
}
```

## JavaScript

Archivo sugerido:

`src/assets/js/assets/_topBoton.js`

```js
export const topBoton = (btn) => {
  const boton = document.querySelector(btn);

  if (!boton) return;

  window.addEventListener("scroll", () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > 600) {
      boton.classList.remove("hidden");
    } else {
      boton.classList.add("hidden");
    }
  });

  document.addEventListener("click", (e) => {
    if (e.target.matches(btn) || e.target.matches(`${btn} *`)) {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    }
  });
};
```

## Importar en `main.js`

```js
import { topBoton } from "./assets/_topBoton.js";

document.addEventListener("DOMContentLoaded", () => {
  topBoton(".topBoton");
});
```

Si `main.js` ya tiene otros componentes, simplemente se anade la llamada dentro del mismo `DOMContentLoaded`.

## Explicacion basica

```js
const boton = document.querySelector(btn);
```

Busca el boton en el HTML.

```js
window.addEventListener("scroll", () => {});
```

Escucha cuando el usuario hace scroll.

```js
boton.classList.remove("hidden");
boton.classList.add("hidden");
```

Quita o pone la clase `hidden`.

```js
window.scrollTo({ top: 0, behavior: "smooth" });
```

Hace que la pagina vuelva arriba suavemente.

## Version parecida a la funcion inicial

Esta version conserva la estructura de la funcion original, pero corrige el sentido de `hidden`: si bajamos mas de 600px, el boton debe mostrarse.

```js
const topBoton = (btn) => {
  const $scrollBtn = document.querySelector(btn).classList;
  const btn2 = ".fa-arrow-up";

  window.addEventListener("scroll", () => {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    scrollTop > 600 ? $scrollBtn.remove("hidden") : $scrollBtn.add("hidden");
  });

  document.addEventListener("click", (e) => {
    if (e.target.matches(btn) || e.target.matches(btn2)) {
      window.scrollTo({
        behavior: "smooth",
        top: 0,
      });
    }
  });
};
```

La version recomendada es la primera, porque guarda el boton completo en una constante y comprueba si existe antes de usarlo.
