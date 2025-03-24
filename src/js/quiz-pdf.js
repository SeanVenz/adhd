(function($) {
    $(document).ready(function() {
        // Add click handler to the download button
        $('#download-pdf-btn').on('click', function() {
            generatePDF();
        });
        
        function generatePDF() {
            // Make sure jsPDF and html2canvas are properly loaded
            if (typeof window.jspdf === 'undefined' || typeof html2canvas === 'undefined') {
                alert('PDF generation libraries not loaded properly. Please try again or contact support.');
                return;
            }
            
            // Get the element - ensure it exists before proceeding
            const element = document.getElementById('quiz-result-container');
            if (!element) {
                console.error('Element not found: quiz-result-container');
                alert('Could not generate PDF: Element not found');
                return;
            }
            
            // Create instance of jsPDF
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            
            // Use html2canvas with proper options
            html2canvas(element, {
                scale: 2, // Higher scale for better quality
                useCORS: true,
                logging: false,
                allowTaint: true
            }).then(function(canvas) {
                const imgData = canvas.toDataURL('image/png');
                
                // Add image to PDF
                const imgWidth = 190;
                const pageHeight = 295;
                const imgHeight = canvas.height * imgWidth / canvas.width;
                let position = 10;
                
                doc.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                
                // Add footer
                doc.setFontSize(10);
                doc.text('Generated on ' + quizData.date, 10, 285);
                
                // Save the PDF
                doc.save('quiz_results.pdf');
            }).catch(function(error) {
                console.error('Error generating PDF:', error);
                alert('Could not generate PDF. Please try again later.');
            });
        }
    });
})(jQuery);