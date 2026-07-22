<!doctype html>
<html lang="<?= e($lang ?? env('LANG_DEFAULT', 'es')) ?>">
  <head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="<?= asset('assets/img/icons/favicon.svg') ?>">
    <link rel="canonical" href="<?= url('/') ?>">
    <title>Niko Mezkiritz | Desarrollador Full Stack y Portfolio</title>
    <meta name="description" content="Portfolio de Niko Mezkiritz, desarrollador Full Stack. Descubre mis proyectos web, habilidades, experiencia y proceso creativo.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   
    <?= vite_tags($route['resources'] ?? null) ?>
  </head>

  <style>

    /* ==========================================================
   ICONOS SVG
========================================================== */

.service-icon{
    width:72px;
    height:72px;
    display:block;
    margin:0 auto 18px;
    overflow:visible;
}

/* ==========================================================
   ICONO APRENDIZAJE (NODOS)
========================================================== */

.line{
    stroke:#111;
    stroke-width:3;
    stroke-linecap:round;
    stroke-linejoin:round;
    fill:none;
}

.node{
    fill:#111;
    transform-origin:center;
    animation:pulse 2.2s ease-in-out infinite;
}

.n2{animation-delay:.2s;}
.n3{animation-delay:.4s;}
.n4{animation-delay:.6s;}
.n5{animation-delay:.8s;}

.flow{
    stroke-dasharray:5 4;
    animation:flow 2s linear infinite;
}

@keyframes flow{
    to{
        stroke-dashoffset:-18;
    }
}

@keyframes pulse{
    0%,100%{
        transform:scale(1);
    }
    50%{
        transform:scale(1.25);
    }
}

/* ==========================================================
   ICONO OJO
========================================================== */

.eye{
    stroke:#111;
    stroke-width:3;
    fill:none;
    stroke-linecap:round;
    stroke-linejoin:round;
}

.pupil{
    fill:#111;
    transform-origin:center;
    animation:look 4s ease-in-out infinite;
}

.eyelid{
    transform-origin:32px 32px;
    animation:blink 5s infinite;
}

@keyframes blink{

    0%,8%,100%{
        transform:scaleY(1);
    }

    10%{
        transform:scaleY(.05);
    }

    12%{
        transform:scaleY(1);
    }

    60%{
        transform:scaleY(1);
    }

    62%{
        transform:scaleY(.05);
    }

    64%{
        transform:scaleY(1);
    }
}

@keyframes look{

    0%,100%{
        transform:translateX(0);
    }

    20%{
        transform:translateX(-2px);
    }

    40%{
        transform:translateX(2px);
    }

    60%{
        transform:translateY(1px);
    }

    80%{
        transform:translateX(-1px);
    }
}

/* ==========================================================
   ICONO BLOQUE (NODOS)
========================================================== */

.block{
    fill:none;
    stroke:#111;
    stroke-width:3;
    stroke-linejoin:round;
    stroke-linecap:round;
}

.block-1{
    animation:block1 3s ease-in-out infinite;
}

.block-2{
    animation:block2 3s ease-in-out infinite;
}

.block-3{
    animation:block3 3s ease-in-out infinite;
}

@keyframes block1{
    0%,100%{
        transform:translate(0,0);
    }
    50%{
        transform:translate(-3px,-3px);
    }
}

@keyframes block2{
    0%,100%{
        transform:translate(0,0);
    }
    50%{
        transform:translate(3px,-3px);
    }
}

@keyframes block3{
    0%,100%{
        transform:translate(0,0);
    }
    50%{
        transform:translate(0,4px);
    }
}

/* ==========================================================
   ICONO ENGRANAJE (NODOS)
========================================================== */


    .gear{
    transform-origin:32px 32px;
    animation:rotate 10s linear infinite;
    }

    .outline{
    fill:none;
    stroke:#111;
    stroke-width:3;
    stroke-linecap:round;
    stroke-linejoin:round;
    }

    .center{
    fill:#111;
    animation:pulse 2.5s ease-in-out infinite;
    transform-origin:32px 32px;
    }

    @keyframes rotate{

    from{
        transform:rotate(0deg);
    }

    to{
        transform:rotate(360deg);
    }

    }

    @keyframes pulse{

    0%,100%{
        transform:scale(1);
        opacity:1;
    }

    50%{
        transform:scale(1.15);
        opacity:.75;
    }

    }


