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

                $array_to_be_used = $shaded_response_count >= 4 ? $positive : $negative;
                ?>

                <main class='quiz-result' id='quiz-result-container'>
                    <div class="header-holder">
                        <a href="<?php echo get_home_url(); ?>"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg><span>Wróć</span></a>
                        <div class="text-holder">
                            <h1><?php echo esc_html(get_field('results_title')); ?></h1>
                            <span><?php echo esc_html(get_field('results_sub_title')); ?></span>
                        </div>
                        <div>

                        </div>
                    </div>
                    <div class="min-width">
                        <div class="result-score-holder">
                            <div class="print-header">
                                <p><?php echo esc_html(get_field('results_detailed_answer')); ?></p>
                                <button id='download-pdf-btn'
                                    class='download'><?php echo esc_html(get_field('download_pdf_button')); ?></button>
                            </div>

                            <ul class="result-descriptions">
                                <?php if ($shaded_response_count >= 4): ?>
                                    <ul class="result-descriptions">
                                        <li class="positive">
                                            <div class="result-description-icon">
                                                <svg width="75" height="74" viewBox="0 0 75 74" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.832031 37C0.832031 16.5655 17.3975 0 37.832 0C58.2666 0 74.832 16.5655 74.832 37V59.6774C74.832 67.5876 68.4196 74 60.5094 74H37.832C17.3975 74 0.832031 57.4345 0.832031 37Z"
                                                        fill="#17462B" />
                                                    <path
                                                        d="M45.9198 20.8242C42.4471 20.8242 39.4698 23.8841 37.832 28.5497C36.1943 23.8841 33.217 20.8242 29.7443 20.8242C24.4536 20.8242 20.3086 27.9296 20.3086 36.9997C20.3086 46.0698 24.4536 53.1752 29.7443 53.1752C33.217 53.1752 36.1943 50.1153 37.832 45.4497C39.4698 50.1153 42.4471 53.1752 45.9198 53.1752C51.2105 53.1752 55.3555 46.0698 55.3555 36.9997C55.3555 27.9296 51.2105 20.8242 45.9198 20.8242ZM34.2802 46.8381C33.0181 49.1515 31.3652 50.4793 29.7443 50.4793C28.1234 50.4793 26.4704 49.1515 25.2084 46.8381C24.3925 45.2909 23.8111 43.6311 23.483 41.913C24.3042 42.2842 25.2054 42.4436 26.1041 42.3766C27.0028 42.3097 27.8704 42.0186 28.6276 41.5299C29.3848 41.0412 30.0074 40.3705 30.4385 39.5791C30.8696 38.7877 31.0955 37.9009 31.0955 36.9997C31.0955 36.0985 30.8696 35.2117 30.4385 34.4203C30.0074 33.6289 29.3848 32.9582 28.6276 32.4695C27.8704 31.9808 27.0028 31.6897 26.1041 31.6228C25.2054 31.5558 24.3042 31.7152 23.483 32.0864C23.8111 30.3683 24.3925 28.7085 25.2084 27.1613C26.4704 24.8479 28.1234 23.5201 29.7443 23.5201C31.3652 23.5201 33.0181 24.8479 34.2802 27.1613C35.7006 29.7662 36.4841 33.2608 36.4841 36.9997C36.4841 40.7386 35.7006 44.2332 34.2802 46.8381ZM50.4556 46.8381C49.1936 49.1515 47.5407 50.4793 45.9198 50.4793C44.2989 50.4793 42.6459 49.1515 41.3839 46.8381C40.568 45.2909 39.9865 43.6311 39.6585 41.913C40.4797 42.2842 41.3809 42.4436 42.2796 42.3766C43.1783 42.3097 44.0459 42.0186 44.8031 41.5299C45.5602 41.0412 46.1829 40.3705 46.614 39.5791C47.0451 38.7877 47.271 37.9009 47.271 36.9997C47.271 36.0985 47.0451 35.2117 46.614 34.4203C46.1829 33.6289 45.5602 32.9582 44.8031 32.4695C44.0459 31.9808 43.1783 31.6897 42.2796 31.6228C41.3809 31.5558 40.4797 31.7152 39.6585 32.0864C39.9865 30.3683 40.568 28.7085 41.3839 27.1613C42.6459 24.8479 44.2989 23.5201 45.9198 23.5201C47.5407 23.5201 49.1936 24.8479 50.4556 27.1613C51.8761 29.7662 52.6596 33.2608 52.6596 36.9997C52.6596 40.7386 51.8761 44.2332 50.4556 46.8381Z"
                                                        fill="white" />
                                                </svg>
                                            </div>
                                            <div class="result-description-text">
                                                <p class="result-description-title">
                                                    <?php echo esc_html(get_field('positive_first_box_title')); ?></p>
                                                <p class="result-description-description">
                                                    <?php echo esc_html(get_field('positive_first_box_sub_title')); ?></p>
                                            </div>
                                        </li>

                                        <li class="positive">
                                            <div class="result-description-icon">

                                            </div>
                                            <div class="result-description-text">
                                                <p class="result-description-title">
                                                    <?php echo esc_html(get_field('positive_second_box_title')); ?></p>
                                                <p class="result-description-description">
                                                    <?php echo esc_html(get_field('positive_second_box_sub_title')); ?></p>
                                            </div>
                                        </li>

                                        <li class="positive">
                                            <div class="result-description-icon">
                                                <svg width="75" height="74" viewBox="0 0 75 74" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.164062 37C0.164062 16.5655 16.7295 0 37.1641 0C57.5986 0 74.1641 16.5655 74.1641 37V59.6774C74.1641 67.5876 67.7516 74 59.8415 74H37.1641C16.7295 74 0.164062 57.4345 0.164062 37Z"
                                                        fill="#17462B" />
                                                    <path
                                                        d="M24.7788 19.8613H22.6364C21.5 19.8613 20.4101 20.3128 19.6066 21.1163C18.803 21.9199 18.3516 23.0097 18.3516 24.1461V31.6446C18.3516 34.7697 19.593 37.7668 21.8028 39.9766C24.0126 42.1864 27.0097 43.4278 30.1348 43.4278C33.2599 43.4278 36.257 42.1864 38.4668 39.9766C40.6766 37.7668 41.918 34.7697 41.918 31.6446V24.1461C41.918 23.0097 41.4666 21.9199 40.663 21.1163C39.8595 20.3128 38.7696 19.8613 37.6332 19.8613H35.4908"
                                                        stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M29.0622 43.4276C29.0622 45.1157 29.3946 46.7872 30.0406 48.3468C30.6866 49.9064 31.6335 51.3235 32.8271 52.5171C34.0208 53.7107 35.4378 54.6576 36.9974 55.3036C38.557 55.9496 40.2285 56.2821 41.9166 56.2821C43.6047 56.2821 45.2762 55.9496 46.8358 55.3036C48.3954 54.6576 49.8124 53.7107 51.0061 52.5171C52.1997 51.3235 53.1466 49.9064 53.7926 48.3468C54.4386 46.7872 54.771 45.1157 54.771 43.4276V37.0004M35.4894 17.7188V22.0036M24.7773 17.7188V22.0036"
                                                        stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M50.4883 32.7145C50.4883 33.8509 50.9397 34.9408 51.7433 35.7443C52.5468 36.5479 53.6367 36.9993 54.7731 36.9993C55.9095 36.9993 56.9994 36.5479 57.8029 35.7443C58.6065 34.9408 59.0579 33.8509 59.0579 32.7145C59.0579 31.5781 58.6065 30.4882 57.8029 29.6847C56.9994 28.8811 55.9095 28.4297 54.7731 28.4297C53.6367 28.4297 52.5468 28.8811 51.7433 29.6847C50.9397 30.4882 50.4883 31.5781 50.4883 32.7145Z"
                                                        stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <div class="result-description-text">
                                                <p class="result-description-title">
                                                    <?php echo esc_html(get_field('positive_third_box_title')); ?></p>
                                                <p class="result-description-description">
                                                    <?php echo esc_html(get_field('positive_third_box_sub_title')); ?></p>
                                            </div>
                                        </li>
                                    </ul>
                                <?php else: ?>
                                    <ul class="result-descriptions">
                                        <li class="negative">
                                            <div class="result-description-icon">
                                                <svg width="75" height="74" viewBox="0 0 75 74" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.832031 37C0.832031 16.5655 17.3975 0 37.832 0C58.2666 0 74.832 16.5655 74.832 37V59.6774C74.832 67.5876 68.4196 74 60.5094 74H37.832C17.3975 74 0.832031 57.4345 0.832031 37Z"
                                                        fill="#17462B" />
                                                    <path
                                                        d="M45.9198 20.8242C42.4471 20.8242 39.4698 23.8841 37.832 28.5497C36.1943 23.8841 33.217 20.8242 29.7443 20.8242C24.4536 20.8242 20.3086 27.9296 20.3086 36.9997C20.3086 46.0698 24.4536 53.1752 29.7443 53.1752C33.217 53.1752 36.1943 50.1153 37.832 45.4497C39.4698 50.1153 42.4471 53.1752 45.9198 53.1752C51.2105 53.1752 55.3555 46.0698 55.3555 36.9997C55.3555 27.9296 51.2105 20.8242 45.9198 20.8242ZM34.2802 46.8381C33.0181 49.1515 31.3652 50.4793 29.7443 50.4793C28.1234 50.4793 26.4704 49.1515 25.2084 46.8381C24.3925 45.2909 23.8111 43.6311 23.483 41.913C24.3042 42.2842 25.2054 42.4436 26.1041 42.3766C27.0028 42.3097 27.8704 42.0186 28.6276 41.5299C29.3848 41.0412 30.0074 40.3705 30.4385 39.5791C30.8696 38.7877 31.0955 37.9009 31.0955 36.9997C31.0955 36.0985 30.8696 35.2117 30.4385 34.4203C30.0074 33.6289 29.3848 32.9582 28.6276 32.4695C27.8704 31.9808 27.0028 31.6897 26.1041 31.6228C25.2054 31.5558 24.3042 31.7152 23.483 32.0864C23.8111 30.3683 24.3925 28.7085 25.2084 27.1613C26.4704 24.8479 28.1234 23.5201 29.7443 23.5201C31.3652 23.5201 33.0181 24.8479 34.2802 27.1613C35.7006 29.7662 36.4841 33.2608 36.4841 36.9997C36.4841 40.7386 35.7006 44.2332 34.2802 46.8381ZM50.4556 46.8381C49.1936 49.1515 47.5407 50.4793 45.9198 50.4793C44.2989 50.4793 42.6459 49.1515 41.3839 46.8381C40.568 45.2909 39.9865 43.6311 39.6585 41.913C40.4797 42.2842 41.3809 42.4436 42.2796 42.3766C43.1783 42.3097 44.0459 42.0186 44.8031 41.5299C45.5602 41.0412 46.1829 40.3705 46.614 39.5791C47.0451 38.7877 47.271 37.9009 47.271 36.9997C47.271 36.0985 47.0451 35.2117 46.614 34.4203C46.1829 33.6289 45.5602 32.9582 44.8031 32.4695C44.0459 31.9808 43.1783 31.6897 42.2796 31.6228C41.3809 31.5558 40.4797 31.7152 39.6585 32.0864C39.9865 30.3683 40.568 28.7085 41.3839 27.1613C42.6459 24.8479 44.2989 23.5201 45.9198 23.5201C47.5407 23.5201 49.1936 24.8479 50.4556 27.1613C51.8761 29.7662 52.6596 33.2608 52.6596 36.9997C52.6596 40.7386 51.8761 44.2332 50.4556 46.8381Z"
                                                        fill="white" />
                                                </svg>
                                            </div>
                                            <div class="result-description-text">
                                                <p class="result-description-title">
                                                    <?php echo esc_html(get_field('negative_first_box_title')); ?></p>
                                                <p class="result-description-description">
                                                    <?php echo esc_html(get_field('negative_first_box_sub_title')); ?></p>
                                            </div>
                                        </li>

                                        <li class="negative">
                                            <div class="result-description-icon">

                                            </div>
                                            <div class="result-description-text">
                                                <p class="result-description-title">
                                                    <?php echo esc_html(get_field('negative_second_box_title')); ?></p>
                                                <p class="result-description-description">
                                                    <?php echo esc_html(get_field('negative_second_box_subtitle')); ?></p>
                                            </div>
                                        </li>

                                        <li class="negative">
                                            <div class="result-description-icon">
                                                <svg width="75" height="74" viewBox="0 0 75 74" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.164062 37C0.164062 16.5655 16.7295 0 37.1641 0C57.5986 0 74.1641 16.5655 74.1641 37V59.6774C74.1641 67.5876 67.7516 74 59.8415 74H37.1641C16.7295 74 0.164062 57.4345 0.164062 37Z"
                                                        fill="#17462B" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M38.9267 50.6503C48.8311 50.6503 56.8612 43.8665 56.8612 35.5001C56.8612 27.1336 48.8311 20.3477 38.9267 20.3477C29.0224 20.3477 20.9922 27.1314 20.9922 35.5001C20.9922 38.7664 22.2162 41.7929 24.2989 44.2656L22.1131 54.5353L30.892 49.0496C33.4363 50.1151 36.1684 50.6594 38.9267 50.6503Z"
                                                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M38.9256 38.2825C40.0465 38.2825 41.1674 37.1616 41.1674 36.0406C41.1674 34.9197 40.0465 33.7988 38.9256 33.7988C37.8047 33.7988 36.686 34.9197 36.686 36.0406C36.686 37.1616 37.8047 38.2825 38.9256 38.2825ZM29.9583 38.2825C31.0792 38.2825 32.2001 37.1616 32.2001 36.0406C32.2001 34.9197 31.0792 33.7988 29.9583 33.7988C28.8374 33.7988 27.7188 34.9197 27.7188 36.0406C27.7188 37.1616 28.8374 38.2825 29.9583 38.2825ZM47.8928 38.2825C49.0138 38.2825 50.1369 37.1616 50.1369 36.0406C50.1369 34.9197 49.016 33.7988 47.8951 33.7988C46.7742 33.7988 45.6533 34.9197 45.6533 36.0406C45.6533 37.1616 46.7742 38.2825 47.8951 38.2825"
                                                        fill="white" />
                                                </svg>
                                            </div>
                                            <div class="result-description-text">
                                                <p class="result-description-title">
                                                    <?php echo esc_html(get_field('negative_third_box_title')); ?></p>
                                                <p class="result-description-description">
                                                    <?php echo esc_html(get_field('negative_third_box_sub_title')); ?></p>
                                            </div>
                                        </li>
                                    </ul>
                                <?php endif; ?>

                            </ul>
                            <div class=" d-flex flex-column gap-4">
                                <button id='show-breakdown-btn'
                                    class='breakdown'><?php echo esc_html(get_field('show_table_button')); ?></button>
                                <button id='download-pdf-btn-mobile'
                                    class='download mobile'><?php echo esc_html(get_field('download_pdf_button')); ?></button>
                            </div>
                        </div>

                        <!-- Breakdown section -->
                        <div id="pdf-breakdown" class="offscreen" style="display: none;">
                            <h2><?php echo esc_html(get_field('table_header')); ?></h2>
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
                            breakdownBtn.textContent = isOpen ? '<?php echo esc_html(get_field('close_table_button')); ?>' : '<?php echo esc_html(get_field('show_table_button')); ?>';
                            if (breakdownBtnMobile) {
                                breakdownBtnMobile.textContent = isOpen ? '<?php echo esc_html(get_field('close_table_button')); ?>' : '<?php echo esc_html(get_field('show_table_button')); ?>';
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