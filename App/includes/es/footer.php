<?php
// Footer en castellano. Los textos, rutas y datos de contacto se editan aquí
// sin depender de arrays de configuración ni de condiciones de idioma.
?>
<footer class="footer01">
  <div class="footer01__inner">
    <section class="footer01__column" aria-labelledby="footer01-menu-title-es">
      <h2 class="footer01__title" id="footer01-menu-title-es">Navegación</h2>
      <?php
      // Se reutiliza el listado para no mantener dos menús diferentes.
      $idSubmenu = 'footer-servicios-es';
      require app_path('includes/es/enlaces.php');
      ?>
    </section>

    <section class="footer01__column" aria-labelledby="footer01-legal-title-es">
      <h2 class="footer01__title" id="footer01-legal-title-es">Legal</h2>
      <ul class="footer01__list">
        <li><a class="footer01__link" href="/es/legal#aviso-legal">Aviso legal</a></li>
        <li><a class="footer01__link" href="/es/legal#politica-privacidad">Política de privacidad</a></li>
        <li><a class="footer01__link" href="/es/legal#gestion-cookies">Gestión de cookies</a></li>
      </ul>
    </section>

    <section class="footer01__column" aria-labelledby="footer01-contact-title-es">
      <h2 class="footer01__title" id="footer01-contact-title-es">Contacto</h2>
      <address class="footer01__address">
        <a class="footer01__link" href="tel:+34000000000">
          <img class="footer01__icon" src="<?= asset('assets/img/icons/phone.svg') ?>" alt="">
          <span>+34 000 000 000</span>
        </a>
        <a class="footer01__link" href="mailto:hola@ejemplo.com">
          <img class="footer01__icon" src="<?= asset('assets/img/icons/mail.svg') ?>" alt="">
          <span>hola@ejemplo.com</span>
        </a>
        <a class="footer01__link" href="https://www.google.com/maps/search/?api=1&query=Calle+Ejemplo+1" target="_blank" rel="noopener noreferrer">
          <img class="footer01__icon" src="<?= asset('assets/img/icons/map.svg') ?>" alt="">
          <span>Ver en Google Maps</span>
        </a>
        <p class="footer01__text">
          <img class="footer01__icon" src="<?= asset('assets/img/icons/pin.svg') ?>" alt="">
          <span>Calle Ejemplo 1, 00000 Ciudad</span>
        </p>
      </address>
    </section>
  </div>

  <div class="footer01__bottom">
    <p>Desarrollado por xxxx. &copy; <?= date('Y') ?> Todos los derechos reservados.</p>
  </div>
</footer>
