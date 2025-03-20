<?php get_header(); ?>

<style>
    .privacy-policy-section {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #fff;
        color: #0e3a26;
        padding-bottom: 256px;
        padding-top: 125px
    }

    .privacy-policy-section .min-width {
        width: 100%;
        max-width: 1720px;
        min-width: 1720px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        flex-basis: auto;
        flex-grow: 1;
        flex-shrink: 1;
        margin: 0 auto
    }

    .privacy-policy-container {
        display: flex;
        flex-direction: column;
        width: 100%;
        max-width: 100%;
        justify-content: center;
        align-items: center
    }

    .privacy-policy-container h1 {
        font-family: 'Manrope';
        font-weight: 700;
        font-size: 42px;
        line-height: 100%;
        letter-spacing: 0%;
        color: #17462B;
        margin-bottom: 0;
        padding-bottom: 50px;
        width: 100%;
    }

    .privacy-policy-container a,
    .privacy-policy-container p,
    .privacy-policy-container strong {
        font-size: 16px;
        line-height: 23px;
    }

    .privacy-policy-container p {
        font-weight: 400
    }

    .privacy-policy-container a {
        text-decoration: none;
        color: #c36;
        cursor: pointer
    }

    .privacy-policy-container a:hover {
        color: #336
    }

    .privacy-policy-container h5 {
        padding-top: 35px;
        text-align: center
    }

    .privacy-policy-container .wp-block-heading {
        font-size: 24px !important;
        font-weight: 700 !important;
    }

    .privacy-policy-container tbody>:first-child td,
    .privacy-policy-container tbody>:nth-child(odd) {
        background-color: hsla(0, 0%, 50.2%, .1019607843);
        line-height: 1.5;
        vertical-align: top
    }

    .privacy-policy-container table {
        border-spacing: 0;
        border-collapse: collapse
    }

    .privacy-policy-container table,
    .privacy-policy-container table a {
        font-size: 14.4px
    }

    .privacy-policy-container table tr>:first-child {
        width: 30%;
        max-width: 100%
    }

    .privacy-policy-container table tr>:nth-child(2) {
        width: 70%;
        max-width: 100%
    }

    .privacy-policy-container table td {
        padding: 15px;
        border: 1px solid hsla(0, 0%, 50.2%, .5019607843)
    }

    .privacy-policy-container tr:hover {
        background-color: hsla(0, 0%, 50.2%, .1019607843)
    }

    @media (max-width:1200px) {
        .privacy-policy-section .min-width {
            min-width: unset;
            width: 90%
        }

        .privacy-policy-section{
            padding-top: 80px;
        }
    }

    @media (max-width:1024px) {

        .privacy-policy-section{
            padding-top: 80px;
            padding-bottom: 128px;
        }
    }

    @media (max-width:768px) {
        .privacy-policy-section .min-width {
            width: 100%;
            padding-left: 7%;
            padding-right: 7%
        }

        .privacy-policy-section{
            padding-bottom: 64px;
        }

        .privacy-policy-container h1{
            font-size: 28px;
        }
    }
</style>

<?php
/**
 * Template Name: Terms and Conditions
 */

// Get the Privacy Policy page by its ID or slug
$privacy_page = get_page_by_path('regulamin');

if ($privacy_page):
    // Display the content of the page
    ?>
    <section class="privacy-policy-section">
        <div class="min-width">
            <article class="privacy-policy-container">
                <h1><?php echo esc_html(get_the_title($privacy_page)); ?></h1>
                <div class="single-post">
                    <div class="post-content">
                        <?php echo apply_filters('the_content', $privacy_page->post_content); ?>
                    </div>
                </div>
            </article>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>