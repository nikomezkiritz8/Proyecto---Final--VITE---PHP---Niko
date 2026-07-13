<!doctype html>
<html lang="<?= e($lang ?? env('LANG_DEFAULT', 'es')) ?>">
  <head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="<?= asset('favicon.svg') ?>">
    <link rel="canonical" href="<?= url('/lege-oharra') ?>">
    <title>Lege oharra, pribatutasuna eta cookieak</title>
    <meta name="description" content="Webgunearen titulartasunari, pribatutasunari, datuen babesari eta cookieen kudeaketari buruzko lege informazio eredua.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= vite_tags($route['resources'] ?? null) ?>
  </head>
  <body>
    <?php require app_path('includes/eu/nav.php'); ?>

    <main class="legalPage">
      <header class="legalPage__hero">
        <p class="legalPage__eyebrow">Lege informazioa</p>
        <h1>Lege oharra, pribatutasuna eta cookieak</h1>
        <p class="legalPage__intro">Web korporatibo arrunt baterako lege testu eredua. Ordezkatu kortxete arteko datuak titularraren benetako datuekin eta egokitu helburuak proiektuak formularioak, eskaerak, newsletterra, analitika edo hirugarrenen cookieak erabiltzen baditu.</p>
      </header>

      <nav class="legalPage__index" aria-label="Lege aurkibidea">
        <a href="#aviso-legal">Lege oharra</a>
        <a href="#politica-privacidad">Pribatutasun politika</a>
        <a href="#gestion-cookies">Cookieen kudeaketa</a>
      </nav>

      <section class="legalPage__section" id="aviso-legal">
        <h2>Lege oharra</h2>
        <p>Informazio gizartearen zerbitzuei aplikatu beharreko araudia betez, webgune honen titularra honako hau dela jakinarazten da:</p>
        <ul>
          <li>Titularra: [Izena edo sozietatearen izena]</li>
          <li>IFZ/IFK: [Identifikazio zenbakia]</li>
          <li>Helbidea: [Helbide osoa]</li>
          <li>Posta elektronikoa: [posta@domeinua.com]</li>
          <li>Telefonoa: [harremanetarako telefonoa]</li>
          <li>Erregistro datuak, hala badagokio: [Merkataritza Erregistroa, liburukia, folioa, orria eta inskripzioa]</li>
        </ul>
        <h3>Helburua</h3>
        <p>Webguneak titularraren jarduerari, produktuei edo zerbitzuei buruzko informazioa eskaintzen du. Webgunera sartzeak eta hura erabiltzeak erabiltzaile izaera ematen du eta lege ohar hau onartzea dakar.</p>
        <h3>Webgunearen erabilera</h3>
        <p>Erabiltzaileak webgunea modu zilegi, arduratsu eta errespetuzkoan erabiltzeko konpromisoa hartzen du, sistemak, edukiak edo zerbitzuak kaltetu gabe eta jarduera legez kanpoko, iruzurrezko edo fede onaren aurkakoak egin gabe.</p>
        <h3>Jabetza intelektuala eta industriala</h3>
        <p>Edukiak, testuak, irudiak, diseinua, iturburu kodea, markak eta bereizgarriak titularrarenak edo haren lizentziadunenak dira. Ez da baimentzen horiek erreproduzitzea, banatzea edo eraldatzea berariazko baimenik gabe, legeak baimentzen dituen kasuetan izan ezik.</p>
        <h3>Erantzukizuna</h3>
        <p>Titularrak informazioa eguneratuta eta eskuragarri mantentzen saiatzen da, baina ez du bermatzen akatsik, etenik edo gorabehera teknikorik ez dagoenik. Kanpoko estekek, halakorik badago, hirugarrenen webguneetara eramaten dute, eta haien baldintzak eta politikak titularrarenak ez dira.</p>
      </section>

      <section class="legalPage__section" id="politica-privacidad">
        <h2>Pribatutasun politika</h2>
        <p>Webgune honen bidez jaso daitezkeen datu pertsonalak isilpean tratatuko dira eta aplikatu beharreko datuen babeserako araudiaren arabera.</p>
        <h3>Tratamenduaren arduraduna</h3>
        <p>Arduraduna: [Izena edo sozietatearen izena]. Kontaktua: [posta@domeinua.com]. Helbidea: [Helbide osoa].</p>
        <h3>Helburuak</h3>
        <p>Datuak kontsultak erantzuteko, eskaerak kudeatzeko, kontratatutako zerbitzuak emateko, merkataritza edo administrazio harremana mantentzeko eta legezko betebeharrak betetzeko tratatu ahal izango dira.</p>
        <h3>Legitimazioa</h3>
        <p>Tratamenduaren oinarri juridikoa interesdunaren baimena, kontratu aurreko edo kontratuzko neurriak, legezko betebeharrak betetzea edo interes legitimoa izan daiteke, kasuan kasu.</p>
        <h3>Kontserbazioa</h3>
        <p>Datuak bildu ziren helburua betetzeko behar den denboran gordeko dira eta, ondoren, legezko erantzukizunak artatzeko behar diren epeetan.</p>
        <h3>Hartzaileak</h3>
        <p>Ez zaizkie datuak hirugarrenei jakinaraziko, legezko betebeharra dagoenean edo zerbitzua emateko tratamendu enkargatuak behar direnean izan ezik, hala nola web ostatua, posta elektronikoa, mantentze teknikoa edo kudeaketa tresnak.</p>
        <h3>Eskubideak</h3>
        <p>Interesdunak datuetara sartzeko, datuak zuzentzeko, ezabatzeko, tratamendua mugatzeko, aurka egiteko, eramangarritasuna eskatzeko eta baimena kentzeko eskubideak erabil ditzake [posta@domeinua.com] helbidera idatziz. Halaber, Datuak Babesteko Espainiako Agentzian erreklamazioa aurkez dezake.</p>
      </section>

      <section class="legalPage__section" id="gestion-cookies">
        <h2>Cookieen kudeaketa</h2>
        <p>Stack honek ez du cookie ez-teknikorik instalatzen lehenespenez. Azken proiektuak analitika, publizitatea, txertatutako mapak, bideoak, sare sozialak edo hirugarrenen beste zerbitzu batzuk erabiltzen baditu, informazio eta baimen sistema gehitu beharko da dagokionean.</p>
        <h3>Cookie motak</h3>
        <ul>
          <li>Cookie teknikoak: nabigazioa eta oinarrizko funtzioak ahalbidetzen dituzte. Normalean ez dute baimenik behar.</li>
          <li>Lehentasun, analitika, publizitate edo hirugarrenen cookieak: informazio argia eta, hala badagokio, instalatu aurreko baimena behar dute.</li>
        </ul>
        <h3>Nola aldatu baimena</h3>
        <p>Cookie kudeatzaile bat ezartzen denean, erabiltzaileak cookieak onartu, baztertu edo konfiguratu ahal izan beharko ditu erraztasun berarekin, eta baimena geroago ere kendu ahal izango du atal honetatik.</p>
        <p class="legalPage__notice">Egokitu beharreko txantiloia: ordezkatu bloke hau benetako konfigurazio botoiarekin proiektuak baimena behar duten cookieak erabiltzen dituenean.</p>
      </section>
    </main>

    <?php require app_path('includes/eu/footer.php'); ?>
  </body>
</html>
