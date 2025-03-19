document.addEventListener('DOMContentLoaded', function() {
    // Get the button
    const backToTopButton = document.getElementById('back-to-top');
    
    // Show button when page is scrolled down 300px
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            backToTopButton.classList.add('visible');
        } else {
            backToTopButton.classList.remove('visible');
        }
    });
    
    // Scroll to top when button is clicked
    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});