<?php

require './../../config/config.php';
$filepath = BASE_PATH . '/timeline_items.json';

// Process download
if (file_exists($filepath)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));
    flush(); // Flush system output buffer
    readfile($filepath);
    unlink($filepath);
    die();
} else {
    http_response_code(404);
    die();
}

$response = true;
echo json_encode($response);
