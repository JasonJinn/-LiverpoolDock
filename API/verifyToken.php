<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 06/04/2017
 * Time: 9:21 PM
 */
include '../DAO/Database.php';
include '../Controller/method/DES.php';

$dao = getQuery('User');
$des = new DES('1996');
$token = $_GET['token'];
//echo $token.'<br>';
$arr=explode( '^&*',($des->passport_decrypt($token)));
$email=$arr[0];
$time=$arr[1];
$nowtime=time();
$diff =$nowtime-$time;
//echo $email.'<br>';
$result = $dao->get(array("email"=>$email));

$flag = isset($token);
$flag = $result[0]['token']==$token?$flag:false;
$flag = $diff>60*30?false:$flag;

if($flag){
    echo "true";
}else{
    echo "false";
}
?>