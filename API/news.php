<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 08/04/2017
 * Time: 12:06 AM
 */
include "../Controller/method/urlCatcher.php";
include "../Controller/method/variable.php";

$url = $newsUrl;
$count = 0;
$page = 0;
$hash=array();
while($count<5)
{
    $urls = newsUrlCatch($url.date("Y/m/d",time()-$page*60*60*24)."/");
    for($i=0;$i<count($urls);$i++){
        $content = contentCatch($urls[$i]);
        $hash[$content["title"]]=$content;
        $count++;
        //echo json_encode($content,JSON_UNESCAPED_SLASHES);
    }
    $urls=null;
    $page++;
}

echo json_encode($hash,JSON_UNESCAPED_SLASHES);

?>