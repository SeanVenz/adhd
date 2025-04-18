<?php

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
                ?>
                <style>
                    .quiz-container {
                        width: 100%;
                        text-align: center;
                        margin-bottom: 0;
                        overflow: hidden;
                    }

                    .quiz-container thead tr:first-child th:first-child {
                        max-width: 800px !important;
                        width: 54%;
                    }

                    .quiz-container th,
                    .quiz-container td {
                        border: 1px solid #17462B
                    }

                    .quiz-container th {
                        background-color: #1E5837;
                        color: white;
                        text-align: left;
                        font-family: 'Manrope';
                        font-weight: 600;
                        font-size: 16px;
                    }

                    .highlight {
                        background-color: #DAF4E7;
                        color: #17462B;
                        font-weight: bold;
                    }

                    .question-col {
                        text-align: left;
                        word-wrap: break-word;
                        width: 800px;
                        padding: 24px;
                        white-space: normal;
                        color: #17462B;
                        font-family: 'Manrope';
                        font-weight: 400;
                        font-size: 16px;
                    }

                    .summary-row {
                        background-color: #F9E9DD;
                        font-family: Manrope;
                        font-weight: 700;
                        font-size: 16px;
                        color: #17462B;
                    }

                    .summary-row td {
                        border: 1px solid #17462B;
                        padding: 24px;
                    }

                    thead th {
                        padding: 16px 24px;
                    }

                    @media(max-width: 768px) {
                        .quiz-container {
                            table-layout: fixed;
                            width: 100%;
                            border-collapse: collapse;
                        }

                        .quiz-container tr {
                            height: 50px;
                        }

                        .quiz-container td {
                            height: 50px;
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                        }

                        .quiz-container thead {
                            height: 50px;
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                        }

                        .question-col {
                            padding: 12px;
                            font-size: 12px;
                        }

                        .quiz-container td {
                            padding: 6px;
                        }

                        thead th {
                            padding: 4px 8px;
                        }

                        tbody tr {
                            max-height: 92px;
                            height: 100%;
                        }

                        .quiz-container th {
                            font-size: 12px
                        }

                        .summary-row {
                            font-size: 12px;
                        }

                        .highlight {
                            font-size: 12px;
                        }
                    }
                </style>

                <table class="quiz-container">
                    <thead>
                        <tr>
                            <th>Pytanie</th>
                            <th>0 <span class="d-none d-md-inline"> - Nigdy</span></th>
                            <th>1 <span class="d-none d-md-inline"> - Rzadko</span></th>
                            <th>2 <span class="d-none d-md-inline"> - Czasami</span></th>
                            <th>3 <span class="d-none d-md-inline"> - Często</span></th>
                            <th>4 <span class="d-none d-md-inline"> - Bardzo często</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Function to display questions with a running question number
                        function display_questions($questions, &$question_counter)
                        {
                            foreach ($questions as $question): ?>
                                <tr>
                                    <td class="question-col">
                                        <?php
                                        $question_number = $question_counter++;
                                        echo esc_html("{$question_number}. " . ($question['question_title'] ?? 'No question title'));
                                        ?>
                                    </td>
                                    <?php
                                    // Determine the user's answer.
                                    if (isset($question['user_answer'])) {
                                        if (is_array($question['user_answer']) && !empty($question['user_answer'])) {
                                            $user_answer = function_exists('array_key_first') ? array_key_first($question['user_answer']) : reset(array_keys($question['user_answer']));
                                        } else {
                                            $user_answer = intval($question['user_answer']);
                                        }
                                    } else {
                                        $user_answer = null;
                                    }

                                    for ($i = 0; $i <= 4; $i++):
                                        $class = ($i === $user_answer) ? 'highlight' : '';
                                        echo "<td class='$class'>" . ($i === $user_answer ? "✔" : "") . "</td>";
                                    endfor;
                                    ?>
                                </tr>
                            <?php endforeach;
                        }

                        // Get category IDs sorted in the order we want to display them
                        $category_ids = array_keys($categories);
                        sort($category_ids);

                        $test_index = 0;
                        $question_counter = 1; // Start question numbering from 1
        
                        // Display each category's questions and summary
                        foreach ($category_ids as $cat_id):
                            $cat_data = $categories[$cat_id];
                            $cat_questions = $cat_data['questions'];

                            if (empty($cat_questions)) {
                                continue;
                            }

                            $test_label = 'Test ' . chr(65 + $test_index);
                            $test_index++;

                            display_questions($cat_questions, $question_counter);

                            ?>
                            <!-- Category Summary Row -->
                            <tr class="summary-row">
                                <td style="text-align: center;" colspan="4">Wynik całkowity</td>
                                <td style="background-color: #F9E9DD; text-align: center;"><?php echo esc_html($test_label); ?></td>
                                <td style="background-color: #F9E9DD; text-align: center;"><?php echo $cat_data['score']; ?></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>

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
?>