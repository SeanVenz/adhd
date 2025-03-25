<?php

global $articleItems;

if (!isset($articleItems) || !is_array($articleItems)) {
  $articleItems = []; // Initialize as empty array if not set
}

if (is_countable($articleItems)) {
  $articleCount = count($articleItems);
} else {
  $articleCount = 0;  // Fallback for when $articleItems is not countable
}


if (!function_exists('sinulan_theme_setup')):
  function sinulan_theme_setup()
  {
    add_theme_support('post-thumbnails');
    add_theme_support('post-formats', array('aside', 'gallery', 'quote', 'image', 'video'));
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
  }
endif;

add_action('after_setup_theme', 'sinulan_theme_setup');

function enqueue_scripts()
{
  // Get stylesheet versions
  $style_version = filemtime(get_template_directory() . '/style.css');
  $about_version = filemtime(get_template_directory() . '/src/css/page-about.css');
  $assessment_version = filemtime(get_template_directory() . '/src/css/page-assessment.css');
  $results_version = filemtime(get_template_directory() . '/src/css/page-results.css');

  // Enqueue stylesheets
  wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), $style_version);
  if (is_page('o-nas')) {
    wp_enqueue_style('page-about', get_template_directory_uri() . '/src/css/page-about.css', array(), $about_version);
  }
  if (is_page_template('templates/page-assessment.php')) {
    wp_enqueue_style('page-assessment', get_template_directory_uri() . '/src/css/page-assessment.css', array(), $assessment_version);
  }
  if (is_page_template('templates/page-results.php')) {
    wp_enqueue_style('page-results', get_template_directory_uri() . '/src/css/page-results.css', array(), $results_version);
  }
  wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '5.3.2', 'all');
  wp_enqueue_style(
    'owl-carousel-css',
    'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css',
    array(),
    '2.3.4',
    'all'
  );
  wp_enqueue_style(
    'owl-carousel-theme-css',
    'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css',
    array('owl-carousel-css'),
    '2.3.4',
    'all'
  );
  // Enqueue scripts
  wp_enqueue_script('jquery');
  wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.2', true);
  wp_enqueue_script(
    'owl-carousel-js',
    'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js',
    array('jquery'),
    '2.3.4',
    true
  );
  wp_enqueue_script('script', get_template_directory_uri() . '/src/js/script.js', array('jquery', 'owl-carousel-js'), filemtime(get_template_directory() . '/src/js/script.js'), true);
}

add_action('wp_enqueue_scripts', 'enqueue_scripts');

function add_articles_script()
{
  wp_enqueue_script('articles-pagination', get_stylesheet_directory_uri() . '/src/js/articles-pagination.js', array('jquery'), '1.0', true);
  wp_localize_script('articles-pagination', 'articlesData', array(
    'postsPerPage' => 3,
    'totalArticles' => count($GLOBALS['articleItems']),
  ));
}
add_action('wp_enqueue_scripts', 'add_articles_script');

