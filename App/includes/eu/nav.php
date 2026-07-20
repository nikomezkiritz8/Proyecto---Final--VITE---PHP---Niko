<?php
// Nav en euskera. Las rutas se escriben aquí de forma explícita para que
// el alumno pueda relacionar fácilmente cada enlace con App/config/config.php.
?>
<nav class="nav01" data-nav01>
  <div class="nav01__inner">
    <a class="nav01__brand" href="/eu" aria-label="Hasierara joan">
      <span class="nav01__logo" aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 64 64"
          width="64"
          height="64"
          fill="none">

          <!-- Hexágono -->
          <path
              d="M32 4
                L52 16
                L52 48
                L32 60
                L12 48
                L12 16
                Z"
              fill="url(#grad)"
          />

          <!-- Cursor > -->
          <path
              d="M24 25 L31 32 L24 39"
              stroke="white"
              stroke-width="3"
              stroke-linecap="round"
              stroke-linejoin="round"/>

          <!-- Guion bajo -->
          <line
              x1="34"
              y1="39"
              x2="42"
              y2="39"
              stroke="white"
              stroke-width="3"
              stroke-linecap="round"/>

          <!-- Gradiente -->
          <defs>
              <linearGradient id="grad"
                              x1="12"
                              y1="4"
                              x2="52"
                              y2="60"
                              gradientUnits="userSpaceOnUse">
                  <stop offset="0%" stop-color="#6366F1"/>
                  <stop offset="100%" stop-color="#F59E0B"/>
              </linearGradient>
          </defs>

      </svg>

</span>

      <p>Niko Studio</p>
      <span class="nav01__brandText"></span>

    </a>

    <button class="nav01__toggle" type="button" aria-controls="nav01-menu-eu" aria-expanded="false" aria-label="Menua ireki" data-nav01-toggle data-nav01-label-open="Menua ireki" data-nav01-label-close="Menua itxi">
      <span class="nav01__toggleLine"></span>
      <span class="nav01__toggleLine"></span>
      <span class="nav01__toggleLine"></span>
    </button>

    <div class="nav01__panel" id="nav01-menu-eu" data-nav01-menu>
      <div class="nav01__panelInner">
        <?php
        // enlaces.php también se usa en el footer. Cada copia necesita un ID
        // distinto para que aria-controls apunte a un submenú único.
        $idSubmenu = 'nav-zerbitzuak-eu';
        require app_path('includes/eu/enlaces.php');
        ?>

        <div class="nav01__langs" aria-label="Hizkuntzak">
          <!-- Para mantener el ejemplo sencillo, cada idioma enlaza a su inicio. -->
          <a class="nav01__lang" href="/es" lang="es" hreflang="es">ES</a>
          <a class="nav01__lang is-active" href="/eu" lang="eu" hreflang="eu" aria-current="true">EU</a>
        </div>
      </div>
    </div>
  </div>
</nav>