</style>


  
  <body>

    <?php require app_path('includes/es/nav.php'); ?>

    <header class="header01">
      <img class="header01__media" src="<?= asset('assets/img/views/hero-bg.avif') ?>" alt="Programando en Donosti" title="Programando en Donosti">
      <div class="header01__content">
        <p class="header01__eyebrow"></p>
        <h1>Desarrollador Web Front-End</h1>
        <p class="header01__text">Creo páginas rápidas, modernas y enfocadas en convertir visitantes en clientes.</p>
        <p class="header01__text">Especializado en HTML, CSS, JavaScript, PHP y Vite.</p>
        <a href="/es/mis-proyectos" class="boton">Ver proyectos</a>
        <a href="/es/contacto" class="boton">Contactar</a>
      </div>
    </header>

    <main>

        <section>

            <!-- Sección de Presentación sobre mí -->
            <h2>¿QUIERES CONOCERME?</h2>

            <!-- Artículo 10-->
             <!-- presentación -->
            <article class="art10">
                <h3>Desarrollador con otra forma de pensar</h3>
                <p>Me apasiona crear páginas web rápidas, accesibles y con un diseño cuidado.</p>
                
                <div class="matrix-items">
                    <div class="ficha">
                        <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 64 64"
                        class="service-icon">

                   

                    <g class="gear">

                        <!-- dientes -->

                        <rect class="outline" x="29" y="5" width="6" height="8" rx="2"/>

                        <rect class="outline"
                            x="29"
                            y="51"
                            width="6"
                            height="8"
                            rx="2"/>

                        <rect class="outline"
                            x="51"
                            y="29"
                            width="8"
                            height="6"
                            rx="2"/>

                        <rect class="outline"
                            x="5"
                            y="29"
                            width="8"
                            height="6"
                            rx="2"/>

                        <rect class="outline"
                            x="45"
                            y="11"
                            width="6"
                            height="8"
                            rx="2"
                            transform="rotate(45 48 15)"/>

                        <rect class="outline"
                            x="13"
                            y="43"
                            width="6"
                            height="8"
                            rx="2"
                            transform="rotate(45 16 47)"/>

                        <rect class="outline"
                            x="43"
                            y="45"
                            width="6"
                            height="8"
                            rx="2"
                            transform="rotate(-45 46 49)"/>

                        <rect class="outline"
                            x="11"
                            y="13"
                            width="6"
                            height="8"
                            rx="2"
                            transform="rotate(-45 14 17)"/>

                        <!-- aro -->

                        <circle
                            class="outline"
                            cx="32"
                            cy="32"
                            r="16"/>

                        <!-- interior -->

                        <circle
                            class="outline"
                            cx="32"
                            cy="32"
                            r="8"/>

                    </g>

                    <circle
                        class="center"
                        cx="32"
                        cy="32"
                        r="3.5"/>

                    </svg>
                        <h4 class="sub-header">Atención al detalle</h4>
                        <p>Detecto inconsistencias visuales, errores de accesibilidad y bugs que otros pasan por alto. Mi código es limpio, consistente y bien documentado.</p>
                    </div>
                    <div class="ficha">
                        <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 64 64"
                        class="service-icon">


                    <!-- Bloque superior izquierdo -->
                    <rect
                        class="block block-1"
                        x="16"
                        y="14"
                        width="14"
                        height="14"
                        rx="2"/>

                    <!-- Bloque superior derecho -->
                    <rect
                        class="block block-2"
                        x="34"
                        y="14"
                        width="14"
                        height="14"
                        rx="2"/>

                    <!-- Bloque inferior -->
                    <rect
                        class="block block-3"
                        x="25"
                        y="34"
                        width="14"
                        height="14"
                        rx="2"/>

                    </svg>
                        <h4 class="sub-header">Pensamiento lógico</h4>
                        <p>Descomponer problemas complejos en partes más pequeñas es mi forma natural de pensar. Disfruto depurando y optimizando.</p>
                    </div>
                    <div class="ficha">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 64 64"
                            class="service-icon">

                        
                        <g class="eyelid">

                            <!-- contorno -->viewBox="0 0 64 64"
                            class="service-icon">

                        

                        <g class="eyelid">

                            <!-- contorno -->
                            <path class="eye"
                                d="M8 32
                                C14 22 23 16 32 16
                                C41 16 50 22 56 32
                                C50 42 41 48 32 48
                                C23 48 14 42 8 32Z"/>

                            <!-- iris -->
                            <circle class="eye" cx="32" cy="32" r="8"/>

                            <!-- pupila -->
                            <circle class="pupil" cx="32" cy="32" r="3.2"/>

                        </g>

                        </svg>
                            <path class="eye"
                                d="M8 32
                                C14 22 23 16 32 16
                                C41 16 50 22 56 32
                                C50 42 41 48 32 48
                                C23 48 14 42 8 32Z"/>

                            <!-- iris -->
                            <circle class="eye" cx="32" cy="32" r="8"/>

                            <!-- pupila -->
                            <circle class="pupil" cx="32" cy="32" r="3.2"/>

                        </g>

                        </svg>
                        <h4 class="sub-header">Enfoque profundo</h4>
                        <p>Cuando estoy programando, entro en hiperconcentración. Puedo trabajar durante horas manteniendo altos niveles de calidad.</p>
                    </div>
                    <div class="ficha">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 64 64"
                            class="service-icon">

                        

                        <!-- conexiones -->
                        <g class="line flow">
                            <line x1="32" y1="12" x2="32" y2="24"/>
                            <line x1="32" y1="24" x2="20" y2="36"/>
                            <line x1="32" y1="24" x2="44" y2="36"/>
                            <line x1="20" y1="36" x2="32" y2="48"/>
                            <line x1="44" y1="36" x2="32" y2="48"/>
                        </g>

                        <!-- nodos -->
                        <circle class="node" cx="32" cy="10" r="3.5"/>
                        <circle class="node n2" cx="32" cy="24" r="3.5"/>
                        <circle class="node n3" cx="20" cy="36" r="3.5"/>
                        <circle class="node n4" cx="44" cy="36" r="3.5"/>
                        <circle class="node n5" cx="32" cy="50" r="3.5"/>

                        </svg>

                        <h4 class="sub-header">Aprendizaje estructurado</h4>
                        <p>Sigo rutinas de aprendizaje metódicas. Documento todo lo que aprendo y construyo desde los fundamentos hacia arriba.</p>
                    </div>
                    
                </div>
            </article>

            <!-- Artículo 9-->
             <!-- tecnologías que conozco -->
            <article class="art09">

                <h3>Tecnologías que utilizo habitualmente y aquellas en las que sigo creciendo.</h3>

                <div class="art09-content">

                    <div class="skills">

                        <h4>Full Stack</h4>

                        <div class="skills-list">

                            <span>HTML</span>
                            <span>SCSS</span>
                            <span>CSS</span>
                            <span>PHP</span>
                            <span>Vite</span>
                            <span>Git</span>

                        </div>

                    </div>


                    <div class="skills">

                        <h4>En aprendizaje</h4>

                        <div class="skills-list">

                            <span>React</span>
                            <span>JavaScript</span>
                            <span>Figma</span>
                            <span>GitHub</span>

                        </div>

                    </div>

            </article>


            <!-- artículpo 06 -->
            <!-- Qué me gustaría hacer -->
            <article class="art06">
                <div>
                    <h3>¿QUE ME GUSTARIA HACER?</h3>
                    <p>Busco integrarme en proyectos desafiantes donde pueda aportar mi iniciativa y seguir evolucionando como desarrollador. Mi meta es diseñar soluciones digitales que no solo funcionen a la perfección, sino que también dejen huella.</p>

                    <p>Formar parte de equipos dinámicos donde el aprendizaje mutuo, la comunicación y el código limpio sean la prioridad.</p>
                    <p>Especializarme en tecnologías modernas (como profundizar en frameworks de Frontend o explorar la integración de IA) para crear interfaces más rápidas e intuitivas.</p>
                    <p>Afrontar retos reales, ayudando a traducir ideas complejas en experiencias web accesibles y atractivas para cualquier usuario.</p>
                    <a href="/es/contacto" title="" class="boton">¿Hablamos?</a>
                </div>     
            </article>
        


        </section>

        <section>
            <h2>MIS PROYECTOS</h2>

            <!-- Artículo 13-->
            <article class="art13">
                <img
                    alt="Ordenador vistas a Donosti" 
                    title="Ordenador vistas a Donosti"
                    srcset="
                    <?= asset('assets/img/views/portfolio.avif') ?> 1800w,
                    <?= asset('assets/img/views/portfolio.avif') ?> 1200w
                    "
                    sizes="
                    (max-width:800px) 900px,
                    1500px
                    "
                    src="<?= asset('assets/img/views/portfolio.avif') ?>"          
                >
                <div>
                    <h3>Portfolio personal</h3>
                    <p>Mi carta de presentación digital. Diseñada para demostrar que la accesibilidad, el rendimiento impecable y el diseño interactivo pueden convivir en armonía.</p>
                    <p>Tech: HTML, SCSS, PHP, Vite</p>
                    <a href="/es/mis-proyectos" class="boton">Ver proyecto</a> 
                    
                </div>
            </article>

            <!-- Artículo 13 invertido -->
            <article class="art13 upsidedown">
                <img
                    alt="Casa a fueras de Donosti" 
                    title="Casa a fueras de Donosti"
                    srcset="
                    <?= asset('assets/img/views/arquitectura.avif') ?> 1800w,
                    <?= asset('assets/img/views/arquitectura.avif') ?> 1200w
                    "
                    sizes="
                    (max-width:800px) 900px,
                    1500px
                    "
                    src="<?= asset('assets/img/views/arquitectura.avif') ?>"          
                >
                <div>
                    <h3>Landing page de arquitectura</h3>
                    <p>Concepto visual y funcional para un estudio de arquitectura contemporáneo de Donostia. Inspirado en líneas rectas, orden estructural y elegancia monocromática.</p>
                    <p>Tech: HTML, CSS</p>
                    <a href="/es/mis-proyectos" class="boton">Ver Proyecto</a>
                </div>
            </article>

            <!-- Artículo 13 -->
            <article class="art13">
                <img
                    alt="Chica japonesa sirviendose té" 
                    title="Chica japonesa sirviendose té"
                    srcset="
                    <?= asset('assets/img/views/chicajapo.avif') ?> 1800w,
                    <?= asset('assets/img/views/chicajapo.avif') ?> 1200w
                    "
                    sizes="
                    (max-width:800px) 900px,
                    1500px
                    "
                    src="<?= asset('assets/img/views/chicajapo.avif') ?>"          
                >
                <div>
                    <h3>Ecommerce de una tienda japónesa</h3>
                    <p>Demostración de una boutique online dedicada a la importación de té e inciensos de KOKORO. Combina sobriedad minimalista y dinamismo comercial.</p>
                    <p>Tech: WordPress</p>
                    <a href="/es/mis-proyectos" class="boton">Ver proyecto</a>
                </div>
            </article>

            <!-- Artículo 13 invertido -->
            <article class="art13 upsidedown">
                <img
                    alt="Tecnología flotando en el aire" 
                    title="Tecnología flotando en el aire"
                    srcset="
                    <?= asset('assets/img/views/tuempresa.avif') ?> 1800w,
                    <?= asset('assets/img/views/tuempresa.avif') ?> 1200w
                    "

                    sizes="
                    (max-width:800px) 900px,
                    1500px
                    "

                    src="<?= asset('assets/img/views/tuempresa.avif') ?>"          
                >
                <div>
                    <h3>¿La web de tu empresa?</h3>
                    <p>¿Tienes un proyecto en mente? Me encanta adaptarme a nuevas necesidades. Desde landing pages hasta sitios corporativos, puedo ayudarte a construir tu presencia digital.</p>
                    <p>Tech: A medida</p>
                    <a href="/es/contacto" class="boton">Contactar</a>
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

                <img src="<?= asset('assets/img/icons/headphones.svg') ?>" alt="Focus Mode" title="Focus Mode">

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
