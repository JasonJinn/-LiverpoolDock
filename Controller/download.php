<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 30/04/2017
 * Time: 11:13 PM
 */
require_once 'method/variable.php';
require_once 'method/tokenVerify.php';
header("Content-type:text/html;charset=utf-8");
//need repository(public or private);
//need filename ()

if(verifyToken($_COOKIE['token'])=='true'){
    $file_name=$_REQUEST['filename'];

    $file_name=iconv("utf-8","gb2312",$file_name);
    $file_sub_path=$repositoryUrl."/".urlencode($_COOKIE['mail'])."/".$_REQUEST['repository']."/";
    $file_path=$file_sub_path.$file_name;

    if(!file_exists($file_path)){
        echo "no such file";
        return ;
    }
    $fp=fopen($file_path,"r");
    $file_size=filesize($file_path);
    //head
    Header("Content-type: application/octet-stream");
    Header("Accept-Ranges: bytes");
    Header("Accept-Length:".$file_size);
    Header("Content-Disposition: attachment; filename=".$file_name);
    $buffer=1024;
    $file_count=0;
    //return data
    while(!feof($fp) && $file_count<$file_size){
        $file_con=fread($fp,$buffer);
        $file_count+=$buffer;
        echo $file_con;
    }
    fclose($fp);
}else{
    echo "token failed";
    return;
}
?>