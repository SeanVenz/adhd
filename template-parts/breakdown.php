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
            // Access the array containing question data
            $questions = $quiz_results[1];

            // Check if questions array exists
            if (is_array($questions)):
                ?>
                <style>
                    .quiz-container {
                        width: 100%;
                        border-collapse: collapse;
                        text-align: center;
                        margin-top: 20px;
                    }
                    .quiz-container th, .quiz-container td {
                        padding: 10px;
                        border: 1px solid #ddd;
                    }
                    .quiz-container th {
                        background-color: #0056b3;
                        color: white;
                    }
                    .highlight {
                        background-color: #4CAF50;
                        color: white;
                        font-weight: bold;
                    }
                    .question-col {
                        text-align: left;
                        font-weight: bold;
                        background-color: #f8f8f8;
                    }
                </style>

                <table class="quiz-container">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>0 - Nigdy</th>
                            <th>1 - Rzadko</th>
                            <th>2 - Czasami</th>
                            <th>3 - Często</th>
                            <th>4 - Bardzo często</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($questions as $question): ?>
                            <tr>
                                <td class="question-col"><?php echo esc_html($question['question_title']); ?></td>
                                <?php
                                $user_answer = isset($question['user_answer']) ? array_keys($question['user_answer'])[0] : null;

                                for ($i = 0; $i <= 4; $i++):
                                    $class = ($i == $user_answer) ? 'highlight' : '';
                                    echo "<td class='$class'>" . ($i == $user_answer ? "✔" : "") . "</td>";
                                endfor;
                                ?>
                            </tr>
                        <?php endforeach; ?>
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
