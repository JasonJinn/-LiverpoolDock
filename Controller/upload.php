<?php
require_once 'method/Flow/Autoloader.php';
Flow\Autoloader::register();

$config = new \Flow\Config();
$config->setTempDir('../Upload_Chunks');
$file = new \Flow\File($config);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($file->checkChunk()) {
        header("HTTP/1.1 200 Ok");
    } else {
        header("HTTP/1.1 204 No Content");
        return ;
    }
} else {
    if ($file->validateChunk()) {
        $file->saveChunk();
    } else {
        // error, invalid chunk upload request, retry
        header("HTTP/1.1 400 Bad Request");
        return ;
    }
}
if ($file->validateFile() && $file->save('../Repo/'.$_POST['flowFilename'])) {
    // File upload was completed
    echo "Upload complete";
	
	//Small chance to prune abandoned chunks, avoids using crontab, can be amended later
	if (1 == mt_rand(1, 500)) {
		\Flow\Uploader::pruneChunks('../Upload_Chunks');
	}
} else {
    // This is not a final chunk, continue to upload
}
?>