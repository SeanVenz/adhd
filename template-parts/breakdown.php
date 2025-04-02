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
                // Group questions by part (A, B, C, D)
                $part_a_questions = [];
                $part_b_questions = [];
                $part_c_questions = [];
                $part_d_questions = [];

                // Calculate scores for each part
                $part_a_score = 0;
                $part_b_score = 0;
                $part_c_score = 0;
                $part_d_score = 0;

                // Group questions by category
                foreach ($questions as $question) {
                    if (isset($question['multicategories']) && isset($question['points'])) {
                        $categories = $question['multicategories'];
                        $points = intval($question['points']);

                        if (in_array(5, $categories)) {
                            $part_a_questions[] = $question;
                            $part_a_score += $points;
                        } elseif (in_array(6, $categories)) {
                            $part_b_questions[] = $question;
                            $part_b_score += $points;
                        } elseif (in_array(7, $categories)) {
                            $part_c_questions[] = $question;
                            $part_c_score += $points;
                        } elseif (in_array(8, $categories)) {
                            $part_d_questions[] = $question;
                            $part_d_score += $points;
                        }
                    }
                }

                $total_score = $part_a_score + $part_b_score + $part_c_score + $part_d_score;
                ?>
                <style>
                    .quiz-container {
                        width: 100%;
                        text-align: center;
                        margin-bottom: 0;
                        border-radius: 24px;
                        overflow: hidden;
                    }

                    /* .quiz-container table {
                                                                                                        width: 100%;
                                                                                                        border-collapse: separate;
                                                                                                        border-spacing: 0;
                                                                                                        border-radius: 24px;
                                                                                                        overflow: hidden;
                                                                                                    } */

                    .quiz-container thead tr:first-child th:first-child {
                        /* border-top-left-radius: 24px; */
                        max-width: 800px !important;
                        width: 54%;
                    }

                    /* .quiz-container thead tr:first-child th:last-child {
                                                                                                        border-top-right-radius: 24px;
                                                                                                    }

                                                                                                    .quiz-container tbody tr:last-child td:first-child {
                                                                                                        border-bottom-left-radius: 24px;
                                                                                                    }

                                                                                                    .quiz-container tbody tr:last-child td:last-child {
                                                                                                        border-bottom-right-radius: 24px;
                                                                                                    } */


                    .quiz-container th,
                    .quiz-container td {
                        /* padding: 16px 24px; */
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
                </style>

                <table class="quiz-container">
                    <thead>
                        <tr>
                            <th>Pytanie</th>
                            <th>0 - Nigdy</th>
                            <th>1 - Rzadko</th>
                            <th>2 - Czasami</th>
                            <th>3 - Często</th>
                            <th>4 - Bardzo często</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Function to display questions
                        function display_questions($questions)
                        {
                            foreach ($questions as $question): ?>
                                <tr>
                                    <td class="question-col">
                                        <?php echo esc_html($question['question_title'] ?? 'No question title'); ?>
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

                        // Display Part A questions
                        display_questions($part_a_questions);
                        ?>
                        <!-- Part A Summary Row -->
                        <tr class="summary-row">
                            <td style="text-align: center;">Wynik całkowity</td>
                            <td colspan="3"></td>
                            <td style="background-color: #F9E9DD; text-align: center;">Test A</td>
                            <td style="background-color: #F9E9DD; text-align: center;"><?php echo $part_a_score; ?></td>
                        </tr>

                        <?php
                        // Display Part B questions
                        display_questions($part_b_questions);
                        ?>
                        <!-- Part B Summary Row -->
                        <tr class="summary-row">
                            <td style="text-align: center;">Wynik całkowity</td>
                            <td colspan="3"></td>
                            <td style="background-color: #F9E9DD; text-align: center;">Test B</td>
                            <td style="background-color: #F9E9DD; text-align: center;"><?php echo $part_b_score; ?></td>
                        </tr>

                        <?php
                        // Display Part C questions
                        display_questions($part_c_questions);
                        ?>
                        <!-- Part C Summary Row -->
                        <tr class="summary-row">
                            <td style="text-align: center;">Wynik całkowity</td>
                            <td colspan="3"></td>
                            <td style="background-color: #F9E9DD; text-align: center;">Test C</td>
                            <td style="background-color: #F9E9DD; text-align: center;"><?php echo $part_c_score; ?></td>
                        </tr>

                        <?php
                        // Display Part D questions
                        display_questions($part_d_questions);
                        ?>
                        <!-- Part D Summary Row -->
                        <tr class="summary-row">
                            <td style="text-align: center;">Wynik całkowity</td>
                            <td colspan="3"></td>
                            <td style="background-color: #F9E9DD; text-align: center;">Test D</td>
                            <td style="background-color: #F9E9DD; text-align: center;"><?php echo $part_d_score; ?></td>
                        </tr>
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