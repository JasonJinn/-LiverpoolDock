<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 11/04/2017
 * Time: 12:36 AM
 */
//unfinished

function makedir($mail,$repositoryUrl,$repositoryUrl1){
    mkdir($repositoryUrl."/".urlencode($mail)."/"."private",0777,true);
    mkdir($repositoryUrl."/".urlencode($mail)."/"."public",0777,true);
    mkdir($repositoryUrl1."/".md5(md5($mail).md5($mail)),0777,true); //need configure
}

function maketeacherdir($name,$repositoryUrl){
    mkdir($repositoryUrl."/lecture",0777,true);
    mkdir($repositoryUrl."/lab",0777,true);
    mkdir($repositoryUrl."/assessment",0777,true);
}
?>