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
            </div>
            <div class="min-width">
                <div class="quiz-result-holder">
                    <h1>Your Quiz Results</h1>
                    <p><strong>Part A Score:</strong> <?php echo esc_html($part_a_score); ?></p>
                    <p><strong>Part B Score:</strong> <?php echo esc_html($part_b_score); ?></p>
                    <p><strong>Total Score:</strong> <?php echo esc_html($total_score); ?></p>

                    <button id='download-pdf-btn' class='button button-primary'>Download Results as PDF</button>
                </div>
            </div>
        </main>

    <?php else: ?>
        <p>Quiz result not found.</p>
    <?php endif; ?>
<?php else: ?>
    <p>Invalid quiz result.</p>
<?php endif;

get_footer();
?>