<!doctype html>
<html lang="<?= e($lang ?? env('LANG_DEFAULT', 'es')) ?>">
  <head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="<?= asset('favicon.svg') ?>">
    <link rel="canonical" href="<?= url('/') ?>">
    <title>Mi portfolio</title>
    <meta name="description" content="Portfolio echo por mi.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= vite_tags($route['resources'] ?? null) ?>
  </head>
  <body>

    <?php require app_path('includes/es/nav.php'); ?>

    <header class="header01">
      <img class="header01__media" src="<?= asset('assets/img/views/hero-bg.avif') ?>" alt="Escena de Matrix">
      <div class="header01__content">
        <p class="header01__eyebrow"></p>
        <h1>Hola, soy Niko</h1>
        <p class="header01__text">Desarrollador Web Junior en Donostia-San Sebastián.</p>
        <p class="header01__text">Atención al detalle · Código limpio · Pensamiento analítico</p>
        <a href="#showroom-recursos" class="boton">Ver proyectos</a>
      </div>
    </header>

    <main>

        <section>

            <!-- Sección de Presentación sobre mí -->
            <h2>¿quieres conocerme? </h2>

            <!-- Artículo 10-->
             <!-- presentación -->
            <article class="art10">
                <h3>Desarrollador con otra forma de pensar</h3>
                <p>Soy un desarrollador web junior apasionado por crear interfaces limpias, accesibles y bien estructuradas. Vivo en Donostia y estudio desarrollo web. Tengo síndrome de Asperger, lo que me da una forma de pensar muy analítica, gran atención al detalle y un enfoque metódico para resolver problemas — cualidades que aplico cada día al programar.</p>
                
                <div class="matrix-items">
                    <div class="ficha">
                        <img src="<?= asset('assets/img/icons/home-solid.svg') ?>" alt="" title="">
                        <h4 class="sub-header">Atención al detalle</h4>
                        <p>Detecto inconsistencias visuales, errores de accesibilidad y bugs que otros pasan por alto. Mi código es limpio, consistente y bien documentado.</p>
                    </div>
                    <div class="ficha">
                        <img src="<?= asset('assets/img/icons/garages.svg') ?>" alt="" title="">
                        <h4 class="sub-header">Pensamiento lógico</h4>
                        <p>Descomponer problemas complejos en partes más pequeñas es mi forma natural de pensar. Disfruto depurando y optimizando.</p>
                    </div>
                    <div class="ficha">
                        <img src="<?= asset('assets/img/icons/furniture.svg') ?>" alt="" title="">
                        <h4 class="sub-header">Enfoque profundo</h4>
                        <p>Cuando estoy programando, entro en hiperconcentración. Puedo trabajar durante horas manteniendo altos niveles de calidad.</p>
                    </div>
                    <div class="ficha">
                        <img src="<?= asset('assets/img/icons/paint-tool.svg') ?>" alt="" title="">
                        <h4 class="sub-header">Aprendizaje estructurado</h4>
                        <p>Sigo rutinas de aprendizaje metódicas. Documento todo lo que aprendo y construyo desde los fundamentos hacia arriba.</p>
                    </div>
                    
                </div>
            </article>

            <!-- Artículo 9-->
             <!-- tecnologías que conozco -->
            <article class="art09">

                <h3>Nivel autoevaluado con honestidad. Prefiero mostrar lo que sé hacer bien que inflar números.</h3>

                <div class="art09-content">

                    <div class="contenedor-lista">
                    <h4>Full Stack</h4>
                    <ul>
                        <li>
                        <img src="<?= asset('assets/img/icons/checkmark-circle.svg') ?>" alt="" title="">
                        <span>HTML5</span>
                        </li>
                        <li>
                        <img src="<?= asset('assets/img/icons/checkmark-circle.svg') ?>" alt="" title="">
                        <span>CSS3</span>
                        </li>
                        <li>
                        <img src="<?= asset('assets/img/icons/checkmark-circle.svg') ?>" alt="" title="">
                        <span>SCSS</span>
                        </li>
                        <li>
                        <img src="<?= asset('assets/img/icons/checkmark-circle.svg') ?>" alt="" title="">
                        <span>PHP</span>
                        </li>
                        <li>
                        <img src="<?= asset('assets/img/icons/checkmark-circle.svg') ?>" alt="" title="">
                        <span>VITE</span>
                        </li>
                    </ul>
                    </div>

                    <div class="contenedor-lista">
                    <h4>Aprendiendo</h4>
                    <ul>
                        <li>
                        <img src="<?= asset('assets/img/icons/checkmark-circle.svg') ?>" alt="" title="">
                        <span>JavaScript</span>
                        </li>
                        <li>
                        <img src="<?= asset('assets/img/icons/checkmark-circle.svg') ?>" alt="" title="">
                        <span>React</span>
                        </li>
                        <li>
                        <img src="<?= asset('assets/img/icons/checkmark-circle.svg') ?>" alt="" title="">
                        <span>Git & Github</span>
                        </li>
                        <li>
                        <img src="<?= asset('assets/img/icons/checkmark-circle.svg') ?>" alt="" title="">
                        <span>Figma</span>
                        </li>
                        <li>
                        <img src="<?= asset('assets/img/icons/checkmark-circle.svg') ?>" alt="" title="">
                        <span>VS code</span>
                        </li>
                    </ul>
                    </div>

                    

                </div>

            </article>


            <!-- artículpo 06 -->
            <!-- Qué me gustaría hacer -->
            <article class="art06">
                <div>
                    <h3>Qué me gustaría hacer</h3>
                    <p>Matrix ipsum dolor sit amet, consectetur adipisicing elit. Agent Smith erroribus reiciendis, Zion libertatem defendit dum machinae mundum regunt.</p>
                    <a href="#" title="" class="boton">CTA</a>
                </div>     
            </article>
        


        </section>

        <section>
            <h2>Mis proyectos</h2>

            <!-- Artículo 13-->
            <article class="art13">
                <img
                    alt="" 
                    title=""
                    srcset="
                    <?= asset('assets/img/test/dummy_1800.avif') ?> 1800w,
                    <?= asset('assets/img/test/dummy_1200.avif') ?> 1200w
                    "
                    sizes="
                    (max-width:800px) 900px,
                    1500px
                    "
                    src="<?= asset('assets/img/test/dummy_1200.avif') ?>"          
                >
                <div>
                    <h3>Portfolio personal</h3>
                    <p>Matrix ipsum dolor sit amet, consectetur adipisicing elit. Neo eligendi veritatis codicem et simulacrum. Morpheus quaerat optionem, pillula rubra aperiam systema et realitatem.</p>
                    <p>Matrix ipsum dolor sit amet, consectetur adipisicing elit. Agent Smith erroribus reiciendis et Zion libertatem defendit.</p>
                    <a href="#" class="boton">CTA</a>
                </div>
            </article>

            <!-- Artículo 13 invertido -->
            <article class="art13 upsidedown">
                <img
                    alt="" 
                    title=""
                    srcset="
                    <?= asset('assets/img/test/dummy_1800.avif') ?> 1800w,
                    <?= asset('assets/img/test/dummy_1200.avif') ?> 1200w
                    "
                    sizes="
                    (max-width:800px) 900px,
                    1500px
                    "
                    src="<?= asset('assets/img/test/dummy_1200.avif') ?>"          
                >
                <div>
                    <h3>Landing page de arquitectura</h3>
                    <p>Matrix ipsum dolor sit amet, consectetur adipisicing elit. Morpheus quaerat optionem, pillula rubra aperiam systema et realitatem.</p>
                    <p>Matrix ipsum dolor sit amet, consectetur adipisicing elit. Neo eligendi veritatis codicem et simulacrum.</p>
                    <a href="#" class="boton">CTA</a>
                </div>
            </article>

            <!-- Artículo 13 -->
            <article class="art13">
                <img
                    alt="" 
                    title=""
                    srcset="
                    <?= asset('assets/img/test/dummy_1800.avif') ?> 1800w,
                    <?= asset('assets/img/test/dummy_1200.avif') ?> 1200w
                    "
                    sizes="
                    (max-width:800px) 900px,
                    1500px
                    "
                    src="<?= asset('assets/img/test/dummy_1200.avif') ?>"          
                >
                <div>
                    <h3>Eccomerce de una tienda japónesa</h3>
                    <p>Matrix ipsum dolor sit amet, consectetur adipisicing elit. Zion libertatem defendit dum machinae mundum regunt.</p>
                    <p>Matrix ipsum dolor sit amet, consectetur adipisicing elit. Agent Smith erroribus reiciendis et systema simulacrum celat.</p>
                    <a href="#" class="boton">CTA</a>
                </div>
            </article>

            <!-- Artículo 13 invertido -->
            <article class="art13 upsidedown">
                <img
                    alt="" 
                    title=""
                    srcset="
                    <?= asset('assets/img/test/dummy_1800.avif') ?> 1800w,
                    <?= asset('assets/img/test/dummy_1200.avif') ?> 1200w
                    "
                    sizes="
                    (max-width:800px) 900px,
                    1500px
                    "
                    src="<?= asset('assets/img/test/dummy_1200.avif') ?>"          
                >
                <div>
                    <h3>¿La web de tu empresa?</h3>
                    <p>Matrix ipsum dolor sit amet, consectetur adipisicing elit. Morpheus quaerat optionem, pillula rubra aperiam systema et realitatem.</p>
                    <p>Matrix ipsum dolor sit amet, consectetur adipisicing elit. Neo eligendi veritatis codicem et simulacrum.</p>
                    <a href="#" class="boton">CTA</a>
                </div>
            </article>

        </section>

        <section>
            <!-- artForm02 ajax -->
            <article class="artForm02">          

                <h2>Contacta con nosotros</h2>
                <div>
                    <div class="contenedor-form">
                    
                    <img src="<?= asset('assets/img/icons/mail-solid.svg') ?>" alt="">
                                    

                    <!-- MODAL QUE SALE CUANDO SE ENVÍA EL FORM CON ÉXITO -->
                    <div id="modal_envio">
                        <!-- nuestro modal con html y css -->
                        <h3 id="h3_modal_envio">Matrix ipsum modal</h3>
                        <p id="p_modal_envio">Matrix ipsum dolor sit amet, consectetur adipisicing elit. Neo eligendi veritatis codicem et simulacrum.</p>
                        <div class="boton" id="boton_modal_envio">Escribir otra consulta</div>
                    </div>

                    <form id="idForAjax" action="/app/artForm02" method="post">
                        
                        <p class="error" id="errorForm02"></p>

                        <!-- nombre -->
                        <label for="nombreAjax">Nombre *</label>
                        <input type="text" id="nombreAjax" name="nombre" placeholder="Escribe aquí tu nombre *">

                        <!-- teléfono -->
                        <label for="telefonoAjax">Teléfono *</label>
                        <input type="tel" id="telefonoAjax" name="telefono" placeholder="Escribe aquí tu teléfono *">

                        <!-- Correo -->
                        <label for="emailAjax">Correo Electrónico</label>
                        <input type="email" id="emailAjax" name="email" placeholder="Escribe aquí tu correo electrónico">

                        <!-- Mensaje -->
                        <label for="mensajeAjax">Escribe tu mensaje</label>
                        <textarea name="mensaje" id="mensajeAjax" placeholder="Escribe aquí tu mensaje"></textarea>

                        <!-- términos -->
                        <div class="horizontal">
                        <label for="terminosAjax">Aceptar términos y condiciones de privacidad</label>
                        <input type="checkbox" name="terminos" id="terminosAjax">
                        </div>
                        

                        <!-- captcha -->
                        <label for="respuesta">Resuelve</label>
                        <div class="horizontal">
                        <span id="num1ajax"></span>
                        <span id="operadorajax"></span>
                        <span id="num2ajax"></span>
                        <input type="text" name="respUser" id="respuestaajax" placeholder="Respuesta" autocomplete="off">
                        <input type="hidden" name="respSystem" id="respSystemajax" value="">
                        </div>

                        <input type="hidden" name="url" value="<?= e($url) ?>">
                        <input type="hidden" name="lang" value="<?= e($lang) ?>">

                        <input type="submit" class="boton" value="Enviar" id="botonEnviarAjax">
                    </form>
                    
                    <div class="moduloLoader01" id="moduloLoader01">
                        <!-- <svg version="1.1" id="L2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                        <circle fill="none" stroke="#000000" stroke-width="4" stroke-miterlimit="10" cx="50" cy="50" r="48"/>
                        <line fill="none" stroke-linecap="round" stroke="#000000" stroke-width="4" stroke-miterlimit="10" x1="50" y1="50" x2="85" y2="50.5">
                            <animateTransform 
                                attributeName="transform" 
                                dur="2s"
                                type="rotate"
                                from="0 50 50"
                                to="360 50 50"
                                repeatCount="indefinite" />
                        </line>
                        <line fill="none" stroke-linecap="round" stroke="#000000" stroke-width="4" stroke-miterlimit="10" x1="50" y1="50" x2="49.5" y2="74">
                            <animateTransform 
                                attributeName="transform" 
                                dur="15s"
                                type="rotate"
                                from="0 50 50"
                                to="360 50 50"
                                repeatCount="indefinite" />
                        </line>
                        </svg> -->
                        <svg version="1.1" id="L7" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                        <path fill="#000000" d="M31.6,3.5C5.9,13.6-6.6,42.7,3.5,68.4c10.1,25.7,39.2,38.3,64.9,28.1l-3.1-7.9c-21.3,8.4-45.4-2-53.8-23.3
                            c-8.4-21.3,2-45.4,23.3-53.8L31.6,3.5z">
                                <animateTransform 
                                attributeName="transform" 
                                attributeType="XML" 
                                type="rotate"
                                dur="2s" 
                                from="0 50 50"
                                to="360 50 50" 
                                repeatCount="indefinite" />
                            </path>
                        <path fill="#000000" d="M42.3,39.6c5.7-4.3,13.9-3.1,18.1,2.7c4.3,5.7,3.1,13.9-2.7,18.1l4.1,5.5c8.8-6.5,10.6-19,4.1-27.7
                            c-6.5-8.8-19-10.6-27.7-4.1L42.3,39.6z">
                                <animateTransform 
                                attributeName="transform" 
                                attributeType="XML" 
                                type="rotate"
                                dur="1s" 
                                from="0 50 50"
                                to="-360 50 50" 
                                repeatCount="indefinite" />
                            </path>
                        <path fill="#000000" d="M82,35.7C74.1,18,53.4,10.1,35.7,18S10.1,46.6,18,64.3l7.6-3.4c-6-13.5,0-29.3,13.5-35.3s29.3,0,35.3,13.5
                            L82,35.7z">
                                <animateTransform 
                                attributeName="transform" 
                                attributeType="XML" 
                                type="rotate"
                                dur="2s" 
                                from="0 50 50"
                                to="360 50 50" 
                                repeatCount="indefinite" />
                            </path>
                        </svg>
                    </div>

                    </div>
                    <div class="contenedor-info">
                    <ul>
                        <li>
                        <a href="tel:+34943123123" target="_blank">
                            <img src="<?= asset('assets/img/icons/tel.svg') ?>" alt="" title="">
                            <span>638 141 964</span>
                        </a>
                        </li>
                        <li>
                        <a href="mailto:aranaz@webda.eus" target="_blank">
                            <img src="<?= asset('assets/img/icons/mail-solid.svg') ?>" alt="" title="">
                            <span>no-reply@webda.eus</span>
                        </a>
                        </li>
                        <li>
                        <a href="https://wa.me/628749350" target="_blank">
                            <img src="<?= asset('assets/img/icons/wa.svg') ?>" alt="" title="">
                            <span>638 141 964</span>
                        </a>
                        </li>
                        <li>
                        <a href="https://maps.app.goo.gl/Kh7rZM3WF1chSZSj7" target="_blank">
                            <img src="<?= asset('assets/img/icons/map-pin-solid.svg') ?>" alt="" title="">
                            <span>C/ Juan Fermín, Juan F. Gilisagasti Kalea, 4, 1º, 20018 Donostia / San Sebastián, Gipuzkoa</span>
                        </a>
                        </li>
                    </ul>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1886.901188915529!2d-2.0047191655624914!3d43.29790730427824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd51b013f0513629%3A0x57e4ff3311f619d9!2s%C3%81rea%20Escuela%20de%20Dise%C3%B1o%20y%20Nuevas%20Tecnolog%C3%ADas!5e1!3m2!1ses!2ses!4v1768584957042!5m2!1ses!2ses" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </article>
        </section>

    </main>
   
    <?php require app_path('includes/es/footer.php'); ?>
  </body>
</html>
