<?php
/**
 * Template Name: Quiz Result Page
 */
get_header();

$result_id = get_query_var('quiz_id', 0);

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

        $part_a_score = 0;
        $part_b_score = 0;
        $total_possible_points = isset($quiz_data[21]) ? $quiz_data[21] : 0;

        // Loop through each question
        foreach ($questions_data as $question) {
            if (isset($question['multicategories']) && isset($question['points'])) {
                $categories = $question['multicategories'];
                $points = intval($question['points']);

                // Category 5 is Part A, Category 6 is Part B (based on your data)
                if (in_array(5, $categories)) {
                    $part_a_score += $points;
                } elseif (in_array(6, $categories)) {
                    $part_b_score += $points;
                }
            }
        }

        $total_score = $part_a_score + $part_b_score;

        // Define score ranges and descriptions
        $score_descriptions = array(
            array(
                'range' => array(0, 7),
                'title' => 'Mało prawdopodobne ADHD',
                'description' => 'Twój wynik sugeruje, że ADHD jest mało prawdopodobne. Jeśli jednak odczuwasz znaczące trudności, warto skonsultować się ze specjalistą.',
                'color' => '#4CAF50', // Green
                'test' => 'test'
            ),
            array(
                'range' => array(8, 15),
                'title' => 'Łagodne objawy ADHD',
                'description' => 'Twój wynik wskazuje na łagodne objawy ADHD. Możliwe, że doświadczasz pewnych trudności z koncentracją lub impulsywnością, ale nie na poziomie klinicznym.',
                'color' => '#FFC107' // Amber
            ),
            array(
                'range' => array(16, 24),
                'title' => 'Umiarkowane objawy ADHD',
                'description' => 'Twój wynik sugeruje umiarkowane nasilenie objawów ADHD. Zalecana jest konsultacja z lekarzem psychiatrą lub psychologiem w celu dokładniejszej diagnozy.',
                'color' => '#FF9800' // Orange
            ),
            array(
                'range' => array(25, 40),
                'title' => 'Znaczące objawy ADHD',
                'description' => 'Twój wynik wskazuje na znaczące nasilenie objawów ADHD. Zdecydowanie zalecana jest konsultacja ze specjalistą w celu przeprowadzenia pełnej diagnozy i omówienia możliwości leczenia.',
                'color' => '#F44336' // Red
            )
        );

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
        ?>

        <main class='quiz-result' id='quiz-result-container'
            style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/home/Test_assesstment_BG.webp');">
            <div class="header-holder">
                <a href="<?php echo get_home_url(); ?>"> <span>Dom</span> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="#17462B" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path
                            d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                    </svg></a>
                <div class="text-holder">
                    <h1>Podstawowa punktacja</h1>
                    <span>Obiektywna ocena nasilenia objawów ADHD (Skala 0-40)</span>
                </div>
                <div>

                </div>
            </div>
            <div class="min-width">
                <div class="result-score-holder">
                    <h2>Twój wynik testu</h2>

                    <div class="score-section">
                        <p><strong>Część A:</strong> <?php echo esc_html($part_a_score); ?> punktów</p>
                        <p><strong>Część B:</strong> <?php echo esc_html($part_b_score); ?> punktów</p>
                        <p class="total-score"><strong>Wynik całkowity:</strong> <?php echo esc_html($total_score); ?> / 40</p>
                    </div>

                    <?php if ($current_description): ?>
                        <div class="result-description"
                            style="border: 2px solid <?php echo esc_attr($current_description['color']); ?>; padding: 20px; margin: 20px 0; border-radius: 8px;">
                            <h2 style="color: <?php echo esc_attr($current_description['color']); ?>;">
                                <?php echo esc_html($current_description['title']); ?>
                            </h2>
                            <p><?php echo esc_html($current_description['description']); ?></p>
                            <span><?php echo esc_html($current_description['test']); ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="result-details">
                        <p><strong>Jak interpretować wynik:</strong></p>
                        <ul>
                            <li><span style="color: #4CAF50;">0-7 punktów</span>: Mało prawdopodobne ADHD</li>
                            <li><span style="color: #FFC107;">8-15 punktów</span>: Łagodne objawy ADHD</li>
                            <li><span style="color: #FF9800;">16-24 punktów</span>: Umiarkowane objawy ADHD</li>
                            <li><span style="color: #F44336;">25-40 punktów</span>: Znaczące objawy ADHD</li>
                        </ul>
                    </div>

                    <div class="disclaimer">
                        <p><em>Uwaga: Ten test jest narzędziem przesiewowym i nie zastępuje profesjonalnej diagnozy. Jeśli masz
                                obawy dotyczące ADHD, skonsultuj się ze specjalistą zdrowia psychicznego.</em></p>
                    </div>

                    <div class="action-buttons">
                        <button id='download-pdf-btn' class='button button-primary'>Pobierz wyniki jako PDF</button>
                        <button id='share-result-btn' class='button button-secondary' data-bs-toggle="modal"
                            data-bs-target="#shareModal">Udostępnij wynik</button>
                    </div>
                </div>
            </div>
        </main>

        <!-- Share Modal -->
        <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="shareModalLabel">Pobierz swój wynik</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <div class="user-avatar d-inline-block rounded-circle bg-purple p-3"
                                style="width: 60px; height: 60px;">
                                <span class="text-white fs-4">JM</span>
                            </div>
                        </div>

                        <div class="share-options d-flex justify-content-center gap-4 mb-4">
                            <a href="mailto:?subject=Mój wynik testu ADHD&body=Sprawdź mój wynik testu ADHD: <?php echo esc_url($share_url); ?>"
                                class="text-center text-decoration-none">
                                <div class="share-icon bg-success rounded-circle d-flex align-items-center justify-content-center mb-2"
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-envelope-fill text-white fs-5"></i>
                                </div>
                                <span>email</span>
                            </a>

                            <a href="#" class="text-center text-decoration-none">
                                <div class="share-icon bg-dark rounded-circle d-flex align-items-center justify-content-center mb-2"
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-chat-fill text-white fs-5"></i>
                                </div>
                                <span>message</span>
                            </a>
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="share-link" value="<?php echo esc_url($share_url); ?>"
                                readonly>
                            <button class="btn btn-success" type="button" id="copy-link-btn">Copy</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JavaScript for copy functionality -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const copyLinkBtn = document.getElementById('copy-link-btn');
                const shareLinkInput = document.getElementById('share-link');

                // Function to extract quiz_id from the URL
                function getQuizId() {
                    const urlParams = new URLSearchParams(window.location.search);
                    let quizId = urlParams.get('quiz_id');

                    if (!quizId) {
                        const pathParts = window.location.pathname.split('/').filter(Boolean);
                        const lastPart = pathParts[pathParts.length - 1];

                        if (lastPart && !isNaN(lastPart)) {
                            quizId = lastPart;
                        }
                    }

                    return quizId || '';
                }

                const quizId = getQuizId();

                // Format the URL in the preferred format
                let formattedUrl;
                if (quizId) {
                    formattedUrl = window.location.origin + '/quiz/result/' + quizId;
                } else {
                    formattedUrl = window.location.href;
                }

                // Set the formatted URL as the value of the input field
                shareLinkInput.value = formattedUrl;

                copyLinkBtn.addEventListener('click', function () {
                    // Copy text using the modern clipboard API with fallback
                    try {
                        navigator.clipboard.writeText(shareLinkInput.value).then(function () {
                            // Update button text temporarily
                            const originalText = copyLinkBtn.textContent;
                            copyLinkBtn.textContent = 'Copied!';

                            setTimeout(function () {
                                copyLinkBtn.textContent = originalText;
                            }, 2000);
                        });
                    } catch (err) {
                        // Fallback for browsers that don't support the clipboard API
                        shareLinkInput.select();
                        shareLinkInput.setSelectionRange(0, 99999);
                        document.execCommand('copy');

                        // Update button text temporarily
                        const originalText = copyLinkBtn.textContent;
                        copyLinkBtn.textContent = 'Copied!';

                        setTimeout(function () {
                            copyLinkBtn.textContent = originalText;
                        }, 2000);
                    }
                });
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