<?php
/**
 * Template Name: Testimonials
 */
get_header();

?>
<section class="articles">
<?php echo do_shortcode('[testimonial_view id="2"]'); ?>
</section>

<?php get_template_part('template-parts/where-to-buy'); ?>

<?php get_footer(); ?>

<?php wp_reset_postdata(); ?>
