(function($) {
    $(document).ready(function() {
        $('#download-pdf-btn, #download-pdf-btn-mobile').on('touchstart click', function(e) {
            e.preventDefault(); // Prevent double execution

            const button = $(this);
            const originalText = button.html(); // Save original button text
            button.html('<span class="loader"></span> Generowanie...').prop('disabled', true);

            generateFullPagePDF(button, originalText);
        });

        function generateFullPagePDF(button, originalText) {
            if (typeof window.jspdf === 'undefined' || typeof html2canvas === 'undefined') {
                alert('PDF generation libraries not loaded properly. Please try again or contact support.');
                button.html(originalText).prop('disabled', false);
                return;
            }

            // Temporarily show the breakdown section so it appears in the PDF
            $('#pdf-breakdown').show();

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({
                orientation: 'p', // Portrait mode
                unit: 'mm',
                format: 'a4' // Standard PDF format
            });

            html2canvas(document.body, {
                scale: 2, // Increase resolution
                useCORS: true,
                logging: false,
                allowTaint: true,
                scrollX: 0,
                scrollY: 0,
                windowWidth: document.documentElement.scrollWidth, // Ensures full width is captured
                windowHeight: document.documentElement.scrollHeight // Ensures full height is captured
            }).then(function(canvas) {
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 210; // A4 width in mm
                const imgHeight = (canvas.height * imgWidth) / canvas.width;

                doc.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                doc.setFontSize(10);
                doc.text('Generated on ' + (quizData?.date || 'Unknown Date'), 10, 285);

                doc.save('wyniki_quizu.pdf');

                // Hide the breakdown after PDF generation
                $('#pdf-breakdown').hide();
                button.html(originalText).prop('disabled', false);
            }).catch(function(error) {
                console.error('Error generating PDF:', error);
                alert('Could not generate PDF. Please try again later.');
                // Ensure breakdown is hidden if there was an error
                $('#pdf-breakdown').hide();
                button.html(originalText).prop('disabled', false);
            });
        }
    });
})(jQuery);