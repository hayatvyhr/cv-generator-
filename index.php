<?php
require 'fpdf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $stage = $_POST['stage'];
    $formation = $_POST['formation'];
    $competence = $_POST['Competence'];
    $centreintr = $_POST['centreintr'];
    $langues = $_POST['langues'];

    // Handle image upload
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        // Create PDF
        $pdf = new FPDF();
        $pdf->AddPage();

        // Set background color for the title
        $pdf->SetFillColor(128, 0, 128);
        $pdf->Rect(0, 0, $pdf->GetPageWidth(), 30, 'F');

        // Add title to PDF
        $pdf->SetFont('Arial', 'B', 30);
        $pdf->SetTextColor(255, 255, 255); // Set text color to white
        $pdf->Cell(0, 10, 'Curriculum Vitae', 0, 1, 'C', true);

        // Reset text color

        // Create clipping mask for circular image
        $pdf->SetFillColor(255, 255, 255); // Set fill color to white

        $pdf->Image($uploadFile, 15, 32, 50, 50, 'PNG', '', true);
    

        // Add space below the image
        $pdf->Ln(60);

        $pdf->SetTextColor(128, 0, 128);
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->Cell(0, 10, "Informations Personnelles", 0, 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, "$nom $prenom ", 0, 1);
        $pdf->Cell(0, 10, "Age: $age", 0, 1);
        $pdf->Cell(0, 10, "Tel: $telephone", 0, 1);
        $pdf->Cell(0, 10, "$email", 0, 1);

        $pdf->Ln(10);

        $pdf->SetTextColor(128, 0, 128);
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->Cell(0, 10, "Formation et Stage", 0, 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(0, 10,"Stage: $stage", 1, 'L');
        $pdf->Ln(5);
        $pdf->MultiCell(0, 10, "Formation: $formation", 1, 'L');
        $pdf->Ln(10);

        $pdf->SetTextColor(128, 0, 128);
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->Cell(0, 10, "Competences et Langues", 0, 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(0, 10, "Competence: $competence", 1, 'L');
        $pdf->Cell(0, 10, "Centre d'interet: $centreintr", 0, 1);
        $pdf->Cell(0, 10, "Langues: $langues", 0, 1);

        // 'D' stands for download. Output the PDF, specifying the name of the downloaded file
        $pdf->Output('D', 'Curriculum_Vitae.pdf');

        // Delete the uploaded file after use
        unlink($uploadFile);

        exit();
    } else {
        echo 'Failed to upload image.';
    }
}


?>
