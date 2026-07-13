<?php
// Listado compartido por el nav y el footer en euskera. Si se crea una página
// nueva, su href debe coincidir con una ruta de App/config/config.php.
// $idSubmenu llega desde nav.php o footer.php para evitar IDs HTML duplicados.
?>
<ul class="enlaces01">
  <li class="enlaces01__item">
    <a class="enlaces01__link" href="/eu">
      <img class="enlaces01__icon" src="<?= asset('assets/img/icons/home.svg') ?>" alt="">
      <span>Hasiera</span>
    </a>
  </li>

  <li class="enlaces01__item">
    <a class="enlaces01__link" href="/eu/kontaktua">
      <img class="enlaces01__icon" src="<?= asset('assets/img/icons/mail.svg') ?>" alt="">
      <span>Kontaktua</span>
    </a>
  </li>

  <li class="enlaces01__item">
    <a class="enlaces01__link" href="/eu/nortzuk-gara">
      <img class="enlaces01__icon" src="<?= asset('assets/img/icons/users.svg') ?>" alt="">
      <span>Nortzuk gara</span>
    </a>
  </li>

  <!-- Este item contiene un segundo nivel de navegación. -->
  <li class="enlaces01__item enlaces01__item--hasSubmenu" data-nav01-submenu-item>
    <div class="enlaces01__submenuHeader">
      <a class="enlaces01__link enlaces01__link--parent" href="/eu/zerbitzuak">
        <img class="enlaces01__icon" src="<?= asset('assets/img/icons/boxes.svg') ?>" alt="">
        <span>Zerbitzuak</span>
      </a>
      <button class="enlaces01__submenuToggle" type="button" aria-controls="<?= e($idSubmenu) ?>" aria-expanded="false" aria-label="Azpimenua ireki Zerbitzuak" data-nav01-submenu-toggle data-nav01-label-open="Azpimenua ireki" data-nav01-label-close="Azpimenua itxi" data-nav01-submenu-label="Zerbitzuak">
        <img class="enlaces01__chevron" src="<?= asset('assets/img/icons/chevron.svg') ?>" alt="">
      </button>
    </div>

    <ul class="enlaces01__submenu" id="<?= e($idSubmenu) ?>" data-nav01-submenu>
      <li class="enlaces01__item">
        <a class="enlaces01__link enlaces01__link--child" href="/eu/zerbitzuak/pintorea">
          <img class="enlaces01__icon" src="<?= asset('assets/img/icons/tag.svg') ?>" alt="">
          <span>Pintorea</span>
        </a>
      </li>
      <li class="enlaces01__item">
        <a class="enlaces01__link enlaces01__link--child" href="/eu/zerbitzuak/altzari-zaharberritzailea">
          <img class="enlaces01__icon" src="<?= asset('assets/img/icons/spark.svg') ?>" alt="">
          <span>Altzari zaharberritzailea</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="enlaces01__item">
    <a class="enlaces01__link" href="/showroom">
      <img class="enlaces01__icon" src="<?= asset('assets/img/icons/grid.svg') ?>" alt="">
      <span>Showroom</span>
    </a>
  </li>
</ul>
