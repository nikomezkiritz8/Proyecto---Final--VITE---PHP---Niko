<!doctype html>
<html lang="<?= e($lang ?? env('LANG_DEFAULT', 'es')) ?>">
  <head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="<?= asset('assets/img/icons/favicon.svg') ?>">
    <link rel="canonical" href="<?= url('/') ?>">
    <title>Niko Mezkiritz | Garatzaile Full Stack-a eta Portfolioa</title>
    <meta name="description" content="Niko Mezkiritzen portfolioa, Full Stack garatzailea. Ezagutu nire web proiektuak, gaitasunak, esperientzia eta sormen-prozesua.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= vite_tags($route['resources'] ?? null) ?>
    <?php require app_path('includes/cookielad.php'); ?>
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
    <?php require app_path('includes/eu/nav.php'); ?>

    <header class="header01">
      <img class="header01__media" src="<?= asset('assets/img/views/hero-bg.avif') ?>" alt="Donostian programatzen" title=" Donostian programatzen">
      <div class="header01__content">
        <p class="header01__eyebrow"></p>
        <h1>Front-End web garatzailea</h1>
        <p class="header01__text">Webgune azkarrak eta modernoak sortzen ditut, bisitariak bezero bihurtzera bideratuta.</p>
        <p class="header01__text">HTML, CSS, JavaScript, PHP eta Vite teknologietan espezializatua.</p>
        <a href="/eu/nere-proiektuak" class="boton">Ikusi proiektuak</a>
        <a href="/eu/kontaktua" class="boton">Kontaktatu</a>
      </div>
    </header>

    <main>

        <section>

            <!-- Sección de Presentación sobre mí -->
            <h2>EZAGUTU NAHI AL NAUZU?</h2>

            <!-- Artículo 10-->
             <!-- presentación -->
            <article class="art10">
                <h3>Ikuspegi desberdina duen garatzailea</h3>
                <p>Webgune azkarrak eta irisgarriak sortzea gustuko dut, diseinu zainduarekin eta erabiltzaile-esperientzia bikainarekin.</p>
                
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
                        <h4 class="sub-header">Xehetasunekiko arreta</h4>
                        <p>Besteek ikusten ez dituzten ikusizko desorekak, irisgarritasun-arazoak eta bug-ak identifikatzeko gai naiz. Nire kodea garbia, koherentea eta behar bezala dokumentatua da.</p>
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
                        <h4 class="sub-header">Pentsamendu logikoa</h4>
                        <p>Arazo konplexuak zati txikiagoetan banatzea nire pentsatzeko modu naturala da. Kodea araztea eta optimizatzea gustuko dut.</p>
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
                        <h4 class="sub-header">Kontzentrazio sakona</h4>
                        <p>Programatzen ari naizenean, kontzentrazio-maila handia lortzen dut. Ordu asko eman ditzaket lanean, kalitate-maila altua eta arreta mantenduz.</p>
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

                        <h4 class="sub-header">Ikaskuntza egituratua</h4>
                        <p>Ikaskuntza-prozesu metodikoak jarraitzen ditut. Ikasten dudan eta sortzen dudan guztia dokumentatzen dut, oinarrietatik abiatuta ezagutza sendoak eraikiz.</p>
                    </div>
                    
                </div>
            </article>

            <!-- Artículo 9-->
             <!-- tecnologías que conozco -->
            <article class="art09">

                <h3>Maiz erabiltzen ditudan teknologiak eta hobetzen jarraitzen dudan horiek.</h3>

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

                        <h4>Ikasten</h4>

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
                    <h3>ZER GUSTATUKO LITZAIDAKE EGITEA?</h3>
                    <p>Erronka handiko proiektuetan parte hartu nahi dut, nire ekimena eta gaitasunak eskainiz, garatzaile gisa etengabe eboluzionatzen jarraitzeko. Nire helburua behar bezala funtzionatzen duten eta aldi berean aztarna uzten duten irtenbide digitalak diseinatzea da.</p>

                    <p>Ikaskuntza kolektiboa, komunikazioa eta kode garbia lehenesten dituzten talde dinamikoetako kide izatea.</p>
                    <p>Teknologia modernoetan espezializatzea (hala nola Frontend frameworketan sakontzea edo AIaren integrazioa esploratzea), interfaze azkarragoak eta intuitiboagoak sortzeko.</p>
                    <p>Benetako erronkei aurre egitea, ideia konplexuak edozein erabiltzailerentzat eskuragarri eta erakargarri izango diren web esperientziatara eramaten lagunduz.</p>
                    <a href="/eu/kontaktua" title="" class="boton">Hitz egiten dugu?</a>
                </div>     
            </article>
        


        </section>

        <section>
            <h2>NERE PROIEKTUAK</h2>

            <!-- Artículo 13-->
            <article class="art13">
                <img
                    alt="Donostiako bistak" 
                    title="Donostiako bistak"
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
                    <h3>Portfolio pertsonala</h3>
                    <p>Nire aurkezpen-gutun digitala. Irisgarritasuna, errendimendu akasgabea eta diseinu interaktiboa harmonian bizi daitezkeela frogatzeko diseinatua.</p>
                    <p>Tech: HTML, SCSS, PHP, Vite</p>
                    <a href="/eu/nere-proiektuak" class="boton">Ikusi proiektua</a> 
                    
                </div>
            </article>

            <!-- Artículo 13 invertido -->
            <article class="art13 upsidedown">
                <img
                    alt="Donostiko kanpoko etxea" 
                    title="Donostiko kanpoko etxea"
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
                    <h3>Arkitektura lan baten landing page-a</h3>
                    <p>Donostiako arkitektura-estudio garaikide baterako kontzeptu bisual eta funtzionala. Lerro zuzenetan, egitura-ordenan eta dotoretasun monokromatikoan inspiratua.</p>
                    <p>Tech: HTML, CSS</p>
                    <a href="/eu/nere-proiektuak" class="boton">Ikusi proiektua</a>
                </div>
            </article>

            <!-- Artículo 13 -->
            <article class="art13">
                <img
                    alt="japoniako neska tea hartzen" 
                    title="japoniako neska tea hartzen"
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
                    <h3>Denda japoniar baten online denda</h3>
                    <p>KOKOROko tea eta intsentsua inportatzen dituen lineako boutique baten erakustaldia. Soiltasun minimalista eta dinamismo komertziala uztartzen ditu.</p>
                    <p>Tech: WordPress</p>
                    <a href="/eu/nere-proiektuak" class="boton">Ikusi proiektua</a>
                </div>
            </article>

            <!-- Artículo 13 invertido -->
            <article class="art13 upsidedown">
                <img
                    alt="teknologia airean" 
                    title="teknologia airean"
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
                    <h3>Zure enpresaren webgunea?</h3>
                    <p>Proiekturen bat duzu buruan? Oso gogoko dut behar berrietara egokitzea. Landing page-etatik hasi eta gune korporatiboetaraino, zure presentzia digitala eraikitzen lagun zaitzaket.</p>
                    <p>Tech: A medida</p>
                    <a href="/eu/kontaktua" class="boton">Kontaktatu</a>
                </div>
            </article>

        </section>

        <!-- antes estaba la sección estática de contacto -->
        <?php require app_path('includes/eu/section_form.php'); ?>

    <?php require app_path('includes/eu/footer.php'); ?>

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
