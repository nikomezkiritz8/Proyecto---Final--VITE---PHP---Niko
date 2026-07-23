<!doctype html>
<html lang="<?= e($lang ?? env('LANG_DEFAULT', 'es')) ?>">
  <head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="<?= asset('assets/img/icons/favicon.svg') ?>">
    <link rel="canonical" href="<?= url('/mis-proyectos') ?>">
    <title>Proyectos | Niko Mezkiritz — Desarrollo Full Stack</title>
    <meta name="description" content="Explora los proyectos de Niko Mezkiritz: aplicaciones web, diseño, desarrollo Full Stack y soluciones digitales creadas con tecnologías modernas.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= vite_tags($route['resources'] ?? null) ?>
    <?php require app_path('includes/cookielad.php'); ?>
  </head>
  <body>
    <?php require app_path('includes/es/nav.php'); ?>

    <header class="header02">
        <img class="header02__media" src="<?= asset('assets/img/views/chicoprograma.avif') ?>" alt="Escena de Matrix">
        <div class="header02__content">
        <p class="header02__eyebrow">PROYECTOS</p>
        <h1 class="header02__title">Lo que he construido</h1>
        <p class="header02__text">Una selección de aplicaciones web y proyectos donde he aplicado HTML, CSS, JavaScript, PHP y otras tecnologías para crear soluciones funcionales y modernas.</p>
        <a href="/es/contacto" class="boton">Ponte en contacto</a>
        </div>
    </header>

    <main>

      <section>
        <!-- Presentación de mi portfolio -->


        <!-- Art14 -->
        <article class="art14">
          <div class="content">
            <h2>Portfolio Personal</h2>
            <span>HTML · SCSS · PHP · Vite · JavaScript</span>
            <p>Mi carta de presentación digital. Diseñada para demostrar que la accesibilidad, el rendimiento impecable y el diseño interactivo pueden convivir en armonía.</p>
            <p>Mi portfolio personal nace con un objetivo muy claro: crear una plataforma que represente mi perfil como desarrollador web junior y que, al mismo tiempo, sirva como escaparate de mis conocimientos técnicos y mi forma de trabajar. Más allá de mostrar proyectos, esta web está diseñada para transmitir profesionalidad, organización y atención al detalle desde el primer momento.</p>
            <p>El desarrollo comenzó con una fase de planificación en la que definí la arquitectura del sitio, la experiencia de usuario y la identidad visual. Quería una interfaz moderna, limpia y fácil de navegar, donde cada sección tuviera un propósito claro y facilitara el acceso a la información más importante.</p>
            <p>A nivel técnico, el proyecto ha sido desarrollado utilizando HTML semántico para mejorar la accesibilidad y el posicionamiento SEO, SCSS para crear una hoja de estilos modular y fácilmente mantenible, PHP para gestionar funcionalidades dinámicas como el formulario de contacto y Vite como herramienta de desarrollo para optimizar la compilación y mejorar el rendimiento durante el desarrollo.</p>
            <p>Uno de los aspectos que más importancia recibió fue el diseño responsive. Toda la interfaz se adapta correctamente a ordenadores, tablets y dispositivos móviles, garantizando una experiencia consistente independientemente del tamaño de pantalla.</p>
            <p>Durante el desarrollo también trabajé aspectos relacionados con la optimización del rendimiento, minimizando recursos, organizando correctamente el código y aplicando una estructura escalable que permita seguir ampliando el proyecto en el futuro.</p>

            <h3>OBJETIVOS ALCANZADOS</h3>
            
            <ul>
              <li>Crear una identidad digital profesional</li>
              <li>Demostrar conocimientos de desarrollo Front-End</li>
              <li>Aplicar buenas prácticas de estructura y organización del código</li>
              <li>Desarrollar una web completamente responsive</li>
              <li>Mejorar la experiencia del usuario mediante una navegación intuitiva</li>
              <li>Disponer de un proyecto real que pueda evolucionar continuamente con nuevas funcionalidades y proyectos</li>
            </ul>
            <img src="<?= asset('assets/img/views/otrohero.avif') ?>" alt="portfolio" title ="portfolio">
            <div class="contenedor-botones">
              <a href="/es/mis-proyectos" class="boton">Ver proyecto</a>
              <a href="/es/mis-proyectos" class="boton">Código</a>
              <a href="/es/mis-proyectos" class="boton">Caso de estudio</a>
            </div>
            
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
            <p>ARQ Studio es una página web conceptual diseñada para un estudio de arquitectura contemporánea. El proyecto busca transmitir elegancia, minimalismo y exclusividad mediante un diseño limpio donde la arquitectura es la auténtica protagonista.</p>
            <p>Desde el inicio, el objetivo fue construir una experiencia visual muy cuidada, utilizando grandes imágenes, amplios espacios en blanco y una paleta cromática neutra que reforzara la sensación de calidad y sofisticación.</p>
            <p>La estructura de la página está orientada a presentar los servicios del estudio, mostrar proyectos realizados y facilitar el contacto con posibles clientes. Cada sección ha sido diseñada para que la información sea clara y fácilmente accesible, priorizando siempre la legibilidad y la experiencia del usuario.</p>
            <p>Uno de los principales retos del proyecto fue conseguir una composición visual equilibrada utilizando únicamente HTML y CSS, prestando especial atención al posicionamiento de los elementos, la jerarquía visual y la adaptación responsive.</p>
            <p>Este proyecto me permitió profundizar en conceptos relacionados con Flexbox, CSS Grid, diseño adaptable y organización del código CSS, aprendiendo a construir interfaces limpias y escalables.</p>


            <h3>ASPECTOS DESTACADOS</h3>
            
            <ul>
              <li>Diseño minimalista inspirado en estudios de arquitectura modernos</li>
              <li>Uso intensivo de imágenes de gran formato</li>
              <li>Maquetación completamente responsive</li>
              <li>Código organizado y fácilmente mantenible</li>
              <li>Experiencia de navegación elegante y fluida</li>
            </ul>
            <img src="<?= asset('assets/img/views/casahorizonte.avif') ?>" alt="página de arquitectura" title ="página de arquitectura" >
            <div class="contenedor-botones">

              <a href="/es/mis-proyectos" class="boton">Ver proyecto</a>
              <a href="/es/mis-proyectos" class="boton">Código</a>
              <a href="/es/mis-proyectos" class="boton">Caso de estudio</a>
            </div>

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
            <p>KOKORO es un proyecto de comercio electrónico inspirado en la estética japonesa, creado con el objetivo de ofrecer una experiencia de compra sencilla, elegante y centrada en el producto.</p>
            <p>La idea principal consistía en construir una tienda online donde el diseño transmitiera los valores asociados a la cultura japonesa: equilibrio, sencillez, armonía y atención al detalle. Para ello se eligió una estética minimalista con colores suaves, tipografías limpias y una distribución que permite que cada producto destaque por sí mismo.</p>
            <p>El proyecto fue desarrollado utilizando WordPress como gestor de contenidos, aprovechando su flexibilidad para gestionar productos, categorías y contenido dinámico de forma sencilla.</p>
            <p>Además del diseño visual, se trabajó especialmente la experiencia del usuario durante el proceso de compra, organizando la navegación para que el cliente pudiera localizar rápidamente los productos, consultar la información necesaria y completar la compra con el menor número posible de pasos.</p>
            <p>También se prestó atención al diseño responsive, garantizando una experiencia cómoda tanto desde ordenador como desde dispositivos móviles.</p>

            <h3>CARACTERISTICAS PRINCIPALES</h3>
            

            <ul>
              <li>Diseño inspirado en la filosofía japonesa.</li>
              <li>Navegación sencilla e intuitiva.</li>       
              <li>Catálogo organizado por categorías.</li>
              <li>Fichas de producto claras y visuales.</li>
              <li>Interfaz responsive.</li>
              <li>Enfoque centrado en la experiencia de compra.</li>
            </ul>

            <img src="<?= asset('assets/img/views/japo.avif') ?>" alt="ecommerce japones" title ="ecommerce japones">
            <div class="contenedor-botones">
              <a href="/es/mis-proyectos" class="boton">Ver proyecto</a>
              <a href="/es/mis-proyectos" class="boton">Código</a>
              <a href="/es/mis-proyectos" class="boton">Caso de estudio</a>
            </div>
            
          </div>
        </article>
      </section>


      <section id="section5">
        <!-- Galeria de proyectos realizados -->
        <h2 data-lang="encabezado">MI PROCESO DE TRABAJO</h2>
        <p>Cada proyecto que desarrollo sigue una metodología que me ayuda a mantener el código organizado y ofrecer soluciones bien estructuradas.</p>
        <p><strong>1. Investigación y análisis</strong></p>
        <p><strong>2. Diseño de la interfaz</strong></p>
        <p><strong>3. Desarrollo</strong></p>
        <p><strong>4. Pruebas y optimización</strong></p>
        <p><strong>5. Entrega y mejora continua</strong></p>

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

      <!-- antes estaba la sección estática de contacto -->
      <?php require app_path('includes/es/section_form.php'); ?>

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
