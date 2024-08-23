<?php
// Handle POST request from JavaScript
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve quiz data from POST request
    $quizData = $_POST["quizData"];

    // Generate PDF content
    $pdfContent = "Quiz Result:\n\n";
    $pdfContent .= "Score: " . $quizData["totalScore"] . "\n";
    // Add more details as needed

    // Save PDF content to database
    // Insert code to save $pdfContent to your database

    // Generate PDF file
    // Insert code to generate PDF file using $pdfContent

    // Return success response
    echo json_encode(array("success" => true));
} else {
    // Return error response for invalid request
    echo json_encode(array("error" => "Invalid request"));
}
?>
function downloadPDF() {
    const userName = document.getElementById('name').value;
    const userPhone = document.getElementById('phone').value;
    const uniqueNumber = Math.floor(Math.random() * 1000000); // Generate a random number
    const fileName = `${userName}_${userPhone}_${uniqueNumber}_Prescription.pdf`;

    const element = document.getElementById('wrapper');

    // Create a copy of the element to modify for PDF generation
    const elementCopy = element.cloneNode(true);
    const downloadButton = elementCopy.querySelector('.download-pdf-button');
    if (downloadButton) {
        downloadButton.parentNode.removeChild(downloadButton);
    }

    // Add styling to the container to mimic a doctor's prescription
    elementCopy.style.position = 'relative';
    elementCopy.style.padding = '20px';
    elementCopy.style.border = '1px solid #000';
    elementCopy.style.backgroundColor = '#f9f9f9';
    elementCopy.style.textAlign = 'justify'; // Justify the text

    // Add clinic name and address (Header)
    const headerDiv = document.createElement('div');
    headerDiv.style.textAlign = 'center';
    headerDiv.style.fontSize = '20px';
    headerDiv.style.fontWeight = 'bold';
    headerDiv.style.color = '#4caf50';
    headerDiv.textContent = 'Life Science Clinic';
    elementCopy.insertBefore(headerDiv, elementCopy.firstChild);

    // Add clinic address and contact info below header
    const contactInfoDiv = document.createElement('div');
    contactInfoDiv.style.textAlign = 'center';
    contactInfoDiv.style.fontSize = '12px';
    contactInfoDiv.style.marginTop = '5px';
    contactInfoDiv.style.color = '#555';
    contactInfoDiv.textContent = '123 Science Road, Knowledge City, TX 75001 | Phone: (123) 456-7890';
    elementCopy.insertBefore(contactInfoDiv, elementCopy.firstChild);

    // Add patient info section
    const patientInfoDiv = document.createElement('div');
    patientInfoDiv.style.marginTop = '20px';
    patientInfoDiv.style.fontSize = '14px';
    patientInfoDiv.style.color = '#000';
    patientInfoDiv.innerHTML = `<strong>Name:</strong> ${userName} <br> <strong>Phone:</strong> ${userPhone} <br> <strong>ID:</strong> ${uniqueNumber}`;
    elementCopy.insertBefore(patientInfoDiv, elementCopy.firstChild);

    // Add footer with doctor's signature line and date
    const footerDiv = document.createElement('div');
    footerDiv.style.position = 'absolute';
    footerDiv.style.bottom = '10px';
    footerDiv.style.width = '100%';
    footerDiv.style.display = 'flex';
    footerDiv.style.justifyContent = 'space-between';
    footerDiv.style.fontSize = '14px';
    footerDiv.style.color = '#000';
    footerDiv.innerHTML = `<div><strong>Date:</strong> ${new Date().toLocaleDateString()}</div><div><strong>Doctor's Signature:</strong> ____________________</div>`;
    elementCopy.appendChild(footerDiv);

    // Add Rx symbol
    const rxSymbol = document.createElement('div');
    rxSymbol.style.position = 'absolute';
    rxSymbol.style.top = '10px';
    rxSymbol.style.left = '10px';
    rxSymbol.style.fontSize = '48px';
    rxSymbol.style.fontWeight = 'bold';
    rxSymbol.style.color = '#4caf50';
    rxSymbol.textContent = 'Rx';
    elementCopy.appendChild(rxSymbol);

    // Ensure content fits within one page by setting page size
    const options = {
        margin: [10, 10, 10, 10],
        filename: fileName,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
        pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
    };

    // Generate PDF using html2pdf library
    html2pdf()
        .from(elementCopy)
        .set(options)
        .save();
}