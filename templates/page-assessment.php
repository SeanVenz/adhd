<?php
/**
 * Template Name: Assessment
 */
get_header();

$table_results = $wpdb->prefix . "mlw_results";

$total_results = $wpdb->get_var("SELECT COUNT(*) FROM {$table_results}");

?>

<style>
  .quiz.has-results {
    background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/home/Test_assesstment_BG.webp') !important;
  }
</style>

<section class="quiz">
  <div class="header-holder">
    <a href="<?php echo get_home_url(); ?>"> <span>Dom</span> <svg xmlns="http://www.w3.org/2000/svg" width="24"
        height="24" fill="#17462B" class="bi bi-house-fill" viewBox="0 0 16 16">
        <path
          d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
      </svg></a>

    <p class="counter-quiz">Ocenę wypełniło ponad <strong><?php echo $total_results ?></strong> osób.</p>
    <div></div>
  </div>
  <div class="min-width">

    <div class="quiz-holder">

      <div class="short-code">

        <?php echo do_shortcode('[qsm quiz=1]'); ?>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>

<?php wp_reset_postdata(); ?>

<script>
  document.addEventListener('DOMContentLoaded', function () {

    // Define the function
    function checkAndUpdateQuiz() {
      document.querySelectorAll('.quiz').forEach(function (quizDiv) {
        if (quizDiv.querySelector('.qmn_results_page')) {
          quizDiv.classList.add('has-results');
        }
      });
    }

    // Run the check initially
    checkAndUpdateQuiz();

    // Set up a MutationObserver to detect dynamic changes
    const observer = new MutationObserver(function (mutations) {
      let needsCheck = false;

      mutations.forEach(function (mutation) {
        if (mutation.addedNodes.length) {
          needsCheck = true;
        }
      });

      if (needsCheck) {
        setTimeout(checkAndUpdateQuiz, 100); // Small delay to ensure DOM updates
      }
    });

    // Observe quiz containers for changes
    const quizContainers = document.querySelectorAll('.quiz-holder, .short-code');
    quizContainers.forEach(container => {
      observer.observe(container, { childList: true, subtree: true });
    });

    // Also observe body as fallback
    observer.observe(document.body, { childList: true, subtree: true });

    // jQuery event listener for clicking on answers
    jQuery(document).ready(function ($) {

      $(document).on("click", ".qmn_mc_answer_wrap", function (e) {

        var radioInput = $(this).find('input[type="radio"]');
        if (radioInput.length) {

          radioInput.prop("checked", true).trigger("change").focus();
        } else {
        }
      });
    });

    function updatePageIndicator() {
      let pageIndicator = document.querySelector(".pages_count"); // Adjust class if needed
      if (pageIndicator) {
        let text = pageIndicator.innerText.trim(); // Get current text
        let match = text.match(/(\d+)\s*out\s*of\s*(\d+)/i); // Match "X out of Y"

        if (match) {
          let currentPage = match[1];
          let totalPages = match[2];
          pageIndicator.innerText = `${currentPage} of ${totalPages}`; // Change format dynamically
        }
      }
    }

    // Run immediately on page load
    updatePageIndicator();

    // Observe changes in the pageIndicator element
    let targetNode = document.querySelector(".pages_count");
    if (targetNode) {
      let observer = new MutationObserver(updatePageIndicator);
      observer.observe(targetNode, { childList: true, subtree: true, characterData: true });
    }
  });

</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const el = document.querySelector('.pages_count');
    if (el) {
      el.textContent = el.textContent.replace(/\bof\b/, 'z');
    }
  });
</script>

<script>
  function updateNextButtonState() {
    // 1) Only operate on *real* quiz pages (skip the intro)
    const currentPage = document.querySelector(".qsm-page:not([style*='display: none'])");
    if (!currentPage) {
      console.log("No visible .qsm-page found.");
      return;
    }
    // if this visible page is still the intro, bail out
    if (currentPage.classList.contains('quiz_begin')) {
      console.log("Intro page — skipping counter‑hide logic.");
      return;
    }

    // 2) Grab radios, next button and your counters
    const options  = currentPage.querySelectorAll("input[type='radio'].qmn_quiz_radio");
    const nextBtn  = document.querySelector("a.mlw_custom_next");
    const counters = document.querySelectorAll("p.counter-quiz");

    if (!nextBtn) {
      console.log("❌ Next button not found.");
      return;
    }

    // 3) Hide counters whenever Next exists on a *real* quiz page
    counters.forEach(c => c.style.display = 'none');
    console.log("ℹ️ Counters hidden");

    // 4) Enable/disable Next based on selection
    const checkSelection = () => {
      const any = Array.from(options).some(o => o.checked);
      if (any) {
        nextBtn.classList.remove("qsm-disabled");
        nextBtn.style.pointerEvents = "auto";
        console.log("✔ Option selected — Next enabled");
      } else {
        nextBtn.classList.add("qsm-disabled");
        nextBtn.style.pointerEvents = "none";
        console.log("❌ No option — Next disabled");
      }
    };

    // initially disable
    nextBtn.classList.add("qsm-disabled");
    nextBtn.style.pointerEvents = "none";

    // tear down old listeners by replacing the inputs
    options.forEach(opt => {
      const parent = opt.parentNode;
      parent.replaceChild(opt.cloneNode(true), opt);
    });

    // re‑query and bind
    currentPage.querySelectorAll("input[type='radio'].qmn_quiz_radio").forEach(opt => {
      opt.addEventListener("change", checkSelection, { once: true });

      if (opt.id) {
        const lbl = currentPage.querySelector(`label[for="${opt.id}"]`);
        if (lbl) {
          lbl.addEventListener("click", () => setTimeout(checkSelection, 50), { once: true });
        }
      }

      const wrap = opt.closest('.qmn_mc_answer_wrap');
      if (wrap) {
        wrap.addEventListener("click", () => setTimeout(checkSelection, 50), { once: true });
      }
    });

    // initial check
    checkSelection();
  }

  window.addEventListener("load", () => {
    setTimeout(updateNextButtonState, 300);

    const obs = new MutationObserver(muts => {
      for (const m of muts) {
        if (m.type === 'childList') {
          setTimeout(updateNextButtonState, 100);
          break;
        }
      }
    });

    obs.observe(document.body, { childList: true, subtree: true });
  });
</script>

