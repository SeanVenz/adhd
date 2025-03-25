(function($) {
    $(document).ready(function() {
        $('#download-pdf-btn, #download-pdf-btn-mobile').on('touchstart click', function(e) {
            e.preventDefault(); // Prevent double execution

            const button = $(this);
            const originalText = button.html(); // Save original button text
            button.html('<span class="loader"></span> Generowanie...').prop('disabled', true);

            generatePDF(button, originalText);
        });

        function generatePDF(button, originalText) {
            if (typeof window.jspdf === 'undefined' || typeof html2canvas === 'undefined') {
                alert('PDF generation libraries not loaded properly. Please try again or contact support.');
                button.html(originalText).prop('disabled', false);
                return;
            }

            const element = document.getElementById('quiz-result-container');
            if (!element) {
                alert('Could not generate PDF: Element not found');
                button.html(originalText).prop('disabled', false);
                return;
            }

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            html2canvas(element, {
                scale: 2,
                useCORS: true,
                logging: false,
                allowTaint: true
            }).then(function(canvas) {
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 190;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;

                doc.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
                doc.setFontSize(10);
                doc.text('Generated on ' + (quizData?.date || 'Unknown Date'), 10, 285);

                doc.save('wyniki_quizu.pdf');

                // Restore button text after saving
                button.html(originalText).prop('disabled', false);
            }).catch(function(error) {
                console.error('Error generating PDF:', error);
                alert('Could not generate PDF. Please try again later.');
                button.html(originalText).prop('disabled', false);
            });
        }
    });
})(jQuery);
