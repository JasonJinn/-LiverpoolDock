<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 11/04/2017
 * Time: 12:42 AM
 */
//unfinished
include "method/variable.php";

foreach($_FILES as $key =>$value){
    $tempFile = $value;
    $filename = $value['name'];
    $type = $value['type'];
    $tmp_name = $value['tmp_name'];
    $size=$value['size'];
    $error=$value['error'];

    //echo move_uploaded_file($tmp_name,$repositoryUrl."/$public");
}
?>