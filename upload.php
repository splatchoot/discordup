<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Check for any errors during the file upload
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Specify the directory where you want to save the uploaded files
        $uploadDir = 'uploads/';

        // Create the uploads directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir);
        }

        // Generate a unique filename to avoid conflicts
        $filename = uniqid() . '_' . $file['name'];
        $filePath = $uploadDir . $filename;

        // Move the uploaded file to the desired location
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            // Generate the link to the uploaded file
            $link = 'https://your-website.com/' . $filePath;

            // Redirect back to the index.html file with the link as a query parameter
            header('Location: index.html?link=' . urlencode($link));
            exit;
        } else {
            echo 'Error while moving the uploaded file.';
        }
    } else {
        echo 'Error during file upload: ' . $file['error'];
    }
} else {
    echo 'Invalid request.';
}
?>
