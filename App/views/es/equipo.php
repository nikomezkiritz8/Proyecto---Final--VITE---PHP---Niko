<!doctype html>
<html lang="<?= e($lang ?? env('LANG_DEFAULT', 'es')) ?>">
  <head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="<?= asset('favicon.svg') ?>">
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
            <h2>PORTFOLIO PERSONAL</h2>
            <p>Mi carta de presentación digital. Diseñada para demostrar que la accesibilidad, el rendimiento impecable y el diseño interactivo pueden convivir en armonía.</p>
            <img src="<?= asset('assets/img/views/otrohero.avif') ?>" alt="portfolio" title ="portfolio">
          </div>
        </article>
        
      </section>

      <section>
        <!-- Presentación de mi landing page de arquitectura  -->

        <!-- Art14 -->
        <article class="art14">
          <div class="content">
            <h2>PAGINA WEB DE ARQ</h2>
            <p>Concepto visual y funcional para un estudio de arquitectura contemporáneo de Donostia. Inspirado en líneas rectas, orden estructural y elegancia monocromática.</p>
            <img src="<?= asset('assets/img/views/casahorizonte.avif') ?>" alt="página de arquitectura" title ="página de arquitectura" >
          </div>
        </article>
      </section>

      <section>
        <!-- Presentación de mi Ecommerce japonésa -->

        <!-- Art14 -->
        <article class="art14">
          <div class="content">
            <h2>ECOMMERCE JAPONES</h2>
            <p>Demostración de una boutique online dedicada a la importación de tés e inciensos de KOKORO. Combina sobriedad minimalista y dinamismo comercial.</p>
            <img src="<?= asset('assets/img/views/japo.avif') ?>" alt="ecommerce japones" title ="ecommerce japones">
          </div>
        </article>
      </section>


      <section id="section5">
        <!-- Galeria de proyectos realizados -->
        <h2 data-lang="encabezado">GALERIA</h2>

        <article class="art11">
              <h3></h3>
              <div>
                  <img src="<?= asset('assets/img/test/dummy01.avif') ?>" alt="Escena de Matrix">
              </div>

              <div>
                  <img src="<?= asset('assets/img/test/dummy02.avif') ?>" alt="Escena de Matrix">
              </div>

              <div>
                  <img src="<?= asset('assets/img/test/dummy03.avif') ?>" alt="Escena de Matrix">
              </div>

              <div>
                  <img src="<?= asset('assets/img/test/dummy04.avif') ?>" alt="Escena de Matrix">
              </div>

              <div>
                  <img src="<?= asset('assets/img/test/dummy01.avif') ?>" alt="Escena de Matrix">
              </div>

              <div>
                  <img src="<?= asset('assets/img/test/dummy02.avif') ?>" alt="Escena de Matrix">
              </div>

              <div>
                  <img src="<?= asset('assets/img/test/dummy03.avif') ?>" alt="Escena de Matrix">
              </div>

              <div>
                  <img src="<?= asset('assets/img/test/dummy04.avif') ?>" alt="Escena de Matrix">
              </div>

          </article>
        
          <article class="artSlider01" aria-label="Carrusel de mis proyectos">
            
            <div class="artSlider01__visor">
                <div class="artSlider01__pista">
                  <div class="artSlider01__slide">
                    <h3>Matrix ipsum 01</h3>
                    <img src="<?= asset('assets/img/test/dummy01.avif') ?>" alt="Escena de Matrix">
                  </div>
                  <div class="artSlider01__slide">
                    <h3>Matrix ipsum 02</h3>
                    <img src="<?= asset('assets/img/test/dummy03.avif') ?>" alt="Escena de Matrix">
                  </div>

                  <div class="artSlider01__slide">
                    <h3>Matrix ipsum 03</h3>
                    <img src="<?= asset('assets/img/test/dummy04.avif') ?>" alt="Escena de Matrix">
                  </div>
                </div>
            </div>

            <button class="artSlider01__arrow artSlider01__arrow--prev" > &lsaquo; </button>
            <button class="artSlider01__arrow artSlider01__arrow--next"> &rsaquo; </button>

          <div class="artSlider01__track">
              <div class="artSlider01__track__dot active"></div>
              <div class="artSlider01__track__dot"></div>
              <div class="artSlider01__track__dot"></div>
          </div>
        </article>

      </section>

    </main>

    <?php require app_path('includes/es/footer.php'); ?>
</body>
</html>
