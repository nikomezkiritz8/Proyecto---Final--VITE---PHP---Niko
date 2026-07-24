<!doctype html>
<html lang="<?= e($lang ?? env('LANG_DEFAULT', 'es')) ?>">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="<?= asset('favicon.svg') ?>">
    <link rel="canonical" href="<?= url('/kontaktua') ?>">
    <title>Kontaktua | Niko Mezkiritz — Hitz egin dezagun zure proiektuari buruz</title>
    <meta name="description" content="Jarri harremanetan Niko Mezkiritzekin web garapenari, diseinuari eta proiektu digitalei buruz hitz egiteko. Konta iezadazu zure ideia eta eraiki dezagun neurriko irtenbide bat.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= vite_tags($route['resources'] ?? null) ?>
    <?php require app_path('includes/cookielad.php'); ?>
  </head>
<body>
    <?php require app_path('includes/eu/nav.php'); ?>

    <header class="header02">
        <img class="header02__media" src="<?= asset('assets/img/views/chicoprograma.avif') ?>" alt="Programatzen ari den mutila" title="mutila programatzen">
        <div class="header02__content">
        <p class="header02__eyebrow">Kontaktua</p>
        <h1 class="header02__title">Web garatzaile junior gisa lan-aukera berrietarako prest.</h1>
        <p class="header02__text">Xehetasunei arreta jartzen dien, kode garbia idazten duen eta ikasten jarraitzeko gogoa duen junior web garatzaile baten bila zabiltza? Pozik hitz egingo dut zurekin.</p>
        <a href="<?= url('/eu/kontaktua') ?>#idForAjax" class="boton">Kontaktuan jar zaitez</a>
        </div>
    </header>

    <main>

        <!-- antes estaba la sección estática de contacto -->
        <?php require app_path('includes/eu/section_form.php'); ?>
            
        <section>
            <!-- Opiniones clientes -->
            <!-- artículo 4 -->
            <article class="art04">
                <h2>TESTIGANTZAK</h2>
                <span class="ralla"></span>
                <div class="contenedor-fichas">
                    <div class="ficha">
                        <h3>Leire</h3>
                        <img src="<?= asset('assets/img/views/leire.avif') ?>" alt="Leire" title="Leire">                        
                        <p>"Nikok ikuspegi berritzailea eskaini zion gure proiektuari. Guk ikusi ez genituen xehetasunak identifikatzeko zuen gaitasunak azken emaitza eta erabiltzailearen esperientzia nabarmen hobetu zituen."</p>
                        <span class="ralla"></span>
                    </div>

                    <div class="ficha">
                        <h3>Ibon</h3>
                        <img src="<?= asset('assets/img/views/ibon.avif') ?>" alt="Ibon" title="Ibon">                        
                        <p>"Azkarra, metodikoa eta ekimen handikoa da. Proiektua aurreikusitako epea baino lehen amaitu zuen, eta kodea modu bikain eta txukunean antolatuta zegoen."</p>
                        <span class="ralla"></span>
                    </div>

                    <div class="ficha">
                        <h3>Igor</h3>
                        <img src="<?= asset('assets/img/views/igor.avif') ?>" alt="Igor" title="Igor">                        
                        <p>"Berarekin lan egitea erraza izan zen hasieratik. Gure lan egiteko modura egokitu zen, beharrezkoak ziren galderak egin zituen eta arazo konplexuak lasaitasunez eta eraginkortasunez konpondu zituen."</p>
                        <span class="ralla"></span>
                    </div>

                    <div class="ficha">
                        <h3>Laura</h3>
                        <img src="<?= asset('assets/img/views/laura.avif') ?>" alt="Laura" title="Laura">                        
                        <p>"Irisgarritasunari eta errendimenduari buruzko bere ikuspegiak frontend-a lantzeko modua berrikustera bultzatu gintuen. Taldearentzat ekarpen bikaina izan zen."</p>
                        <span class="ralla"></span>
                    </div>
                </div>
            </article>
        </section>
    </main>

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
