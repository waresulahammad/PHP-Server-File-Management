// Direct file transfer from one hosting to another hosting
// Download file link should be public

<?php
$url = 'https://waresul.site/new.printmystuff.sg.zip'; // Download file public url
$path = basename($url); // Automatically keeps original name

$remoteFile = @fopen($url, 'r');

if ($remoteFile) {
    if (file_put_contents($path, $remoteFile)) {
        echo "✅ Download completed as '$path'.";
    } else {
        echo "❌ Download failed: Could not save the file.";
    }
    fclose($remoteFile);
} else {
    echo "❌ Download failed: Could not access the URL.";
}
?>
