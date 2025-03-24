<!-- HEADER -->
<?php get_header(); ?>

<!-- CONSTANTS -->
<?php
$feature = [
    ["number" => "Step 1", "desc" => "Badanie przesiewowe", "header" => "Test przesiewowy - czy warto go wykonać?", "text" => "W przypadku podejrzenia u siebie ADHD warto na początku sięgnąć po test przesiewowy w kierunku ADHD, który pozwoli ocenić, czy wskazane będzie przeprowadzenie pełnego wywiadu diagnostycznego.", "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 32 32"><path fill="#17462B" d="M8.25 2A3.25 3.25 0 0 0 5 5.25v6a3.25 3.25 0 0 0-2 3V25.5A4.5 4.5 0 0 0 7.5 30h17a4.5 4.5 0 0 0 4.5-4.5v-3.25a3.25 3.25 0 0 0-2-3V8.75a3.25 3.25 0 0 0-2-3V19h-1.5V5.25A3.25 3.25 0 0 0 20.25 2zM21.5 19h-.568a1.25 1.25 0 0 1-.884-.366l-6.682-6.682A3.25 3.25 0 0 0 11.068 11H7V5.25C7 4.56 7.56 4 8.25 4h12c.69 0 1.25.56 1.25 1.25zM5 14.25c0-.69.56-1.25 1.25-1.25h4.818c.332 0 .65.132.884.366l6.682 6.682a3.25 3.25 0 0 0 2.298.952h4.818c.69 0 1.25.56 1.25 1.25v3.25a2.5 2.5 0 0 1-2.5 2.5h-17A2.5 2.5 0 0 1 5 25.5z"/></svg>'],
    ["number" => "Step 2", "desc" => "Test ASRS", "header" => "Jak działa test przesiewowy ASRS?", "text" => "Najpopularniejszym narzędziem do wstępnej diagnozy ADHD jest Adult ADHD Self-Report Scale (ASRS), opracowany przez WHO. Test przesiewowy obejmuje 6 pytań (część A) – 4+ pozytywne odpowiedzi (zacienione pola) sugerują konieczność dalszej diagnostyki.", "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24"><g fill="none" stroke="#17462B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M7 14a3 3 0 1 0 1 5.83"/><path d="M4.264 15.605a4 4 0 0 1-.874-6.636m.03-.081A2.5 2.5 0 0 1 7 5.5m.238.065A2.5 2.5 0 1 1 12 4.5V20m-4 0a2 2 0 1 0 4 0m0-13a3 3 0 0 0 3 3m2 4a3 3 0 1 1-1 5.83"/><path d="M19.736 15.605a4 4 0 0 0 .874-6.636m-.03-.081A2.5 2.5 0 0 0 17 5.5m-5-1a2.5 2.5 0 1 1 4.762 1.065M16 20a2 2 0 1 1-4 0"/></g></svg>'],
    ["number" => "Step 3", "desc" => "Diagnostyka ze specjalistą", "header" => "Rekomendowane podejście do diagnozy ADHD", "text" => "Preferowaną metodą diagnozy ADHD jest starannie przeprowadzony wywiad kliniczny. Może mieć formę swobodną lub ustrukturyzowaną, np. kwestionariusz DIVA-5. Wywiad powinien prowadzić doświadczony klinicysta, pozyskując informacje z różnych źródeł.", "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 2048 2048"><path fill="#17462B" d="M1790 1717q98 48 162 135t81 196h-110q-11-57-41-106t-73-84t-97-56t-112-20q-59 0-112 20t-97 55t-73 85t-41 106h-110q16-108 80-195t163-136q-57-45-88-109t-32-136q0-45 12-87t36-79t57-66t74-49q-27-39-62-69t-76-53t-86-33t-93-12q-80 0-153 31t-127 91q24 65 24 134q0 92-41 173t-115 136q65 33 117 81t90 108t57 128t20 142H896q0-79-30-149t-82-122t-123-83t-149-30q-80 0-149 30t-122 82t-83 123t-30 149H0q0-73 20-141t57-128t89-108t118-82q-74-55-115-136t-41-173q0-79 30-149t82-122t122-83t150-30q85 0 161 36t132 100q26-25 56-45t63-38q-74-55-115-136t-41-173q0-79 30-149t82-122t122-83t150-30q79 0 149 30t122 82t83 123t30 149q0 92-41 173t-115 136q70 37 126 90t95 123q64 0 120 24t99 67t66 98t24 121q0 72-31 136t-89 109M512 1536q53 0 99-20t82-55t55-81t20-100q0-53-20-99t-55-82t-81-55t-100-20q-53 0-99 20t-82 55t-55 81t-20 100q0 53 20 99t55 82t81 55t100 20m384-896q0 53 20 99t55 82t81 55t100 20q53 0 99-20t82-55t55-81t20-100q0-53-20-99t-55-82t-81-55t-100-20q-53 0-99 20t-82 55t-55 81t-20 100m704 630q-42 0-78 16t-64 43t-44 64t-16 79t16 78t43 64t64 44t79 16t78-16t64-43t44-64t16-79t-16-78t-43-64t-64-44t-79-16"/></svg>'],
];

$hero = [
    ["header" => "Rozpocznij test", "link" => "/rozpocznij-ocene", "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m9.5 16.5l7-4.5l-7-4.5zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m0-2q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8"/></svg>'],
    [
        "header" => "Więcej wiedzy",
        "link" => "/centrum-wiedzy",
        "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
  <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
</svg>'
    ],
];

$wellBeing = [
    [
        "header" => "Psychoedukacja",
        "text" => "Po postawieniu diagnozy ADHD, podstawową interwencją jest psychoedukacja. Klinicyści powinni dostarczać osobom edukację i informacje na temat przyczyn i konsekwencji tego zaburzenia oraz potwierdzonych naukowo metod terapii. Ważne jest, aby ten proces budził nadzieję i motywację do działania. W proces psychoedukacji mogą zostać włączeni bliscy.",
        "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" fill="#17462B" class="bi bi-lightbulb" viewBox="0 0 16 16">
  <path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13a.5.5 0 0 1 0 1 .5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1 0-1 .5.5 0 0 1 0-1 .5.5 0 0 1-.46-.302l-.761-1.77a2 2 0 0 0-.453-.618A5.98 5.98 0 0 1 2 6m6-5a5 5 0 0 0-3.479 8.592c.263.254.514.564.676.941L5.83 12h4.342l.632-1.467c.162-.377.413-.687.676-.941A5 5 0 0 0 8 1"/>
</svg>'
    ],
    [
        "header" => "Psychoterapia",
        "text" => "Interwencje poznawczo-behawioralne powinny być oferowane dorosłym z ADHD w ramach leczenia multimodalnego (wraz z farmakoterapią) lub samodzielnie w przypadku osób z ADHD, które świadomie zrezygnowały z leczenia farmakologicznego, nie uzyskują zadowalających wyników lub mają problemy z tolerancją leków. Dostępne dowody potwierdzają korzyści płynące z interwencji poznawczo-behawioralnych (CBT, MBCT, DBT).",
        "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24"><g fill="none" stroke="#17462B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M7 14a3 3 0 1 0 1 5.83"/><path d="M4.264 15.605a4 4 0 0 1-.874-6.636m.03-.081A2.5 2.5 0 0 1 7 5.5m.238.065A2.5 2.5 0 1 1 12 4.5V20m-4 0a2 2 0 1 0 4 0m0-13a3 3 0 0 0 3 3m2 4a3 3 0 1 1-1 5.83"/><path d="M19.736 15.605a4 4 0 0 0 .874-6.636m-.03-.081A2.5 2.5 0 0 0 17 5.5m-5-1a2.5 2.5 0 1 1 4.762 1.065M16 20a2 2 0 1 1-4 0"/></g></svg>'
    ],
    [
        "header" => "Farmakoterapia osób dorosłych",
        "text" => "Decyzja o rozpoczęciu farmakoterapii powinna być podejmowana wspólnie ze specjalistą i zależeć od poziomu dysfunkcji oraz oczekiwań pacjenta co do wyników leczenia. Należy uwzględnić wpływ ADHD na codzienne życie, pracę i relacje oraz cele pacjenta, takie jak poprawa koncentracji czy regulacja nastroju.",
        "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24"><path fill="none" stroke="#17462B" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 3a1 1 0 0 1 1 1v4.535l3.928-2.267a1 1 0 0 1 1.366.366l1 1.732a1 1 0 0 1-.366 1.366L16.001 12l3.927 2.269a1 1 0 0 1 .366 1.366l-1 1.732a1 1 0 0 1-1.366.366L14 15.464V20a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-4.536l-3.928 2.268a1 1 0 0 1-1.366-.366l-1-1.732a1 1 0 0 1 .366-1.366L7.999 12L4.072 9.732a1 1 0 0 1-.366-1.366l1-1.732a1 1 0 0 1 1.366-.366L10 8.535V4a1 1 0 0 1 1-1z"/></svg>'
    ],
];
?>

<!-- MAIN SECTION -->
<main class="front">

    <section class="main-hero"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/home/hero_bg.webp');">
        <div class="min-width">
            <div class="main-hero-holder">
                <div class="text-holder">
                    <div class="heading">
                        <h1>Pełnia życia z ADHD: Rośnij i osiągaj sukcesy</h1>
                        <span>Tutaj znajdziesz najważniejsze informacje, jak radzić sobie z ADHD. Pamiętaj, że im wcześniejsza diagnoza, tym mniejszy negatywny wpływ na Twoje życie.</span>
                    </div>
                    <ul>
                        <?php foreach ($hero as $her): ?>
                            <li>
                                <a href="<?php echo get_home_url(); ?><?php echo htmlspecialchars($her['link']); ?>">
                                    <span><?php echo htmlspecialchars($her['header']); ?></span>
                                    <?php echo $her['svg']; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="img-holder">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/Group_87.png" alt="Hero"
                        loading="lazy">
                </div>
            </div>
        </div>

    </section>

    <div class="bg"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/home/Mesh_gradient_bg.webp');">
        <section class="what">
            <div class="min-width">
                <div class="what-holder">
                    <div class="text-holder">
                        <div class="texts">
                            <span class="header">Czym jest ADHD?</span>
                            <h2>Więcej niż brak koncentracji</h2>
                            <span class="desc">ADHD wpływa na koncentrację, emocje i codzienne funkcjonowanie –
                                jego zrozumienie to pierwszy krok.</span>
                            <p>Wielu dorosłych zmaga się z zarządzaniem czasem, impulsywnością i trudnościami w
                                organizacji,
                                często nie zdając sobie sprawy, że te problemy mogą być związane z ADHD. Objawy mogą
                                pozostaćniezauważone lub być mylnie interpretowane jako stres, prokrastynacja czy brak
                                motywacji.Rozpoznanie tych sygnałów to pierwszy krok do zrozumienia, jak ADHD wpływa na
                                codzienne życie,oraz do znalezienia skutecznych strategii, które pomagają odzyskać
                                kontrolę,
                                poprawićkoncentrację i zwiększyć ogólne samopoczucie.</p>
                        </div>
                        <a href="<?php echo get_home_url(); ?>/centrum-wiedzy">Jak rozpoznać ADHD</a>
                    </div>
                    <div class="img-holder">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/Early_detection_image.webp"
                            alt="Hero" loading="lazy">
                    </div>
                </div>
            </div>

        </section>

        <section class="development">
            <div class="min-width">
                <div class="development-holder">
                    <div class="text-holder">
                        <h2>Jak diagnozuje się ADHD?</h2>
                        <span>Dowiedz się, jak wygląda proces rekomendowany przez Polskie Towarzystwo Psychiatryczne. Rozpocznij od przesiewowego testu ASRS, a następnie, jeśli to konieczne, kontynuuj diagnostykę u specjalisty.</span>
                    </div>
                    <ul>
                        <?php foreach ($feature as $feat): ?>
                            <li>
                                <div class="svg-holder">
                                    <?php echo $feat['svg']; ?>
                                    <div class="texts">
                                        <span><?php echo htmlspecialchars($feat['number']); ?></span>
                                        <p><?php echo htmlspecialchars($feat['desc']); ?></p>
                                    </div>
                                </div>
                                <div class="header-holder">
                                    <h5><?php echo htmlspecialchars($feat['header']); ?></h5>
                                    <p><?php echo htmlspecialchars($feat['text']); ?></p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="<?php echo get_home_url(); ?>/rozpocznij-ocene">Wykonaj test Adult ADHD Self-Report Scale</a>
                </div>
            </div>

        </section>

    </div>

    <section class="well-being"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/home/Overiew_HomePage_AboutUS.webp');">
        <div class="min-width">
            <div class="well-being-holder">
                <div class="text-holder">
                    <span>Daj sobie szansę</span>
                    <h2>W jaki sposób leczy się objawy ADHD?</h2>
                    <p>Można wyróżnić trzy główne ścieżki oddziaływań rekomendowane u osób dorosłych z diagnozą ADHD: psychoedukację, interwencje niefarmakologiczne (psychospołeczne) oraz interwencje farmakologiczne. Wsparcie osoby z ADHDpowinno być działaniem multimodalnym, obejmującym różne rodzaje interwencji, specjalistów oraz modyfikacje,uwzględniające indywidualne potrzeb.</p>
                </div>
                <ul>
                    <?php foreach ($wellBeing as $feat): ?>
                        <li>
                            <?php echo $feat['svg']; ?>

                            <div class="header-holder">
                                <h5><?php echo htmlspecialchars($feat['header']); ?></h5>
                                <p><?php echo htmlspecialchars($feat['text']); ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?php echo get_home_url(); ?>/o-nas">Poznaj nasz poradnik</a>
            </div>
        </div>

    </section>

    <section class="knowledge-center">
        <div class="min-width">
            <div class="knowledge-center-holder">
                <div class="text-holder">
                    <div class="header">
                        <span>Poradnik ADHDowca</span>
                        <h2>Poznaj praktyczne porady dla osób z diagnozą w kierunku ADHD</h2>
                        <p>Skorzystaj z poradnika eksperta, psychiatry dr. Tomasza Gondka, który pomoże w zarządzaniu objawami ADHD i poprawie jakości życia, oferując skuteczne strategie terapeutyczne.</p>
                    </div>
                    <p class="desc">Skuteczne zarządzanie ADHD wymaga odpowiednich technik i nastawienia. Odkryj strategie opracowane przez ekspertów, wskazówki dotyczące produktywności oraz techniki regulacji emocji, które pomogą Ci lepiej funkcjonować na co dzień.</p>
                </div>
                <?php get_template_part('template-parts/blogs-main', null, array(
                    'posts_per_page' => 3
                )); ?>
            </div>
        </div>

    </section>

    <section class="accordions">
        <div class="min-width">
            <div class="accordions-holder">
                <div class="header">
                    <h2>Najczęściej zadawane pytania</h2>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Czy treści na stronie są oparte na badaniach naukowych?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                            Tak, wszystkie treści dostępne na naszej stronie są opracowane w oparciu o aktualne badania naukowe, rekomendacje i zalecenia Polskiego Towarzystwa Psychiatrycznego oraz konsultowane z ekspertami. Dbamy o to, by informacje były rzetelne i zgodne z najnowszymi standardami medycznymi dotyczącymi diagnozy i leczenia ADHD.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Jak mogę rozpoznać u siebie objawy ADHD?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                            Samodzielna diagnostyka ADHD może być trudna, jednak warto obserwować pewne charakterystyczne objawy, takie jak trudności z koncentracją, impulsywność, nadmierną aktywność czy problemy z organizacją codziennych zadań. Zachęcamy do wykonania testu przesiewowego ASRS, który dostępny jest na naszej stronie. Ważne jest jednak, aby jego wyniki skonsultować się z lekarzem specjalistą, który przeprowadzi szczegółową diagnozę, opartą na strukturyzowanych kwestionariuszach i wywiadzie klinicznym.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Gdzie mogę szukać pomocy, jeśli podejrzewam u siebie ADHD?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                            Jeśli podejrzewasz u siebie ADHD, warto zacząć od konsultacji z lekarzem rodzinnym, który może skierować Cię do psychiatry lub psychologa. Specjaliści ci przeprowadzą odpowiednie testy i ocenią objawy, a także wskażą na możliwe formy terapii i leczenia.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Jak bezpieczna jest Wasza platforma?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                            Leczenie ADHD obejmuje zarówno terapie farmakologiczne, jak i psychoterapię. Najczęściej stosowanymi lekami są substancje, takie jak metylofenidat, które pomagają w kontroli objawów. Psychoterapia, w szczególności terapia behawioralno-poznawcza (CBT), pomaga pacjentom radzić sobie z codziennymi trudnościami i lepiej zarządzać objawami. W zależności od potrzeb, lekarz dobiera indywidualnie najlepsze podejście terapeutyczne.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="step"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/home/Take_The_Test_bg.webp');">
        <div class="min-width">
            <div class="step-holder">
                <div class="text-holder">
                    <h2>Zrób pierwszy krok - rozpocznij <br> swoją ocenę ADHD już dziś!</h2>
                    <span>Poczuj różnicę na własnej skórze</span>
                </div>
                <a href="<?php echo get_home_url(); ?>/rozpocznij-ocene">Rozpocznij ocenę <svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-play-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path
                            d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445" />
                    </svg></a>
            </div>
        </div>
        </sectio>

</main>


<!-- FOOTER -->
<?php get_footer(); ?>