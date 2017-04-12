<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 09/04/2017
 * Time: 10:55 PM
 */
function newsUrlCatch($url){
    $html = file_get_contents($url);

    preg_match("/<article class=\"content\" role=\"main\">(.*?)<\/article>/s",$html,$article);

    preg_match_all("/<a href=\"(.*?)\" rel/s",$article[0],$matches);
    return $matches[1];
}

function contentCatch($url){
    $hash=array();
    $html = file_get_contents($url);
//**************
    preg_match("/<h1 class=\"entry-title\">(.*)?<\/h1>/",$html,$matches);
    $title=$matches[1];
    //echo $title;
    $hash["title"] = $title;
//****************

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
    //echo $article;
    $hash["article"] = $article;
//*****************
    preg_match("/https:\/\/news\.liverpool\.ac\.uk\/wp-content\/uploads(.*?)\.jpg/s",$html,$matches);
    $picture = $matches[0];
    //print_r($picture);
    $hash["pictureURL"] = $picture;
    return $hash;
}
?>