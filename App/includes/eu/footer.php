<?php
// Footer en euskera. Los textos, rutas y datos de contacto se editan aquí
// sin depender de arrays de configuración ni de condiciones de idioma.
?>
<footer class="footer01">
  <div class="footer01__inner">
    <section class="footer01__column" aria-labelledby="footer01-menu-title-eu">
      <h2 class="footer01__title" id="footer01-menu-title-eu">Nabigazioa</h2>
      <?php
      // Se reutiliza el listado para no mantener dos menús diferentes.
      $idSubmenu = 'footer-zerbitzuak-eu';
      require app_path('includes/eu/enlaces.php');
      ?>
    </section>

    <section class="footer01__column" aria-labelledby="footer01-legal-title-eu">
      <h2 class="footer01__title" id="footer01-legal-title-eu">Legezkoa</h2>
      <ul class="footer01__list">
        <li><a class="footer01__link" href="<?= url('/eu/lege-oharra#aviso-legal') ?>">Lege oharra</a></li>
        <li><a class="footer01__link" href="<?= url('/eu/lege-oharra#politica-privacidad') ?>">Pribatutasun politika</a></li>
        <li><a class="footer01__link" href="<?= url('/eu/lege-oharra#gestion-cookies') ?>">Cookieen kudeaketa</a></li>
      </ul>
    </section>

    <section class="footer01__column" aria-labelledby="footer01-contact-title-eu">
      <h2 class="footer01__title" id="footer01-contact-title-eu">Kontaktua</h2>
      <address class="footer01__address">
        <a class="footer01__link" href="tel:+34638141964">
          <img class="footer01__icon" src="<?= asset('assets/img/icons/telephone.svg') ?>" alt="mugikorra" title="mugikorra">
          <span>+34 638 141 964</span>
        </a>
        <a class="footer01__link" href="mailto:nikomezkiritz8@gmail.com">
          <img class="footer01__icon" src="<?= asset('assets/img/icons/email.svg') ?>" alt="email-a" title="email-a">
          <span>nikomezkiritz8@gmail.com</span>
        </a>
        <a class="footer01__link" href="https://www.google.com/maps/search/?api=1&query=Calle+Ejemplo+1" target="_blank" rel="noopener noreferrer">
          <img class="footer01__icon" src="<?= asset('assets/img/icons/google-maps.svg') ?>" alt="mapa" title="mapa">
          <span>Ikusi Google Mapsen</span>
        </a>
        <p class="footer01__text">
          <img class="footer01__icon" src="<?= asset('assets/img/icons/maps-square-02.svg') ?>" alt="pin" title="pin">
          <span>Baratzategi Kalea 10, Donostia</span>
        </p>
      </address>

      <div class="footer01__social">

          <a
              class="footer01__socialLink"
              href="https://github.com/nikomezkiritz8"
              target="_blank"
              rel="noopener noreferrer"
              aria-label="GitHub">

              <img
                  src="<?= asset('assets/img/icons/github-loop.svg') ?>"
                  alt="github"
                  title="github"
                  class="footer01__socialIcon">
          </a>

          <a
              class="footer01__socialLink"
              href="https://www.linkedin.com/in/niko-mezkiritz-8151b92b1/"
              target="_blank"
              rel="noopener noreferrer"
              aria-label="LinkedIn">

              <img
                  src="<?= asset('assets/img/icons/linkedin.svg') ?>"
                  alt="linkedin"
                  title="linkedin"
                  class="footer01__socialIcon">
          </a>

        </div>

    </section>
  </div>

  <div class="footer01__bottom">
    <p>Nikok garatua. &copy; <?= date('Y') ?> Eskubide guztiak erreserbatuta.</p>
  </div>
</footer>
