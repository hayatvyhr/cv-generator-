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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Vitae Form</title>
    <style>
        fieldset {
            width: 550px;
            margin: auto;
        }

        label {
            display: inline-block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555; 
        }
        legend {
            font-size: 1.2em;
            font-weight: bold;
            color: #007bff; /* Blue color for legends */
        }


        .ipt label {
            display: inline-block;
            width: 200px;
            margin-bottom: 10px;
        }

        input {
            width: 180px;
            margin-bottom: 10px;
        }

        .ipt input {
            width: 180px;
            margin-bottom: 10px;
        }
        input[name="Telecharger"] {
        background-color: blue; /* Green color */
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px; /* Adjust the margin-top value as needed */
        font-size: 16px;
    }

    </style>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data" id="myForm">
        <fieldset>
            <fieldset class="ipt">
                <legend>Cordonnees Personnels</legend>
                <label for="nom">Nom: </label>
                <input type="text" name="nom" required>
                <br>
                <label for="prenom">Prenom:</label>
                <input type="text" name="prenom" required>
                <br>
                <label for="age">Age:</label>
                <input type="text" name="age" required>
                <br>
                <label for="telephone">Numero de Telephone:</label>
                <input type="tel" name="telephone" required>
                <br>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </fieldset>
            <fieldset>
                <legend>Photo</legend>
                <label for="image">Photo:</label>
                <input type="file" name="image">
            </fieldset>
            <fieldset>
                <legend>Stage et Formation </legend>
                <label for="stage">Stage</label>
                <textarea name="stage" id="" cols="30" rows="2"></textarea>
                <br>
                <label for="formtion">Formation</label>
                <textarea name="formation" id="" cols="30" rows="2"></textarea>
            </fieldset>
            <fieldset>
                <label for="Competence">Competence</label>
                <textarea name="Competence" id="" cols="30" rows="2"></textarea>
                <br>
    <label for="centreintr">Centre d'interet</label>
    <input type="text" name="centreintr">
    <br>
    <label for="langues">Langues</label>
     <input type="text" name="langues">
</fieldset>
<input type="submit" name="Telecharger" value="Telecharger">

</fieldset>
</form>
</body>
</html>

