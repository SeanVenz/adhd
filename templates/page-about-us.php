<!-- HEADER -->
<?php

/**
 * Template Name: About Us
 */

get_header(); ?>

<!-- CONSTANTS -->
<?php
$feature = [
    ["header" => "Oparte na badaniachi klinicznie przetestowane", "text" => "Nasze testy zostały opracowane przez ekspertów i bazują na najnowszych badaniach nad ADHD, zapewniając dokładność, rzetelność i praktyczne zastosowanie.", "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24"><path fill="#17462B" fill-rule="evenodd" d="M9.945 1.25h4.11c1.368 0 2.47 0 3.337.117c.9.12 1.658.38 2.26.981c.602.602.86 1.36.982 2.26c.116.867.116 1.97.116 3.337v8.11c0 1.367 0 2.47-.116 3.337c-.121.9-.38 1.658-.982 2.26s-1.36.86-2.26.982c-.867.116-1.97.116-3.337.116h-4.11c-1.367 0-2.47 0-3.337-.116c-.9-.122-1.658-.38-2.26-.982s-.86-1.36-.981-2.26a12 12 0 0 1-.082-.943a.75.75 0 0 1-.016-.392a66 66 0 0 1-.019-2.002v-8.11c0-1.367 0-2.47.117-3.337c.12-.9.38-1.658.982-2.26c.601-.602 1.36-.86 2.26-.981c.866-.117 1.969-.117 3.336-.117m-5.168 17c.015.353.039.664.076.942c.099.734.28 1.122.556 1.399c.277.277.666.457 1.4.556c.755.101 1.756.103 3.191.103h4c1.436 0 2.437-.002 3.192-.103c.734-.099 1.122-.28 1.4-.556c.196-.196.343-.449.448-.841H8a.75.75 0 0 1 0-1.5h11.223c.019-.431.025-.925.026-1.5H7.898c-.978 0-1.32.006-1.582.077a2.25 2.25 0 0 0-1.54 1.422m14.473-3H7.782c-.818 0-1.376 0-1.855.128a3.8 3.8 0 0 0-1.177.548V8c0-1.435.002-2.437.103-3.192c.099-.734.28-1.122.556-1.399c.277-.277.666-.457 1.4-.556c.755-.101 1.756-.103 3.191-.103h4c1.436 0 2.437.002 3.192.103c.734.099 1.122.28 1.4.556c.276.277.456.665.555 1.4c.102.754.103 1.756.103 3.191zM7.25 7A.75.75 0 0 1 8 6.25h8a.75.75 0 0 1 0 1.5H8A.75.75 0 0 1 7.25 7m0 3.5A.75.75 0 0 1 8 9.75h5a.75.75 0 0 1 0 1.5H8a.75.75 0 0 1-.75-.75" clip-rule="evenodd"/></svg>'],
    ["header" => "Łatwe w użyciui dostępne", "text" => "Zaprojektowane dla każdego – bez skomplikowanych procesów, tylko jasne, przejrzyste testy z łatwymi do zrozumienia wynikami.", "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24"><g fill="none" stroke="#17462B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="currentColor"><path d="M21.999 11c-.008 2.626-.086 4.044-.813 5.081a4.5 4.5 0 0 1-1.105 1.105C18.92 18 17.28 18 14 18h-4c-3.28 0-4.919 0-6.081-.814a4.5 4.5 0 0 1-1.105-1.105C2 14.92 2 13.28 2 10s0-4.919.814-6.081a4.5 4.5 0 0 1 1.105-1.105C5.08 2 6.72 2 10 2h1.5"/><path d="M14 6s1 0 2 2c0 0 3.177-5 6-6M11 15h2m-1 3v4m-4 0h8"/></g></svg>'],
    ["header" => "Kompleksowe ispersonalizowane analizy", "text" => "Oferujemy więcej niż tylko wynik. Nasze raporty zawierają szczegółową analizę mocnych stron, wyzwań oraz rekomendacje oparte na wiedzy ekspertów, dostosowane do Twoich potrzeb.", "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24"><path fill="#17462B" fill-rule="evenodd" d="M12.05 1.25h-.1c-.664 0-1.237 0-1.696.062c-.491.066-.963.215-1.345.597s-.531.854-.597 1.345c-.062.459-.062 1.032-.062 1.697v2.427a2.3 2.3 0 0 0-.75-.128h-3A2.25 2.25 0 0 0 2.25 9.5v11.75H2a.75.75 0 0 0 0 1.5h20a.75.75 0 0 0 0-1.5h-.25V14.5a2.25 2.25 0 0 0-2.25-2.25h-3q-.396.002-.75.128V4.951c0-.665 0-1.238-.062-1.697c-.066-.491-.215-.963-.597-1.345s-.853-.531-1.345-.597c-.459-.062-1.032-.062-1.697-.062m8.2 20V14.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75v6.75zm-6 0V5c0-.728-.002-1.2-.048-1.546c-.044-.325-.115-.427-.172-.484s-.159-.128-.484-.172c-.347-.046-.818-.048-1.546-.048s-1.2.002-1.546.048c-.325.044-.427.115-.484.172s-.128.159-.172.484c-.046.347-.048.818-.048 1.546v16.25zm-6 0V9.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75v11.75z" clip-rule="evenodd"/></svg>'],
    ["header" => " Zaufane przez profesjonalistów i użytkowników", "text" => "Nasza platforma jest wykorzystywana przez rodziny, nauczycieli i specjalistów ds. zdrowia psychicznego na całym świecie jako wiarygodne narzędzie do zrozumienia i zarządzania ADHD.", "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24"><path fill="#17462B" fill-rule="evenodd" d="M12.05 1.25h-.1c-.664 0-1.237 0-1.696.062c-.491.066-.963.215-1.345.597s-.531.854-.597 1.345c-.062.459-.062 1.032-.062 1.697v2.427a2.3 2.3 0 0 0-.75-.128h-3A2.25 2.25 0 0 0 2.25 9.5v11.75H2a.75.75 0 0 0 0 1.5h20a.75.75 0 0 0 0-1.5h-.25V14.5a2.25 2.25 0 0 0-2.25-2.25h-3q-.396.002-.75.128V4.951c0-.665 0-1.238-.062-1.697c-.066-.491-.215-.963-.597-1.345s-.853-.531-1.345-.597c-.459-.062-1.032-.062-1.697-.062m8.2 20V14.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75v6.75zm-6 0V5c0-.728-.002-1.2-.048-1.546c-.044-.325-.115-.427-.172-.484s-.159-.128-.484-.172c-.347-.046-.818-.048-1.546-.048s-1.2.002-1.546.048c-.325.044-.427.115-.484.172s-.128.159-.172.484c-.046.347-.048.818-.048 1.546v16.25zm-6 0V9.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75v11.75z" clip-rule="evenodd"/></svg>'],
    ["header" => "Bezpiecznei poufne", "text" => "Twoja prywatność jest naszym priorytetem. Korzystamy z zaawansowanego szyfrowania i ścisłych zasad poufności, aby Twoje dane były zawsze bezpieczne i pod Twoją kontrolą.", "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24"><g fill="none" stroke="#17462B" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M5 13a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2z"/><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0-2 0m-3-5V7a4 4 0 1 1 8 0v4"/></g></svg>'],
    ["header" => "Wsparcie pozakończeniu oceny", "text" => "Oferujemy wskazówki dotyczące dalszych kroków, w tym dostęp do zasobów eksperckich i praktycznych strategii, które pomogą Ci lepiej zrozumieć i zarządzać ADHD.", "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 16 16"><g fill="#17462B" fill-rule="evenodd" clip-rule="evenodd"><path d="M7.199 2A.2.2 0 0 0 7 2.199c0 1.808-1.958 2.939-3.524 2.034a.2.2 0 0 0-.272.073l-.8 1.388a.2.2 0 0 0 .072.271c1.566.905 1.566 3.165 0 4.07a.2.2 0 0 0-.073.271l.801 1.388a.2.2 0 0 0 .272.073C5.042 10.862 7 11.993 7 13.8c0 .11.089.199.199.199H8.8c.11 0 .199-.089.199-.199c0-1.808 1.958-2.939 3.524-2.034a.2.2 0 0 0 .271-.073l.802-1.388a.2.2 0 0 0-.073-.271c-1.303-.753-1.516-2.434-.665-3.5a.75.75 0 0 1 1.172.936a.852.852 0 0 0 .243 1.265a1.7 1.7 0 0 1 .622 2.32l-.802 1.388a1.7 1.7 0 0 1-2.32.622a.85.85 0 0 0-1.274.735c0 .938-.76 1.699-1.699 1.699H7.2c-.938 0-1.699-.76-1.699-1.699a.85.85 0 0 0-1.274-.735a1.7 1.7 0 0 1-2.32-.622l-.802-1.388a1.7 1.7 0 0 1 .622-2.32a.85.85 0 0 0 0-1.472a1.7 1.7 0 0 1-.622-2.32l.801-1.388a1.7 1.7 0 0 1 2.32-.622A.85.85 0 0 0 5.5 2.2c0-.94.76-1.7 1.699-1.7H9.3a.75.75 0 1 1 0 1.5zm.8 7.5a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3M8 11a3 3 0 1 0 0-6a3 3 0 0 0 0 6"/><path d="M12.5 5.5a2 2 0 1 0 0-4a2 2 0 0 0 0 4"/></g></svg>'],
];

$hero = [
    ["header" => "Wiedza uwzględniająca najnowsze wytyczne", "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M8.48 15.98v-1h1.695q-.067.25-.105.491q-.037.24-.045.51zM8.347 21q-1.805 0-3.076-1.241T4 16.73V7.654q-.69 0-1.172-.472q-.482-.473-.482-1.163V4.654q0-.69.482-1.172T4 3h8.673q.69 0 1.182.482q.491.481.491 1.172v1.365q0 .69-.491 1.163q-.492.472-1.182.472v3.737q-.235.163-.437.346t-.384.398H8.481v-1h3.192V7.654H5v9.077q0 1.384.98 2.327T8.347 20q.654 0 1.219-.229q.564-.229 1.008-.63q.104.25.229.459t.283.423q-.56.458-1.252.717q-.692.26-1.487.26m7.827-1.692q1.166 0 1.987-.822q.82-.82.82-1.986t-.82-1.986q-.821-.822-1.987-.822q-1.165 0-1.986.822q-.821.82-.821 1.986t.82 1.987t1.987.82m5.1 2.982l-2.777-2.777q-.511.388-1.102.592q-.59.204-1.221.204q-1.586 0-2.697-1.111t-1.11-2.697t1.11-2.697t2.697-1.11t2.697 1.11t1.11 2.697q0 .63-.203 1.221q-.204.59-.592 1.102l2.777 2.777z"/></svg>'],
    ["header" => "Poradnik przygotowany przez ekspertów", "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M11.861 2.39a3 3 0 0 1 3.275-.034L19.29 5H21a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1h-1.52a2.65 2.65 0 0 1-1.285 2.449l-5.093 3.056a2 2 0 0 1-2.07-.008a2 2 0 0 1-2.561.073l-5.14-4.039a2 2 0 0 1-.565-2.446A2 2 0 0 1 2 13.51V6a1 1 0 0 1 1-1h4.947zM4.173 13.646l.692-.605a3 3 0 0 1 4.195.24l2.702 2.972a3 3 0 0 1 .396 3.487l5.009-3.005a.66.66 0 0 0 .278-.79l-4.427-6.198a1 1 0 0 0-1.101-.377l-2.486.745a3 3 0 0 1-2.983-.752l-.293-.292A2 2 0 0 1 5.68 7H4v6.51zm9.89-9.602a1 1 0 0 0-1.093.012l-5.4 3.6l.292.293a1 1 0 0 0 .995.25l2.485-.745a3 3 0 0 1 3.303 1.13L18.515 14H20V7h-.709a2 2 0 0 1-1.074-.313zM6.181 14.545l-1.616 1.414l5.14 4.039l.705-1.232a1 1 0 0 0-.129-1.169L7.58 14.625a1 1 0 0 0-1.398-.08"/></svg>'],
    ["header" => "Narzędzia przyjazne dla użytkowników", "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="#FFFFFF"><path fill="#FFFFFF" d="m12 3l.295-.69a.75.75 0 0 0-.59 0zm0 18l-.372.651a.75.75 0 0 0 .744 0zm6.394-15.26l-.295.69zM8.024 18.727l-.373.652zm3.68-16.416L5.312 5.05L5.9 6.43l6.394-2.74zM4.25 6.659v6.86h1.5v-6.86zm3.401 12.72l3.977 2.272l.744-1.302l-3.977-2.273zm4.721 2.272l3.977-2.272l-.744-1.303l-3.977 2.273zm7.378-8.133V6.66h-1.5v6.86zm-1.06-8.467l-6.395-2.74l-.59 1.378l6.394 2.74zm1.06 1.608c0-.7-.417-1.332-1.06-1.608l-.591 1.379a.25.25 0 0 1 .151.23zm-3.401 12.72a6.75 6.75 0 0 0 3.401-5.86h-1.5a5.25 5.25 0 0 1-2.645 4.557zM4.25 13.519a6.75 6.75 0 0 0 3.401 5.86l.744-1.303a5.25 5.25 0 0 1-2.645-4.558zM5.31 5.05a1.75 1.75 0 0 0-1.06 1.608h1.5c0-.1.06-.19.152-.23z"/><path stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m15 10l-4 4l-2-2"/></g></svg>'],
];
?>

<!-- MAIN SECTION -->
<main class="front">

    <section class="hero"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/home/hero_bg.webp');">
        <div class="min-width">
            <div class="hero-holder">
                <div class="text-holder">
                    <h1>Projekt z misją</h1>
                    <span>Poznaj nasze zaangażowanie w poprawę jakości życia osób z ADHD</span>
                    <p>Exeltis Poland z pełnym zaangażowaniem wspiera osoby z zespołem nadpobudliwości psychoruchowej z
                        deficytem uwagi, realizując projekt popularyzujący wiedzę opartą o najnowsze wytyczne
                        diagnostyczno-terapeutyczne Polskiego Towarzystwa Psychiatrycznego. Nad jego merytoryczną stroną
                        czuwają doświadczeni eksperci z dziedziny psychiatrii. Misją naszej firmy jest realna pomoc
                        pacjentom z ADHD poprzez dostarczanie rzetelnych informacji, narzędzi wspierających leczenie
                        oraz edukację, która pozwala budować bardziej zrozumiałe i przyjazne otoczenie dla osób z tą
                        diagnozą.</p>
                    <ul>
                        <?php foreach ($hero as $her): ?>
                            <li>
                                <div><?php echo $her['svg']; ?></div>
                                <span><?php echo htmlspecialchars($her['header']); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="img-holder">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/about.webp" alt="Hero"
                        loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <section class="history">
        <div class="min-width">
            <div class="history-holder">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/AboutUs_Image.webp" alt="History"
                    loading="lazy">
                <div class="desc">
                    <div class="header">
                        <span>Wiedza dla pacjenta</span>
                        <h2>Znajdź placówkę działającą w ramach NFZ</h2>
                        <p>Naukowe Wnioski dla Jasności, Pewności i Lepszego Samopoczucia</p>
                    </div>
                    <p>Poniżej przedstawiamy listę wybranych placówek realizujących diagnostykę i terapię ADHD w ramach
                        Narodowego Funduszu Zdrowia. Zestawienie to ma na celu ułatwienie pacjentom i ich rodzinom
                        dostępu do specjalistycznej opieki w różnych regionach Polski. Warto pamiętać, że zakres
                        oferowanych usług może się różnić w zależności od placówki, dlatego zalecamy wcześniejszy
                        kontakt telefoniczny w celu potwierdzenia dostępności konkretnej formy wsparcia.</p>
                    <p>Aby zapewnić najwyższe standardy, nasze testy są opracowywane w oparciu o naukowo zweryfikowane
                        metodologie i nieustannie udoskonalane na podstawie najnowszych badań nad ADHD. Wykorzystując
                        najnowocześniejsze badania i analizy danych, oferujemy rzetelną i intuicyjną platformę, która
                        pomaga użytkownikom uzyskać precyzyjne i wartościowe informacje na temat ich wzorców poznawczych
                        i behawioralnych.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="min-width">
            <div class="feature-holder">
                <div class="header">
                    <h5>Dlaczego warto nas wybrać?</h5>
                </div>
                <ul class="navigation">
                    <?php foreach ($feature as $feat): ?>
                        <li>
                            <?php echo $feat['svg']; ?>
                            <div class="desc">
                                <h6><?php echo htmlspecialchars($feat['header']); ?></h6>
                                <span><?php echo htmlspecialchars($feat['text']); ?></span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="min-width">
            <div class="testimonials-holder">
                <div class="text-holder">
                    <div class="header">
                        <span>Opinie</span>
                        <h2>Budowanie wsparcia poprzez <br> wspólne doświadczenia</h2>
                    </div>
                    <span class="growth">Prawdziwe historie wzrostu, odporności i wsparcia społeczności</span>
                </div>

                <?php echo do_shortcode('[testimonial_view id="1"]'); ?>
            </div>
        </div>
    </section>

    <?php get_template_part('template-parts/step'); ?>

</main>


<!-- FOOTER -->
<?php get_footer(); ?>