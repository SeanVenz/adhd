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

        $part_a_score = 0;
        $part_b_score = 0;
        $part_c_score = 0;
        $part_d_score = 0;
        $total_possible_points = isset($quiz_data[21]) ? $quiz_data[21] : 0;

        // Loop through each question
        foreach ($questions_data as $question) {
            if (isset($question['multicategories']) && isset($question['points'])) {
                $categories = $question['multicategories'];
                $points = intval($question['points']);

                // Category 5 is Part A, Category 6 is Part B (based on your data)
                if (in_array(6, $categories)) {
                    $part_a_score += $points;
                } elseif (in_array(7, $categories)) {
                    $part_b_score += $points;
                } elseif (in_array(8, $categories)) {
                    $part_c_score += $points;
                } elseif (in_array(9, $categories)) {
                    $part_d_score += $points;
                }
            }
        }

        $total_score = $part_a_score + $part_b_score + $part_c_score + $part_d_score;

        // Definicja zakresów wyników i opisów
        $score_descriptions = array(
            array(
                'range' => array(0, 7),
                'title' => 'Niski poziom objawów ADHD',
                'description' => 'Twoje wyniki wskazują na minimalne trudności związane z ADHD. Zazwyczaj dobrze radzisz sobie z koncentracją, organizacją i kontrolą impulsów. Sporadyczne rozproszenie nie wpływa znacząco na codzienne funkcjonowanie. Skuteczne zarządzanie czasem może jeszcze bardziej zwiększyć produktywność.'
            ),
            array(
                'range' => array(8, 15),
                'title' => 'Łagodne objawy ADHD',
                'description' => 'Twoje wyniki sugerują pewne trudności z koncentracją, impulsywnością lub organizacją. Możesz czasem zapominać o zadaniach lub łatwo się rozpraszać, ale są to wyzwania do opanowania. Ustalanie rutyn i stosowanie technik uważności może pomóc. W razie potrzeby warto skonsultować się ze specjalistą.'
            ),
            array(
                'range' => array(16, 40),
                'title' => 'Umiarkowane objawy ADHD',
                'description' => 'Twoje wyniki wskazują na zauważalne trudności związane z ADHD, które mogą wpływać na koncentrację, impulsywność i organizację. Korzystanie z uporządkowanych strategii, takich jak narzędzia do planowania i przypomnienia, może pomóc. Warto rozważyć konsultację ze specjalistą, aby uzyskać spersonalizowane porady.'
            ),
            array(
                'range' => array(41, 80),
                'title' => 'Silne objawy ADHD',
                'description' => 'Twoje wyniki sugerują znaczące trudności związane z ADHD, które mogą istotnie wpływać na codzienne funkcjonowanie. Możesz mieć trudności z silnym rozpraszaniem się, impulsywnością i organizacją. Zalecane jest skorzystanie z pomocy specjalisty, takiej jak terapia, coaching lub konsultacja medyczna. Wprowadzenie uporządkowanych rutyn i systemów wsparcia może pomóc w lepszym radzeniu sobie z objawami.'
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

        $scores = [
            'Kontrola uwagi' => [
                'score' => $part_a_score,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"><path fill="#17462B" d="m17.545 15.467l-3.779-3.779a6.15 6.15 0 0 0 .898-3.21c0-3.417-2.961-6.377-6.378-6.377A6.185 6.185 0 0 0 2.1 8.287c0 3.416 2.961 6.377 6.377 6.377a6.15 6.15 0 0 0 3.115-.844l3.799 3.801a.953.953 0 0 0 1.346 0l.943-.943c.371-.371.236-.84-.135-1.211M4.004 8.287a4.28 4.28 0 0 1 4.282-4.283c2.366 0 4.474 2.107 4.474 4.474a4.284 4.284 0 0 1-4.283 4.283c-2.366-.001-4.473-2.109-4.473-4.474"/></svg>'
            ],
            'Realizacja zadań' => [
                'score' => $part_b_score,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48"><g fill="none" stroke="#17462B" stroke-linejoin="round" stroke-width="4"><path d="M24 44a19.94 19.94 0 0 0 14.142-5.858A19.94 19.94 0 0 0 44 24a19.94 19.94 0 0 0-5.858-14.142A19.94 19.94 0 0 0 24 4A19.94 19.94 0 0 0 9.858 9.858A19.94 19.94 0 0 0 4 24a19.94 19.94 0 0 0 5.858 14.142A19.94 19.94 0 0 0 24 44Z"/><path stroke-linecap="round" d="m16 24l6 6l12-12"/></g></svg>'
            ],
            'Impulsywność i decyzje' => [
                'score' => $part_c_score,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="#17462B" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12.748 3.572c.059-.503-.532-.777-.835-.388L4.111 13.197c-.258.33-.038.832.364.832h6.988c.285 0 .506.267.47.57l-.68 5.83c-.06.502.53.776.834.387l7.802-10.013c.258-.33.038-.832-.364-.832h-6.988c-.285 0-.506-.267-.47-.57z"/></svg>'
            ],
            'Organizacja i planowanie' => [
                'score' => $part_d_score,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48"><g fill="none" stroke="#17462B" stroke-width="4"><path stroke-linejoin="round" d="M5 19h38v22a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2zm0-9a2 2 0 0 1 2-2h34a2 2 0 0 1 2 2v9H5z"/><path stroke-linecap="round" stroke-linejoin="round" d="m16 31l6 6l12-12"/><path stroke-linecap="round" d="M16 5v8m16-8v8"/></g></svg>'
            ]
        ];
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
                    <span>Obiektywna ocena nasilenia objawów ADHD (Skala 0-80)</span>
                </div>
                <div>

                </div>
            </div>
            <div class="min-width">
                <div class="result-score-holder">
                    <?php if ($current_description): ?>
                        <div class="result-description">
                            <span>Twój wynik</span>
                            <div class="total">
                                <p class="total-score"><span><?php echo esc_html($total_score); ?></span> z 80</p>
                            </div>
                            <div class="desc">
                                <h2>
                                    <?php echo esc_html($current_description['title']); ?>
                                </h2>
                                <p><?php echo esc_html($current_description['description']); ?></p>
                            </div>
                            <div class="action-buttons-mobile">
                                <button id='download-pdf-btn-mobile' class='download'>Pobierz wyniki jako PDF</button>
                                <button id='share-result-btn' class='share' data-bs-toggle="modal"
                                    data-bs-target="#shareModal">Udostępnij wynik</button>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="result-details">
                        <div class="header">
                            <p><strong>Podsumowanie</strong></p>
                            <ul>
                                <?php foreach ($scores as $label => $data): ?>
                                    <li>
                                        <span><?php echo $data['icon']; ?><?php echo esc_html($label); ?></span>
                                        <span><?php echo esc_html($data['score']); ?> / 20</span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="action-buttons">
                            <button id='download-pdf-btn' class='download'>Pobierz wyniki jako PDF</button>
                            <button id='share-result-btn' class='share' data-bs-toggle="modal"
                                data-bs-target="#shareModal">Udostępnij wynik</button>
                        </div>
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
                        <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16" fill="#17462B">
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="share-options d-flex justify-content-start mb-4">
                            <a href="mailto:?subject=Mój wynik testu ADHD&body=Sprawdź mój wynik testu ADHD: <?php echo esc_url($share_url); ?>"
                                class="text-center text-decoration-none">
                                <div class="share-icon rounded-circle d-flex align-items-center justify-content-center mb-2"
                                    style="width: 50px; height: 50px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="none" stroke="#F8FAFC" stroke-width="1.5">
                                            <rect width="18.5" height="17" x="2.682" y="3.5" rx="4" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m2.729 7.59l7.205 4.13a3.96 3.96 0 0 0 3.975 0l7.225-4.13" />
                                        </g>
                                    </svg>
                                </div>
                                <span>email</span>
                            </a>

                            <a href="#" class="text-center text-decoration-none">
                                <div class="share-icon rounded-circle d-flex align-items-center justify-content-center mb-2"
                                    style="width: 50px; height: 50px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="none" stroke="#F8FAFC" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M3.464 16.828C2 15.657 2 14.771 2 11s0-5.657 1.464-6.828C4.93 3 7.286 3 12 3s7.071 0 8.535 1.172S22 7.229 22 11s0 4.657-1.465 5.828C19.072 18 16.714 18 12 18c-2.51 0-3.8 1.738-6 3v-3.212c-1.094-.163-1.899-.45-2.536-.96" />
                                    </svg>
                                </div>
                                <span>message</span>
                            </a>
                        </div>

                        <div class="input-group mb-3 flex flex-row align-items-center">
                            <input type="text" class="form-control" id="share-link" value="<?php echo esc_url($share_url); ?>"
                                readonly>
                            <button class="copy" type="button" id="copy-link-btn">Kopia</button>
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
                    formattedUrl = window.location.origin + '/rozpocznij-test/wynik/' + quizId;
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
                            copyLinkBtn.textContent = 'Zrobione!';

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
                        copyLinkBtn.textContent = 'Zrobione!';

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