<style>
  .footer {
    background: #F8F8E7;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 96px;
    flex-direction: column;
    gap: 60px;
    width: 100%;
    z-index: 100;
  }

  .footer ul {
    list-style-type: none;
    display: flex;
    flex-direction: row;
    gap: 8px;
    padding-left: 0;
  }

  .socials-holder {
    display: flex;
    flex-direction: row;
    gap: 24px;
  }

  .socials-holder span {
    font-weight: 500;
    font-size: 16px;
    color: #17462B;
  }

  .footer-holder {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 64px;
  }

  .logo-holder {
    width: 100%;
    display: flex;
    justify-content: space-between;
  }

  .ql-holder {
    width: 100%;
    display: flex;
    flex-direction: row;
    gap: 228px;
  }

  .ql-holder .navigation {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .navigation a {
    text-decoration: none;
    font-family: 'Manrope';
    font-weight: 500;
    font-size: 16px;
    color: #17462B;
  }

  .navigation .contact {
    display: flex;
    flex-direction: row;
    gap: 8px;
    align-items: center;
  }

  .navigation h5 {
    font-family: 'Manrope';
    font-weight: 500;
    font-size: 32px;
    color: #17462B;
  }

  .privacy {
    padding: 24px 12px;
    display: flex;
    flex-direction: row;
    gap: 100px;
    font-family: 'Manrope';
    font-weight: 400;
    font-size: 16px;
    color: #17462B;
  }

  .privacy a {
    text-decoration: none;
    font-family: 'Manrope';
    font-weight: 400;
    font-size: 16px;
    color: #17462B;
  }

  @media (max-width: 1024px) {
    .footer {
      padding-top: 48px;
      /* Reduce padding */
      gap: 40px;
    }

    .footer-holder {
      gap: 40px;
      /* Reduce spacing */
    }

    .logo-holder {
      flex-direction: row;
      align-items: center;
      text-align: center;
      gap: 16px;
    }

    .socials-holder span {
      display: none;
    }

    .socials-holder {
      flex-direction: column;
      align-items: center;
      gap: 12px;
    }

    .ql-holder {
      flex-direction: column;
      gap: 32px;
      text-align: center;
      align-items: center;
    }

    .ql-holder .navigation {
      align-items: center;
    }

    .navigation h5 {
      font-size: 24px;
      /* Reduce heading size */
    }

    .navigation a {
      font-size: 14px;
      /* Reduce font size */
    }

    .privacy {
      flex-direction: column;
      text-align: center;
      gap: 16px;
    }
  }

  @media (max-width: 768px) {
    .footer {
      padding-top: 32px;
      gap: 32px;
    }

    .ql-holder .navigation {
      width: 100%;
      justify-content: flex-start;
      align-items: flex-start;
    }

    .footer ul {
      margin-bottom: 0;
    }

    .footer-holder {
      gap: 32px;
    }

    .ql-holder {
      gap: 24px;
    }

    .navigation h5 {
      font-size: 20px;
    }

    .navigation a {
      font-size: 14px;
    }

    .privacy {
      gap: 44px;
      flex-direction: row;
      width: 100%;
      justify-content: center;
      align-items: center;
    }
  }

  @media (max-width: 480px) {
    .footer {
      padding-top: 24px;
      gap: 24px;
    }

    .ql-holder {
      gap: 64px;
    }

    .navigation h5 {
      font-size: 18px;
    }

    .navigation a {
      font-size: 12px;
    }

    .privacy {
      font-size: 14px;
    }
  }
</style>

<!-- CONSTANT DECLARATION -->
<?php
$socials = [
  [
    "icon" => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#17462B" class="bi bi-facebook" viewBox="0 0 16 16">
  <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
</svg>',
    "link" => "/",
  ],
  [
    "icon" => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#17462B" class="bi bi-linkedin" viewBox="0 0 16 16">
  <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
</svg>',
    "link" => "/"
  ]
];

$homeLinks = [
  ["text" => "Strona główna", "link" => "/"],
  ["text" => "O nas", "link" => "o-nas"],
  ["text" => "Ocena ADHD", "link" => "/"],
  ["text" => "Centrum Wiedzy", "link" => "centrum-wiedzy"],
  ["text" => "Kontakt", "link" => "/"],
];

$contact = [
  [
    "text" => "email_address",
    "link" => "/",
    "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
  <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
</svg>'
  ],
  [
    "text" => "contact_number",
    "link" => "/",
    "svg" => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
  <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
</svg>'
  ],
];
?>

<footer class="footer">
  <div class="min-width">
    <div class="footer-holder">
      <div class="logo-holder">
        ADHD
        <div class="socials-holder">
          <span>Media społecznościowe:</span>
          <ul class="socials">
            <?php foreach ($socials as $social): ?>
              <li>
                <a href="<?php echo htmlspecialchars($social['link']); ?>">
                  <?php echo $social['icon']; ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="ql-holder">
        <!-- <ul class="navigation">
          <h5>Lorem Ipsum</h5>
          <?php foreach ($navigation as $nav): ?>
            <li>
              <a href="<?php echo htmlspecialchars($nav['link']); ?>">
                <?php echo htmlspecialchars($nav['text']); ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul> -->
        <ul class="navigation">
          <h5>Szybkie linki</h5>
          <?php foreach ($homeLinks as $link): ?>
            <li>
              <a href="<?php echo htmlspecialchars($link['link']); ?>">
                <?php echo htmlspecialchars($link['text']); ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
        <ul class="navigation">
          <h5>Skontaktuj się z nami</h5>
          <?php foreach ($contact as $cont): ?>
            <li>
              <a class="contact" href="<?php echo get_home_url(); ?> / <?php echo htmlspecialchars($cont['link']); ?>">
                <?php echo $cont['svg']; ?>   <?php echo htmlspecialchars($cont['text']); ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="privacy">
    <a href="/regulamin">Regulamin</a>
    <a href="/polityka-prywatnosci">Polityka prywatności</a>
  </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>