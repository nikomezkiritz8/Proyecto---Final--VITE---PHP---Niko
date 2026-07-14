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
        <h3 class="header02__title">Lo que he construido</h3>
        <p class="header02__text">Una selección de aplicaciones web y proyectos donde he aplicado HTML, CSS, JavaScript, PHP y otras tecnologías para crear soluciones funcionales y modernas.</p>
        <a href="#showroom-recursos" class="boton">Ponte en contacto</a>
        </div>
    </header>

    <?php require app_path('includes/es/footer.php'); ?>
</body>
</html>
