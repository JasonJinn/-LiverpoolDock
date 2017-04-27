<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 06/04/2017
 * Time: 9:42 PM
 */
//include "method/smtp.php";
//
//$smtpserver = "ssl://smtp.mail.yahoo.com";
//
//$smtpserverport = 465;
//
//$smtpusermail = "LiverpoolDock@yahoo.com";
//
//$smtpemailto = "524867701@qq.com";
//
//$smtpuser = "LiverpoolDock@yahoo.com";
//$smtppass = "tricycle15";
//
//$isauth = true;
//
//$mailtype = "TXT";
//
//$mailsubject = "hello";
//
//$mailbody = "I am jeffer";
//
//
//$smtp = new smtp($smtpserver, $smtpserverport, $isauth, $smtpuser, $smtppass);
//
//
//$smtp->debug = false;
//
//
//$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
//
//echo "mail sent";
//include 'method/DES.php';
//include '../DAO/Database.php';
//
//$dao = getQuery('User');
//$result = $dao->get(array("token"=>"UmUMOVZhCwgHJwEoBTVVZVVoBmIGNlQzUm1SN19uDzM="));
//
//print_r(array_values($reuslt));
//$html = file_get_contents("https://news.liverpool.ac.uk/2017/04/06/");
//
//preg_match("/<article class=\"content\" role=\"main\">(.*?)<\/article>/s",$html,$article);
////print_r($article);
//
//preg_match_all("/<a href=\"(.*?)\" rel/s",$article[0],$matches);
//print_r($matches[1]);


//include "../Controller/method/urlCatcher.php";
//include "../Controller/method/variable.php";
//include "../DAO/Database.php";
//
//$url = $newsUrl;
//$count = 0;
//$page = 3;
//$hash = array();
//$dao = getQuery("news");
//
//
////echo $url.date("Y/m/d",time()-$page*60*60*24)."/";
////
////    $urls = newsUrlCatch($url.date("Y/m/d",time()-$page*60*60*24)."/");
////  //  print_r($urls);
//////echo count($urls);
////
////        $content = contentCatch($urls[0]);
////        //print_r($content);
////        print_r( json_decode(json_encode($content,JSON_UNESCAPED_SLASHES),true));
//        //echo var_dump(json_last_error());
//        //echo iconv("UTF-8","UTF-8//IGNORE",$s);
//    //$content = contentCatch($urls[0]);
//    //print_r($content);
//
//
////    $page++;
//
//
////echo json_encode($hash);
//
//$dir= mkdir("hello",0777,true);
//chmod("hello",0777);
//if($dir)
//    echo 1;
//else
//    echo 2;


//print_r($_FILES);
//$name = $_FILES['myFile']['tmp_name'];
//$fname = $_FILES['myFile']['name'];
//echo $name;
//echo copy($name,"hello/".$fname);

//echo mkdir("/Users/shoujiafeng/desktop/repository/"."524867701/"."private",0777,true);
//include "../DAO/Database.php";
//
//$dao = getQuery("User");
//$cnt = $dao->getMax("level_of_security");
//
//print_r($cnt);
//print_r(json_decode(file_get_contents("http://localhost/-liverpooldock/API/moduleList.php?token=UGdTZlNkXF9VdQ4nUWEGNlZrUjZSbQZmBTIAagc0CDY%3D"),true));
//include "../DAO/Database.php";
//
//$dao=getQuery("votingOption");
//$result = $dao->getDistinct("poll_option",array("poll_id"=>1));
//print_r($result);
//echo date("Y-m-d H:i:s",time());
include "../DAO/Database.php";

$dao = getQuery("message");
$cnt = $dao->insert(array("from_user"=>"Jeffer","to_user"=>"Je",
    "content"=>"hello","time"=>date("Y-m-d H:i:s",time()),"isRead"=>"1"));
print_r($cnt);
?>