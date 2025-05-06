<!-- HEADER -->
<?php

/**
 * Template Name: Homepage
 */

get_header(); ?>

<!-- MAIN SECTION -->
<main class="front">

    <section class="main-hero lazy-bg" data-bg="<?php echo get_template_directory_uri(); ?>/assets/home/hero_bg.webp">
        <div class="min-width">
            <div class="main-hero-holder">
                <div class="text-holder">
                    <div class="heading">
                        <h1><?php echo esc_html(get_field('hero_section_title')); ?></h1>
                        <span><?php echo esc_html(get_field('hero_section_sub_title')); ?></span>
                    </div>
                    <ul>
                        <li>
                            <a href="<?php echo get_home_url() ?>/rozpocznij-test">
                                <span><?php echo esc_html(get_field('hero_section_first_button')); ?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="m9.5 16.5l7-4.5l-7-4.5zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m0-2q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8" />
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo get_home_url() ?>/centrum-wiedzy">
                                <span><?php echo esc_html(get_field('hero_section_second_button')); ?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-book" viewBox="0 0 16 16">
                                    <path
                                        d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="img-holder">
                    <img src="<?php echo esc_url(get_field('hero_banner_image')); ?>" alt="Hero">
                </div>
            </div>
        </div>
    </section>

    <div class="bg"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/home/Mesh_gradient_bg.webp');">
        <section class="what">
            <div class="min-width">
                <div class="what-holder">
                    <div class="text-holder">
                        <div class="texts">
                            <span
                                class="header"><?php echo esc_html(get_field('concentration_section_pre_title')); ?></span>
                            <h2><?php echo esc_html(get_field('concentration_section_title')); ?></h2>
                            <span
                                class="desc"><?php echo esc_html(get_field('concentration_section_sub_title')); ?></span>
                            <p><?php echo esc_html(get_field('concentration_section_paragraph')); ?></p>
                        </div>
                        <a href="#development"><?php echo esc_html(get_field('concentration_section_button')); ?></a>
                    </div>
                    <div class="frame">
                        <img src="<?php echo esc_url(get_field('concentration_image')); ?>"
                            alt="Concentration">
                        <h2><?php echo esc_html(get_field('concentration_image_header')); ?></h2>

                        <div class="cover"></div>
                        <div class="red"></div>
                        <div class="frame-text-holder">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 15 15">
                                <path fill="#17462B"
                                    d="M2.5 1A1.5 1.5 0 0 0 1 2.5V10a4 4 0 0 0 4 4v-1a3 3 0 0 1-3-3V7h3.5A1.5 1.5 0 0 0 7 5.5v-3A1.5 1.5 0 0 0 5.5 1zm7 0A1.5 1.5 0 0 0 8 2.5V10a4 4 0 0 0 4 4v-1a3 3 0 0 1-3-3V7h3.5A1.5 1.5 0 0 0 14 5.5v-3A1.5 1.5 0 0 0 12.5 1z" />
                            </svg>
                            <p><?php echo esc_html(get_field('concentration_image_sub_header')); ?></p>
                            <span><?php echo esc_html(get_field('concentration_image_description')); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="development" id="development">
            <div class="min-width">
                <div class="development-holder">
                    <div class="text-holder">
                        <h2><?php echo esc_html(get_field('diagnosed_section_title')); ?></h2>
                        <span><?php echo esc_html(get_field('diagnosed_section_subtitle')); ?></span>
                    </div>
                    <ul>
                        <li>
                            <div class="svg-holder">
                                <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24">
                                    <path fill="#17462B"
                                        d="M3.5 3.75a.25.25 0 0 1 .25-.25h13.5a.25.25 0 0 1 .25.25v10a.75.75 0 0 0 1.5 0v-10A1.75 1.75 0 0 0 17.25 2H3.75A1.75 1.75 0 0 0 2 3.75v16.5c0 .966.784 1.75 1.75 1.75h7a.75.75 0 0 0 0-1.5h-7a.25.25 0 0 1-.25-.25z" />
                                    <path fill="#17462B"
                                        d="M6.25 7a.75.75 0 0 0 0 1.5h8.5a.75.75 0 0 0 0-1.5zm-.75 4.75a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75m16.28 4.53a.75.75 0 1 0-1.06-1.06l-4.97 4.97l-1.97-1.97a.75.75 0 1 0-1.06 1.06l2.5 2.5a.75.75 0 0 0 1.06 0z" />
                                </svg>
                                <div class="texts">
                                    <span><?php echo esc_html(get_field('diagnosed_section_first_card_title')); ?></span>
                                    <p><?php echo esc_html(get_field('diagnosed_section_first_card_sub_title')); ?></p>
                                </div>
                            </div>
                            <div class="header-holder">
                                <h3><?php echo esc_html(get_field('diagnosed_section_first_card_paragraph')); ?></h3>
                                <p><?php echo esc_html(get_field('diagnosed_section_first_card_sub_paragraph')); ?></p>
                            </div>
                        </li>

                        <li>
                            <div class="svg-holder">
                                <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 36 36">
                                    <path fill="#17462B"
                                        d="M21 12H7a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1M8 10h12V7.94H8Z"
                                        class="clr-i-outline clr-i-outline-path-1" />
                                    <path fill="#17462B"
                                        d="M21 14.08H7a1 1 0 0 0-1 1V19a1 1 0 0 0 1 1h11.36L22 16.3v-1.22a1 1 0 0 0-1-1M20 18H8v-2h12Z"
                                        class="clr-i-outline clr-i-outline-path-2" />
                                    <path fill="#17462B"
                                        d="M11.06 31.51v-.06l.32-1.39H4V4h20v10.25l2-1.89V3a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v28a1 1 0 0 0 1 1h8a3.4 3.4 0 0 1 .06-.49"
                                        class="clr-i-outline clr-i-outline-path-3" />
                                    <path fill="#17462B" d="m22 19.17l-.78.79a1 1 0 0 0 .78-.79"
                                        class="clr-i-outline clr-i-outline-path-4" />
                                    <path fill="#17462B"
                                        d="M6 26.94a1 1 0 0 0 1 1h4.84l.3-1.3l.13-.55v-.05H8V24h6.34l2-2H7a1 1 0 0 0-1 1Z"
                                        class="clr-i-outline clr-i-outline-path-5" />
                                    <path fill="#17462B"
                                        d="m33.49 16.67l-3.37-3.37a1.61 1.61 0 0 0-2.28 0L14.13 27.09L13 31.9a1.61 1.61 0 0 0 1.26 1.9a1.6 1.6 0 0 0 .31 0a1.2 1.2 0 0 0 .37 0l4.85-1.07L33.49 19a1.6 1.6 0 0 0 0-2.27ZM18.77 30.91l-3.66.81l.89-3.63L26.28 17.7l2.82 2.82Zm11.46-11.52l-2.82-2.82L29 15l2.84 2.84Z"
                                        class="clr-i-outline clr-i-outline-path-6" />
                                    <path fill="none" d="M0 0h36v36H0z" />
                                </svg>
                                <div class="texts">
                                    <span><?php echo esc_html(get_field('diagnosed_section_second_card_title')); ?></span>
                                    <p><?php echo esc_html(get_field('diagnosed_section_second_card_sub_title')); ?></p>
                                </div>
                            </div>
                            <div class="header-holder">
                                <h3><?php echo esc_html(get_field('diagnosed_section_second_card_paragraph')); ?></h3>
                                <p><?php echo esc_html(get_field('diagnosed_section_second_card_sub_paragraph')); ?></p>
                            </div>
                            <a href="<?php echo get_home_url() ?>/rozpocznij-test">
                                <?php echo esc_html(get_field('diagnosed_section_second_card_button')); ?>
                            </a>
                        </li>

                        <li>
                            <div class="svg-holder">
                                <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="-2 -2 24 24">
                                    <path fill="#17462B"
                                        d="M7 12.917v.583a4.5 4.5 0 1 0 9 0v-1.67a3.001 3.001 0 1 1 2 0v1.67a6.5 6.5 0 1 1-13 0v-.583A6 6 0 0 1 0 7V2a2 2 0 0 1 2-2h1a1 1 0 1 1 0 2H2v5a4 4 0 1 0 8 0V2H9a1 1 0 1 1 0-2h1a2 2 0 0 1 2 2v5a6 6 0 0 1-5 5.917M17 10a1 1 0 1 0 0-2a1 1 0 0 0 0 2" />
                                </svg>
                                <div class="texts">
                                    <span><?php echo esc_html(get_field('diagnosed_section_third_card_title')); ?></span>
                                    <p><?php echo esc_html(get_field('diagnosed_section_third_card_sub_title')); ?></p>
                                </div>
                            </div>
                            <div class="header-holder">
                                <h3><?php echo esc_html(get_field('diagnosed_section_third_card_paragraph')); ?></h3>
                                <p><?php echo esc_html(get_field('diagnosed_section_third_card_sub_paragraph')); ?></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </section>

    </div>

    <section class="well-being"
        style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/home/Overiew_HomePage_AboutUS.webp');">
        <div class="min-width">
            <div class="well-being-holder">
                <div class="text-holder">
                    <span><?php echo esc_html(get_field('treated_pre_title')); ?></span>
                    <h2><?php echo wp_kses_post(get_field('treated_title')); ?></h2>
                    <p><?php echo esc_html(get_field('treated_paragraph')); ?></p>
                </div>
                <ul>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" fill="#17462B"
                            class="bi bi-lightbulb" viewBox="0 0 16 16">
                            <path
                                d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13a.5.5 0 0 1 0 1 .5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1 0-1 .5.5 0 0 1 0-1 .5.5 0 0 1-.46-.302l-.761-1.77a2 2 0 0 0-.453-.618A5.98 5.98 0 0 1 2 6m6-5a5 5 0 0 0-3.479 8.592c.263.254.514.564.676.941L5.83 12h4.342l.632-1.467c.162-.377.413-.687.676-.941A5 5 0 0 0 8 1" />
                        </svg>

                        <div class="header-holder">
                            <h3><?php echo esc_html(get_field('treated_first_card_title')); ?></h3>
                            <p><?php echo esc_html(get_field('treated_first_card_sub_title')); ?></p>
                        </div>
                    </li>

                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24">
                            <g fill="none" stroke="#17462B" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5">
                                <path d="M7 14a3 3 0 1 0 1 5.83" />
                                <path
                                    d="M4.264 15.605a4 4 0 0 1-.874-6.636m.03-.081A2.5 2.5 0 0 1 7 5.5m.238.065A2.5 2.5 0 1 1 12 4.5V20m-4 0a2 2 0 1 0 4 0m0-13a3 3 0 0 0 3 3m2 4a3 3 0 1 1-1 5.83" />
                                <path
                                    d="M19.736 15.605a4 4 0 0 0 .874-6.636m-.03-.081A2.5 2.5 0 0 0 17 5.5m-5-1a2.5 2.5 0 1 1 4.762 1.065M16 20a2 2 0 1 1-4 0" />
                            </g>
                        </svg>

                        <div class="header-holder">
                            <h3><?php echo esc_html(get_field('treated_second_card_title')); ?></h3>
                            <p><?php echo esc_html(get_field('treated_second_card_sub_title')); ?></p>
                        </div>
                    </li>

                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24">
                            <path fill="none" stroke="#17462B" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 3a1 1 0 0 1 1 1v4.535l3.928-2.267a1 1 0 0 1 1.366.366l1 1.732a1 1 0 0 1-.366 1.366L16.001 12l3.927 2.269a1 1 0 0 1 .366 1.366l-1 1.732a1 1 0 0 1-1.366.366L14 15.464V20a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-4.536l-3.928 2.268a1 1 0 0 1-1.366-.366l-1-1.732a1 1 0 0 1 .366-1.366L7.999 12L4.072 9.732a1 1 0 0 1-.366-1.366l1-1.732a1 1 0 0 1 1.366-.366L10 8.535V4a1 1 0 0 1 1-1z" />
                        </svg>

                        <div class="header-holder">
                            <h3><?php echo esc_html(get_field('treated_third_card_title')); ?></h3>
                            <p><?php echo esc_html(get_field('treated_third_card_sub_title')); ?></p>
                        </div>
                    </li>
                </ul>
                <!-- <a href="<?php echo get_home_url(); ?>/o-nas">Poznaj nasz poradnik</a> -->
            </div>
        </div>

    </section>

    <section class="accordions">
        <div class="min-width">
            <div class="accordions-holder">
                <div class="header">
                    <h2><?php echo esc_html(get_field('faq_title')); ?></h2>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <?php echo wp_kses_post(get_field('faq_first_title')); ?>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php echo esc_html(get_field('faq_first_subtitle')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <?php echo esc_html(get_field('faq_second_title')); ?>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php echo wp_kses_post(get_field('faq_second_subtitle')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <?php echo esc_html(get_field('faq_third_title')); ?>
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php echo esc_html(get_field('faq_third_subtitle')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <?php echo esc_html(get_field('faq_fourth_title')); ?>
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php echo esc_html(get_field('faq_fourth_subtitle')); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="knowledge-center">
        <div class="min-width">
            <div class="knowledge-center-holder">
                <div class="text-holder">
                    <div class="header">
                        <span><?php echo esc_html(get_field('knowledge_center_pre_title')); ?></span>
                        <h2><?php echo esc_html(get_field('knowledge_center_title')); ?></h2>
                        <p><?php echo esc_html(get_field('knowledge_center_sub_title')); ?></p>
                    </div>
                    <p class="desc"><?php echo esc_html(get_field('knowledge_center_paragraph')); ?></p>
                </div>
                <?php get_template_part('template-parts/blogs-main', null, array(
                    'posts_per_page' => 3
                )); ?>
            </div>
        </div>

    </section>



    <?php get_template_part('template-parts/step'); ?>

</main>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var lazyBackgrounds = [].slice.call(document.querySelectorAll(".lazy-bg"));

        if ("IntersectionObserver" in window) {
            let lazyBackgroundObserver = new IntersectionObserver(function (entries, observer) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        let lazyBackground = entry.target;
                        lazyBackground.style.backgroundImage = 'url(' + lazyBackground.dataset.bg + ')';
                        lazyBackground.classList.add("loaded");
                        lazyBackgroundObserver.unobserve(lazyBackground);
                    }
                });
            });

            lazyBackgrounds.forEach(function (lazyBackground) {
                lazyBackgroundObserver.observe(lazyBackground);
            });
        }
    });

</script>

<!-- FOOTER -->
<?php get_footer(); ?>