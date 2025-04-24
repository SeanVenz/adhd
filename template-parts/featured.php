<?php
// Template part for displaying blog posts with load more functionality

// Initial posts query
$postsPerPage = 3;
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
    .featured-cointainer {
        width: 100%;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 55px;
        justify-content: center;
        padding-top: 174px;
        padding-bottom: 228px;
    }

    .knowledge {
        width: 31%;
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 44px;
        box-shadow: 4px 4px 12px 0px #00000014;
        border-radius: 28px;
        height: 700px
    }

    .knowledge .heading-container a {
        font-weight: 600;
        font-size: 24px;
        color: #17462B;
        text-decoration: none;
    }

    .knowledge .heading-container p {
        font-weight: 400;
        font-size: 16px;
        color: #44674F;
        margin-bottom: 0;
    }

    .knowledge img {
        object-fit: cover;
        width: 100%;
    }

    .knowledge .img-container a {
        width: 100%;
        height: 100%;
        display: flex;
    }

    .knowledge .text-holder {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .knowledge .read-more {
        text-decoration: none;
        font-weight: 600;
        font-size: 20px;
        color: #17462B;
        padding: 12px 24px;
        border: 1px solid #17462B;
        width: 100%;
        border-radius: 12px;
        gap: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .featured-cointainer h2 {
        font-family: 'Manrope';
        font-weight: 600;
        font-size: 32px;
        color: #17462B;

    }

    .featured-cointainer .header {
        width: 100%;
        display: flex;
        justify-content: flex-start;
    }

    .featured-cointainer ul {
        padding-left: 0;
        list-style-type: none;
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: flex-start;
        width: 100%;
    }

    .featured-cointainer .article-container {
        display: flex;
        flex-direction: column;
        width: 100%;
        gap: 54px;
    }

    @media (max-width: 1024px) {
        .featured-cointainer{
            padding-top: 64px;
            padding-bottom: 64px;
        }

        .knowledge{
            width: 100%;
        }
    }

    @media (max-width: 768px) {

        .knowledge{
            border-radius: 14px
        }

        .knowledge .read-more{
            justify-content: space-between;
        }

        .featured-cointainer {
            padding-top: 54px;
            padding-bottom: 54px;
        }


    }
</style>

<section class="featured-cointainer" id="article-container">
    <div class="article-container">
        <div class="header">
            <h2>Polecane dla Ciebie</h2>
        </div>
        <ul>
            <?php if ($query->have_posts()): ?>
                <?php while ($query->have_posts()):
                    $query->the_post(); ?>
                    <div class="knowledge">

                        <div class="img-container">
                            <?php if (has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>">
                                    <img loading="lazy" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>"
                                        alt="<?php the_title(); ?>"></a>
                            <?php else: ?>
                                <img loading="lazy"
                                    src="<?php echo get_stylesheet_directory_uri() . "/src/images/default-thumbnail.jpg"; ?>"
                                    alt="Default Thumbnail">
                            <?php endif; ?>
                        </div>
                        <div class="text-container">
                            <div class="heading-container">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <p><?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?></p>
                            </div>
                        </div>

                        <a href="<?php the_permalink(); ?>" class="read-more">Czytaj więcej <svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                            </svg></a>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </ul>
        <?php else: ?>
            <p>Brak dostępnych postów.</p>
        <?php endif; ?>
    </div>
</section>