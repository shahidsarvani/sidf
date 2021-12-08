<?php

header('Content-Type: application/json'); // set json response headers

require './../../config/config.php';
require BASE_PATH . '/cms/model/Media.php';

$targetDir = $items_config['section_pillsvid_media_path'];
$images_url = $items_config['section_pillsvid_media_url'];
$media = new Media();

$outData = upload($targetDir, $images_url, $media); // a function to upload the bootstrap-fileinput files
echo json_encode($outData); // return json data
exit(); // terminate

// main upload function used above
// upload the bootstrap-fileinput files
// returns associative array
function upload($targetDir, $images_url, $media)
{
    $preview = $config = $errors = [];
    if (!file_exists($targetDir)) {
        @mkdir($targetDir);
    }
    // return $_POST;
    $fileBlob = 'fileBlob';                      // the parameter name that stores the file blob
    if (isset($_FILES[$fileBlob])) {
        $file = $_FILES[$fileBlob]['tmp_name'];  // the path for the uploaded file chunk 
        $fileName = $_POST['fileName'];          // you receive the file name as a separate post data
        $fileSize = $_POST['fileSize'];          // you receive the file size as a separate post data
        $fileId = $_POST['fileId'];              // you receive the file identifier as a separate post data
        $index =  $_POST['chunkIndex'];          // the current file chunk index
        $totalChunks = $_POST['chunkCount'];     // the total number of chunks for this file
        $targetFile = $targetDir . '/' . $fileName;  // your target file path
        $combined = true;
        if ($totalChunks > 1) {                  // create chunk files only if chunks are greater than 1
            $targetFile .= '_' . str_pad($index, 4, '0', STR_PAD_LEFT);
            $combined = false;
        }


        // $thumbnail = 'unknown.jpg';
        if (move_uploaded_file($file, $targetFile)) {
            // get list of all chunks uploaded so far to server
            $chunks = glob("{$targetDir}/{$fileName}_*");
            // check uploaded chunks so far (do not combine files if only one chunk received)
            $allChunksUploaded = $totalChunks > 1 && count($chunks) == $totalChunks;
            if ($allChunksUploaded) {           // all chunks were uploaded
                $outFile = $targetDir . '/' . $fileName;
                // combines all file chunks to one file
                $combined = combineChunks($chunks, $outFile);
            }
            $targetUrl = $images_url . $fileName;
            $ext = pathinfo($targetUrl, PATHINFO_EXTENSION);
            if ($ext == 'avi' || $ext == 'mp4' || $ext == 'wmv' || $ext == 'mkv' || $ext == 'webm' || $ext == 'mp4' || $ext == 'flv' || $ext == 'mp4' || $ext == 'amv' || $ext == 'm4p' || $ext == 'm4v' || $ext == 'mpg' || $ext == 'mpeg') {
                $type = 'video';
            } else {
                $type = 'image';
            }
            if ($combined) {
                $data = [
                    'name' => $fileName,
                    'file_key' => $fileId,
                    'type' => $type,
                    'filetype' => $type.'/'.$ext,
                ];
                $media_id = insert_into_media_table($media, $data);
            }
            // if you wish to generate a thumbnail image for the file
            // $targetUrl = getThumbnailUrl($path, $fileName);

            // separate link for the full blown image file
            // $zoomUrl = 'http://localhost/uploads/' . $fileName;
            // if()
            return [
                'chunkIndex' => $index,         // the chunk index processed
                'initialPreview' => $targetUrl, // the thumbnail preview data (e.g. image)
                'initialPreviewConfig' => [
                    [
                        'type' => $type,      // check previewTypes (set it to 'other' if you want no content preview)
                        'caption' => $fileName, // caption
                        'key' => $fileId,       // keys for deleting/reorganizing preview
                        'fileId' => $fileId,    // file identifier
                        'size' => $fileSize,    // file size
                        // 'zoomData' => $zoomUrl, // separate larger zoom data
                    ]
                ],
                'append' => true,
            ];
        } else {
            return [
                'error' => 'Error uploading chunk ' . $_POST['chunkIndex']
            ];
        }
    }
    return [
        'error' => 'No file found'
    ];
}

// combine all chunks
// no exception handling included here - you may wish to incorporate that
function combineChunks($chunks, $targetFile)
{
    // open target file handle
    $handle = fopen($targetFile, 'a+');

    foreach ($chunks as $file) {
        fwrite($handle, file_get_contents($file));
    }

    // you may need to do some checks to see if file 
    // is matching the original (e.g. by comparing file size)

    // after all are done delete the chunks
    foreach ($chunks as $file) {
        @unlink($file);
    }

    // close the file handle
    fclose($handle);
    return true;
}

function insert_into_media_table($media, $data)
{
    return $media->add_media($data);
}
 
// generate and fetch thumbnail for the file
// function getThumbnailUrl($path, $fileName) {
//     // assuming this is an image file or video file
//     // generate a compressed smaller version of the file
//     // here and return the status
//     $sourceFile = $path . '/' . $fileName;
//     $targetFile = $path . '/thumbs/' . $fileName;
//     //
//     // generateThumbnail: method to generate thumbnail (not included)
//     // using $sourceFile and $targetFile
//     //
//     if (generateThumbnail($sourceFile, $targetFile) === true) { 
//         return 'http://localhost/uploads/thumbs/' . $fileName;
//     } else {
//         return 'http://localhost/uploads/' . $fileName; // return the original file
//     }
// }
