<?php
/**
 * Template Name: Quiz Result Page
 */
get_header();

function check_shaded_responses($questions, $shaded_responses)
{
    $shaded_response_count = 0;
    $log = [];

    // Map text responses to numerical values
    $response_values = [
        'Nigdy' => 0,
        'Rzadko' => 1,
        'Czasami' => 2,
        'Często' => 3,
        'Bardzo często' => 4
    ];

    // Process only the first 6 questions (Part A)
    for ($i = 1; $i <= 6; $i++) {
        if (!isset($questions[$i - 1])) {
            continue; // Skip if question doesn't exist
        }

        $question = $questions[$i - 1];

        // Get user's answer
        $user_answer_value = null;
        if (isset($question['user_answer'])) {
            if (is_array($question['user_answer']) && !empty($question['user_answer'])) {
                $user_answer = function_exists('array_key_first') ?
                    array_key_first($question['user_answer']) :
                    reset(array_keys($question['user_answer']));
                $user_answer_value = intval($user_answer);
            } else {
                $user_answer_value = intval($question['user_answer']);
            }
        }

        // Get the text representation of the answer
        $user_answer_text = array_search($user_answer_value, $response_values);

        // Check if the answer is in the shaded responses for this question
        if (isset($shaded_responses[$i]) && in_array($user_answer_text, $shaded_responses[$i])) {
            $shaded_response_count++;
            $log[] = "Question {$i}: '{$user_answer_text}' is a shaded response. Count is now {$shaded_response_count}.";
        } else {
            $log[] = "Question {$i}: '{$user_answer_text}' is NOT a shaded response. Count remains {$shaded_response_count}.";
        }
    }

    return [
        'count' => $shaded_response_count,
        'log' => $log
    ];
}

$url = $_SERVER['REQUEST_URI'];
$segments = explode('/', rtrim($url, '/'));
$result_id = intval(end($segments));

