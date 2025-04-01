<?php
function deleteFolder($folderPath) {
    if (!is_dir($folderPath)) {
        echo "The folder does not exist.";
        return false;
    }
    
    $files = array_diff(scandir($folderPath), ['.', '..']);
    
    foreach ($files as $file) {
        $filePath = $folderPath . DIRECTORY_SEPARATOR . $file;
        if (is_dir($filePath)) {
            deleteFolder($filePath);
        } else {
            unlink($filePath);
        }
    }
    
    return rmdir($folderPath);
}

$folderToDelete = __DIR__ . '/old_2'; // Adjust the path if needed
if (deleteFolder($folderToDelete)) {
    echo "Folder deleted successfully.";
} else {
    echo "Failed to delete folder.";
}
?>
