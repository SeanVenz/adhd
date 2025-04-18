<?php
/**
 * Template Name: Quiz Result Page
 */
get_header();

$url = $_SERVER['REQUEST_URI'];
$segments = explode('/', rtrim($url, '/'));
$result_id = intval(end($segments));

if ($result_id > 0):
    global $wpdb;
    $table_results = $wpdb->prefix . "mlw_results";

    // Fetch Quiz Result
    $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_results WHERE result_id = %d", $result_id));

    if ($result):
        // Parse the quiz data from the serialized string
        $quiz_data = unserialize($result->quiz_results);

        // Looking at your data structure, questions data is in index 1
        $questions_data = isset($quiz_data[1]) ? $quiz_data[1] : array();


        $shaded_responses = [
            1 => ['Czasami', 'Często', 'Bardzo często'],
            2 => ['Czasami', 'Często', 'Bardzo często'],
            3 => ['Czasami', 'Często', 'Bardzo często'],
            4 => ['Często', 'Bardzo często'],
            5 => ['Często', 'Bardzo często'],
            6 => ['Często', 'Bardzo często'],
        ];

        $shaded_count = 0;

        foreach ($questions_data as $question) {
            //change to 6 when going live
            if (isset($question['multicategories']) && in_array(5, $question['multicategories'])) {
                $question_id = intval($question['id']);

                // Get the user answer from the associative array
                $user_answer = '';
                if (isset($question['user_answer']) && is_array($question['user_answer'])) {
                    // Get the first value from the user_answer array
                    $user_answer = reset($question['user_answer']);
                }

                // Log the found answer                     // Log shaded responses for the question
                $shaded = $shaded_responses[$question_id] ?? [];

                // Check if the user's answer is in the shaded responses
                if (in_array($user_answer, $shaded)) {
                    $shaded_count++;
                }
            }
        }


        // Determine the result
        $part_a_result = ($shaded_count >= 4) ? 'Positive' : 'Negative';


        $total_score = $part_a_score + $part_b_score + $part_c_score + $part_d_score;
        $total_possible_points = $part_a_totalScore + $part_b_totalScore + $part_c_totalScore + $part_d_totalScore;
        // Definicja zakresów wyników i opisów

        // Find the appropriate description based on total score
        $current_description = null;
        foreach ($score_descriptions as $description) {
            if ($total_score >= $description['range'][0] && $total_score <= $description['range'][1]) {
                $current_description = $description;
                break;
            }
        }

        // Get current URL to share
        $share_url = get_permalink() . '?quiz_id=' . $result_id;

        $positive = [
            'first' => [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="74" height="74" viewBox="0 0 256 256"><path fill="currentColor" d="m223.68 66.15l-88-48.15a15.88 15.88 0 0 0-15.36 0l-88 48.17a16 16 0 0 0-8.32 14v95.64a16 16 0 0 0 8.32 14l88 48.17a15.88 15.88 0 0 0 15.36 0l88-48.17a16 16 0 0 0 8.32-14V80.18a16 16 0 0 0-8.32-14.03M128 120L47.65 76L128 32l80.35 44Zm8 99.64v-85.81l80-43.78v85.76Z"/></svg>',
                'title' => 'Co to oznacza',
                'description' => 'Twoje odpowiedzi wskazują na objawy często związane z ADHD. Mogą one obejmować wzorce nieuwagi, niepokoju lub impulsywności.'
            ],
            'second' => [
                'title' => 'Pozytywny',
                'description' => 'Zidentyfikowano oznaki ADHD'
            ],
            'third' => [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="74" height="74" viewBox="0 0 256 256"><path fill="currentColor" d="m223.68 66.15l-88-48.15a15.88 15.88 0 0 0-15.36 0l-88 48.17a16 16 0 0 0-8.32 14v95.64a16 16 0 0 0 8.32 14l88 48.17a15.88 15.88 0 0 0 15.36 0l88-48.17a16 16 0 0 0 8.32-14V80.18a16 16 0 0 0-8.32-14.03M128 120L47.65 76L128 32l80.35 44Zm8 99.64v-85.81l80-43.78v85.76Z"/></svg>',
                'title' => 'Co możesz zrobić dalej',
                'description' => 'Rozważ rozmowę z licencjonowanym specjalistą zdrowia psychicznego w celu pełnej oceny. Dostępne są wsparcie, wskazówki i opcje leczenia — a wiele osób odczuwa ulgę dzięki odpowiedniej opiece.'
            ],
        ];

        $negative = [
            'first' => [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="74" height="74" viewBox="0 0 256 256"><path fill="currentColor" d="m223.68 66.15l-88-48.15a15.88 15.88 0 0 0-15.36 0l-88 48.17a16 16 0 0 0-8.32 14v95.64a16 16 0 0 0 8.32 14l88 48.17a15.88 15.88 0 0 0 15.36 0l88-48.17a16 16 0 0 0 8.32-14V80.18a16 16 0 0 0-8.32-14.03M128 120L47.65 76L128 32l80.35 44Zm8 99.64v-85.81l80-43.78v85.76Z"/></svg>',
                'title' => 'Co to oznacza',
                'description' => 'Twoje odpowiedzi nie wskazują na wyraźne oznaki ADHD. Wszelkie rozproszenia, których doświadczasz, mieszczą się w typowym zakresie.'
            ],
            'second' => [
                'title' => 'Negatywny',
                'description' => 'ADHD nie jest wskazane'
            ],
            'third' => [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="74" height="74" viewBox="0 0 256 256"><path fill="currentColor" d="m223.68 66.15l-88-48.15a15.88 15.88 0 0 0-15.36 0l-88 48.17a16 16 0 0 0-8.32 14v95.64a16 16 0 0 0 8.32 14l88 48.17a15.88 15.88 0 0 0 15.36 0l88-48.17a16 16 0 0 0 8.32-14V80.18a16 16 0 0 0-8.32-14.03M128 120L47.65 76L128 32l80.35 44Zm8 99.64v-85.81l80-43.78v85.76Z"/></svg>',
                'title' => 'Chcesz Porozmawiać z Kimś?',
                'description' => 'Jeśli wciąż masz pytania lub obawy, rozmowa z licencjonowanym specjalistą zdrowia psychicznego pomoże Ci zgłębić temat.'
            ],
        ];

        $array_to_be_used = $part_a_result == 'Positive' ? $positive : $negative;
        ?>

        <main class='quiz-result' id='quiz-result-container'>
            <div class="header-holder">
                <a href="<?php echo get_home_url(); ?>"> <span>Dom</span> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="#17462B" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path
                            d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                    </svg></a>
                <div class="text-holder">
                    <h1>Wynik Twojej Oceny ADHD</h1>
                    <span>Ta ocena opiera się na Twoich odpowiedziach — wyróżnia to co działa dobrze, oraz na czym warto skupić
                        uwagę.</span>
                </div>
                <div>

                </div>
            </div>
            <div class="min-width">
                <div class="result-score-holder">
                    <div class="print-header">
                        <p>Oto Co Zauważyliśmy</p>
                        <button id='download-pdf-btn' class='download'>Pobierz PDF</button>
                    </div>

                    <ul class="result-descriptions">
                        <?php foreach ($array_to_be_used as $key => $value): ?>
                            <li <?php echo $part_a_result == 'Positive' ? 'class="positive"' : 'class="negative"'; ?>>
                                <div class="result-description-icon">
                                    <?php echo $value['svg']; ?>
                                </div>
                                <div class="result-description-text">
                                    <p class="result-description-title"><?php echo $value['title']; ?></p>
                                    <p class="result-description-description"><?php echo $value['description']; ?></p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class=" d-flex flex-column gap-4">
                    <button id='show-breakdown-btn' class='breakdown'>Zobacz Szczegółową Ocenę</button>
                    <button id='download-pdf-btn-mobile' class='download mobile'>Pobierz PDF</button>
                    </div>
                </div>

                <!-- Breakdown section -->
                <div id="pdf-breakdown" class="offscreen" style="display: none;">
                    <h2>Tabela Odpowiedzi Użytkownika</h2>
                    <div class="all-parts-container">
                        <?php get_template_part('template-parts/breakdown'); ?>
                    </div>
                </div>
            </div>


        </main>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const breakdownBtn = document.getElementById('show-breakdown-btn');
                const breakdownBtnMobile = document.querySelector('#show-breakdown-btn-mobile'); // In case there's a mobile version
                const breakdownSection = document.getElementById('pdf-breakdown');
                const quizResultContainer = document.querySelector('.quiz-result');
                const bodyElement = document.body;

                // Add animation styles to the head of the document
                const styleElement = document.createElement('style');
                styleElement.textContent = `
        #pdf-breakdown {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-in-out, opacity 0.5s ease-in-out, margin 0.5s ease-in-out;
            opacity: 0;
            margin-top: 0;
            margin-bottom: 0;
            display: flex;
            flex-direction: column;
        }
        
        #pdf-breakdown.open {
            max-height: 5000px; /* Large enough to accommodate content */
            opacity: 1;
            margin-top: 20px;
            margin-bottom: 20px;
            max-width: 1500px;
            width: 100%;
        }
        
        /* CSS classes for overflow management */
        .overflow-visible {
            overflow: auto !important;
            height: auto !important;
            background-size: cover !important;
            background-image: none !important;
            transition:  background-image 0.5s ease-in-out, opacity 0.5s ease-in-out, margin 0.5s ease-in-out;
        }
        
        .overflow-hidden {
            overflow: hidden !important;
        }
    `;
                document.head.appendChild(styleElement);

                // Initialize breakdown section style
                breakdownSection.style.display = 'flex'; // Make it initially block but max-height: 0
                breakdownSection.classList.remove('offscreen');

                // Function to toggle the breakdown visibility with animation
                function toggleBreakdown() {
                    // Toggle the open class which controls the animation
                    breakdownSection.classList.toggle('open');

                    // Update button text based on the current state
                    const isOpen = breakdownSection.classList.contains('open');

                    // Manage overflow on body and quiz-result container
                    if (isOpen) {
                        // When showing breakdown, allow overflow
                        bodyElement.classList.add('overflow-visible');
                        quizResultContainer.classList.add('overflow-visible');

                        // Scroll to the breakdown section
                        setTimeout(() => {
                            breakdownSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }, 100);
                    } else {
                        // When hiding breakdown, after animation is complete, restore hidden overflow
                        setTimeout(() => {
                            bodyElement.classList.remove('overflow-visible');
                            quizResultContainer.classList.remove('overflow-visible');
                        }, 500); // This matches the transition duration
                    }

                    // Update text on both buttons if they exist
                    breakdownBtn.textContent = isOpen ? 'Ukryj szczegóły' : 'Zobacz Szczegółową Ocenę';
                    if (breakdownBtnMobile) {
                        breakdownBtnMobile.textContent = isOpen ? 'Ukryj szczegóły' : 'Zobacz Szczegółową Ocenę';
                    }
                }

                // Add click event to the main button
                breakdownBtn.addEventListener('click', toggleBreakdown);

                // Add click event to the mobile button if it exists
                if (breakdownBtnMobile) {
                    breakdownBtnMobile.addEventListener('click', toggleBreakdown);
                }
            });        
        </script>
    <?php else: ?>
        <p>Nie znaleziono wyniku testu.</p>
    <?php endif; ?>
<?php else: ?>
    <p>Nieprawidłowy wynik testu.</p>
<?php endif;

get_footer();
?>