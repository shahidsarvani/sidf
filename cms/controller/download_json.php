<?php

require './../config/config.php';

if(isset($_GET['name']) && $_GET['name'] != '') {
    // Process download
	
    $filepath = ($_GET['name'] == "sections.json") ? BASE_PATH . '/process/'.$_GET['name'] : BASE_PATH . '/'.$_GET['name'];
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
        // unlink($filepath);
        die();
    } else {
        http_response_code(404);
        die();
    }
    
    $response = true;
} else {
    http_response_code(404);
    die();
    // $response = false;
}
echo json_encode($response);
