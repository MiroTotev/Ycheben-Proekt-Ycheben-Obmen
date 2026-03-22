<?php
// Check if a file is uploaded
if (isset($_FILES['file'])) {
    // Specify the directory where files will be saved
    $uploadDirectory = 'uploads/';

    // Create the uploads directory if it doesn't exist
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0755, true);
    }

    // Get the file details
    $fileName = $_FILES['file']['name'];
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];

    // Check for errors
    if ($fileError === 0) {
        // Move the uploaded file to the desired directory
        $destination = $uploadDirectory . $fileName;
        if (move_uploaded_file($fileTmpPath, $destination)) {
            echo 'File uploaded successfully: ' . $fileName;
        } else {
            echo 'Error moving the uploaded file.';
        }
    } else {
        echo 'Error uploading the file. Error code: ' . $fileError;
    }
} else {
    echo 'No file uploaded.';
}
?>