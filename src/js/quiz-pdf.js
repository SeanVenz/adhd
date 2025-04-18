(function ($) {
    $(document).ready(function () {
        $('#download-pdf-btn, #download-pdf-btn-mobile').on('touchstart click', function (e) {
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

            $('#download-pdf-btn').hide();
            $('#download-pdf-btn-mobile').hide();
            $('#show-breakdown-btn').hide();
            document.querySelector('.result-score-holder').style.justifyContent = 'center';

            // Temporarily show the breakdown section so it appears in the PDF
            // $('#pdf-breakdown').show();

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({
                orientation: 'p', // Portrait mode
                unit: 'mm',
                format: 'a4' // Standard PDF format
            });

            const contentElement = document.querySelector('#quiz-result-container');

            // A4 dimensions in mm
            const pageWidth = 210;
            const pageHeight = 297;
            const margin = 10; // 10mm margin
            const contentWidth = pageWidth - (2 * margin);
            const contentHeight = pageHeight - (2 * margin);

            html2canvas(contentElement, {
                scale: 2, // Increase resolution
                useCORS: true,
                logging: false,
                allowTaint: true,
                scrollX: 0,
                scrollY: 0,
                windowWidth: contentElement.scrollWidth,
                windowHeight: contentElement.scrollHeight
            }).then(function (canvas) {
                const imgData = canvas.toDataURL('image/png');

                // Calculate the scaled height based on the content width
                const imgWidth = contentWidth;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;

                // Calculate how many pages we need
                const totalPages = Math.ceil(imgHeight / contentHeight);

                // Add content across multiple pages if needed
                let heightLeft = imgHeight;
                let position = 0; // Initial position
                let currentPage = 0;

                // Add image to first page
                doc.addImage(imgData, 'PNG', margin, margin, imgWidth, imgHeight, null, 'FAST');
                heightLeft -= contentHeight;

                // Add additional pages if needed
                while (heightLeft > 0) {
                    currentPage++;
                    position = -(currentPage * contentHeight);

                    // Add new page
                    doc.addPage();

                    // Add part of the image that belongs on this page
                    doc.addImage(imgData, 'PNG', margin, position + margin, imgWidth, imgHeight, null, 'FAST');

                    heightLeft -= contentHeight;
                }

                // Add footer with date on each page
                const pageCount = doc.internal.getNumberOfPages();
                for (let i = 1; i <= pageCount; i++) {
                    doc.setPage(i);
                    doc.setFontSize(10);
                }

                doc.save('wyniki_quizu.pdf');

                // Hide the breakdown after PDF generation
                // $('#pdf-breakdown').hide();
                button.html(originalText).prop('disabled', false);
                $('#download-pdf-btn').show();
                $('#show-breakdown-btn').show();
                $('#download-pdf-btn-mobile').show();
                document.querySelector('.result-score-holder').style.justifyContent = 'space-between';
            }).catch(function (error) {
                console.error('Error generating PDF:', error);
                alert('Could not generate PDF. Please try again later.');
                // Ensure breakdown is hidden if there was an error
                // $('#pdf-breakdown').hide();
                button.html(originalText).prop('disabled', false);
                $('#download-pdf-btn').show();
                $('#show-breakdown-btn').show();
                $('#download-pdf-btn-mobile').show();
                document.querySelector('.result-score-holder').style.justifyContent = 'space-between';
            });
        }
    });
})(jQuery);