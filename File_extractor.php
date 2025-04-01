<?php
$zip = new ZipArchive;
$zipFile = 'my-file-name.zip'; // Path to the zip file
$extractTo = 'extracted_files/'; // Directory where you want to extract the files (make sure this directory is inside your project)

// Check if the zip file exists
if ($zip->open($zipFile) === TRUE) {
    // Create directory if it doesn't exist
    if (!is_dir($extractTo)) {
        if (!mkdir($extractTo, 0777, true)) {
            die("Failed to create directory: " . $extractTo);
        }
    }

    // Extract the zip file
    if ($zip->extractTo($extractTo)) {
        echo "Files have been extracted successfully!";
    } else {
        echo "Error extracting files.";
    }

    // Close the zip file
    $zip->close();
} else {
    echo "Failed to open the zip file.";
}
?>
