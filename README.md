# ADHD7 WordPress Theme Documentation

It is a custom theme for https://adhd-owcy.pl/ site.

## 1. Purpose and Scope
This theme powers an educational and assessment-focused Polish website about ADHD. It delivers: 
- A marketing / informational homepage
- A structured article (knowledge center) system
- An ADHD self-assessment (Quiz – ASRS) workflow with results processing and PDF export
- A specialist (doctors / facilities) locator page with interactive map + synchronized list
- Static legal pages (privacy policy, terms)
- An about/project information page

All templates are built as classic PHP WordPress templates (no block theme JSON) and rely on Advanced Custom Fields (ACF) style calls via `get_field()` for dynamic labels/content.

## 2. Directory Overview
```
wp-content/themes/adhd/
  header.php          Global <head> and navigation
  footer.php          Global footer markup + inline styling
  functions.php       Core theme setup, assets, performance tweaks, helpers
  front-page.php      Homepage template (Template Name: Homepage)
  single.php          Single post layout incl. dynamic Table of Contents support
  index.php           Fallback archive/index
  page-*.php / templates/*  Custom page templates (assessment, results, about, doctors, etc.)
  template-parts/     Re-usable partials (blogs, featured, step blocks, etc.)
  src/css/            Page‑scoped CSS (about, assessment, results)
  src/js/             JavaScript assets (pagination, quiz PDF, misc interactions)
  assets/             Images, logos, SVGs
  style.css           Global stylesheet + theme header metadata
  README.md           This documentation
```

## 3. Global Components
### header.php
- Outputs meta, font preconnects, Bootstrap 4.2.1 CSS include (CDN) and GTM script.
- Calls `wp_head()` for WordPress script/style injection.
- Fixed header with scroll state class toggle (`header.scrolled`).
- Responsive navigation with mobile toggler and custom inline script handling icon swap (burger ↔ close) and scroll padding adjustments.
- Navigation labels pulled from ACF fields (e.g. `get_field('strona_glowna')`).

### footer.php
- Inline CSS encapsulated inside `<style>` (non-enqueued) for footer layout.
- Defines arrays for socials, quick links, and contact but social output currently commented out.
- Legal / navigation links again surface ACF based labels.

## 4. Core Logic (functions.php)
Key responsibilities:
- Theme supports: thumbnails, formats, WooCommerce + product gallery features.
- Asset enqueue logic with file‑modification based versioning to aid cache busting.
- Conditional CSS enqueue: about (`is_page('o-projekcie')`), assessment/results via `is_page_template()` checks.
- External libraries (Bootstrap 5.3.2 bundle JS, OwlCarousel 2.3.4) + jQuery (WP bundled) + base script.
- Defer injection for selected scripts (`add_defer_attribute`).
- Articles pagination script is localized with total count from global `$articleItems`.
- AJAX endpoint `load_more_posts` for article loading (action registered for logged in and anonymous users).
- Additional AJAX script `load-more.js` localized with `ajax_url`.
- Error swallowing snippet via `window.onerror` (suppresses all JS errors site-wide) — reduces noise but hides real issues.
- Critical CSS injection placeholder and non-critical CSS deferring by switching media to print until load.
- Resource optimizations: removes meta bloat (generator, wlwmanifest, etc.), emoji scripts, strips version query parameters.
- TOC generation (`generate_page_toc`) scans post content for headings (H2–H6), injects IDs and returns a built list; modifies global `$post->post_content` in place.
- Conditional enqueue for TOC highlighting and back-to-top scripts only on single posts.
- Custom rewrite rule for quiz results: `/rozpocznij-test/wynik/{id}` mapped to virtual page.
- Adds custom query var (`quiz_id` placeholder; result_id resolved manually in template).
- Conditional PDF libraries enqueue for results pages (html2canvas + jsPDF + custom generator) based on request URI substring match.

## 5. Page Templates (templates/ and root)
### front-page.php (Homepage)
- Hero section with two primary CTAs (test start and knowledge center).
- Content sections fed entirely by ACF fields (hero, concentration, development, well-being blocks).
- Structured lists of feature cards each with SVG icons.

### page-about-us.php (About Us)
- Hero style section with ACF-fed heading, subheading, paragraph, and three feature badge items.
- Includes (commented out) history section placeholder.
- Static arrays for showcasing example centers (currently hard-coded placeholder data) — retained for potential dynamic expansion.

### page-assessment.php (Assessment)
- Displays quiz (shortcode `[qsm quiz=1]` – Quiz And Survey Master plugin assumed).
- Queries total quiz completions directly from `$wpdb->prefix . "mlw_results"` table for a live counter.
- MutationObserver script adds `.has-results` class to `.quiz` container when results appear dynamically.
- Polish localization adjustments (page number format change) after DOM mutation.

