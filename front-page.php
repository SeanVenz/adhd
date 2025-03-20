<!-- HEADER -->
<?php get_header(); ?>

<!-- CONSTANTS -->
<?php
$feature = [
    ["number" => "78", "desc" => "Standaryzowane badanie przesiewowe ADHD u dzieci", "header" => "Kwestionariusz przesiewowy ADHD", "text" => "Strukturalna ocena oparta na ukierunkowanych pytaniach, zaprojektowana do analizy cech uwagi i impulsywności u dzieci. Dzięki 78% dokładności pomaga zidentyfikować potencjalne objawy ADHD poprzez analizę odpowiedzi, wspierając wczesne wykrywanie i interwencję.", "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 32 32"><path fill="#17462B" d="M8.25 2A3.25 3.25 0 0 0 5 5.25v6a3.25 3.25 0 0 0-2 3V25.5A4.5 4.5 0 0 0 7.5 30h17a4.5 4.5 0 0 0 4.5-4.5v-3.25a3.25 3.25 0 0 0-2-3V8.75a3.25 3.25 0 0 0-2-3V19h-1.5V5.25A3.25 3.25 0 0 0 20.25 2zM21.5 19h-.568a1.25 1.25 0 0 1-.884-.366l-6.682-6.682A3.25 3.25 0 0 0 11.068 11H7V5.25C7 4.56 7.56 4 8.25 4h12c.69 0 1.25.56 1.25 1.25zM5 14.25c0-.69.56-1.25 1.25-1.25h4.818c.332 0 .65.132.884.366l6.682 6.682a3.25 3.25 0 0 0 2.298.952h4.818c.69 0 1.25.56 1.25 1.25v3.25a2.5 2.5 0 0 1-2.5 2.5h-17A2.5 2.5 0 0 1 5 25.5z"/></svg>'],
    ["number" => "91", "desc" => "Rzetelna ocena objawów ADHD", "header" => "Skala samodzielnej oceny ADHD u dorosłych (ASRS)", "text" => "ASRS to zaufane narzędzie samooceny zaprojektowane do pomiaru objawów ADHD u dorosłych. Dzięki 91% dokładności skutecznie identyfikuje wyzwania związane z ADHD, pomagając lepiej zrozumieć własne wzorce poznawcze.", "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24"><g fill="none" stroke="#17462B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M7 14a3 3 0 1 0 1 5.83"/><path d="M4.264 15.605a4 4 0 0 1-.874-6.636m.03-.081A2.5 2.5 0 0 1 7 5.5m.238.065A2.5 2.5 0 1 1 12 4.5V20m-4 0a2 2 0 1 0 4 0m0-13a3 3 0 0 0 3 3m2 4a3 3 0 1 1-1 5.83"/><path d="M19.736 15.605a4 4 0 0 0 .874-6.636m-.03-.081A2.5 2.5 0 0 0 17 5.5m-5-1a2.5 2.5 0 1 1 4.762 1.065M16 20a2 2 0 1 1-4 0"/></g></svg>'],
    ["number" => "84", "desc" => "Wiarygodne badanie przesiewowe ADHD u dzieci", "header" => "Kwestionariusz zachowań dziecięcych (CBCL)", "text" => "Kwestionariusz wypełniany przez opiekunów, który identyfikuje wzorce zachowań związane z ADHD. Dzięki 84% czułości stanowi skuteczne narzędzie przesiewowe wspierające wczesne wykrywanie ADHD u dzieci.", "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 2048 2048"><path fill="#17462B" d="M1790 1717q98 48 162 135t81 196h-110q-11-57-41-106t-73-84t-97-56t-112-20q-59 0-112 20t-97 55t-73 85t-41 106h-110q16-108 80-195t163-136q-57-45-88-109t-32-136q0-45 12-87t36-79t57-66t74-49q-27-39-62-69t-76-53t-86-33t-93-12q-80 0-153 31t-127 91q24 65 24 134q0 92-41 173t-115 136q65 33 117 81t90 108t57 128t20 142H896q0-79-30-149t-82-122t-123-83t-149-30q-80 0-149 30t-122 82t-83 123t-30 149H0q0-73 20-141t57-128t89-108t118-82q-74-55-115-136t-41-173q0-79 30-149t82-122t122-83t150-30q85 0 161 36t132 100q26-25 56-45t63-38q-74-55-115-136t-41-173q0-79 30-149t82-122t122-83t150-30q79 0 149 30t122 82t83 123t30 149q0 92-41 173t-115 136q70 37 126 90t95 123q64 0 120 24t99 67t66 98t24 121q0 72-31 136t-89 109M512 1536q53 0 99-20t82-55t55-81t20-100q0-53-20-99t-55-82t-81-55t-100-20q-53 0-99 20t-82 55t-55 81t-20 100q0 53 20 99t55 82t81 55t100 20m384-896q0 53 20 99t55 82t81 55t100 20q53 0 99-20t82-55t55-81t20-100q0-53-20-99t-55-82t-81-55t-100-20q-53 0-99 20t-82 55t-55 81t-20 100m704 630q-42 0-78 16t-64 43t-44 64t-16 79t16 78t43 64t64 44t79 16t78-16t64-43t44-64t16-79t-16-78t-43-64t-64-44t-79-16"/></svg>'],
];

$hero = [
    ["header" => "Rozpocznij ocenę", "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m9.5 16.5l7-4.5l-7-4.5zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m0-2q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8"/></svg>'],
    [
        "header" => "Odkryj więcej",
        "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
  <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
</svg>'
    ],
];

$wellBeing = [
    [
        "header" => "Efektywność & Prostota",
        "text" => "Wierzymy w upraszczanie skomplikowanych procesów. Nasze intuicyjne rozwiązania ułatwiają zadania, pozwalając użytkownikom osiągać rezultaty bez wysiłku.",
        "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" fill="#17462B" class="bi bi-hourglass-split" viewBox="0 0 16 16">
  <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
</svg>'
    ],
    [
        "header" => "Innowacja & Ekspertyza",
        "text" => "Opierając się na nowoczesnej technologii i specjalistycznej wiedzy, nieustannie rozwijamy nasze narzędzia, dostosowując je do realnych potrzeb użytkowników.",
        "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" fill="#17462B" class="bi bi-lightbulb" viewBox="0 0 16 16">
  <path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13a.5.5 0 0 1 0 1 .5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1 0-1 .5.5 0 0 1 0-1 .5.5 0 0 1-.46-.302l-.761-1.77a2 2 0 0 0-.453-.618A5.98 5.98 0 0 1 2 6m6-5a5 5 0 0 0-3.479 8.592c.263.254.514.564.676.941L5.83 12h4.342l.632-1.467c.162-.377.413-.687.676-.941A5 5 0 0 0 8 1"/>
</svg>'
    ],
    [
        "header" => "Zaufanie & Wsparcie",
        "text" => "Stawiamy na przejrzystość, bezpieczeństwo i niezawodność, tworząc przestrzeń, w której każdy może uzyskać rzetelną ocenę ADHD i fachowe wsparcie z pełnym zaufaniem.",
        "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" fill="#17462B" class="bi bi-shield-check" viewBox="0 0 16 16">
  <path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56"/>
  <path d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
</svg>'
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
                    <h1>ADHD? Zrozum siebie w kilka minut</h1>
                    <ul>
                        <?php foreach ($hero as $her): ?>
                            <li>
                                <span><?php echo htmlspecialchars($her['header']); ?></span>
                                <?php echo $her['svg']; ?>
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
                        <a href="">Dowiedz się więcej</a>
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
                        <h2>Twoje Wnioski, Twój Rozwój</h2>
                        <span>Zrozumienie swojego umysłu to klucz do realnych zmian.</span>
                    </div>
                    <ul>
                        <?php foreach ($feature as $feat): ?>
                            <li>
                                <div class="svg-holder">
                                    <?php echo $feat['svg']; ?>
                                    <div class="texts">
                                        <span><?php echo htmlspecialchars($feat['number']); ?>%</span>
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
                    <a href="">Rozpocznij moją ocenę ADHD</a>
                </div>
            </div>

        </section>

    </div>

    <section class="well-being"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/home/Overiew_HomePage_AboutUS.webp');">
        <div class="min-width">
            <div class="well-being-holder">
                <div class="text-holder">
                    <span>O nas</span>
                    <h2>Twoje dobro, nasz priorytet</h2>
                    <p>We make ADHD assessment accessible and easy to understand with science-backed, user-friendly
                        tools.Our mission is to provide accurate, research-driven insights that help individuals,
                        families, and professionalsrecognize, manage, and navigate ADHD with confidence. Whether you're
                        seeking clarity about your own symptomsor supporting a loved one, our assessments serve as a
                        reliable first step toward informed decision-making, effectivestrategies, and improved
                        well-being.</p>
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
                <a href="">Dowiedz się więcej</a>
            </div>
        </div>

    </section>

    <section class="knowledge-center">
        <div class="min-width">
            <div class="knowledge-center-holder">
                <div class="text-holder">
                    <div class="header">
                        <span>Centrum Wiedzy</span>
                        <h2>Praktyczne wskazówki i spostrzeżenia dotyczące ADHD</h2>
                        <p>Skuteczne strategie dla lepszej koncentracji i codziennego sukcesu</p>
                    </div>
                    <p class="desc">Skuteczne zarządzanie ADHD wymaga odpowiednich technik i nastawienia. Odkryj
                        strategie opracowane przez ekspertów, wskazówki dotyczące produktywności oraz techniki regulacji
                        emocji, które pomogą Ci lepiej funkcjonować na co dzień.</p>
                </div>
                <?php get_template_part('template-parts/blogs', null, array(
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
                                Czym Wasza usługa różni się od innych?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Skupiamy się na efektywności, innowacji i niezawodności, aby dostarczać zoptymalizowane
                                rozwiązania dostosowane do Twoich potrzeb. W przeciwieństwie do tradycyjnych usług,
                                które mogą być skomplikowane i czasochłonne, upraszczamy procesy bez kompromisów w
                                zakresie wydajności. Nasze nowatorskie podejście łączy zaawansowaną technologię,
                                intuicyjny design i analitykę opartą na danych, zapewniając maksymalnie skuteczne i
                                przyjazne użytkownikowi doświadczenie. Dzięki ciągłej optymalizacji naszych rozwiązań
                                pomagamy Ci osiągać cele szybciej i efektywniej. Ponadto stawiamy na długoterminową
                                niezawodność, gwarantując stabilność, bezpieczeństwo i elastyczność naszych usług, które
                                dostosowują się do Twoich zmieniających się potrzeb. Nasze zaangażowanie w satysfakcję
                                użytkowników sprawia, że oferujemy nie tylko usługę, ale także kompleksowe i
                                bezproblemowe rozwiązanie, które naprawdę robi różnicę.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Jak zapewniacie wysoką jakość usług?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Ponadto priorytetowo traktujemy długoterminową niezawodność, dbając o to, aby nasze
                                usługi były spójne, bezpieczne i elastyczne, dostosowując się do Twoich zmieniających
                                się potrzeb. Dzięki silnemu zaangażowaniu w satysfakcję klienta nie oferujemy jedynie
                                usługi – dostarczamy kompleksowe, wysokowydajne rozwiązanie, które naprawdę robi
                                różnicę.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Czy Wasza platforma jest przyjazna dla początkujących?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Stworzyliśmy naszą platformę z myślą o prostocie i łatwości użytkowania. Niezależnie od
                                tego, czy jesteś początkującym, czy doświadczonym użytkownikiem, intuicyjny interfejs i
                                przewodniki krok po kroku sprawiają, że nawigacja jest bezproblemowa. Nawet jeśli
                                dopiero zaczynasz, możesz szybko rozpocząć pracę bez potrzeby długiego wdrażania.
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
                                Poważnie podchodzimy do prywatności i bezpieczeństwa danych. Nasza platforma nie wymaga
                                logowania użytkownika, a jednocześnie wykorzystujemy zaawansowane metody, aby zapewnić
                                prywatność i bezpieczeństwo Twoich danych oraz wyników oceny. Wszystkie informacje
                                wprowadzone podczas oceny ADHD są traktowane z najwyższą poufnością – nie przechowujemy,
                                nie udostępniamy ani nie wykorzystujemy Twoich danych w celach komercyjnych. Stosujemy
                                najlepsze praktyki branżowe, aby zapobiegać nieautoryzowanemu dostępowi i zapewnić, że
                                wyniki są dostępne tylko dla Ciebie. Twoja prywatność jest dla nas priorytetem, dlatego
                                dokładamy wszelkich starań, aby zapewnić bezpieczne i godne zaufania doświadczenie
                                oceny.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Jak mogę zacząć?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Rozpoczęcie jest szybkie i proste! Wystarczy kliknąć „Rozpocznij ocenę”, aby przejść
                                przez proces oceny. Jeśli kiedykolwiek będziesz potrzebować pomocy, nasz zespół wsparcia
                                i centrum pomocy są zawsze dostępne, aby odpowiedzieć na pytania i udzielić wskazówek.
                                Bez względu na poziom doświadczenia znajdziesz u nas wszystko, czego potrzebujesz, aby w
                                pełni wykorzystać możliwości naszej platformy.
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
                <a href="">Rozpocznij ocenę <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-play-circle" viewBox="0 0 16 16">
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