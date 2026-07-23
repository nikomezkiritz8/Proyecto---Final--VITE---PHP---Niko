<!doctype html>
<html lang="<?= e($lang ?? env('LANG_DEFAULT', 'es')) ?>">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="<?= asset('assets/img/icons/favicon.svg') ?>">
    <link rel="canonical" href="<?= url('/contacto') ?>">
    <title>Contacto | Niko Mezkiritz — Hablemos de tu proyecto</title>
    <meta name="description" content="Contacta con Niko Mezkiritz para hablar sobre desarrollo web, diseño y proyectos digitales. Cuéntame tu idea y construyamos una solución a medida.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= vite_tags($route['resources'] ?? null) ?>
    <?php require app_path('includes/cookielad.php'); ?>
  </head>
<body>
    <?php require app_path('includes/es/nav.php'); ?>

    <header class="header02">
        <img class="header02__media" src="<?= asset('assets/img/views/chicoprograma.avif') ?>" alt="Escena de chico programando" title="chico programando">
        <div class="header02__content">
        <p class="header02__eyebrow">Contacto</p>
        <h1 class="header02__title">Disponible para nuevas oportunidades como desarrollador web junior</h1>
        <p class="header02__text">¿Buscas un desarrollador junior con atención al detalle, código limpio y ganas de seguir aprendiendo? Estaré encantado de hablar contigo.</p>
        <a href="<?= url('/es/contacto') ?>" class="boton">Ponte en contacto</a>
        </div>
    </header>

    <main>
        
        <!-- antes estaba la sección estática de contacto -->
        <?php require app_path('includes/es/section_form.php'); ?>
            
        <section>
            <!-- Opiniones clientes -->
            <!-- artículo 4 -->
            <article class="art04">
                <h2>TESTIMONIOS</h2>
                <span class="ralla"></span>
                <div class="contenedor-fichas">
                    <div class="ficha">
                        <h3>Leire</h3>
                        <img src="<?= asset('assets/img/views/leire.avif') ?>" alt="Leire" title="Leire">                        
                        <p>"Niko aportó una perspectiva fresca a nuestro proyecto. Su capacidad para detectar detalles que nosotros pasamos por alto mejoró mucho la experiencia final."</p>
                        <span class="ralla"></span>
                    </div>

                    <div class="ficha">
                        <h3>Ibon</h3>
                        <img src="<?= asset('assets/img/views/ibon.avif') ?>" alt="Ibon" title="Ibon">                        
                        <p>"Rápido, metódico y con mucha iniciativa. Entregó el proyecto antes de lo previsto y el código estaba impecablemente organizado."</p>
                        <span class="ralla"></span>
                    </div>

                    <div class="ficha">
                        <h3>Igor</h3>
                        <img src="<?= asset('assets/img/views/igor.avif') ?>" alt="Igor" title="Igor">                        
                        <p>"Trabajar con él fue sencillo desde el primer día. Se adaptó a nuestro flujo, preguntó lo necesario y resolvió problemas complejos con calma."</p>
                        <span class="ralla"></span>
                    </div>

                    <div class="ficha">
                        <h3>Laura</h3>
                        <img src="<?= asset('assets/img/views/laura.avif') ?>" alt="Laura" title="Laura">                        
                        <p>"Su enfoque en la accesibilidad y el rendimiento nos hizo replantearnos cómo enfrentábamos el frontend. Un gran aporte para el equipo."</p>
                        <span class="ralla"></span>
                    </div>
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
