<?php
require_once 'method/Flow/Autoloader.php';
require_once 'method/variable.php';
require_once '../DAO/Database.php';
include_once "method/tokenVerify.php";

Flow\Autoloader::register();

$config = new \Flow\Config();
$config->setTempDir('../Upload_Chunks');
$file = new \Flow\File($config);
if(verifyToken($_COOKIE['token'])=='true') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if ($file->checkChunk()) {
            header("HTTP/1.1 200 Ok");
        } else {
            header("HTTP/1.1 204 No Content");
            return;
        }
    } else {
        if ($file->validateChunk()) {
            $file->saveChunk();
        } else {
            // error, invalid chunk upload request, retry
            header("HTTP/1.1 400 Bad Request");
            return;
        }
    }
    if ($file->validateFile()&&$_POST["staff"]=='student' &&
        $file->save($repositoryUrl . '/' . urlencode($_COOKIE['mail']) . '/' . $_POST['Repotype'] . '/' . $_POST['flowFilename'])) {
        // File upload was completed
        $dao = getQuery('file');
        $dao->insert(array('mail' => $_COOKIE['mail'], 'name' => $_POST['flowFilename'],
            'size' => $_POST['flowTotalSize'], 'Repo' => $_POST['Repotype'],'time'=>date("Y/m/d H:i:s", time())));

        echo "Upload complete";

        //Small chance to prune abandoned chunks, avoids using crontab, can be amended later
        if (1 == mt_rand(1, 500)) {
            \Flow\Uploader::pruneChunks('../Upload_Chunks');
        }
    } else {
        // This is not a final chunk, continue to upload
    }

    if ($file->validateFile()&&$_POST["staff"]=='teacher' &&
        $file->save($teacherRepository . '/' . $_POST["code"] . '/' .$_POST["type"]. '/' . $_POST['flowFilename'])) {
        // File upload was completed
        $dao = getQuery('module_material');
        $dao->insert(array('uploader' => $_COOKIE['mail'], 'file_name' => $_POST['flowFilename'],
            'file_type' => $_POST['type'], 'module_code'=>$_POST["code"], 'time'=>date("Y/m/d H:i:s", time())));
        if($_POST['type']=='assessment' && isset($_POST["deadline"]) )
            $dao->update(array("deadline"=>$_POST['deadline']),array('uploader' => $_COOKIE['mail'], 'file_name' => $_POST['flowFilename'],
                'file_type' => $_POST['type'],'module_code'=>$_POST["code"]));

        echo "Upload complete";

        //Small chance to prune abandoned chunks, avoids using crontab, can be amended later
        if (1 == mt_rand(1, 500)) {
            \Flow\Uploader::pruneChunks('../Upload_Chunks');
        }
    } else {
        // This is not a final chunk, continue to upload
    }
}else{
    header("HTTP/1.1 404 NOT FOUND");
}
?>

