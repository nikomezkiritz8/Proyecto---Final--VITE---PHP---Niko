<!doctype html>
<html lang="<?= e($lang ?? env('LANG_DEFAULT', 'es')) ?>">
  <head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="<?= asset('favicon.svg') ?>">
    <title>Página no encontrada | Niko Studio</title>
    <meta name="description" content="La página que buscas no existe o ha cambiado de dirección. Vuelve al inicio de Niko Studio o regresa a la página anterior.">
    <meta name="robots" content="noindex, follow">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= vite_tags($route['resources'] ?? null) ?>
    <?php require app_path('includes/cookielad.php'); ?>
  </head>
  <body>
    <?php require app_path('includes/es/nav.php'); ?>
    <main class="error404" id="contenido-principal">
      <section class="error404__panel" aria-labelledby="error404-title">
        <div class="error404__content">
          <p class="error404__eyebrow">Error 404</p>
          <h1 class="error404__title" id="error404-title">Esta página se ha perdido en el código</h1>
          <p class="error404__text">
            La dirección no existe, ha cambiado o quizá contiene un error. Puedes volver al inicio o regresar a la página anterior.
          </p>
          <div class="error404__actions" aria-label="Opciones para continuar">
            <a class="error404__button error404__button--primary" href="/es">
              <svg aria-hidden="true" viewBox="0 0 24 24">
                <path d="M3 11.5 12 4l9 7.5M5.5 10v10h13V10M9.5 20v-6h5v6"/>
              </svg>
              Volver al inicio
            </a>
            <button class="error404__button error404__button--secondary" type="button" data-history-back>
              <svg aria-hidden="true" viewBox="0 0 24 24">
                <path d="m9 6-6 6 6 6M4 12h10a6 6 0 0 1 6 6"/>
              </svg>
              Página anterior
            </button>
          </div>
        </div>

        <div class="error404__visual" aria-hidden="true">
          <span class="error404__glow"></span>
          <svg class="error404__illustration" viewBox="0 0 560 420">
            <path class="error404__orbit" d="M71 229c31-104 134-168 252-151 119 17 180 105 163 202"/>
            <circle class="error404__dot error404__dot--one" cx="74" cy="226" r="7"/>
            <circle class="error404__dot error404__dot--two" cx="486" cy="280" r="9"/>
            <g class="error404__window">
              <rect x="92" y="94" width="376" height="240" rx="22"/>
              <path d="M92 145h376"/>
              <circle cx="126" cy="120" r="7"/>
              <circle cx="151" cy="120" r="7"/>
              <circle cx="176" cy="120" r="7"/>
              <path class="error404__code" d="m191 207-36 28 36 28M369 207l36 28-36 28M310 186l-57 98"/>
            </g>
            <text class="error404__number" x="280" y="385" text-anchor="middle">404</text>
          </svg>
        </div>
      </section>
    </main>
    <?php require app_path('includes/es/footer.php'); ?>
</body>
</html>
