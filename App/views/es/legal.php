<!doctype html>
<html lang="<?= e($lang ?? env('LANG_DEFAULT', 'es')) ?>">
  <head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="<?= asset('favicon.svg') ?>">
    <link rel="canonical" href="<?= url('/legal') ?>">
    <title>Aviso legal, privacidad y cookies</title>
    <meta name="description" content="Información legal tipo sobre titularidad, privacidad, protección de datos y gestión de cookies.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= vite_tags($route['resources'] ?? null) ?>
  </head>
  <body>
    <?php require app_path('includes/es/nav.php'); ?>

    <main class="legalPage">
      <header class="legalPage__hero">
        <p class="legalPage__eyebrow">Información legal</p>
        <h1>Aviso legal, privacidad y cookies</h1>
        <p class="legalPage__intro">Texto legal tipo para una web corporativa básica. Sustituye los datos entre corchetes por los datos reales del titular y adapta las finalidades si el proyecto recoge formularios, pedidos, newsletter, analítica o cookies de terceros.</p>
      </header>

      <nav class="legalPage__index" aria-label="Índice legal">
        <a href="#aviso-legal">Aviso legal</a>
        <a href="#politica-privacidad">Política de privacidad</a>
        <a href="#gestion-cookies">Gestión de cookies</a>
      </nav>

      <section class="legalPage__section" id="aviso-legal">
        <h2>Aviso legal</h2>
        <p>En cumplimiento de la normativa aplicable a los servicios de la sociedad de la información, se informa de que este sitio web es titularidad de:</p>
        <ul>
          <li>Titular: [Nombre o razón social]</li>
          <li>NIF/CIF: [Número identificativo]</li>
          <li>Domicilio: [Dirección completa]</li>
          <li>Correo electrónico: [correo@dominio.com]</li>
          <li>Teléfono: [teléfono de contacto]</li>
          <li>Datos registrales, si procede: [Registro Mercantil, tomo, folio, hoja e inscripción]</li>
        </ul>
        <h3>Objeto</h3>
        <p>El sitio web facilita información sobre la actividad, productos o servicios del titular. El acceso y uso del sitio atribuye la condición de usuario e implica la aceptación de este aviso legal.</p>
        <h3>Uso del sitio web</h3>
        <p>La persona usuaria se compromete a utilizar el sitio web de forma lícita, diligente y respetuosa, sin provocar daños en los sistemas, contenidos o servicios, ni realizar actividades ilícitas, fraudulentas o contrarias a la buena fe.</p>
        <h3>Propiedad intelectual e industrial</h3>
        <p>Los contenidos, textos, imágenes, diseño, código fuente, marcas y signos distintivos pertenecen al titular o a sus legítimos licenciantes. No se permite su reproducción, distribución o transformación sin autorización expresa, salvo en los casos legalmente permitidos.</p>
        <h3>Responsabilidad</h3>
        <p>El titular procura mantener la información actualizada y disponible, pero no garantiza la inexistencia de errores, interrupciones o incidencias técnicas. Los enlaces externos, si existen, dirigen a sitios de terceros cuyas condiciones y políticas son ajenas al titular.</p>
      </section>

      <section class="legalPage__section" id="politica-privacidad">
        <h2>Política de privacidad</h2>
        <p>Los datos personales que se puedan recoger a través de este sitio web serán tratados de forma confidencial y conforme a la normativa de protección de datos aplicable.</p>
        <h3>Responsable del tratamiento</h3>
        <p>Responsable: [Nombre o razón social]. Contacto: [correo@dominio.com]. Dirección: [Dirección completa].</p>
        <h3>Finalidades</h3>
        <p>Los datos podrán tratarse para atender consultas, gestionar solicitudes, prestar servicios contratados, mantener la relación comercial o administrativa y cumplir obligaciones legales. Si se habilitan newsletters, formularios avanzados, venta online o analítica, deberán añadirse sus finalidades concretas.</p>
        <h3>Legitimación</h3>
        <p>La base jurídica del tratamiento podrá ser el consentimiento de la persona interesada, la ejecución de medidas precontractuales o contractuales, el cumplimiento de obligaciones legales o el interés legítimo cuando resulte aplicable.</p>
        <h3>Conservación</h3>
        <p>Los datos se conservarán durante el tiempo necesario para cumplir la finalidad para la que fueron recogidos y, posteriormente, durante los plazos exigidos para atender posibles responsabilidades legales.</p>
        <h3>Destinatarios</h3>
        <p>No se comunicarán datos a terceros salvo obligación legal o cuando sea necesario para prestar el servicio mediante encargados de tratamiento, como alojamiento web, correo electrónico, mantenimiento técnico o herramientas de gestión.</p>
        <h3>Derechos</h3>
        <p>La persona interesada puede solicitar el acceso, rectificación, supresión, oposición, limitación del tratamiento, portabilidad de sus datos y retirada del consentimiento escribiendo a [correo@dominio.com]. También puede presentar una reclamación ante la Agencia Española de Protección de Datos si considera que el tratamiento no se ajusta a la normativa.</p>
      </section>

      <section class="legalPage__section" id="gestion-cookies">
        <h2>Gestión de cookies</h2>
        <p>Este stack no instala cookies no técnicas por defecto. Si el proyecto final incorpora analítica, publicidad, mapas embebidos, vídeos, redes sociales u otros servicios de terceros, deberá añadirse un sistema de información y consentimiento previo cuando corresponda.</p>
        <h3>Tipos de cookies</h3>
        <ul>
          <li>Cookies técnicas: permiten la navegación y el uso de funciones básicas. Normalmente no requieren consentimiento.</li>
          <li>Cookies de preferencias, analíticas, publicitarias o de terceros: requieren información clara y, cuando proceda, consentimiento antes de su instalación.</li>
        </ul>
        <h3>Cómo modificar el consentimiento</h3>
        <p>Cuando se implemente un gestor de cookies, la persona usuaria deberá poder aceptar, rechazar o configurar cookies con la misma facilidad, y también retirar su consentimiento posteriormente desde esta sección.</p>
        <p class="legalPage__notice">Plantilla pendiente de adaptar: sustituye este bloque por el botón real de configuración cuando el proyecto incorpore cookies que requieran consentimiento.</p>
      </section>
    </main>

    <?php require app_path('includes/es/footer.php'); ?>
  </body>
</html>
