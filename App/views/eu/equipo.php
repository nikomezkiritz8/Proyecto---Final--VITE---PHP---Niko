<!doctype html>
<html lang="<?= e($lang ?? env('LANG_DEFAULT', 'es')) ?>">
  <head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="<?= asset('favicon.svg') ?>">
    <link rel="canonical" href="<?= url('/nere-proiektuak') ?>">
    <title>Proiektuak | Niko Mezkiritz — Full Stack Garapena</title>
    <meta name="description" content="Ezagutu Niko Mezkiritzen proiektuak: teknologia modernoz sortutako web aplikazioak, diseinua, Full Stack garapena eta irtenbide digitalak.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= vite_tags($route['resources'] ?? null) ?>
  </head>
  
  <body>
    <?php require app_path('includes/eu/nav.php'); ?>

    <header class="header02">
        <img class="header02__media" src="<?= asset('assets/img/views/chicoprograma.avif') ?>" alt="Programatzen ari den mutila" title="mutila programatzen">
        <div class="header02__content">
        <p class="header02__eyebrow">PROIEKTUAK</p>
        <h1 class="header02__title">Nire sorkuntzak</h1>
        <p class="header02__text">HTML, CSS, JavaScript, PHP eta beste teknologia batzuk erabiliz konponbide funtzional eta modernoak sortzeko garatu ditudan web aplikazio eta proiektuen hautaketa bat.</p>
        <a href="/eu/kontaktua" class="boton">Kontaktuan jarri</a>
        </div>
    </header>

    <main>

      <section>
        <!-- Presentación de mi portfolio -->


        <!-- Art14 -->
        <article class="art14">
          <div class="content">
            <h2>Portfolio Pertsonala</h2>
            <span>HTML · SCSS · PHP · Vite · JavaScript</span>
            <p>Nire aurkezpen-gutun digitala. Irisgarritasuna, errendimendu akasgabea eta diseinu interaktiboa harmonian bizi daitezkeela frogatzeko diseinatua.</p>
            <p>Nire portfolio pertsonala helburu oso argi batekin jaio da: garatzaile web junior gisa dudan profila islatuko duen eta, aldi berean, nire ezagutza teknikoen zein lan egiteko moduaren erakusleiho izango den plataforma bat sortzea. Proiektuak erakustetik harago, webgune hau lehen unetik profesionaltasuna, antolaketa eta xehetasunekiko arreta transmititzeko diseinatuta dago.</p>
            <p>Garapena plangintza-fase batekin hasi zen; bertan, gunearen arkitektura, erabiltzaile-esperientzia eta identitate bisuala zehaztu nituen. Interfaze moderno, garbi eta nabigatzeko erraza nahi nuen, non atal bakoitzak helburu argi bat izango zuen eta informazio garrantzitsunera iristea erraztuko zuen.</p>
            <p>Maila teknikoan, proiektua garatzeko HTML semantikoa erabili da, irisgarritasuna eta SEO posizionamendua hobetzeko; SCSS, estilo-orri modularra eta mantentzen erraza sortzeko; PHP, kontakturako formularioa bezalako funtzionalitate dinamikoak kudeatzeko; eta Vite, konpilazioa optimizatzeko eta garapen-fasean errendimendua hobetzeko garapen-tresna gisa.</p>
            <p>Garrantzirik handiena eman zitzaion alderdietako bat responsive diseinua izan zen. Interfaze osoa ezin hobeto egokitzen da ordenagailu, tablet eta gailu mugikorretara, pantaila-tamaina edozein izanda ere esperientzia koherente bat bermatuz.</p>
            <p>Garapenean zehar, errendimenduaren optimizazioarekin lotutako alderdiak ere landu nituen: baliabideak minimizatuz, kodea egoki antolatuz eta etorkizunean proiektua zabaltzen jarraitzea ahalbidetuko duen egitura eskalagarria aplikatuz.</p>

            <h3>LORTUTAKO HELBURUAK</h3>
            
            <ul>
              <li>Identitate digital profesional bat sortzea</li>
              <li>Front-End garapeneko ezagutzak erakustea</li>
              <li>Kodearen egituran eta antolaketan jardunbide egokiak aplikatzea</li>
              <li>Webgune guztiz responsive bat garatzea</li>
              <li>Erabiltzaile-esperientzia hobetzea nabigazio intuitibo baten bidez</li>
              <li>Funtzionalitate eta proiektu berriekin etengabe eboluzionatu dezakeen benetako proiektu bat izatea</li>
            </ul>
            <img src="<?= asset('assets/img/views/otrohero.avif') ?>" alt="portfolio" title ="portfolio">
            <div class="contenedor-botones">
              <a href="/eu/nere-proiektuak" class="boton">Ikusi proiektua</a>
              <a href="/eu/nere-proiektuak" class="boton">Kodea</a>
              <a href="/eu/nere-proeiktuak" class="boton">Kasuen azterketa</a>
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
            <p>Donostiako arkitektura-estudio garaikide baterako kontzeptu bisual eta funtzionala. Lerro zuzenetan, egitura-ordenean eta dotorezia monokromatikoan inspiratua.</p>
            <p>ARQ Studio arkitektura-estudio garaikide baterako diseinatutako webgune kontzeptual bat da. Proiektuak dotorezia, minimalismoa eta esklusibotasuna transmititzea du helburu, arkitektura bera benetako protagonista bilakatzen duen diseinu garbi baten bidez.</p>
            <p>Hasieratik, helburua bisualki oso zaindutako esperientzia bat eraikitzea izan zen: irudi handiak, espazio zuri zabalak eta kalitate zein sofistikazio sentipena indartuko zuen kolore-paleta neutro bat erabiliz.</p>
            <p>Webgunearen egitura estudioaren zerbitzuak aurkeztera, egindako proiektuak erakustera eta balizko bezeroekiko kontaktua erraztera bideratuta dago. Atal bakoitza informazioa argia eta erraz eskura egoteko diseinatu da, betiere irakurgarritasuna eta erabiltzaile-esperientzia lehenetsiz.</p>
            <p>Proiektuaren erronka nagusietako bat HTML eta CSS soilik erabiliz konposizio bisual orekatu bat lortzea izan zen, arreta berezia jarriz elementuen kokapenean, hierarkia bisualean eta egokitzapen responsivean.</p>
            <p>Proiektu honi esker, sakondu egin ahal izan nuen Flexbox, CSS Grid, diseinu moldagarria eta CSS kodearen antolaketarekin lotutako kontzeptuetan, interfaze garbiak eta eskalagarriak eraikitzen ikasiz.</p>


            <h3>ALDERDI NABARMENAK</h3>
            
            <ul>
              <li>Arkitektura-estudio modernoetan inspiratutako diseinu minimalista</li>
              <li>Formatu handiko irudien erabilera intentsiboa</li>
              <li>Maquetazio guztiz responsivea</li>
              <li>Kode antolatua eta erraz mantentzeko modukoa</li>
              <li>Nabigazio-esperientzia dotore eta arina</li>
            </ul>
            <img src="<?= asset('assets/img/views/casahorizonte.avif') ?>" alt="página de arquitectura" title ="página de arquitectura" >
            <div class="contenedor-botones">

              <a href="/eu/nere-proiektuak" class="boton">Ikusi proiektua</a>
              <a href="/eu/nere-proiektuak" class="boton">Kodea</a>
              <a href="/eu/nere-proiektuak" class="boton">Kasuen azterketa</a>
            </div>

          </div>
        </article>
      </section>

      <section>
        <!-- Presentación de mi Ecommerce japonésa -->

        <!-- Art14 -->
        <article class="art14">
          <div class="content">
            <h2>KOKORO · E-commerce Japonesa</h2>
            <span>WordPress</span>
            <p>KOKOROko te eta intsentsuen inportaziora dedikatutako lineako boutique baten erakustaldia. Soiltasun minimalista eta dinamismo komertziala uztartzen ditu.</p>
            <p>KOKORO japoniar estetikan inspiratutako merkataritza elektroniko proiekto bat da, erosketa-esperientzia sinple, dotore eta produktuan zentratua eskaintzeko helburuarekin sortua.</p>
            <p>Idea nagusia diseinuaren bidez japoniar kulturari lotutako balioak transmitituko zituen online denda bat eraikitzea zen: oreka, sinpletasuna, harmonia eta xehetasunekiko arreta. Horretarako, estetika minimalista bat aukeratu zen, kolore leunekin, tipografia garbiekin eta produktu bakoitzari berez nabarmentzeko aukera ematen dion banaketa batekin.</p>
            <p>Proiektua WordPress eduki-kudeatzailea erabiliz garatu zen, tresna honek produktuak, kategoriak eta eduki dinamikoa modu errazean kudeatzeko eskaintzen duen malgutasuna aprobetxatuz.</p>
            <p>Diseinu bisualaz gain, erabiltzaile-esperientzia bereziki landu zen erosketa-prozesuan zehar; nabigazioa antolatu zen bezeroak produktuak azkar aurkitu, beharrezko informazioa kontsultatu eta erosketa ahalik eta urrats gutxienetan osatu ahal izateko.</p>
            <p>Diseinu responsiveari ere arreta berezia jarri zitzaion, esperientzia erosoa bermatuz bai ordenagailutik bai gailu mugikorretatik.</p>

            <h3>EZAUGARRI NAGUSIAK</h3>
            

            <ul>
              <li>Japoniar filosofian inspiratutako diseinua</li>
              <li>Nabigazio sinple eta intuitiboa</li>       
              <li>Kategorien arabera antolatutako katalogoa</li>
              <li>Produktu-fitxa argi eta bisualak</li>
              <li>Interfaze responsivea</li>
              <li>Erosketa-esperientziara bideratutako ikuspegia</li>
            </ul>

            <img src="<?= asset('assets/img/views/japo.avif') ?>" alt="ecommerce japones" title ="ecommerce japones">
            <div class="contenedor-botones">
              <a href="/eu/nere-proiektuak" class="boton">Ikusi proiektua</a>
              <a href="/eu/nere-proiektuak" class="boton">Kodea</a>
              <a href="/eu/nere-proiektuak" class="boton">Kasuen azterketa</a>
            </div>
            
          </div>
        </article>
      </section>


      <section id="section5">
        <!-- Galeria de proyectos realizados -->
        <h2 data-lang="encabezado">NIRE LAN-PROZESUA</h2>
        <p>Garatzen dudan proiektu bakoitzak metodologia bati jarraitzen dio, kodea antolatuta mantentzen eta ongi egituratutako soluzioak eskaintzen laguntzen didana.</p>
        <p><strong>1. Ikerketa eta analisia</strong></p>
        <p><strong>2. Interfazearen diseinua</strong></p>
        <p><strong>3. Garapena</strong></p>
        <p><strong>4. Probak eta optimizazioa</strong></p>
        <p><strong>5. Inplementazioa eta etengabeko hobekuntza</strong></p>

        <article class="art11">
              <h3></h3>
              <div>
                  <img src="<?= asset('assets/img/views/ordenador.avif') ?>" alt="Itsasorako begirada" title="Itsasorako begirada">
              </div>

              <div>
                  <img src="<?= asset('assets/img/views/haciendocodigo.avif') ?>" alt="Kodigoa egiten" title="Kodigoa egiten">
              </div>

              <div>
                  <img src="<?= asset('assets/img/views/figma.avif') ?>" alt="Figman lan egiten" title="Figman lan egiten">
              </div>

              <div>
                  <img src="<?= asset('assets/img/views/loft.avif') ?>" alt="ARQ Loft" title="ARQ Loft">
              </div>

              <div>
                  <img src="<?= asset('assets/img/views/japones.avif') ?>" alt="E-commerce japonesa" title="E-commerce japonesa">
              </div>

              <div>
                  <img src="<?= asset('assets/img/views/responsive.avif') ?>" alt="Diseinu responsivea" title="Diseinu responsivea">
              </div>

              <div>
                  <img src="<?= asset('assets/img/views/futuro.avif') ?>" alt="Etorkizuna" title="Etorkizuna">
              </div>

              <div>
                  <img src="<?= asset('assets/img/views/relax.avif') ?>" alt="PC multi-pantaila" title="PC multi-pantaila">
              </div>

          </article>

          <article class="artSlider01" aria-label="Carrusel de mis proyectos">
            
            <div class="artSlider01__visor">
                <div class="artSlider01__pista">
                  <div class="artSlider01__slide">
                    <h3>Diseinatu aurretik entzun</h3>
                    <img src="<?= asset('assets/img/views/escuchar.avif') ?>" alt="Besteei entzun" title="Besteei entzun">
                  </div>
                  <div class="artSlider01__slide">
                    <h3>Interfaze bakoitza ideia batekin hasten da.</h3>
                    <img src="<?= asset('assets/img/views/idea.avif') ?>" alt="Figman ideia" title="Figman ideia">
                  </div>

                  <div class="artSlider01__slide">
                    <h3>Kode garbia. Esperientzia azkarrak.</h3>
                    <img src="<?= asset('assets/img/views/code.avif') ?>" alt="Kodea" title="Kodea">
                  </div>

                  <div class="artSlider01__slide">
                    <h3>Xehetasun txikiek egiten dute aldea.</h3>
                    <img src="<?= asset('assets/img/views/lighthouse.avif') ?>" alt="Lighthouse" title="Lighthouse">
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
      <?php require app_path('includes/eu/section_form.php'); ?>

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
