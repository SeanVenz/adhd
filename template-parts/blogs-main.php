<?php
// Template part for displaying blog posts with load more functionality

$postsPerPage = isset($args['posts_per_page']) ? $args['posts_per_page'] : 3;
$args = array(
    'post_type' => 'post',
    'posts_per_page' => $postsPerPage,
    'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
    'order' => 'ASC',
);

$query = new WP_Query($args);
?>

<style>
    .knowledge-container {
        width: 100%;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 55px;
        justify-content: center;
    }

    .knowledge {
        width: 31%;
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 44px;
        box-shadow: 4px 4px 12px 0px #00000014;
        border-radius: 28px;
        height: 700px;
        justify-content: space-between
    }

    .img-text-container {
        display: flex;
        flex-direction: column;
        gap: 44px;
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
        height: auto;
        border-radius: 24px;
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

    .load-more {
        display: block;
        padding: 12px 30px;
        background-color: #17462B;
        color: white;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        font-size: 18px;
        width: max-content;
        align-self: center;
        text-decoration: none !important;
    }

    .load-more:hover{
        color: white !important;
    }

    .spinner {
        animation: rotate 2s linear infinite;
        margin-right: 10px;
    }

    .spinner .path {
        stroke: white;
        stroke-linecap: round;
        animation: dash 1.5s ease-in-out infinite;
    }

    @keyframes rotate {
        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes dash {
        0% {
            stroke-dasharray: 1, 150;
            stroke-dashoffset: 0;
        }

        50% {
            stroke-dasharray: 90, 150;
            stroke-dashoffset: -35;
        }

        100% {
            stroke-dasharray: 90, 150;
            stroke-dashoffset: -124;
        }
    }

    @media (max-width: 992px) {
        .knowledge {
            width: 45%;
        }
    }

    @media (max-width: 768px) {
        .knowledge {
            width: 100%;
            gap: 24px;
            height: auto;
            border-radius: 14px;
        }

        .knowledge-container{
            gap: 24px;
        }

        .knowledge .read-more{
            width: 100%;
            justify-content: space-between;
        }
        .knowledge .heading-container p {
            font-size: 12px;
        }

        .heading-container {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .load-more{
            width: 100%;
            text-align: center;
            padding: 12px 24px;
        }
    }
</style>

<div class="knowledge-container" id="article-container">
    <?php if ($query->have_posts()): ?>
        <?php while ($query->have_posts()):
            $query->the_post(); ?>
            <div class="knowledge">
                <div class="img-text-container">
                    <div class="img-container">
                        <?php if (has_post_thumbnail()): ?>
                            <a href="<?php the_permalink(); ?>">
                                <img loading="lazy" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"
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
                </div>
                <a href="<?php the_permalink(); ?>" class="read-more">Czytaj więcej <svg xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                    </svg>
                </a>
            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>

    <?php else: ?>
        <p>Brak dostępnych postów.</p>
    <?php endif; ?>

</div>
    <a href="/centrum-wiedzy" class="load-more"><?php echo esc_html(get_field('knowledge_center_button')); ?></a>