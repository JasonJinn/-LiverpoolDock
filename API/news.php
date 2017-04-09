<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 08/04/2017
 * Time: 12:06 AM
 */
//$ch = curl_init();
//curl_setopt($ch,CURLOPT_URL,"https://news.liverpool.ac.uk/2017/04/07/vets-gets-ready-grand-national/");
//$html = curl_exec($ch);
//curl_close($ch);
//print escapeshellarg($html);
//$myfile = fopen("file.txt","w");
//fwrite($myfile,$html);
//fclose($myfile);
$html = file_get_contents("https://news.liverpool.ac.uk/2017/04/06/climate-chronic-insecurity-created-welfare-changes/");
//**************
preg_match("/<h1 class=\"entry-title\">(.*)?<\/h1>/",$html,$matches);
$title=$matches[1];
echo $title;
//****************
//if(preg_match("/<div class=\"entry-content\">/",$html))
//    echo 1;
//else
//    echo 2;

//***********************
preg_match_all("/<div class=\"entry-content\">(.*)?<\/div>/s",$html,$matches);
$content = $matches[1][0];

preg_match_all("/<p>(.+?)<\/p>/",$content,$matches);
$content1 = $matches[0];
$content2 = $matches[1];

$article="";
for($i=0;$i<count($content1);$i++){
    if(preg_match("/(jpg|title|<\/span>)/",$content1[$i])){

    }else{
        $article = $article.$content2[$i]."<br>";
    }
}
echo $article;
//*****************
//preg_match("/https:\/\/news\.liverpool\.ac\.uk\/wp-content\/uploads(.*)?\.jpg>/s",$html,$matches);
preg_match("/https:\/\/news\.liverpool\.ac\.uk\/wp-content\/uploads(.*?)\.jpg/s",$html,$matches);
$picture = $matches[0];
print_r($picture);
?>