<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title(); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css"
    integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/home/hero_bg.webp" as="image">
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
  <!-- CookieYes -->
  <script id="cookieyes" type="text/javascript"
    src="https://cdn-cookieyes.com/client_data/39c0dd27d0929bd7a9ba64b2/script.js"></script>
  <!-- End CookieYes -->

  <!-- Google Tag Manager -->
  <script>
    (function (w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-TJZ9KD8W');
  </script>
  <!-- End Google Tag Manager -->
  <noscript>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
  </noscript>
  <?php
  wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <!-- Google Tag Manager (noscript) -->
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TJZ9KD8W" height="0" width="0"
      style="display:none;visibility:hidden"></iframe>
  </noscript>
  <!-- End Google Tag Manager (noscript) -->

  <?php
  $activePages = ['o-projekcie', 'rozpocznij-ocene', 'centrum-wiedzy'];
  ?>

  <header class="<?php echo is_front_page() ? 'home-header' : 'default-header'; ?>">
    <nav class="navbar navbar-expand-md" style="padding:0px">
      <div class="container container-small nav-container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
          aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <!-- Burger Icon -->
          <svg class="burger-icon" xmlns="http://www.w3.org/2000/svg" id="Warstwa_2" data-name="Warstwa 2"
            viewBox="0 0 264.9 249.9" width="30" height="30">
            <defs></defs>
            <g id="Warstwa_1-2" data-name="Warstwa 1">
              <rect class="cls-1" x=".15" y=".15" width="264.6" height="40.8" rx="20.4" ry="20.4"></rect>
              <rect class="cls-1" x=".15" y="104.55" width="264.6" height="40.8" rx="20.4" ry="20.4"></rect>
              <rect class="cls-1" x=".15" y="208.95" width="264.6" height="40.8" rx="20.4" ry="20.4"></rect>
            </g>
          </svg>
          <!-- X Icon -->
          <svg class="x-icon" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
            fill="#17462B" stroke="#17462B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            style="display: none;">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
        <a class="navbar-brand" style="padding:0px" href="<?php echo get_home_url(); ?>" aria-label="Go to Home Page">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/adhd_Logo.png" alt="Logo">
        </a>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-md-none">
              <a class="navbar-brand" style="padding:0px" href="<?php echo get_home_url(); ?>"
                aria-label="Go to Home Page">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/home/adhd_Logo.png" alt="Logo">
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if (is_front_page())
                echo 'active'; ?>" aria-current="page" style="padding:5px;" href="<?php echo get_home_url(); ?>">Strona
                główna</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if (is_page('o-projekcie'))
                echo 'active'; ?>" style="padding:5px;" href="<?php echo get_home_url(); ?>/o-projekcie">O
                projekcie</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php
              if (is_page('rozpocznij-test')) {
                echo 'active';
              }
              ?>" style="padding:5px;" href="<?php echo get_home_url(); ?>/rozpocznij-test">Test ASRS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php
              if (is_page('centrum-wiedzy')) {
                echo 'active';
              }
              ?>" style="padding:5px;" href="<?php echo get_home_url(); ?>/centrum-wiedzy">Centrum Wiedzy</a>
            </li>
          </ul>
        </div>

      </div>
    </nav>
  </header>

  <script>
    document.addEventListener('DOMContentLoaded', function () { window.addEventListener('scroll', function () { const header = document.querySelector('header'); if (window.scrollY > 0) { header.classList.add('scrolled') } else { header.classList.remove('scrolled') } }); const navbarToggler = document.querySelector('.navbar-toggler'); const burgerIcon = document.querySelector('.burger-icon'); const xIcon = document.querySelector('.x-icon'); window.addEventListener('scroll', function () { const header = document.querySelector('header'); if (window.scrollY > 1) { header.style.padding = '10px 0'; header.classList.add('scrolled') } else { header.style.padding = '40px 0'; header.classList.remove('scrolled') } }); navbarToggler.addEventListener('click', function () { if (burgerIcon.style.display === 'none') { burgerIcon.style.display = 'block'; xIcon.style.display = 'none' } else { burgerIcon.style.display = 'none'; xIcon.style.display = 'block' } }); const navbarCollapse = document.getElementById('navbarText'); navbarCollapse.addEventListener('hidden.bs.collapse', function () { burgerIcon.style.display = 'block'; xIcon.style.display = 'none' }); navbarCollapse.addEventListener('shown.bs.collapse', function () { burgerIcon.style.display = 'none'; xIcon.style.display = 'block' }) })
  </script>