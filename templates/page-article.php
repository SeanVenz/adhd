<?php
/**
 * Template Name: Articles
 */
get_header();

$postsPerPage = 1;
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'order' => 'DESC',         // Get newer posts first
    'orderby' => 'date',       // Order by publication date
    'tax_query' => array(
        array(
            'taxonomy' => 'category',      // Changed to category instead of post_tag
            'field' => 'slug',
            'terms' => 'featured',      // The slug of your "featured" category
        ),
    ),
);

$query = new WP_Query($args);
?>

<style>
    .articles {
        display: flex;
        flex-direction: column;
        width: 100%;
        justify-content: center;
        align-items: center;
        margin-top: 200px;
        padding-bottom: 228px;
    }

    .articles h1 {
        text-align: left;
        font-family: "Manrope";
        font-weight: 600;
        font-size: 64px;
        color: #17462B;
        width: 720px;
    }

    .articles span {
        font-family: Manrope;
        font-weight: 400;
        font-size: 16px;
        color: #44674F;
        width: 908px;
        display: flex;
    }

    .articles header {
        display: flex;
        flex-direction: column;
        gap: 16px
    }

    .main-content {
        display: flex;
        flex-direction: column;
        gap: 54px;
    }

    .article-item {
        width: 100%;
        height: 1720px;
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 44px;
        box-shadow: 4px 4px 12px 0px #00000014;
        border-radius: 28px;
        height: 1114px;
    }

    .article-holder {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .article-item img {
        width: 1672px;
        height: 844px;
    }

    .article-item .text-desc a {
        text-decoration: none;
        font-family: Manrope;
        font-weight: 600;
        font-size: 24px;
        color: #17462B;
    }

    .article-item .text-desc p {
        font-family: Manrope;
        font-weight: 400;
        font-size: 16px;
        color: #44674F;
    }

    .article-item .see-more {
        text-decoration: none;
        font-weight: 400;
        font-size: 20px;
        color: #17462B;
        padding: 12px 24px;
        border: 1px solid #17462B;
        width: max-content;
        border-radius: 12px;
        gap: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .articles h2 {
        font-family: 'Manrope';
        font-weight: 600;
        font-size: 32px;
        color: #17462B;
    }

    .step .step-holder {
        justify-content: center;
        align-items: center;
    }

    .step .step-holder .desc {
        font-family: 'Manrope';
        font-weight: 400;
        font-size: 14px;
        color: #44674F;
        max-width: 543px;
        width: 100%;
    }

    .desc a {
        color: #51A2FF;
        background-color: transparent;
        padding: 0;
        display: inline;
        font-family: 'Manrope';
        font-weight: 400;
        font-size: 14px;
    }

    .step .take-test {
        width: max-content;
        align-self: center;
    }

    .step .test-holder {
        display: flex;
        max-width: 543px;
        justify-content: center;
        align-items: center;
        gap: 54px;
        flex-direction: column;
    }
</style>

<section class="articles">
    <div class="min-width">
        <div class="article-holder" id="article-container">
            <div class="main-content">
                <div class="header">
                    <h1>ADHD: Przewodnik po świadomości i wsparciu</h1>
                    <span>Bądź na bieżąco dzięki eksperckim artykułom, szczegółowym przewodnikom i najnowszym
                        wiadomościom o
                        ADHD.Od diagnozy po codzienne zarządzanie – odkryjcenne informacje, które pomogą osobom z ADHD,
                        ich
                        rodzinom i specjalistomlepiej zrozumieć i skutecznie radzić sobie z tym wyzwaniem.</span>
                </div>
                <?php if ($query->have_posts()): ?>
                    <?php while ($query->have_posts()):
                        $query->the_post(); ?>
                        <div class="article-item">
                            <div class="img-container">
                                <?php if (has_post_thumbnail()): ?>
                                    <a href="<?php the_permalink(); ?>"><img
                                            src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>"
                                            alt="<?php the_title(); ?>"></a>
                                <?php else: ?>
                                    <a href="<?php the_permalink(); ?>"><img
                                            src="<?php echo get_stylesheet_directory_uri() . "/src/images/default-thumbnail.jpg"; ?>"
                                            alt="Default Thumbnail"></a>
                                <?php endif; ?>
                            </div>
                            <div class="text-container">
                                <div class="text-desc">
                                    <a href="<?php the_permalink(); ?>" class="header"><?php the_title(); ?></a>
                                    <p><?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?></p>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="see-more">Czytaj więcej <svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                        </path>
                                    </svg></a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                <?php endif; ?>

                <?php get_template_part('template-parts/featured'); ?>


            </div>
            <div class="">
                <h2>Kompendium wiedzy</h2>
                <?php get_template_part('template-parts/blogs', null, array(
        'posts_per_page' => -1
    )); ?>
            </div>
        </div>

    </div>

</section>

<section class="step">
    <div class="min-width">
        <div class="step-holder">
            <div class="text-holder">
                <h2>Sprawdź swoje umiejętności – <br> Rozpocznij test!</h2>
                <span>Oceń swoje kompetencje i uzyskaj natychmiastową analizę wyników.</span>
            </div>
            <div class="test-holder">
                <a href="" class="take-test">Rozpocznij test</a>
                <span class="desc">
                    Szanujemy Twoją prywatność. Podane przez Ciebie informacje będą wykorzystywane wyłącznie do analizy
                    wyników testu oraz dostarczenia spersonalizowanego raportu. Twoje dane będą przetwarzane zgodnie z
                    naszą
                    <a href="/polityka-prywatnosci">polityką prywatności.</a> <br>
                    Ten formularz jest chroniony przez reCAPTCHA, a obowiązują <a href="/polityka-prywatnosci">Polityką
                        prywatności.</a> i <a href="">Warunki korzystania z
                        usług Google.</a>
                </span>
            </div>

        </div>
    </div>
</section>


<?php get_footer(); ?>

<?php wp_reset_postdata(); ?>