if ($result_id > 0):
    global $wpdb;
    $table_results = $wpdb->prefix . "mlw_results";

    // Fetch Quiz Result
    $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_results WHERE result_id = %d", $result_id));

    if ($result):
        // Unserialize the quiz_results field
        $quiz_results = unserialize($result->quiz_results);

        // Ensure quiz_results is an array
        if (is_array($quiz_results)):
            // Use key 1 if exists; otherwise, use an empty array
            $questions = isset($quiz_results[1]) && is_array($quiz_results[1]) ? $quiz_results[1] : [];

            // Check if questions array exists
            if (!empty($questions) && is_array($questions)):
                // Find all unique categories in the questions
                $category_ids = [];
                foreach ($questions as $question) {
                    if (isset($question['multicategories']) && is_array($question['multicategories'])) {
                        foreach ($question['multicategories'] as $cat_id) {
                            if (!isset($category_ids[$cat_id])) {
                                $category_ids[$cat_id] = true;
                            }
                        }
                    }
                }

                // Get category names from database
                $category_names = [];
                if (!empty($category_ids)) {
                    $cat_id_list = implode(',', array_map('intval', array_keys($category_ids)));
                    $table_categories = $wpdb->prefix . "terms";
                    $table_taxonomy = $wpdb->prefix . "term_taxonomy";

                    $category_results = $wpdb->get_results("
                        SELECT t.term_id, t.name 
                        FROM $table_categories AS t 
                        INNER JOIN $table_taxonomy AS tt ON t.term_id = tt.term_id
                        WHERE tt.taxonomy = 'qsm_category' 
                        AND t.term_id IN ($cat_id_list)
                    ");

                    foreach ($category_results as $cat) {
                        $category_names[$cat->term_id] = $cat->name;
                    }
                }

                // Initialize categories structure
                $categories = [];
                foreach (array_keys($category_ids) as $cat_id) {
                    $categories[$cat_id] = [
                        'questions' => [],
                        'score' => 0,
                        'name' => isset($category_names[$cat_id]) ? $category_names[$cat_id] : 'Category ' . $cat_id
                    ];
                }

                // Group questions by category
                foreach ($questions as $question) {
                    if (isset($question['multicategories']) && isset($question['points'])) {
                        $question_categories = $question['multicategories'];
                        $points = intval($question['points']);

                        foreach ($question_categories as $cat_id) {
                            if (isset($categories[$cat_id])) {
                                $categories[$cat_id]['questions'][] = $question;
                                $categories[$cat_id]['score'] += $points;
                            }
                        }
                    }
                }

                // Calculate total score across all categories
                $total_score = 0;
                foreach ($categories as $cat_data) {
                    $total_score += $cat_data['score'];
                }

                // Define shaded responses criteria
                $shaded_responses = [
                    1 => ['Czasami', 'Często', 'Bardzo często'],
                    2 => ['Czasami', 'Często', 'Bardzo często'],
                    3 => ['Czasami', 'Często', 'Bardzo często'],
                    4 => ['Często', 'Bardzo często'],
                    5 => ['Często', 'Bardzo często'],
                    6 => ['Często', 'Bardzo często'],
                ];

                // Get Part A questions
                $part_a_questions = [];
                $category_ids_array = array_keys($categories);
                sort($category_ids_array);
                if (!empty($category_ids_array)) {
                    $first_category_id = $category_ids_array[0]; // First category is Part A
                    $part_a_questions = array_slice($categories[$first_category_id]['questions'], 0, 6);
                }

                // Check shaded responses
                $shaded_result = check_shaded_responses($part_a_questions, $shaded_responses);
                $shaded_response_count = $shaded_result['count'];

                // Log the results if needed
                foreach ($shaded_result['log'] as $log_entry) {
                    error_log($log_entry);
                }

                // Get current URL to share
                $share_url = get_permalink() . '?quiz_id=' . $result_id;

                $positive = [
                    'first' => [
                        'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="74" height="74" viewBox="0 0 256 256"><path fill="currentColor" d="m223.68 66.15l-88-48.15a15.88 15.88 0 0 0-15.36 0l-88 48.17a16 16 0 0 0-8.32 14v95.64a16 16 0 0 0 8.32 14l88 48.17a15.88 15.88 0 0 0 15.36 0l88-48.17a16 16 0 0 0 8.32-14V80.18a16 16 0 0 0-8.32-14.03M128 120L47.65 76L128 32l80.35 44Zm8 99.64v-85.81l80-43.78v85.76Z"/></svg>',
                        'title' => 'Co to oznacza?',
                        'description' => 'Twoje odpowiedzi wskazują na objawy często związane z ADHD. Mogą one obejmować wzorce nieuwagi, niepokoju lub impulsywności.'
                    ],
                    'second' => [
                        'title' => 'Pozytywny',
                        'description' => 'Zidentyfikowano oznaki ADHD'
                    ],
                    'third' => [
                        'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="74" height="74" viewBox="0 0 256 256"><path fill="currentColor" d="m223.68 66.15l-88-48.15a15.88 15.88 0 0 0-15.36 0l-88 48.17a16 16 0 0 0-8.32 14v95.64a16 16 0 0 0 8.32 14l88 48.17a15.88 15.88 0 0 0 15.36 0l88-48.17a16 16 0 0 0 8.32-14V80.18a16 16 0 0 0-8.32-14.03M128 120L47.65 76L128 32l80.35 44Zm8 99.64v-85.81l80-43.78v85.76Z"/></svg>',
                        'title' => 'Kontynuuj proces diagnostyczny',
                        'description' => 'Zapoznaj się z informacjami zamieszczonymi na naszej stronie. Publikujemy pełen proces diagnostyczny rekomendowany przez Polskie Towarzystwo Psychiatryczne'
                    ],
                ];

                $negative = [
                    'first' => [
                        'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="74" height="74" viewBox="0 0 256 256"><path fill="currentColor" d="m223.68 66.15l-88-48.15a15.88 15.88 0 0 0-15.36 0l-88 48.17a16 16 0 0 0-8.32 14v95.64a16 16 0 0 0 8.32 14l88 48.17a15.88 15.88 0 0 0 15.36 0l88-48.17a16 16 0 0 0 8.32-14V80.18a16 16 0 0 0-8.32-14.03M128 120L47.65 76L128 32l80.35 44Zm8 99.64v-85.81l80-43.78v85.76Z"/></svg>',
                        'title' => 'Co to oznacza?',
                        'description' => 'Twoje odpowiedzi nie wskazują na wyraźne oznaki ADHD. Wszelkie rozproszenia, których doświadczasz, mieszczą się w typowym zakresie.'
                    ],
                    'second' => [
                        'title' => 'Negatywny',
                        'description' => 'Niskie prawdopodobieństwo ADHD'
                    ],
                    'third' => [
                        'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="74" height="74" viewBox="0 0 256 256"><path fill="currentColor" d="m223.68 66.15l-88-48.15a15.88 15.88 0 0 0-15.36 0l-88 48.17a16 16 0 0 0-8.32 14v95.64a16 16 0 0 0 8.32 14l88 48.17a15.88 15.88 0 0 0 15.36 0l88-48.17a16 16 0 0 0 8.32-14V80.18a16 16 0 0 0-8.32-14.03M128 120L47.65 76L128 32l80.35 44Zm8 99.64v-85.81l80-43.78v85.76Z"/></svg>',
                        'title' => 'Chcesz skonsultować wyniki?',
                        'description' => 'Jeśli wciąż masz pytania lub obawy, umów się na konsultację ze specjalistą.'
                    ],
                ];

                $array_to_be_used = $shaded_response_count >= 4 ? $positive : $negative;
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
                            <h1>Wynik twojego testu ASRS</h1>
                            <span>Ta ocena opiera się na Twoich odpowiedziach. Zapoznaj się z poniższymi informacjami.</span>
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
                                    <li <?php echo $shaded_response_count >= 4 ? 'class="positive"' : 'class="negative"'; ?>>
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
                            <h2>Szczegółowe wyniki testu ASRS</h2>
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
                <?php
            else:
                echo '<p>No questions found in the results.</p>';
            endif;
        else:
            echo '<p>Invalid quiz results format.</p>';
        endif;
    else:
        echo '<p>Result not found.</p>';
    endif;
else:
    echo '<p>Invalid result ID.</p>';
endif;

get_footer();
?>