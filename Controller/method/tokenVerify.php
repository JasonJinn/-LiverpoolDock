<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 08/04/2017
 * Time: 10:16 PM
 */
include_once 'Database.php';
include_once 'DES.php';

function verifyToken($token)
{
    $dao = getQuery('User');
    $des = new DES('1996');
    //$token = $_GET['token'];
//echo $token.'<br>';
    $arr = explode('^&*', ($des->passport_decrypt($token)));
    $email = $arr[0];
    $time = $arr[1];
    $nowtime = time();
    $diff = $nowtime - $time;
//echo $email.'<br>';
    $result = $dao->get(array("email" => $email));

    $flag = isset($token);
    $flag = $result[0]['token'] == $token ? $flag : false;
    $flag = $diff > 60 * 30 ? false : $flag;

    if ($flag) {
        return "true";
    } else {
        return "false";
    }
}

?>