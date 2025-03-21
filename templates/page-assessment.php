<?php
/**
 * Template Name: Assessment
 */
get_header();

?>

<style>
.quiz.has-results {
    background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/home/Test_assesstment_BG.webp') !important;
}

</style>

<section class="quiz">
<div class="header-holder">
                <a href="<?php echo get_home_url(); ?>"> <span>Dom</span> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="#17462B" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path
                            d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                    </svg></a>
            </div>
    <div class="min-width">
        
        <div class="quiz-holder">

            <div class="short-code">

                <?php echo do_shortcode('[qsm quiz=1]'); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>

<?php wp_reset_postdata(); ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Define the function
    function checkAndUpdateQuiz() {
        document.querySelectorAll('.quiz').forEach(function (quizDiv) {
            if (quizDiv.querySelector('.qmn_results_page')) {
                quizDiv.classList.add('has-results');
            }
        });
    }

    // Run the check initially
    checkAndUpdateQuiz();

    // Set up a MutationObserver with improved detection
    const observer = new MutationObserver(function(mutations) {
        let needsCheck = false;
        
        mutations.forEach(function(mutation) {
            // Check if any of the added nodes or their descendants might be our target
            if (mutation.addedNodes.length) {
                needsCheck = true;
            }
        });
        
        if (needsCheck) {
            setTimeout(checkAndUpdateQuiz, 100); // Small delay to ensure DOM is updated
        }
    });

    // Observe the quiz container specifically if possible
    const quizContainers = document.querySelectorAll('.quiz-holder, .short-code');
    quizContainers.forEach(container => {
        observer.observe(container, { childList: true, subtree: true });
    });
    
    // Also observe body as fallback
    observer.observe(document.body, { childList: true, subtree: true });
});
</script>