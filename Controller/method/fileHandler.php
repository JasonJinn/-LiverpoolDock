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
}
?>