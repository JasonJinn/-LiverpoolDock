<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 11/04/2017
 * Time: 12:36 AM
 */
//unfinished

function makedir($mail,$repositoryUrl){
    mkdir($repositoryUrl."/".$mail."/"."private",0777,true);
    mkdir($repositoryUrl."/".$mail."/"."public",0777,true);
    mkdir($repositoryUrl."/../".md5(md5($mail).md5($mail)),0777,true); //need configure
}

function maketeacherdir($name,$repositoryUrl){
    mkdir($repositoryUrl."/../".$name."/"."lecture",0777,true);
    mkdir($repositoryUrl."/../".$name."/"."lab",0777,true);
    mkdir($repositoryUrl."/../".$name."/"."assessment",0777,true);

}
?>