<?php
/**
 * Template Name: Quiz Result Page
 */
get_header();

// Get the quiz result ID from the URL
$result_id = get_query_var('quiz_id', 0);

if ($result_id > 0) {
    global $wpdb;
    $table_name = $wpdb->prefix . "mlw_results"; 

    // Fetch quiz result
    $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE result_id = %d", $result_id));

    if ($result) {
        echo "<div class='quiz-result'>";
        echo "<h1>Your Quiz Results</h1>";

        echo "<p><strong>Total Points:</strong> " . esc_html($result->point_score) . "</p>";
        echo "</div>";
    } else {
        echo "<p>Quiz result not found.</p>";
    }
} else {
    echo "<p>Invalid quiz result.</p>";
}

get_footer();
?>
