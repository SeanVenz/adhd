<?php get_header(); ?>

<style>
    .blog-content-section {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-top: 100px;
        padding-bottom: 150px;
    }

    .article-container {
        display: flex;
        width: 100%;
        gap: 63px;
        flex-direction: column;
    }

    .blog-content-section h1 {
        font-family: "Manrope";
        font-weight: 600;
        font-size: 64px;
        color: #17462B;
        max-width: 1246px;
    }

    .blog-content-section .author {
        padding: 8px 24px;
        padding-left: 4px;
        border-radius: 100px;
        background: #00823614;
        font-family: "Manrope";
        font-weight: 600;
        font-size: 16px;
        line-height: 24px;
        letter-spacing: 0.5px;
        width: max-content;
        color: #17462B;
        display: flex;
        justify-content: start;
        align-items: center;
        gap: 12px;
    }

    .blog-content-section .title-holder {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: 100%;
    }

    .blog-content-section .title-author {
        display: flex;
        flex-direction: column;
        gap: 54px;
    }

    .single-post {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .post-content {
        width: 100%;
        padding-bottom: 54px;
    }

    .single-post .post-content img {
        width: 100%;
        height: 919px;
        object-fit: cover;
        border-radius: 20px;
    }

    .sidebar {
        position: sticky;
        top: 100px;
        align-self: flex-start;
        max-height: 90vh;
        overflow-y: auto;
    }

    .content {
        display: flex;
        justify-content: space-between;
        width: 100%;
        gap: 54px;
    }

    .post-content-words {
        color: #44674F;

        border-left: 1px solid #E2E8F0;
        padding-left: 54px;
    }

    .sidebar .toc-item a {
        color: #44674F;
        text-decoration: none;
        transition: color 0.3s ease;
        display: block;
        padding: 5px 0;
    }

    .sidebar {
        max-width: 504px;
        width: 100%;
    }

    .sidebar .toc-item a.active {
        color: #17462B;
        font-weight: 700;
    }

    .sidebar .toc-item a.active .section-number {
        color: white;
        font-weight: 700;
        background-color: #17462B;
    }

    .sidebar .section-number {
        display: inline-block;
        margin-right: 8px;
        padding: 8px 16px;
        background-color: #17462B3D;
        border-radius: 8px;
    }

    .page-toc ul {
        padding-left: 0;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .back-to-top-button {
        padding: 12px 24px;
        border: 2px solid #17462B;
        border-radius: 12px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        margin-top: 74px;
        color: #17462B;
        font-family: "Manrope";
        font-weight: 600;
        font-size: 20px;

    }

    .page-toc h4 {
        font-family: "Manrope";
        font-weight: 500;
        font-size: 24px;
        color: #17462B;
    }

    .back-button {
        padding: 12px 24px;
        border: 1px solid #17462B;
        border-radius: 24px;
        width: max-content;
        height: max-content;
        text-decoration: none;
        color: #17462B;
        font-family: "Manrope";
        font-weight: 600;
        font-size: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
    }

    .back-button:hover {
        text-decoration: none;
        color: #17462B;
    }

    .author img {
        width: 36px;
        height: 36px;
        border-radius: 50%;
    }

    .blog-content-section .extra-article {
        padding-top: 228px;
    }

    .extra-article{
        display: flex;
        flex-direction: column;
        gap: 54px;
        width: 100%;
    }

    .extra-article .text-holder {
        display: flex;
        flex-direction: column;
        gap: 16px
    }

    .extra-article h2 {
        font-family: 'Manrope';
        font-weight: 600;
        font-size: 64px;
        color: #17462B;

    }

    .extra-article span {
        color: #44674F;
        font-family: 'Manrope';
        font-weight: 400;
        font-size: 16px;

    }

    @media (max-width: 1180px){
        .content{
            gap: 28px;
        }

        .single-post .post-content img{
            height: auto;
        }
    }

    @media (max-width: 1100px){
        .sidebar{
            display: none;
        }

        .post-content-words{
            padding-left: 0;
            border-left: none;
        }

        .back-display{
            display: none;
        }
    }

    @media (max-width: 1024px){
        .blog-content-section .extra-article{
            padding-top: 128px;
        }

        .blog-content-section{
            padding-bottom: 64px;
        }
    }

    @media (max-width: 768px){
        .extra-article h2{
            font-size: 36px;
        }

        .blog-content-section{
            padding-bottom: 32px;
        }
    }

    @media (max-width: 480px){
        .extra-article h2{
            font-size: 20px;
        }
    }

    .knowledge-container{
        justify-content: left !important;
    }
</style>

<section class="blog-content-section">
    <div class="min-width">
        <article class="article-container">
            <div class="title-holder">
                <div class="title-author">
                    <h1><?php the_title(); ?></h1>
                    <span class="author"><?php
                    // Get author ID
                    $author_id = $post->post_author;
                    // Get author avatar
                    $author_avatar = get_avatar($author_id, 40);

                    // Output avatar and name
                    echo $author_avatar;
                    ?><?php echo get_the_author_meta('display_name', $author_id); ?></span>
                </div>
                <div class="back-display">
                    <a href="<?php echo get_home_url(); ?>" class="back-button">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Back
                    </a>
                </div>
            </div>
            <?php if (have_posts()):
                while (have_posts()):
                    the_post(); ?>
                    <div class="single-post">
                        <div class="post-content">
                            <img class="img-featured mb-3" src="<?php echo get_the_post_thumbnail_url(); ?>"
                                alt="<?php the_title(); ?>">
                        </div>
                        <div class="content">
                            <div class="sidebar">
                                <?php echo generate_page_toc(); ?>
                            </div>
                            <div class="post-content-words">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endwhile;
            endif; ?>
        <div id="back-to-top" class="back-to-top-button">
            Wróć na górę
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 19V5M12 5L5 12M12 5L19 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </div>
        <div class="extra-article">
            <div class="text-holder">
                <h2>Polecane dla Ciebie</h2>
                <span>Ponieważ przeczytałeś tego typu artykuł, oto kilka rekomendowanych treści dopasowanych do Twoich
                    zainteresowań.</span>
            </div>
            <?php get_template_part('template-parts/blogs'); ?>
        </div>
    </div>

</section>



<!-- FOOTER -->
<?php get_footer(); ?>