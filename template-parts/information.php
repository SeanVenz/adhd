<!-- Constant Declaration -->
<?php
$postsPerPage = 3;
$args = array(
    'post_type' => 'post',
    'posts_per_page' => $postsPerPage,
    'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
    'order' => 'ASC',
);

$query = new WP_Query($args);
?>

<style>
    .information,
    .information .min-width {
        flex-direction: column;
        width: 100%;
        display: flex
    }

    .information {
        justify-content: center;
        background-color: #CEEBC1;
        align-items: center;
        padding-top: 84px;
        padding-bottom: 100px
    }

    .information .min-width {
        max-width: 1100px;
        min-width: 1100px;
        justify-content: center;
        align-items: center;
        flex-basis: auto;
        flex-grow: 1;
        flex-shrink: 1;
        margin: 0 auto
    }

    .information .information-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        width: 100%;
        word-wrap: break-word;
        justify-content: center;
        align-items: center;
    }

    .information .information-container a {
        text-decoration: none;
        color: #0E3A26;
        font-family: Lexend;
        font-weight: 700;
        font-size: 16px;
        line-height: 23.52px;
        letter-spacing: -2%;
        background-color: #FFFFFF;
        text-transform: uppercase;
        padding: 10px;
        display: flex;
        gap: 20px;
        justify-content: center;
        align-items: center;
        border-radius: 5px;
        cursor: pointer;
    }

    .information .information-container p {
        font-family: Lexend;
        font-weight: 300;
        font-size: 16px;
        line-height: 23.52px;
        letter-spacing: 0%;
        text-align: center;
        color: #0E3A26;
    }

    @media (max-width:1100px) {
        .information .min-width {
            min-width: unset;
            width: 90%;
        }
    }

    @media (max-width:768px) {
        .information {
            padding: 50px 8% 55px
        }

        .information .information-container a{
            text-align: center;
        }

        .information .min-width {
            width: 100%;
        }

    }
</style>

<section class="information">
    <div class="min-width">

        <div class="information-container">
            <a href="">skrócona informacja o wyrobie medycznym <img class="img-icon"
                    src="<?php echo get_stylesheet_directory_uri(); ?>/src/images/product/Vector.svg" alt="Vector"
                    loading="lazy"></a>
            <p>To jest wyrób medyczny. Dla bezpieczeństwa używaj go zgodnie z instrukcją lub etykietą. W przypadku
                wątpliwości skonsultuj się ze specjalistą, gdyż ten wyrób medyczny może nie być odpowiedni dla Ciebie.
            </p>
        </div>
    </div>
</section>