### page-results.php (Quiz Result Page)
- Pulls result ID from pretty URL segment.
- Fetches serialized quiz results from `mlw_results` table.
- Parses first section's questions; maps textual answers to numeric values (0–4).
- Implements shaded response counting for first 6 (Part A) per ASRS logic; builds category aggregates by term taxonomy.
- Prepares derived structures: categories, scoring, and potential interpretive metrics.
- (Truncated excerpt provided indicates a larger block that calculates composite data and outputs structured result UI.)

### page-article.php (Articles Listing)
- Custom query for featured posts (category slug: `featured`).
- Server-rendered loop for initial set; client-side progressive loading handled elsewhere (see AJAX section).
- Inline CSS defines large responsive article cards with green branding.

### single.php (Single Post)
- Renders post with styled large hero image (full-width, fixed aspect) and dynamic TOC (provided by `generate_page_toc`).
- Sidebar TOC with active link highlighting; sticky behavior managed with pure CSS and JS highlight script.
- Back-to-top button functionality conditionally enqueued.

### page-privacy-policy.php / page-terms.php
- Legal content wrappers with consistent width constraints and typography. (Only privacy excerpt shown; terms assumed analogous.)

### page-doctors.php (Doctors / Specialist Locator)
- Fetches serialized `wp_mapit_pins` data from postmeta table to build list of specialists.
- Complex client-side discovery of Leaflet map instance produced by WP MapIt plugin (multiple fallback strategies scanning globals, nested objects, layer registries).
- Synchronizes list item clicks with marker lookup (by index, coordinate rounding, nearest fallback) and opens popups.
- Adds animated map centering using `setView(... { animate: true, duration, easeLinearity })` for a smooth zoom.
- Includes live search filtering of specialists and active state styling.
- Accessible ARIA/data attributes could be future enhancement (currently not heavily used).

### Other templates
- `page-testimonials.php`, `page-terms.php`, `page-doctors.php`, etc., follow the pattern: `get_header()`, inline or external styles, structured semantic sections, `get_footer()`.

## 6. Template Parts (template-parts/)
Not fully enumerated here, but typical roles based on naming:
- `blogs.php`, `blogs-main.php`: Modular loops or featured blog compositions.
- `breakdown.php`: Likely quiz or scoring breakdown partial.
- `featured.php`: Highlighted article block.
- `information.php`, `step.php`: Sectional content units for reuse on multiple pages.
These are included via `get_template_part()` calls (search not shown but inferred). They modularize repeated front-end blocks.

## 7. JavaScript Assets (src/js)
| File | Purpose |
|------|---------|
| script.js | Initializes OwlCarousel (3 → responsive 1/2/3 items). Minified jQuery wrapper. |
| articles-pagination.js | Handles AJAX loading of additional posts (GET request to `admin-ajax.php` with `page` param). Updates button state and hides on exhaustion. |
| load-more.js | (Not listed in excerpt, but enqueued in `enqueue_ajax_script` for generic load-more behavior). |
| quiz-pdf.js | PDF generation for result page using html2canvas + jsPDF: full-page capture, multi-page slicing, button state management, error handling. |
| toc-highlight.js | (Inferred) Listens to scroll and applies `active` class to TOC anchors; enqueued only on single posts. |
| back-to-top.js | (Inferred) Adds a scroll-to-top button interaction for long posts. |
| quiz-pdf.js | Only conditionally enqueued when URL matches quiz result path. |

## 8. Styling Strategy
- Global branding in `style.css` using CSS custom properties (greens, neutrals).
- Inline styles per template for rapid iteration (e.g., footer, articles, privacy page). This mixes concerns but reduces dependency management overhead.
- Page-specific stylesheets in `src/css/` for about, assessment, and results pages; loaded conditionally for performance.
- Box shadows, gradients, and subtle interactions emphasize clickable modules.

## 9. Data and Dynamic Content
- ACF fields supply nearly all user-facing copy for navigational items and section content.
- Quiz data relies on external Quiz plugin tables (`mlw_results`) and taxonomy terms for categorization.
- Doctors map pins pulled from meta key `wp_mapit_pins` (serialized array with marker_title, marker_content, lat/lng).

## 10. Performance and Loading Optimizations
- Conditional enqueueing of page-scoped CSS.
- File modification times used as version cache-busters.
- Defer of most JS except critical jQuery handle.
- Removal of WordPress head noise (generator, wlwmanifest, RSD, emojis, shortlinks).
- Defer technique for CSS (media swap) prepared, but critical styles list is effectively empty (placeholder only).
- Potential trade-off: globally suppressing JS errors may conceal production issues.

## 11. Accessibility and Internationalization Notes
- Language is Polish; theme does not wrap strings in translation functions (`__()`, `_e()`), instead relies on ACF-managed labels. This limits localization flexibility.
- Navigation uses semantic lists. Some SVGs lack explicit `role`/`aria-hidden` attributes.
- Interactive map popups and doctor list items could further benefit from ARIA roles and keyboard bindings.

