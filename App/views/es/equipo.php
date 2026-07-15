<!doctype html>
<html lang="<?= e($lang ?? env('LANG_DEFAULT', 'es')) ?>">
  <head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="<?= asset('assets/img/icons/favicon.svg') ?>">
    <link rel="canonical" href="<?= url('/mis-proyectos') ?>">
    <title>Mis proyectos</title>
    <meta name="description" content="Conoce al equipo de panaderos y pasteleros que trabaja cada dia en nuestro obrador.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= vite_tags($route['resources'] ?? null) ?>
  </head>
  <body>
    <?php require app_path('includes/es/nav.php'); ?>

    <header class="header02">
        <img class="header02__media" src="<?= asset('assets/img/views/chicoprograma.avif') ?>" alt="Escena de Matrix">
        <div class="header02__content">
        <p class="header02__eyebrow">PROYECTOS</p>
        <h1 class="header02__title">Lo que he construido</h1>
        <p class="header02__text">Una selección de aplicaciones web y proyectos donde he aplicado HTML, CSS, JavaScript, PHP y otras tecnologías para crear soluciones funcionales y modernas.</p>
        <a href="#showroom-recursos" class="boton">Ponte en contacto</a>
        </div>
    </header>

    <main>

      <section>
        <!-- Presentación de mi portfolio -->


        <!-- Art14 -->
        <article class="art14">
          <div class="content">
            <h2>Portfolio Personal</h2>
            <span>HTML · SCSS · PHP · Vite</span>
            <p>Mi carta de presentación digital. Diseñada para demostrar que la accesibilidad, el rendimiento impecable y el diseño interactivo pueden convivir en armonía.</p>
            <img src="<?= asset('assets/img/views/otrohero.avif') ?>" alt="portfolio" title ="portfolio">
            <a href="/es/mis-proyectos" class="boton">Ver proyecto</a>
            <a href="/es/mis-proyectos" class="boton">Código</a>
            <a href="/es/mis-proyectos" class="boton">Caso de estudio</a>
          </div>
        </article>
        
      </section>

      <section>
        <!-- Presentación de mi landing page de arquitectura  -->

        <!-- Art14 -->
        <article class="art14">
          <div class="content">
            <h2>ARQ Studio</h2>
            <span>HTML · CSS</span>
            <p>Concepto visual y funcional para un estudio de arquitectura contemporáneo de Donostia. Inspirado en líneas rectas, orden estructural y elegancia monocromática.</p>
            <img src="<?= asset('assets/img/views/casahorizonte.avif') ?>" alt="página de arquitectura" title ="página de arquitectura" >
            <a href="/es/mis-proyectos" class="boton">Ver proyecto</a>
            <a href="/es/mis-proyectos" class="boton">Código</a>
            <a href="/es/mis-proyectos" class="boton">Caso de estudio</a>
          </div>
        </article>
      </section>

      <section>
        <!-- Presentación de mi Ecommerce japonésa -->

        <!-- Art14 -->
        <article class="art14">
          <div class="content">
            <h2>KOKORO · E-commerce Japonés</h2>
            <span>WordPress</span>
            <p>Demostración de una boutique online dedicada a la importación de tés e inciensos de KOKORO. Combina sobriedad minimalista y dinamismo comercial.</p>
            <img src="<?= asset('assets/img/views/japo.avif') ?>" alt="ecommerce japones" title ="ecommerce japones">
            <a href="/es/mis-proyectos" class="boton">Ver proyecto</a>
            <a href="/es/mis-proyectos" class="boton">Código</a>
            <a href="/es/mis-proyectos" class="boton">Caso de estudio</a>
          </div>
        </article>
      </section>


      <section id="section5">
        <!-- Galeria de proyectos realizados -->
        <h2 data-lang="encabezado">Mi proceso</h2>

        <article class="art11">
              <h3></h3>
              <div>
                  <img src="<?= asset('assets/img/views/ordenador.avif') ?>" alt="Escena de vista al mar" title="Escena de vista al mar">
              </div>

              <div>
                  <img src="<?= asset('assets/img/views/haciendocodigo.avif') ?>" alt="Escena haciendo código" title="Escena haciendo código">
              </div>

              <div>
                  <img src="<?= asset('assets/img/views/figma.avif') ?>" alt="Escena de creando en Figma" title="Escena de creando en Figma">
              </div>

              <div>
                  <img src="<?= asset('assets/img/views/loft.avif') ?>" alt="Escena de ARQ Loft" title="Escena de ARQ Loft">
              </div>

              <div>
                  <img src="<?= asset('assets/img/views/japones.avif') ?>" alt="Escena de ecommerce japones" title="Escena de ecommerce japones">
              </div>

              <div>
                  <img src="<?= asset('assets/img/views/responsive.avif') ?>" alt="Escena de diseño responsive" title="Escena de diseño responsive">
              </div>

              <div>
                  <img src="<?= asset('assets/img/views/futuro.avif') ?>" alt="Escena del futuro" title="Escena del futuro">
              </div>

              <div>
                  <img src="<?= asset('assets/img/views/relax.avif') ?>" alt="Escena con pc multipantalla" title="Escena de pc con multipantalla">
              </div>

          </article>

          <article class="artSlider01" aria-label="Carrusel de mis proyectos">
            
            <div class="artSlider01__visor">
                <div class="artSlider01__pista">
                  <div class="artSlider01__slide">
                    <h3>Escuchar antes de diseñar.</h3>
                    <img src="<?= asset('assets/img/views/escuchar.avif') ?>" alt="Escena de escucha a los otros" title="Escena de escuchar">
                  </div>
                  <div class="artSlider01__slide">
                    <h3>Cada interfaz empieza con una idea.</h3>
                    <img src="<?= asset('assets/img/views/idea.avif') ?>" alt="Escena de idea en Figma" title="Figma">
                  </div>

                  <div class="artSlider01__slide">
                    <h3>Código limpio. Experiencias rápidas.</h3>
                    <img src="<?= asset('assets/img/views/code.avif') ?>" alt="Escena de código" title="Code">
                  </div>

                  <div class="artSlider01__slide">
                    <h3>Los pequeños detalles marcan la diferencia.</h3>
                    <img src="<?= asset('assets/img/views/lighthouse.avif') ?>" alt="Escena de Lighthouse" title="Lighthouse">
                  </div>

                </div>
            </div>

            <button class="artSlider01__arrow artSlider01__arrow--prev" > &lsaquo; </button>
            <button class="artSlider01__arrow artSlider01__arrow--next"> &rsaquo; </button>

          <div class="artSlider01__track">
              <div class="artSlider01__track__dot active"></div>
              <div class="artSlider01__track__dot"></div>
              <div class="artSlider01__track__dot"></div>
              <div class="artSlider01__track__dot"></div>
          </div>
        </article>

      </section>

    </main>

    <?php require app_path('includes/es/footer.php'); ?>

    <div class="focus-player" id="focusPlayer">

    <button id="focusButton">

        <div class="focus-icon">

            <img src="<?= asset('assets/img/icons/headphones.svg') ?>" alt="Focus Mode">

        </div>

        <div class="focus-info">

            <span>Focus Mode</span>

            <small>Lo-fi Coding Mix</small>

        </div>

        <div class="focus-status"></div>

    </button>

    <audio id="bgMusic" loop>
        <source src="/assets/audio/audioloft.mp3" type="audio/mpeg">
    </audio>

</div>

</body>
</html>