function load_more_posts()
{
  $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
  $postsPerPage = 3;

  $args = array(
    'post_type' => 'post',
    'posts_per_page' => $postsPerPage,
    'paged' => $page,
    'order' => 'ASC',
  );

  $query = new WP_Query($args);

  if ($query->have_posts()):
    while ($query->have_posts()):
      $query->the_post(); ?>
      <div class="knowledge">
        <div class="img-container">
          <?php if (has_post_thumbnail()): ?>
            <a href="<?php the_permalink(); ?>">
              <img loading="lazy" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>"
                alt="<?php the_title(); ?>"></a>
          <?php else: ?>
            <img loading="lazy" src="<?php echo get_stylesheet_directory_uri() . "/src/images/default-thumbnail.jpg"; ?>"
              alt="Default Thumbnail">
          <?php endif; ?>
        </div>
        <div class="text-container">
          <div class="heading-container">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <p><?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?></p>
          </div>
        </div>

        <a href="<?php the_permalink(); ?>" class="read-more">Czytaj więcej <svg xmlns="http://www.w3.org/2000/svg" width="16"
            height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
              d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
          </svg></a>
      </div>
    <?php endwhile;
  endif;

  wp_reset_postdata();
  die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');



add_action('wp_ajax_load_more_posts', 'load_more_posts'); // If logged in
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts'); // If not logged in

function enqueue_ajax_script()
{
  // Enqueue your jQuery
  wp_enqueue_script('jquery');

  // Enqueue your custom JS file
  wp_enqueue_script('load-more', get_template_directory_uri() . '/src/js/load-more.js', array('jquery'), null, true);

  // Localize script to pass AJAX URL and other data to JS
  wp_localize_script('load-more', 'loadmore_params', array(
    'ajax_url' => admin_url('admin-ajax.php'), // Pass AJAX URL
  ));
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_script');

function disable_js_errors()
{
  echo '<script type="text/javascript">
          window.onerror = function(message, source, lineno, colno, error) {
              return true;
          };
        </script>';
}
add_action('wp_footer', 'disable_js_errors');
function add_critical_css()
{
  $critical_css = '
        * {
            font-family: Lexend, sans-serif;
        }
        .hero-banner .img-holder,
        .hero-banner .img-holder2 {
            background-image: url("' . get_stylesheet_directory_uri() . '/src/images/home/kv_sinulan.webp");
        }
    ';
  echo '<style id="critical-css">' . $critical_css . '</style>';
}

// Defer non-critical CSS
function defer_non_critical_css()
{
  function defer_stylesheet($html, $handle, $href, $media)
  {
    if ($media === 'all') {
      // Don't defer critical stylesheets - add their handles to this array
      $critical_styles = ['your-critical-style-handle'];
      if (!in_array($handle, $critical_styles)) {
        return str_replace("media='all'", "media='print' onload=\"this.media='all'\"", $html);
      }
    }
    return $html;
  }
  add_filter('style_loader_tag', 'defer_stylesheet', 10, 4);
}
add_action('wp_enqueue_scripts', 'defer_non_critical_css');

// Defer non-critical JavaScript
function defer_non_critical_js()
{
  if (!is_admin()) {
    function defer_js($tag, $handle, $src)
    {
      // Add handles of scripts that shouldn't be deferred
      $critical_scripts = ['jquery'];

      if (!in_array($handle, $critical_scripts)) {
        return str_replace(' src', ' defer src', $tag);
      }
      return $tag;
    }
    add_filter('script_loader_tag', 'defer_js', 10, 3);
  }
}
add_action('wp_enqueue_scripts', 'defer_non_critical_js');

// Add to functions.php
function optimize_wp_resources()
{
  // Remove unnecessary WordPress features
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wp_shortlink_wp_head');

  // Disable emoji scripts
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');

  // Remove query strings from static resources
  add_filter('style_loader_src', 'remove_version_query', 999);
  add_filter('script_loader_src', 'remove_version_query', 999);
}
add_action('init', 'optimize_wp_resources');

function remove_version_query($src)
{
  if (strpos($src, '?ver='))
    $src = remove_query_arg('ver', $src);
  return $src;
}

function add_google_tag_manager_noscript()
{
  ?>
  <!-- Google Tag Manager (noscript) -->
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKXVQM" height="0" width="0"
      style="display:none;visibility:hidden"></iframe>
  </noscript>
  <!-- End Google Tag Manager (noscript) -->
  <?php
}
add_action('wp_enqueue_scripts', 'add_google_tag_manager_noscript');

function generate_page_toc() {
  global $post;
  $content = $post->post_content;
  
  // Parse content for headings
  preg_match_all('/<h([2-6]).*?>(.*?)<\/h[2-6]>/i', $content, $matches, PREG_SET_ORDER);
  
  if (empty($matches)) return '';
  
  $toc = '<div class="page-toc"><h4>Na tej stronie</h4><ul>';
  $current_section = 1;
  
  foreach ($matches as $heading) {
      $level = $heading[1];
      $title = strip_tags($heading[2]);
      $anchor = sanitize_title($title);
      
      // Add anchor to original heading in content with scroll padding
      $content = str_replace(
          $heading[0], 
          '<h' . $level . ' id="' . $anchor . '" style="scroll-margin-top: 100px;">' . $heading[2] . '</h' . $level . '>',
          $content
      );
      
      $toc .= '<li class="toc-item"><a href="#' . $anchor . '" class="toc-link"><span class="section-number">' . $current_section . '</span> ' . $title . '</a></li>';
      $current_section++;
  }
  
  $toc .= '</ul></div>';
  
  // Update post content with anchors
  $post->post_content = $content;
  
  return $toc;
}
function enqueue_toc_highlight_script() {
  if (is_single()) {
      wp_enqueue_script('toc-highlight', get_template_directory_uri() . '/src/js/toc-highlight.js', array(), '1.0.0', true);
  }
}
add_action('wp_enqueue_scripts', 'enqueue_toc_highlight_script');

function enqueue_back_to_top_script() {
  if (is_single()) {
      wp_enqueue_script('back-to-top', get_template_directory_uri() . '/src/js/back-to-top.js', array(), '1.0.0', true);
  }
}
add_action('wp_enqueue_scripts', 'enqueue_back_to_top_script');

function custom_quiz_result_rewrite() {
  add_rewrite_rule(
      '^rozpocznij-test/wynik/([a-zA-Z0-9]+)/?$',
      'index.php?pagename=quiz-result&result_id=$matches[1]',
      'top'
  );
}
add_action('init', 'custom_quiz_result_rewrite');


function custom_quiz_result_query_vars($vars) {
  $vars[] = 'quiz_id';
  return $vars;
}
add_filter('query_vars', 'custom_quiz_result_query_vars');

function enqueue_pdf_scripts() {
  // Only load on quiz result pages
  if (get_query_var('quiz_id', 0) > 0) {
      // Enqueue jQuery first
      wp_enqueue_script('jquery');
      
      // Enqueue libraries in the correct order
      wp_enqueue_script('html2canvas', 'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js', array('jquery'), '1.4.1', true);
      wp_enqueue_script('jspdf', 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js', array('jquery', 'html2canvas'), '2.5.1', true);
      
      // Enqueue custom script
      wp_enqueue_script('quiz-pdf-generator', get_template_directory_uri() . '/src/js/quiz-pdf.js', array('jquery', 'jspdf', 'html2canvas'), '1.0.0', true);
      
      // Pass quiz data to JavaScript
      $quiz_data = array(
          'site_name' => get_bloginfo('name'),
          'date' => date('F j, Y')
      );
      wp_localize_script('quiz-pdf-generator', 'quizData', $quiz_data);
  }
}
add_action('wp_enqueue_scripts', 'enqueue_pdf_scripts');