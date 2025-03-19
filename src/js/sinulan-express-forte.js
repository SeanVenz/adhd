document.addEventListener('DOMContentLoaded', function() {
    const mobileBreakpoint = 768;
    const graphSteps = document.querySelectorAll('.graph-step');

    function updateImageSources() {
        const isMobile = window.innerWidth < mobileBreakpoint;
        graphSteps.forEach(step => {
            const mobileSrc = step.getAttribute('data-mobile-src');
            const desktopSrc = step.getAttribute('data-desktop-src') || step.src;
            
            if (!step.getAttribute('data-desktop-src')) {
                step.setAttribute('data-desktop-src', desktopSrc);
            }

            if (isMobile && mobileSrc) {
                step.src = mobileSrc;
            } else {
                step.src = step.getAttribute('data-desktop-src');
            }
        });
    }

    // Update on page load
    updateImageSources();

    // Update on window resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(updateImageSources, 250);
    });
});
