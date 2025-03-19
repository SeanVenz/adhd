document.addEventListener('DOMContentLoaded', function() {
    // Get all section headings
    const headings = document.querySelectorAll('h2, h3, h4, h5, h6[id]');
    // Get all sidebar links
    const tocLinks = document.querySelectorAll('.sidebar .toc-item a');
    // Fixed navbar height offset - consistent value of 94px
    const navbarOffset = 100;
    
    // Back to top button functionality
    const backToTopButton = document.getElementById('back-to-top');
    if (backToTopButton) {
        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Add click event listeners to all TOC links
    tocLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get the target element
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                // Calculate position with navbar offset
                const offsetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navbarOffset;
                
                // Scroll to the element
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Set initial active state
    setActiveLink();
    
    // Update active link on scroll
    window.addEventListener('scroll', function() {
        setActiveLink();
    });
    
    function setActiveLink() {
        // Get current scroll position
        const scrollPosition = window.scrollY;
        
        // Determine which section is currently visible
        // Using consistent navbar offset throughout
        const highlightOffset = navbarOffset;
        
        // Default to first link if at top of page
        if (scrollPosition < 100) {
            setActive(tocLinks[0]);
            return;
        }
        
        // Check each section's position
        for (let i = 0; i < headings.length; i++) {
            const heading = headings[i];
            const sectionTop = heading.offsetTop - highlightOffset;
            const nextHeading = headings[i + 1];
            const sectionBottom = nextHeading ? nextHeading.offsetTop - highlightOffset : document.body.scrollHeight;
            
            // If current scroll position is within this section
            if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                // Find corresponding link in sidebar
                const id = heading.getAttribute('id');
                const correspondingLink = document.querySelector(`.sidebar a[href="#${id}"]`);
                
                if (correspondingLink) {
                    setActive(correspondingLink);
                }
                break;
            }
        }
    }
    
    function setActive(activeLink) {
        // Remove active class from all links
        tocLinks.forEach(link => {
            link.classList.remove('active');
        });
        
        // Add active class to current link
        if (activeLink) {
            activeLink.classList.add('active');
        }
    }
});