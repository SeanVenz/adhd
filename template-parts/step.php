<section class="step"
    style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/home/Take_The_Test_bg.webp');">
    <div class="min-width">
        <div class="step-holder">
            <div class="text-holder">
                <h2><?php echo wp_kses_post(get_field('step_title')); ?></h2>
                <!-- <span>Poczuj różnicę na własnej skórze</span> -->
            </div>
            <a href="<?php echo get_home_url(); ?>/rozpocznij-test"><?php echo esc_html(get_field('step_button')); ?> <svg
                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-play-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445" />
                </svg></a>

            <div class="d-flex flex-column justify-content-center align-items-center extra">
                <span>
                <?php echo esc_html(get_field('step_first_paragraph')); ?>
                </span>
                <span>
                <strong><?php echo esc_html(get_field('step_second_paragraph')); ?></strong>
                </span>
            </div>
        </div>
    </div>
</section>