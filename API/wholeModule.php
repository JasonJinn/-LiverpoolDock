<?php
/**
 * Created by PhpStorm.
 * User: shoujiafeng
 * Date: 25/04/2017
 * Time: 1:42 AM
 */
include_once '../DAO/Database.php';
include_once '../Controller/method/DES.php';
include_once '../Controller/method/tokenVerify.php';


$des = new DES('1996');
$token = $_COOKIE['token'];

if(verifyToken($token)=="false"){
    echo "token invalid";
}else {
//echo $token.'<br>';
    $dao = getQuery('module');
    //echo $token;
    $result = $dao->get();
    //print_r(array_values($result));
    $num =count($result);
    $hash = array();
    $temp = array();
    for($i=0;$i<$num;$i++){
        $temp["code"] = $result[$i]["Module_code"];
        $temp["name"] = $result[$i]["module_name"];
        $temp["description"] = $result[$i]["module_description"];

        $hash[]=$temp;
    }

    echo json_encode($hash);
}
?>