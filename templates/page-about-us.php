<!-- HEADER -->
<?php

/**
 * Template Name: About Us
 */

get_header(); ?>

<!-- CONSTANTS -->
<?php
$feature = [
    [
        "header" => "Warszawa",
        "text" => "Centrum Zdrowia Psychicznego dla Dzieci i Młodzieży",
        "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#17462B" class="bi bi-telephone" viewBox="0 0 16 16">
  <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
</svg>',
        "sub" => "ul. Nowowiejska 12, 00-665 Warszawa",
        "number" => "(22) 123 45 67"
    ],
    [
        "header" => "Kraków",
        "text" => "Poradnia Psychologiczno-Pedagogiczna nr 2",
        "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#17462B" class="bi bi-telephone" viewBox="0 0 16 16">
  <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
</svg>',
        "sub" => "ul. Stradomska 15, 31-068 Kraków",
        "number" => "(12) 345 67 89"
    ],
    [
        "header" => "Wrocław",
        "text" => "Specjalistyczna Przychodnia Zdrowia Psychicznego",
        "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#17462B" class="bi bi-telephone" viewBox="0 0 16 16">
  <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
</svg>',
        "sub" => "ul. Dobrzyńska 21/23, 50-403 Wrocław",
        "number" => "(71) 456 78 90"
    ],
    [
        "header" => "Gdańsk",
        "text" => "Ośrodek Diagnozy i Terapii ADHD",
        "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#17462B" class="bi bi-telephone" viewBox="0 0 16 16">
  <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
</svg>',
        "sub" => "ul. Kartuska 200, 80-122 Gdańsk  ",
        "number" => "(58) 765 43 21"
    ],
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
                    <span class="hero-span">Poznaj nasze zaangażowanie w poprawę jakości życia osób z ADHD</span>
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

    <div class="bg"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/home/Mesh_gradient_bg.webp');">
        <section class="history">
            <div class="min-width">
                <div class="history-holder">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/AboutUs_Image.webp"
                        alt="History" loading="lazy">
                    <div class="desc">
                        <div class="header">
                            <span>Wiedza dla pacjenta</span>
                            <h2>Znajdź placówkę działającą w ramach NFZ</h2>
                            <p class="sub">Naukowe Wnioski dla Jasności, Pewności i Lepszego Samopoczucia</p>
                        </div>
                        <p>Poniżej przedstawiamy listę wybranych placówek realizujących diagnostykę i terapię ADHD w
                            ramach
                            Narodowego Funduszu Zdrowia. Zestawienie to ma na celu ułatwienie pacjentom i ich rodzinom
                            dostępu do specjalistycznej opieki w różnych regionach Polski. Warto pamiętać, że zakres
                            oferowanych usług może się różnić w zależności od placówki, dlatego zalecamy wcześniejszy
                            kontakt telefoniczny w celu potwierdzenia dostępności konkretnej formy wsparcia.</p>
                        <p>Aby zapewnić najwyższe standardy, nasze testy są opracowywane w oparciu o naukowo
                            zweryfikowane
                            metodologie i nieustannie udoskonalane na podstawie najnowszych badań nad ADHD.
                            Wykorzystując
                            najnowocześniejsze badania i analizy danych, oferujemy rzetelną i intuicyjną platformę,
                            która
                            pomaga użytkownikom uzyskać precyzyjne i wartościowe informacje na temat ich wzorców
                            poznawczych
                            i behawioralnych.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="features">
            <div class="min-width">
                <div class="feature-holder">
                    <div class="header">
                        <h5>Znajdź placówkę działającą w ramach NFZ</h5>
                    </div>
                    <ul class="navigation">
                        <?php foreach ($feature as $feat): ?>
                            <li>
                                <!-- <?php echo $feat['svg']; ?> -->
                                <div class="desc">
                                    <h6><?php echo htmlspecialchars($feat['header']); ?></h6>
                                    <span class="sub"><?php echo htmlspecialchars($feat['text']); ?></span>
                                    <span><?php echo htmlspecialchars($feat['sub']); ?></span>
                                    <div class="d-flex flex-row align-items-center gap-2 feature-number">
                                        <?php echo $feat['svg']; ?>
                                        <span><?php echo htmlspecialchars($feat['number']); ?></span>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="feature-note">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#17462B"
                            class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                        </svg>
                        <span>Wskazówka: Zanim odwiedzisz placówkę, zadzwoń i upewnij się,że oferują wsparcie
                            odpowiednie do Twoich potrzeb.</span>
                    </div>
                </div>
            </div>
        </section>
    </div>
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