## 12. Security Considerations
- Output escaping: Mix of `esc_html()`, `esc_url()`, but some raw echoes for structured HTML (e.g., result breakdown) should be audited (`wp_kses_post` where needed).
- Direct DB queries (results pages) depend on `$wpdb->prepare` for dynamic IDs (correct in shown snippet).
- AJAX endpoint returns raw HTML blocks; relies implicitly on standard post sanitization.

## 13. AJAX and Dynamic Behaviors
- Endpoint: `load_more_posts` (GET) returns additional post cards in a stream pattern.
- Pagination button updates label states (Loading / Error / Hidden when spent).
- Quiz page uses DOM observation to adapt styling when results appear.

## 14. Quiz Result Processing (Summary)
- Deserializes stored results structure.
- Counts “shaded responses” across part A for quick clinical screening logic (ASRS style logic—count threshold likely used downstream, though threshold logic not shown in excerpt).
- Aggregates category scores by taxonomy, enabling category-specific scoring or interpretations.
- Provides base for later visual or PDF export features (PDF script enqueued separately by URL match logic).

## 15. PDF Generation Workflow
- Trigger buttons (`#download-pdf-btn`, `#download-pdf-btn-mobile`) replaced with loader state during generation.
- Entire result container captured as a high-resolution canvas (scale=2) and sliced into A4 pages if needed.
- Re-displays controls after save.

## 16. Doctors Map Integration Details
- Markers discovered by scanning multiple potential plugin internals (e.g., global variables, nested `_map` references, layers).
- Marker association uses: direct index, coordinate rounding map, nearest-distance fallback.
- Popups built with sanitized HTML fragments.
- Smooth pan+zoom implemented using Leaflet animation options.
- Search input filters visible list; list click drives marker focus and popup.

## 17. Table of Contents System (Single Posts)
- Headings H2–H6 parsed server-side; IDs injected with `scroll-margin-top` for proper in-page anchor offset beneath fixed header.
- Client script highlights active heading and provides number sequencing.

## 18. Known Trade-offs / Improvements
| Area | Observation | Potential Improvement |
|------|-------------|-----------------------|
| Inline CSS | Many templates embed large `<style>` blocks | Consolidate into modular SCSS/CSS files with build pipeline |
| Error suppression | Global `window.onerror` returns true | Replace with selective logging or monitoring integration |
| i18n | Strings not wrapped for translation | Wrap static text in translation functions + `.pot` generation |
| Accessibility | Limited aria-label usage in SVG/menu toggler | Add roles, focus states, keyboard handlers |
| Performance | Multiple external CDNs (fonts, Bootstrap) | Consider self-hosting critical assets + font-display swap |
| Security | Some echoed markup without contextual escaping | Audit with `esc_html`, `esc_attr`, `wp_kses_post` |
| Doctors page complexity | Large monolithic script embedded inline | Extract to dedicated JS module for maintainability |

## 19. Deployment / Caching Notes
- Versioning via `filemtime` ensures browsers update on deploy but can break long-term CDN caching if not managed.
- Removal of query strings may reduce some proxy cache granularity.

## 20. Dependencies and External Services
- WordPress core + ACF (implied by `get_field()` calls)
- Quiz and Survey Master plugin (MLW tables and quiz shortcode)
- WP MapIt (Leaflet map / pins)
- Bootstrap (two versions used: header uses 4.2.1 CSS; functions.php enqueues 5.3.2 JS bundle — version mismatch risk)
- OwlCarousel 2.3.4
- html2canvas 1.4.1, jsPDF 2.5.1 for PDF export
- Google Tag Manager / Google Fonts

## 21. Coding Conventions
- Mixed indentation and inline styling across templates.
- Asset naming uses hyphenated page-intent patterns (e.g., `page-results.css`).
- Minimal abstraction; procedural PHP + inline HTML dominate.

## 22. Suggested Next Steps
1. Unify Bootstrap version (mismatch may cause component JS/CSS inconsistencies).
2. Migrate inline scripts/styles into enqueue-managed files.
3. Introduce build tooling (e.g., npm + SCSS) for maintainability.
4. Harden escaping and security for dynamic HTML fragments.
5. Add automated linting (PHP_CodeSniffer + ESLint + Stylelint).
6. Add translation readiness.
7. Refactor doctors map logic into modular JS with testable units.
8. Replace global error suppression with structured logging.

## 23. Summary
The theme is a custom, performance‑minded but pragmatically implemented WordPress theme focused on educational ADHD content, self-assessment tools, and resource discovery. It blends ACF-driven content, plugin integrations (quiz, mapping), and custom client-side interactivity. Future work should emphasize maintainability, accessibility, internationalization, and modularization.
