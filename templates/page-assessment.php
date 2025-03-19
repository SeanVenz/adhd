<?php
/**
 * Template Name: Assessment
 */
get_header();

?>

<style>
.mlw_previous {
    background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/left.svg') !important;
    background-repeat: no-repeat !important;
    background-position: left center !important;
    padding-left: 30px !important;
}
</style>

<section class="quiz"
style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/home/Test_assesstment_BG.webp');">
<div class="header-holder">
                <a href="<?php echo get_home_url(); ?>">Dom <svg xmlns="http://www.w3.org/2000/svg" width="24"
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