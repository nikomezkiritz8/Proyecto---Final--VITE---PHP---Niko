<?php
// Nav en castellano. Las rutas se escriben aquí de forma explícita para que
// el alumno pueda relacionar fácilmente cada enlace con App/config/config.php.
?>
<nav class="nav01" data-nav01>
  <div class="nav01__inner">
    <a class="nav01__brand" href="/es" aria-label="Ir al inicio">
      <span class="nav01__logo" aria-hidden="true">LS</span>
      <span class="nav01__brandText">Liquid Stack</span>
    </a>

    <button class="nav01__toggle" type="button" aria-controls="nav01-menu-es" aria-expanded="false" aria-label="Abrir menú" data-nav01-toggle data-nav01-label-open="Abrir menú" data-nav01-label-close="Cerrar menú">
      <span class="nav01__toggleLine"></span>
      <span class="nav01__toggleLine"></span>
      <span class="nav01__toggleLine"></span>
    </button>

    <div class="nav01__panel" id="nav01-menu-es" data-nav01-menu>
      <div class="nav01__panelInner">
        <?php
        // enlaces.php también se usa en el footer. Cada copia necesita un ID
        // distinto para que aria-controls apunte a un submenú único.
        $idSubmenu = 'nav-servicios-es';
        require app_path('includes/es/enlaces.php');
        ?>

        <div class="nav01__langs" aria-label="Idiomas">
          <!-- Para mantener el ejemplo sencillo, cada idioma enlaza a su inicio. -->
          <a class="nav01__lang is-active" href="/es" lang="es" hreflang="es" aria-current="true">ES</a>
          <a class="nav01__lang" href="/eu" lang="eu" hreflang="eu">EU</a>
        </div>
      </div>
    </div>
  </div>
</nav>
