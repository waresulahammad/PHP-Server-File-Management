<?php

// Increase execution time and memory limit to handle large files
ini_set('max_execution_time', 0); // No time limit
ini_set('memory_limit', '1024M'); // Increase memory limit

function downloadFile($fileUrl, $saveTo) {
    $fp = fopen($saveTo, 'w');
    if (!$fp) {
        die("Error: Unable to open file for writing.");
    }
    
    $ch = curl_init($fileUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_BUFFERSIZE, 8192); // Download in 8KB chunks
    curl_setopt($ch, CURLOPT_NOPROGRESS, false);
    curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, function ($resource, $downloadSize, $downloaded) {
        if ($downloadSize > 0) {
            echo "\rDownloading: " . round(($downloaded / $downloadSize) * 100, 2) . "% completed";
            flush();
        }
    });
    curl_exec($ch);
    
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    fclose($fp);
    
    if ($httpCode !== 200) {
        die("Error downloading file. HTTP Code: " . $httpCode);
    }
    
    echo "\nFile downloaded successfully as $saveTo!";
}

// Direct download link from Google Drive
$directDownloadLink = "https://drive.usercontent.google.com/download?id=1kUFw-eApF7CWda8hPzJ1o41wfQsYQf_H&export=download";
// Setup a New file name in the hosting
$savePath = __DIR__ . "/file-name.zip";

downloadFile($directDownloadLink, $savePath);
?>
